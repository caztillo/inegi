<?php

namespace App\Http\Controllers;

use App\IndicadorUbicacionGeografica;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("rest.index");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $indicador
     * @param  int  $ubicacion
     * @param  int  $periodo
     * @return Response
     */
    public function show($indicador, $ubicacion=0, $periodo=0)
    {

        try
        {
            $statusCode = 200;




            $data = IndicadorUbicacionGeografica::whereHas('indicador', function($query) use ($indicador)
            {
                $query->where('indicador', '=', $indicador);


            })
                ->with('indicador')
                ->whereHas('ubicacion_geografica', function($query) use ($ubicacion)
                {
                    if(!empty($ubicacion))
                        $query->where('codigo', '=', $ubicacion);

                })
                ->with('ubicacion_geografica');



            if(!empty($periodo))
            {
                $data = $data->where('periodo', $periodo);
            }

            $data = $data->get();



            if($data->isEmpty())
            {
                $data = ['error' => true,'mensaje' => 'Sin Resultados.'];

                return \Illuminate\Support\Facades\Response::json($data, 400);
            }




        }
        catch (\Exception $e)
        {
            $statusCode = 400;
            $data = ['error' => true,'mensaje' => 'Sin Resultados.'];
        }
        finally
        {

            return \Illuminate\Support\Facades\Response::json($data, $statusCode);
        }
    }



    /**
     * Execute cURL method from url.
     *
     * @param  Request  $request
     * @return Response
     */
    public function curl(Request $request)
    {
        $url= $request->input('url');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        session_write_close(); //same site

        $body = curl_exec($ch);
        curl_close($ch);

        session_start(); // same site

        return $body;
    }

    /**
     * Generate a JSON response to graph
     *
     * @param  Request  $request
     * @return Response
     */
    public function graph(Request $request)
    {

        $json = array();
        try
        {
            $statusCode = 200;

            $url = $request->input('url');

            $segments = explode('/', $url);


            $indicador = (isset($segments[9])) ? $segments[9] : null;
            $ubicacion = (isset($segments[11])) ? $segments[11] : null;
            $periodo = (isset($segments[13])) ? $segments[13] : null;



            $data = IndicadorUbicacionGeografica::whereHas('indicador', function($query) use ($indicador)
            {
                $query->where('indicador', '=', $indicador);


            })
                ->with('indicador')
                ->whereHas('ubicacion_geografica', function($query) use ($ubicacion)
                {
                    if(!empty($ubicacion))
                        $query->where('codigo', '=', $ubicacion);

                })
                ->with('ubicacion_geografica');



            if(!empty($periodo))
            {
                $data = $data->where('periodo', $periodo);
            }

            $data = $data->orderBy('periodo','asc')->get();

            if($data->isEmpty())
            {

                return \Illuminate\Support\Facades\Response::json(['mensaje' => 'Sin Resultados.'], $statusCode);
            }

            $json = array();
            $ubicaciones = array();
            $json_keys = array();

            foreach($data as $indicador)
            {
                if(!in_array((string)$indicador->ubicacion_geografica->nombre,$ubicaciones))
                    array_push($ubicaciones,(string)$indicador->ubicacion_geografica->nombre);

                if(!in_array($indicador->periodo,$json_keys))
                    array_push($json_keys,$indicador->periodo);

                $valores[(string)$indicador->ubicacion_geografica->nombre][] = array($indicador->valor);
            }

            $json['json'] = $valores;
            $json['keys'] = $json_keys;
            $json['values'] = $ubicaciones;



        }
        catch (\Exception $e)
        {
            $statusCode = 400;
            $json = ['error' => true,'mensaje' => 'Sin Resultados.'];
        }
        finally
        {
            return \Illuminate\Support\Facades\Response::json($json, $statusCode);
        }

    }
}
