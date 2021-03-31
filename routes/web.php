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

Route::get('/', 'TestController@index')->name('index');
Route::get('/auth', 'TestController@auth')->name('auth');
Route::get('/logout', 'TestController@logout')->name('logout');
Route::get('/export', 'TestController@export')->name('export');
Route::get('/get', 'TestController@get')->name('get');
Route::post('/set', 'TestController@set')->name('set');
