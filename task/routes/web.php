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

Route::get('/', ['as' => 'home', 'uses' => 'UserController@home']);
Route::get('/login', ['as' => 'login', 'uses' => 'AdminController@login']);
Route::post('/submit', ['as' => 'submit', 'uses' => 'UserController@submit']);
Route::post('/submitForm', ['as' => 'submitForm', 'uses' => 'UserController@submitForm']);
Route::post('/saveChanges', ['as' => 'saveChanges', 'uses' => 'UserController@update']);
