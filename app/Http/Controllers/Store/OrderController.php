<?php

namespace App\Http\Controllers\Store;

use App\Order;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 显示页面
     */
    public function index()
    {
        return view('store/order/home');
    }

    /**
     * @param Datatables $datatables
     * @return \Illuminate\Http\JsonResponse  返回订单Json数据
     */
    public function data(Datatables $datatables)
    {
//        $query = Order::where('store_id', Auth::user()->id)->where('is_show', '1')->where('prom_id', 'null')->orderBy('order_sn','desc')->get();
        $query = Order::select(
                'order_id',
                'order_sn',
                'consignee',
                'total_amount',
                'order_amount',
                'order_type',
                'pay_status',
                'shipping_status',
                'pay_name',
                'shipping_name',
                'add_time'
        )->where('store_id', Auth::user()->id)->where('is_show', '1')->orderBy('order_sn','desc')->get();
        foreach ($query as $value) {
            $value->pay_time = date('Y-m-d H:i:s', $value->pay_time);
            $value->add_time = date('Y-m-d H:i:s', $value->add_time);
            $value->shipping_status = $value->shipping_status ? '已发货' : '未发货';
            $value->pay_status = $value->pay_status ? '已付款' : '未付款';
            $value->order_type = $this->transferStatus($value->order_type);
        }

        return $datatables->collection($query)
            ->addColumn('action', 'store.order.user-action')
            ->make(true);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('store/order/show', ['order'=>$order]);
    }

    /*
     * 订单状态 单买状态：
     * 1、待付款
     * 2、待发货
     * 3、待收货
     * 4、已完成
     * 5、已取消
     * 6、待退款
     * 7、已退款、
     * 8、待退货
     * 9、已退货 团购状态
     * 10、拼团中，未付款
     * 11、拼团中，已付款
     * 12、未成团，待付款
     * 13、未成团，已退款
     * 14、已成团，待发货
     * 15、已成团，待收货
     * */
    private function transferStatus($status)
    {
        switch ($status) {
            case 1 :
                return '待付款';
                break;
            case 2 :
                return '待发货';
                break;
            case 3 :
                return '待收货';
                break;
            case 4 :
                return '已完成';
                break;
            case 5 :
                return '已取消';
                break;
            case 6 :
                return '待退款';
                break;
            case 7 :
                return '已退款';
                break;
            case 8 :
                return '待退货';
                break;
            case 9 :
                return '已退货';
                break;
            case 10 :
                return '拼团中，未付款';
                break;
            case 11 :
                return '拼团中，已付款';
                break;
            case 12 :
                return '未成团，待付款';
                break;
            case 13 :
                return '未成团，已退款';
                break;
            case 14 :
                return '已成团，待发货';
                break;
            case 15  :
                return '已成团，待收货';
                break;
        }
    }

}
