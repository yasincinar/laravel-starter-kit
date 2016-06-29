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

Route::group(['middleware' => ['web']], function () {

    Route::get('/login', 'Auth\LoginController@login');
    Route::post('login-post', 'Auth\LoginController@loginPost');

    Route::group(['prefix' => 'admin', 'middleware' => 'sentinel-auth'], function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        });

    });


});

