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

Route::get('/', function () {
     return view('welcome');
});

/* Route::get('/truefalse', function () {
    return ['hello'];
}); */

Route::group(['namespace'=>'Hearty5\TrueFalse\Controllers'],function(){
    Route::get('/truefalse', 'App\Http\Controllers\TrueFalseController@index');
    Route::get('/truefalse/{id}', 'App\Http\Controllers\TrueFalseController@show');
    Route::post('/truefalse', 'App\Http\Controllers\TrueFalseController@store');
    Route::put('/truefalse', 'App\Http\Controllers\TrueFalseController@update');
    Route::delete('/truefalse/{id}', 'App\Http\Controllers\TrueFalseController@destroy');
  });