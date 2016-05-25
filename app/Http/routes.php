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
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::resource('cooperativas', 'CooperativaController');
    Route::resource('solicitudes', 'SolicitudController');
    Route::resource('tipoprestamo', 'TipoPrestamoController');
    Route::resource('credito', 'CreditoController');
    Route::resource('mineral', 'TipoMineralController');
    Route::resource('desembolso', 'DesembolsoController');
    Route::resource('amortizacion', 'AmortizacionController');
    Route::resource('reporte', 'ReporteController');
    Route::post('aprobarsolicitud', 'SolicitudController@aprobarsolicitud');

});

Route::get('API/{solicitud}', function (App\Solicitud $solicitud){
    return $solicitud;
})->middleware('throttle:3');
