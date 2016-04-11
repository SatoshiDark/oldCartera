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
//<?php
///*
// * Same configuration as Laravel 5.2:
// * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
// */
//Route::group(['middleware' => 'web'], function () {
//    Route::auth();
//
//    Route::get('/', 'HomeController@index');
//    Route::get('/home', 'HomeController@index');
//    Route::resource('cooperativas', 'CooperativaController');
//
//});
