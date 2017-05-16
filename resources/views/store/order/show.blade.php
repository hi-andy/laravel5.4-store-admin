@extends('store.menu')
@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">后台主页</a>
                </li>
                <li>
                    <a href="#">订单详情</a>
                </li>
            </ul>
        </div>

        {{ $order->order_id }}
        {{ $order->order_sn }}


        <!-- content ends -->
    </div><!--/#content.col-md-0-->



@endsection
