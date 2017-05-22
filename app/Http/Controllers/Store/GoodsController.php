<?php

namespace App\Http\Controllers\Store;

use App\Goods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class GoodsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品列表页面
     */
    public function index()
    {
        return view('store/goods/home');
    }

    /**
     * @param Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     * 返回商品列表 Json 数据
     */
    public function data(Datatables $datatables)
    {
        $query = Goods::select(
            'goods_id',
            'goods_name',
            'is_special',
            'cat_id',
            'shop_price',
            'store_count',
            'is_audit',
            'is_on_sale',
            'is_show'
        )->where('store_id', Auth::user()->id)->orderBy('goods_id','desc')->get();
        foreach ($query as $value) {
            $value->is_audit = $value->is_audit == 0 ? '待审核' : ($value->is_audit == 1 ? '审核通过' : '审核未通过');
        }

        return $datatables->collection($query)
            ->addColumn('action', 'store.goods.user-action')
            ->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 添加新商品
     */
    public function create()
    {
        $cat = new CategoryController();
        $category = $cat->getSubCategory('0');
        return view('store/goods/create', ['category'=>$category]);
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 保存新增商品信息
     */
    public function store(Request $request)
    {
//        $messages = [
//            'goods_name'    => 'The :attribute and :other must match.',
//            'cat_id'    => 'The :attribute must be exactly :size.',
//            'prom' => 'The :attribute must be greatThan :min',
//            'shop_price'      => '请填写销售价格',
//        ];
        $this->validate($request, [
            'goods_name' => 'required|max:255',
            'store_count'   => 'nullable',
        ]);

        /**
         * 两种方法获取输入数据
         * $goods_name = $request->goods_name;
         * $goods_name = $request->input('goods_name', '可以此作为默认的商品名称');
         */
        $goods = new Goods();
        $goods->cat_id          = $request->cat_id_3 ? $request->cat_id_3 : $request->cat_id_2;
        $goods->goods_name      = $request->goods_name;
        $goods->shop_price      = $request->shop_price;
        $goods->prom            = $request->prom;
        $goods->store_count     = $request->input('store_count', 10);
        $goods->goods_content   = $request->goods_content;
        $goods->goods_remark    = $request->goods_remark;
        $goods->store_id        = $request->user()->id;
        $goods->addtime         = time();
        $goods->list_img = $request->file('list_img')->store('public/goods/list_img');
        $goods->original_img = $request->file('original_img')->store('public/goods/original_img');

        // 确认上传图片是否有效
        if (!$goods->list_img) {
            return redirect('store/goods/create')->with('failed', '请上传商品列表展示图片！');
        }
        if (empty($goods->shop_price)) {
            return redirect()->back()->withInput()->with('failed', '商品售价不能为空！');
        }


        if ($goods->save()) {
            return redirect('store/goods/create')->with('success', '商品添加成功！');
        } else {
            return redirect()->back()->withInput()->with('failed', '保存失败！');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 显示修改商品信息
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        $cat = new CategoryController();
        $category = $cat->getSubCategory('0');
        $category3 = $cat->getCategory($goods->cat_id);
        $category2 = $cat->getCategory($category3->parent_id);
        $category1 = $cat->getCategory($category2->parent_id);
        //print_r($category1->name);
        //dd($goods);
        return view('store/goods/edit', ['goods'=>$goods,'category'=>$category,'category1'=>$category1,'category2'=>$category2,'category3'=>$category3]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * 更新商品信息
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'goods_name' => 'required|max:255',
            'store_count'   => 'nullable',
        ]);

        $goods = Goods::find($id);
        $goods->cat_id          = $request->cat_id_3 ? $request->cat_id_3 : $request->cat_id_2;
        $goods->goods_name      = $request->goods_name;
        $goods->shop_price      = $request->shop_price;
        $goods->prom            = $request->prom;
        $goods->store_count     = $request->input('store_count', 10);
        $goods->goods_content   = $request->goods_content;
        $goods->goods_remark    = $request->goods_remark;
        $goods->store_id        = $request->user()->id;
        $goods->addtime         = time();



        // 确认上传图片是否有效
        if ($request->hasFile('list_img')) {
            $goods->list_img = $request->file('list_img')->store('public/goods/list_img');
        } else {
            return redirect('store/goods/edit/'.$goods->goods_id)->with('failed', '请上传商品列表展示图片！');
        }
        if ($request->hasFile('original_img')) {
            $goods->original_img = $request->file('original_img')->store('public/goods/original_img');
        } else {
            return redirect('store/goods/edit/'.$goods->goods_id)->with('failed', '请上传商品列表大图图片！');
        }
        if (empty($goods->shop_price)) {
            return redirect()->back()->withInput()->with('failed', '商品售价不能为空！');
        }

        if ($goods->save()) {
            return redirect('store/goods/index')->with('success', '商品修改成功！');
        } else {
            return redirect()->back()->withInput()->with('failed', '修改失败！');
        }
    }

    /**
     * @param $id
     * @return $this
     * 删除商品
     */
    public function destroy($id)
    {
        Goods::find($id)->delete();
        return redirect('store/goods/index')->with('success', '商品删除成功！');
    }
}
