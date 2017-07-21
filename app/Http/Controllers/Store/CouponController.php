<?php

namespace App\Http\Controllers\Store;

use App\Coupon;
use App\Http\Requests\StoreCouponPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 列表
     */
    public function index()
    {
        $store_id = Auth::guard('api')->id();

        $query = Coupon::select(
            'id',
            'name',
            'money',
            'condition',
            'createnum',
            'send_num',
            'use_num',
            'use_end_time'
        )->where('store_id', $store_id)->orderBy('id','desc')->paginate(15);
        foreach ($query as $value) {
            $value->use_end_time = date('Y-m-d', $value->use_end_time);
            $value->condition = '满 ' . $value->condition . ' 可用';
        }

        return $this->toClient(200, 'ok', $query);
    }

    /**
     * 创建
     *
     * @param StoreCouponPost $request
     */
    public function store(StoreCouponPost $request)
    {
        $store_id = Auth::guard('api')->id();

        $coupon = new Coupon();
        $coupon->name               = $request->name;
        $coupon->money              = $request->money;
        $coupon->condition          = $request->condition;
        $coupon->createnum          = $request->createnum;
        $coupon->send_start_time    = strtotime($request->send_start_time);
        $coupon->send_end_time      = strtotime($request->send_end_time);
        $coupon->use_start_time     = strtotime($request->use_start_time);
        $coupon->use_end_time       = strtotime($request->use_end_time);
        $coupon->store_id           = $store_id;
        $coupon->add_time           = time();

        if ($coupon->save()) {
            return $this->toClient(201, 'created');
        } else {
            return $this->toClient(500, 'failed');
        }
    }

    /**
     * 详情
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $store_id = Auth::guard('api')->id();
        $coupon = Coupon::where('store_id', $store_id)->find($id);
        $coupon->send_start_time    = date('Y-m-d', $coupon->send_start_time);
        $coupon->send_end_time      = date('Y-m-d', $coupon->send_end_time);
        $coupon->use_start_time     = date('Y-m-d', $coupon->use_start_time);
        $coupon->use_end_time       = date('Y-m-d', $coupon->use_end_time);
        $coupon->add_time       = date('Y-m-d', $coupon->_time);

        return $this->toClient(200, 'ok', $coupon);
    }

    /**
     * 更新/修改
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCouponPost $request, $id)
    {
        $store_id = Auth::guard('api')->id();

        $coupon = Coupon::find($id);
        $coupon->name               = $request->name;
        $coupon->money              = $request->money;
        $coupon->condition          = $request->condition;
        $coupon->createnum          = $request->createnum;
        $coupon->send_start_time    = strtotime($request->send_start_time);
        $coupon->send_end_time      = strtotime($request->send_end_time);
        $coupon->use_start_time     = strtotime($request->use_start_time);
        $coupon->use_end_time       = strtotime($request->use_end_time);
        $coupon->store_id           = $store_id;

        if ($coupon->save()) {
            return $this->toClient(201, 'created');
        } else {
            return $this->toClient(500, 'failed');
        }
    }

    /**
     * 删除
     *
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $store_id = Auth::guard('api')->id();
        Coupon::where('store_id', $store_id)->find($id)->delete();
        return $this->toClient(200, 'ok');
    }

    /**
     * type发放类型: 0面额模板1 按用户发放 2 注册 3 邀请 4 线下发放
     */
}
