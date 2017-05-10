<?php

namespace App\Http\Controllers\Store;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $request = new Request();
        $count = Order::where('store_id', '910')->count();

        $per = '4';
        $pageNums = ceil($count/$per);
        $page = $request->input('page');
        if(empty($page)){
            $page = "1";
        }
        $prev = ($page-1) > 0 ? $page-1 : 1;
        $next = ($page+1) < $pageNums ? $page+1 : $pageNums;
        $offset = ($page-1)*$per;

        $data = Order::where('store_id', '>', 910)->paginate(15);
        //print_r($data);
        $pp = array();
        for($i=1;$i<=$pageNums;$i++){
            $pp[$i]=$i;
        }
        return view('store/order/home',['data'=>$data,'prev'=>$prev,'next'=>$next,'sums'=>$pageNums,'pp'=>$pp,'page'=>$page]);
        //return view('store/order/home');
    }

}
