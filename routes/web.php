<?php

use Illuminate\Support\Facades\Route;

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


//Auth::routes(['verify' => true]);


Route::get('/', 'HomeController@index');

//Single page application (SPA)
/*
 * The Laravel routing component allows all characters except "/". 
 * You must explicitly allow / to be part of your placeholder using a where condition regular expression
*/
//Route::get('/v/{any}', 'SPAController@vueroute')->where('any', '.*');
if(! request()->ajax() ){
    Route::get('/{any}', 'SPAController@vueroute')->where('any', '.*');
}