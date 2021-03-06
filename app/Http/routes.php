<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', array('uses' => 'SoapController@index'));

Route::get('/soap', array('uses' => 'SoapController@index'));
Route::post('/soap-webservice', array('uses' => 'SoapController@webservice'));


Route::get('/rest', array('uses' => 'RestController@index'));
Route::post('/curl', array('uses' => 'RestController@curl'));
Route::get('/graph', array('uses' => 'RestController@graph'));

Route::group(array('prefix' => 'rest/api/v1'), function()
{
    Route::resource('indicador.ubicacion.periodo', 'RestController', array('only' => 'show'));
    Route::resource('indicador.ubicacion', 'RestController', array('only' => 'show'));
    Route::resource('indicador', 'RestController', array('only' => 'show'));
});