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

Route::get('/dashboard', 'HomeController@index');
Route::get('/done-tickets', 'HomeController@done');
Route::post('/ap-assign/{id}','HomeController@update');
Route::post('/remarks/{id}','HomeController@remarks');
Route::get('/check-status','HomeController@checkStatus');
