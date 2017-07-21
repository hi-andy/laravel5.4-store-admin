<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        $store_id = Auth::guard('api')->id();

        $query = \App\Order::select(
            'order_sn',
            'consignee',
            'total_amount',
            'mobile',
            'pay_time',
            'add_time'
        )->where('store_id', $store_id)->orderBy('order_sn','desc')->get();

        foreach ($query as $value) {
            $value->pay_time = date('Y-m-d H:i:s', $value->pay_time);
            $value->add_time = date('Y-m-d H:i:s', $value->add_time);
        }

        return $this->toClient(200, 'ok', $query);
    }

}
