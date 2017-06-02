<?php
/**
 * 提现控制器
 */
namespace App\Http\Controllers\Store;

use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class WithdrawalController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 列表页
     */
    public function index()
    {
        return view('store/withdrawal/home');
    }

    /**
     * @param Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     * 返回列表 Json 数据
     */
    public function data(Datatables $datatables)
    {
        $query = Withdrawal::select(
            'withdrawal_money',
            'withdrawal_type',
            'withdrawal_code',
            'datetime',
            'status',
            'handletime'
        )->where('store_id', Auth::user()->id)->orderBy('sw_id','desc')->get();
        foreach ($query as $value) {
            $value->status = $value->status == 0 ? '申请中' : ($value->status == 1 ? '同意提现' : '拒绝提现');
        }
        return $datatables->collection($query)
            ->make(true);
    }

    // 添加页面
    public function create()
    {
        $amount_money = $this->withdrawal_money(Auth::user()->id);
        return view('store/withdrawal/create', ['amount_money'=>$amount_money]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 保存提现申请记录
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'withdrawal_money' => 'required|max:255',
        ]);

        if (empty($request->withdrawal_money) || $request->withdrawal_money % 500 != 0) {
            return redirect()->back()->withInput()->with('failed', '提现金额不能为空，且必须为500的倍数！');
        }
        if ($request->withdrawal_money > $this->withdrawal_money(Auth::user()->id)) {
            return redirect()->back()->withInput()->with('failed', '提现余额不足！');
        }
        if (empty($request->withdrawal_code)) {
            return redirect()->back()->withInput()->with('failed', '请正确输入提现账号！');
        }
        $today = date('Y-m-d', time());
        $count = Withdrawal::where('store_id', Auth::user()->id)->whereDate('datetime', $today)->orderBy('id', 'desc')->count();
        if ($count) {
            return redirect()->back()->withInput()->with('failed', '一天只能提现一次！');
        }

        $withdrawal = new Withdrawal();
        $withdrawal->withdrawal_money      = $request->withdrawal_money;
        $withdrawal->withdrawal_type       = $request->withdrawal_type;
        $withdrawal->withdrawal_code       = $request->withdrawal_code;
        $withdrawal->status                = 0;
        $withdrawal->end_time              = time();
        $withdrawal->store_name            = Auth::user()->store_name;
        $withdrawal->store_id              = $request->user()->id;
        $withdrawal->datetime              = date('Y-m-d H:i:s');

        if ($withdrawal->save()) {
            return redirect('store/withdrawal/create')->with('success', '提现申请提交成功，请等待平台审核！');
        } else {
            return redirect()->back()->withInput()->with('failed', '提现申请提交失败，请联系管理员！');
        }
    }

    /**
     * @param $store_id
     * @return int 返回可提现金额
     */
    private function withdrawal_money($store_id)
    {
        $time = time() - 3600 * 24 * 2; // 已确认收货48小时的订单
        //订单总额
        $order_amount = \App\Order::where('store_id', '=', $store_id)
                                    ->where('confirm_time', '<>', null)
                                    ->where('confirm_time', '<', $time)
                                    ->where(function ($query) {
                                        $query->where('order_type', '=', 4)
                                        ->orWhere('order_type', '=', 16)
                                        ->orWhere('order_type', '=', 7)
                                        ->orWhere('order_type', '=', 6);
                            })->sum('order_amount');
        //获取以前的提现总额
        $withdrawal_money = Withdrawal::where('store_id', '=', $store_id)
                                        ->where(function ($query) {
                                            $query->where('status', '=', 1)
                                                ->orWhere('status', '=', 0 );
                                        })->sum('withdrawal_money');

        return sprintf("%.2f", $order_amount - $withdrawal_money);
    }

}
