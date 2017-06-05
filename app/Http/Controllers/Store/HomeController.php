<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    private $timeRange;
    public $begin;
    public $end;
    public $order_type;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $timeRange = $request->timeRange;
        $gap = $request->Input('gap', 7);
        if ($timeRange) {
            list($begin, $end) = explode('-', $timeRange);
        } else {
            $lastWeek = date('Y/m/d', (time() - $gap * 60 * 60 * 24)); //上一周
            $begin = $request->Input('begin', $lastWeek);
            $end = $request->Input('end', date('Y/m/d'));
        }

        //echo $begin;exit;
        $this->timeRange = $begin . '-' . $end;
        $this->begin = strtotime($begin);
        $this->end = strtotime($end);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * 后台首页
     */
    public function index()
    {
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

        return view('store\index\home', ['timeRange' => $this->timeRange, 'today' => $today, 'list' => $list, 'result' => $result]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 查看每日订单列表页
     */
    public function dayOrderList(Request $request)
    {
        $this->timeRange = $request->begin . ' - ' . $request->end;
        $this->begin = strtotime($request->begin);
        $this->end = strtotime($request->end);
        $query = DB::table('order_goods')
            ->leftJoin('order', 'order.order_id', '=', 'order_goods.order_id')
            ->select(
                    'order_goods.goods_num',
                    'order_goods.goods_price',
                    'order_goods.goods_name',
                    'order.order_sn',
                    'order.add_time',
                    'order.order_type',
                    'order.order_id'
                    )
            ->where('order.store_id', '=', Auth::user()->id)
            ->where('order.add_time', '>', $this->begin)
            ->where('order.add_time', '<', $this->end)
            ->orderBy('add_time')
            ->paginate(15);
        foreach($query as $value) {
            $value->add_time = date('Y-m-d H:i:s', $value->add_time);
        }
        return view('store\index\dayOrderList', ['timeRange'=>$this->timeRange, 'list'=>$query]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 时间范围内订单列表
     */
    public function rangeOrderList(Request $request)
    {
        if ($time = $request->time) {
            $begin  = date('Y/m/d', (time() - $time * 60 * 60 * 24)); //上一周
            $end = $request->Input('end', date('Y/m/d'));
            $this->timeRange = $begin . '-' . $end;
            $this->begin = strtotime($begin);
            $this->end = strtotime($end);
        }  else {
            $this->timeRange = $request->timeRange;
        }

        $query = DB::table('order_goods')
            ->leftJoin('order', 'order.order_id', '=', 'order_goods.order_id')
            ->select(
                'order_goods.goods_num',
                'order_goods.goods_price',
                'order_goods.goods_name',
                'order.order_sn',
                'order.add_time',
                'order.order_type',
                'order.order_id'
            )
            ->where('order.store_id', '=', Auth::user()->id)
            ->where('order.add_time', '>', $this->begin)
            ->where('order.add_time', '<', $this->end)
            ->orderBy('add_time')
            ->paginate(15);
        foreach($query as $value) {
            $value->add_time = date('Y-m-d H:i:s', $value->add_time);
        }
        return view('store\index\rangeOrderList', ['timeRange'=>$this->timeRange, 'time'=>$time, 'list'=>$query]);
    }
}
