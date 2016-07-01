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

    Route::get('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/login-post', 'Auth\LoginController@loginPost')->name('login-post');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['prefix' => 'admin', 'middleware' => 'sentinel-auth'], function () {

        Route::get('/dashboard', 'Admin\DashboardController@getDashboard')->name('admin.dashboard');

    });
