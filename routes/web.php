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

use Illuminate\Support\Facades\Route as Route;

Route::get('/', 'TaskManagerController@index');

Route::post('store-task', 'TaskManagerController@store');
Route::post('delete-task/{id}', 'TaskManagerController@destroy');

