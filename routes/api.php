<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// 商家后台路由组
Route::group(['middleware' => 'auth:api', 'namespace' => 'Store'], function() {

    // 后台主页
    Route::get('/index', 'HomeController@index');
    Route::get('/dayOrderList/begin/{begin}/end/{end}', 'HomeController@dayOrderList');
    Route::any('/rangeOrderList', 'HomeController@rangeOrderList');
    Route::match(['post','get'], '/rangeOrderList', 'HomeController@rangeOrderList');

    // 订单
    Route::get('/order/index',       'OrderController@index');
    //Route::get('/order/index',       function () { echo Auth::guard('api')->id(); });
    Route::resource('order/show',   'OrderController');

    // 发货单
    Route::get('delivery/index',    'DeliveryController@index');
    Route::get('delivery/data',     'DeliveryController@data');

    // 退货单
    Route::get('refund/index',      'RefundController@index');
    Route::get('refund/data',       'RefundController@data');

    // 商品
    Route::get('goods/index',           'GoodsController@index');
    Route::get('goods/data',            'GoodsController@data');
    Route::get('goods/create',          'GoodsController@create');
    Route::post('goods/ajaxStore',      'GoodsController@ajaxStore');
    Route::post('goods/store',          'GoodsController@store');
    Route::get('goods/edit/{id}',       'GoodsController@edit');
    Route::post('goods/update/{id}',    'GoodsController@update');
    Route::post('goods/destroy/{id}',   'GoodsController@destroy');

    // 商品分类
    Route::get('category/getSubCategory/{id}',  'CategoryController@getSubCategory');

    // 优惠券
    Route::get('coupon/index',           'CouponController@index');
    Route::post('coupon/store',          'CouponController@store');
    Route::get('coupon/show/{id}',       'CouponController@show');
    Route::post('coupon/update/{id}',    'CouponController@update');
    Route::post('coupon/destroy/{id}',   'CouponController@destroy');

    // 提现
    Route::get('withdrawal/index',           'WithdrawalController@index');
    Route::get('withdrawal/data',            'WithdrawalController@data');
    Route::get('withdrawal/create',          'WithdrawalController@create');
    Route::post('withdrawal/store',          'WithdrawalController@store');

});