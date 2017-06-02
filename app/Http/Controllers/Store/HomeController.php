<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public $begin;
    public $end;
    public $order_type;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $timeRange = $request->timeRange;
        $gap = $request->Input('gap', 7);
        if ($timeRange) {
            list($begin, $end) = explode('-', $timeRange);
        } else {
            $lastWeek = date('Y-m-d', (time() - $gap * 60 * 60 * 24)); //上一周
            $begin = $request->Input('begin', $lastWeek);
            $end = $request->Input('end', date('Y-m-d'));
        }
        $timeRange = $begin . '-' . $end;
        $this->begin = strtotime($begin);
        $this->end = strtotime($end);
        //起始时间
        $now = strtotime(date('Y-m-d')); $tomorrow = $now + 24 * 3600;
        //今日销售总额
        $today['today_amount'] = \App\Order::where('store_id', '=', Auth::user()->id)->where('add_time', '>', $now)->where('add_time', '<', $tomorrow)->where('pay_status', 1)->sum('order_amount');
        //计算今日订单数
        $today['today_order'] = \App\Order::where('store_id', '=', Auth::user()->id)->where('add_time', '>', $now)->where('add_time', '<', $tomorrow)->where('pay_status', 1)->count();
        //今日取消订单
        $today['cancel_order'] = \App\Order::where('store_id', '=', Auth::user()->id)->where('add_time', '>', $now)->where('add_time', '<', $tomorrow)->where('is_cancel', 1)->count();
        //待发货订单数     order_type=2 OR order_type=14 //待发货；已成团待发货
        $today['undelivered_order'] = \App\Order::where('store_id', '=', Auth::user()->id)->where(function ($query) {
            $query->where('order_type', 2)->orWhere('order_type', 14);
        })->count();
        //售后订单数
        $today['service_order'] = \App\Refund::where('store_id', '=', Auth::user()->id)->where('status', 0)->count();
        //总销售额
        $today['sign'] = \App\Order::where('store_id', '=', Auth::user()->id)->where('pay_status', 1)->sum('order_amount');
        // 获取以日期（天）分组的订单数据：订单数，销售额
        $res = DB::table('order')
            ->select(DB::raw('count(*) as tnum, SUM(order_amount) as amount, FROM_UNIXTIME(add_time, \'%Y-%m-%d\') as gap'))
            ->where('store_id', '=', Auth::user()->id)
            ->where('add_time', '>', $this->begin)
            ->where('add_time', '<', $this->end + 24 * 3600)
            ->where('pay_status', '=', 1)
            ->groupBy('gap')
            ->get();
        for ($i = 0; $i < count($res); $i++) {
            if ($i == 0) {
                $res[$i]->all = $res[$i]->amount;
            } else {
                $res[$i]->all = $res[$i - 1]->all + $res[$i]->amount;
            }
        }

        $tamount = $tnum = $all = null;
        foreach ($res as $val) {
            $arr[$val->gap] = $val->tnum;
            $brr[$val->gap] = $val->amount;
            $crr[$val->gap] = $val->all;
            $all += $val->all;
            $tnum += $val->tnum;
            $tamount += $val->amount;
        }

        for ($i = $this->begin; $i <= $this->end; $i = $i + 24 * 3600) {
            $tmp_num = empty($arr[date('Y-m-d', $i)]) ? 0 : $arr[date('Y-m-d', $i)];
            $tmp_amount = empty($brr[date('Y-m-d', $i)]) ? 0 : $brr[date('Y-m-d', $i)];
            $all_num = empty($crr[date('Y-m-d', $i)]) ? 0 : $crr[date('Y-m-d', $i)];
            $tmp_sign = empty($tmp_num) ? 0 : round($tmp_amount / $tmp_num, 2);
            $all_arr[] = $all_num;
            $order_arr[] = $tmp_num;
            $amount_arr[] = $tmp_amount;
            $sign_arr[] = $tmp_sign;
            $date = date('Y-m-d', $i);
            $list[] = array('day' => $date, 'order_num' => $tmp_num, 'amount' => $tmp_amount, 'sign' => $tmp_sign, 'all' => $all_num, 'end' => date('Y-m-d', $i + 24 * 60 * 60));
            $day[] = $date;
        }
        for ($i = 0; $i < count($list); $i++) {
            if ($list[$i]['all'] == 0 && $i != 0) {
                $list[$i]['all'] = $list[$i - 1]['all'];
            }
        }
        rsort($list);

        $result = array('order' => $order_arr, 'amount' => $amount_arr, 'sign' => $sign_arr, 'all' => $all_arr, 'time' => $day);
        $collection = collect($result);
        $result = $collection->toJson();

        return view('store\home', ['timeRange' => $timeRange, 'today' => $today, 'list' => $list, 'result' => $result]);
    }
}
