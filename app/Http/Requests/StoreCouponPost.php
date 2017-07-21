<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:255',
            'money'             => 'required',
            'condition'         => 'required',
            'createnum'         => 'required',
            //'send_start_time'   => 'required',
            //'send_end_time'     => 'required',
            'use_start_time'    => 'required',
            'use_end_time'      => 'required',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => '请输入优惠券名称',
            'money.required'            => '请输入优惠券面额',
            'condition.required'        => '请输入优惠券使用条件',
            'createnum.required'        => '请输入优惠券数量',
            //'send_start_time.required'  => '请选择优惠券开始发放日期',
            //'send_end_time.required'    => '请选择优惠券结束发放日期',
            'use_start_time.required'   => '请选择优惠券开始使用日期',
            'use_end_time.required'     => '请选择优惠券结束使用日期',
        ];
    }
}
