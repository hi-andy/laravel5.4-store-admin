<?php
/**
 * 退货处理控制器
 */
namespace App\Http\Controllers\Store;

use App\Refund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class RefundController extends Controller
{
    public function index()
    {
        return view('store/refund/home');
    }

    public function data(Datatables $datatables)
    {
        $query = Refund::select(
            'return_goods.order_sn',
            'goods.goods_name',
            'return_goods.type',
            'return_goods.addtime',
            'return_goods.status')
            ->join('goods','return_goods.goods_id', '=', 'goods.goods_id')
            ->where('return_goods.store_id', Auth::user()->id)->where('is_prom', 0)->orderBy('return_goods.order_sn','desc')->get();
        foreach ($query as $value) {
            $value->addtime = date('Y-m-d H:i:s', $value->addtime);
            $value->pay_status = $value->pay_status ? '已付款' : '未付款';
            $value->type = $value->pay_status ? '换货' : '退货';
            $value->status = $value->status==0 ? '未处理' : ($value->status==1 ? '客服处理中' : '已完成');
        }
        return $datatables->collection($query)
            ->addColumn('action', 'store.refund.user-action')
            ->make(true);
    }
}
