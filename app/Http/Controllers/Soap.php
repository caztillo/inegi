<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class Soap extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return view("soap.index");




    }

    /**
     * Display SOAP XML Object
     *
     * @return Response
     */
    public function webservice(Request $request)
    {

        $client = new \SoapClient("http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL", array('trace' => true));
        $indicador = 1002000001;
        $ubicacionGeografica = 32;

        if($request->has("indicador"))
            $indicador = $request->input("indicador");
        if($request->has("ubicacion_geografica"))
            $ubicacionGeografica = $request->input("ubicacion_geografica");

        $content = $client->obtieneValoresOportunos(["Indicador" =>$indicador, "ubicacionGeografica" => $ubicacionGeografica]);


        return Response($content->obtieneValoresOportunosResult->any,200)->header('Content-Type', 'text/xml');;
        //echo $content->obtieneValoresOportunosResult->any;
        /*
        foreach ($dom->getElementsByTagNameNS('*', 'Obs') as $element) {
            $item = [];
            foreach($element->attributes as $attr){
                $item[$attr->nodeName] = $attr->nodeValue;
            }
            $collection[] = $item;
        }

        echo $collection[0]["OBS_VALUE"];*/

    }
}
