<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
  'prefix' => 'auth'
], function () {
  Route::post('login', 'App\Http\Controllers\AuthController@login');
  Route::post('registration', 'App\Http\Controllers\AuthController@registration');
  Route::post('logout', 'App\Http\Controllers\AuthController@logout');
  Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
  Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('roles', 'UserRolesController@index');
    Route::get('roles/{id}', 'UserRolesController@show');
    Route::post('roles', 'UserRolesController@store');
    Route::post('roles/{id}', 'UserRolesController@update');
    Route::delete('roles/{id}', 'UserRolesController@destroy');

    Route::get('user', 'UserController@index');
    Route::get('user/{id}', 'UserController@show');
    Route::post('user', 'UserController@store');
    Route::post('user/{id}', 'UserController@update');
    Route::delete('user/{id}', 'UserController@destroy');

    Route::get('profile', 'ProfileController@index');
    Route::get('profile/{id}', 'ProfileController@show');
    Route::post('profile', 'ProfileController@store');
    Route::post('profile/{id}', 'ProfileController@update');
    Route::delete('profile/{id}', 'ProfileController@destroy');
});
