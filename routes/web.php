<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

//Route::get('/', 'ApplicationController@index');

Route::group([

    'prefix' => 'admin',

], function ($router) {

   
    Route::resource('oa', 'OasController')->only([
        'index', 'show'
    ]);
    

});

Route::get('/{path}', 'ApplicationController@index')->where('path', '(.*)');