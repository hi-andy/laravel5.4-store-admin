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

// 商家后台路由组
Route::group(['middleware' => 'auth', 'namespace' => 'Store', 'prefix' => 'store'], function() {
    Route::get('/', 'HomeController@index');
//    Route::resource('order', 'OrderController');

    // 订单
    Route::get('order/index',       'OrderController@index');
    Route::get('order/data',        'OrderController@data');
    Route::resource('order/show',   'OrderController');

    //发货单
    Route::get('delivery/index',    'DeliveryController@index');
    Route::get('delivery/data',     'DeliveryController@data');

    //退货单
    Route::get('refund/index',      'RefundController@index');
    Route::get('refund/data',       'RefundController@data');

    // 商品
    Route::get('goods/index',       'GoodsController@index');
    Route::get('goods/data',        'GoodsController@data');
    Route::get('goods/create',      'GoodsController@create');
    Route::post('goods/store',      'GoodsController@store');
    Route::get('goods/edit/{id}',   'GoodsController@edit');
    Route::post('goods/update/{id}',   'GoodsController@update');
    Route::post('goods/delete/{id}',   'GoodsController@delete');

    // 商品分类
    Route::get('category/getSubCategory/{id}',  'CategoryController@getSubCategory');

});


Route::get('eloquent/array', 'Eloquent\ArrayResponseController@index');
Route::get('eloquent/array-data', 'Eloquent\ArrayResponseController@data');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
