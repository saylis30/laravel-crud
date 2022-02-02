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

/*Route::get('/', function () {
    return view('userlist');
});*/

Route::get('/', 'UserController@getuserlist');
Route::get('reload-table', 'UserController@reload')->name('user-table-reload');
Route::post('add', 'UserController@add')->name('add-user');
Route::post('delete', 'UserController@delete')->name('delete-user');
Route::post('edit', 'UserController@edit')->name('edit-user');
Route::post('update', 'UserController@update')->name('update-user');
Route::get('export', 'UserController@export')->name('export-user');
