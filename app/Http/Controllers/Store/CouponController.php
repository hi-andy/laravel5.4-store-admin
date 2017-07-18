<?php

namespace App\Http\Controllers\Store;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class CouponController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 列表页
     */
    public function index()
    {
        $query = Coupon::select(
            'id',
            'name',
            'money',
            'condition',
            'createnum',
            'send_num',
            'use_num',
            'use_end_time'
        )->where('store_id', Auth::user()->id)->orderBy('id','desc')->get();
        foreach ($query as $value) {
            $value->use_end_time = date('Y-m-d', $value->use_end_time);
            $value->condition = '满 ' . $value->condition . ' 可用';
        }

        return response()->json($query);
    }

    // 添加优惠券页面
    public function create()
    {
        return view('store/coupon/create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $coupon = new Coupon();
        $coupon->name               = $request->name;
        $coupon->money              = $request->money;
        $coupon->condition          = $request->condition;
        $coupon->createnum          = $request->createnum;
        $coupon->send_start_time    = strtotime($request->send_start_time);
        $coupon->send_end_time      = strtotime($request->send_end_time);
        $coupon->use_start_time     = strtotime($request->use_start_time);
        $coupon->use_end_time       = strtotime($request->use_end_time);
        $coupon->store_id           = $request->user()->id;
        $coupon->add_time           = time();

        if (empty($coupon->name)) {
            return redirect()->back()->withInput()->with('failed', '优惠券名称不能为空！');
        }

        if ($coupon->save()) {
            return redirect('store/coupon/create')->with('success', '优惠券添加成功！');
        } else {
            return redirect()->back()->withInput()->with('failed', '优惠券添加失败！');
        }
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $coupon->send_start_time    = date('Y-m-d', $coupon->send_start_time);
        $coupon->send_end_time      = date('Y-m-d', $coupon->send_end_time);
        $coupon->use_start_time     = date('Y-m-d', $coupon->use_start_time);
        $coupon->use_end_time       = date('Y-m-d', $coupon->use_end_time);

        //return view('store/coupon/edit', ['coupon'=>$coupon]);
        return response()->json(['coupon'=>$coupon]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * 更新优惠券信息
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $coupon = Coupon::find($id);
        $coupon->name               = $request->name;
        $coupon->money              = $request->money;
        $coupon->condition          = $request->condition;
        $coupon->createnum          = $request->createnum;
        $coupon->send_start_time    = strtotime($request->send_start_time);
        $coupon->send_end_time      = strtotime($request->send_end_time);
        $coupon->use_start_time     = strtotime($request->use_start_time);
        $coupon->use_end_time       = strtotime($request->use_end_time);
        $coupon->store_id           = $request->user()->id;

        if ($coupon->save()) {
            return redirect('store/coupon/index')->with('success', '优惠券修改成功！');
        } else {
            return redirect()->back()->withInput()->with('failed', '优惠券修改失败！');
        }
    }

    /**
     * @param $id
     * @return $this
     * 删除优惠券
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect('store/coupon/index')->with('success', '优惠券删除成功！');
    }

    /**
     * type发放类型: 0面额模板1 按用户发放 2 注册 3 邀请 4 线下发放
     */
}
