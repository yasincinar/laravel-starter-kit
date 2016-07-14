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

Route::get('asd', function(){
    \App\Models\User::create([
        'email' => 'admin2@admin.com',
        'password' => 'admin2',
        'first_name' => 'Admin2',
        'last_name' => 'Admin2',
        'slug' => 'admin2',
        'cell_phone' => 1122111111111,
        'identity_number' => 1221111111111,
        'city_id' => 36
    ]);
});

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login-post', 'Auth\LoginController@loginPost')->name('login-post');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['sentinel-auth', 'authorization']], function () {

    Route::group(['prefix' => 'ajax'], function () {

        Route::post('/common/slug', 'Admin\CommonController@postSlug');
    });

    Route::get('/dashboard', 'Admin\DashboardController@getDashboard')->name('admin.dashboard');

    Route::resource('/users-groups/users', 'Admin\UserController');
    Route::resource('/users-groups/groups', 'Admin\GroupController');

});
