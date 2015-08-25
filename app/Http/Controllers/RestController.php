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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $indicador
     * @param  int  $ubicacion
     * @param  int  $periodo
     * @return Response
     */
    public function show($indicador, $ubicacion, $periodo)
    {

        try
        {
            $statusCode = 200;



            $response = IndicadorUbicacionGeografica::with(['indicador' => function($query) use ($indicador)
            {
                $query->where('indicador',$indicador);
            }, 'ubicacion_geografica' => function($query) use ($ubicacion)
            {
                $query->where('codigo',$ubicacion);
            }])->where('periodo','=',$periodo)->get();

            /*$response = IndicadorUbicacionGeografica::whereHas('indicador', function($query) use ($indicador)
            {
                $query->where('indicador','=',$indicador);
            })->whereHas('ubicacion_geografica', function($query) use ($ubicacion)
            {
                $query->where('codigo','=',$ubicacion);
            })->where('periodo','=',$periodo)->get();*/

        }
        catch (Exception $e)
        {
            $statusCode = 400;
        }
        finally
        {
            return \Illuminate\Support\Facades\Response::json($response, $statusCode);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
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
}
