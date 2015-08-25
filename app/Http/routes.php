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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/soap-inegi', array('uses' => 'SoapController@index'));
Route::post('/soap-inegi-webservice', array('uses' => 'SoapController@webservice'));


Route::get('/rest-inegi', array('uses' => 'RestController@index'));
Route::post('/curl', array('uses' => 'RestController@curl'));



Route::group(array('prefix' => 'rest-inegi/api/v1'), function()
{
    Route::resource('indicador.ubicacion.periodo', 'RestController', array('only' => 'show'));
});