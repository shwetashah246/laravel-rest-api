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

Route::middleware(['json.response'])->group(function () {
	Route::post('register', 'Api\AuthController@register');
	Route::post('login', 'Api\AuthController@login');
});

Route::middleware(['auth:api','json.response'])->group(function () {
	Route::post('logout', 'Api\AuthController@logout');
	Route::get('users', 'Api\UserController@index');
	Route::post('users', 'Api\UserController@store');
	Route::get('users/{id}', 'Api\UserController@show');
	Route::delete('users/{id}', 'Api\UserController@destroy');
	Route::post('add-score/{id}', 'Api\UserController@plusScore');
	Route::post('delete-score/{id}', 'Api\UserController@minusScore');
});