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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth', 'namespace' => 'Store', 'prefix' => 'store'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('order', 'OrderController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
