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

Route::get('/', 'ExpenseController@index');
Route::post('/rows', 'ExpenseController@getCsvRowCount');
Route::post('/import', 'ExpenseController@import');
Route::resource('expense', 'ExpenseController')->only([ 'index', 'store', 'destroy', 'update']);
