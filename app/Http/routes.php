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


Route::get('/', function () {
    return view('welcome');
});

*/

Route::get("/","SignUpController@index");

Route::get("userSingUp","SignUpController@index");
Route::get("userSingUp/{id}","SignUpController@show");
Route::post("userSingUp","SignUpController@store");
Route::put("userSingUp/{id}","SignUpController@update");
Route::delete("userSingUp/{id}","SignUpController@destroy");
