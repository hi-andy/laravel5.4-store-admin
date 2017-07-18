<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('store/delivery/home');
    }

    public function data(Datatables $datatables)
    {
        $query = \App\Order::select(
            'order_sn',
            'consignee',
            'total_amount',
            'mobile',
            'pay_time',
            'add_time'
        )->where('store_id', Auth::user()->id)->orderBy('order_sn','desc')->get();
        foreach ($query as $value) {
            $value->pay_time = date('Y-m-d H:i:s', $value->pay_time);
            $value->add_time = date('Y-m-d H:i:s', $value->add_time);
        }

        return $datatables->collection($query)
            ->addColumn('action', 'store.delivery.user-action')
            ->make(true);
    }
}
