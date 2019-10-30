<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    # AUTH
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'Auth\RegisterController@create');
    Route::post('me', 'AuthController@me');
    # END AUTH

});

Route::group([

    'middleware' => 'api',

], function ($router) {

    # API
    Route::get('oa_adaptation', 'Api\AdaptationController@adaptation');
    Route::post('oa_adaptation', 'Api\AdaptationController@adaptation');
    # END API

});