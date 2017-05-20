<?php

namespace App\Http\Controllers\Store;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    /**
     * @param $id
     * @return mixed 返回分类列表
     */
    public function getSubCategory($id)
    {
        return DB::select('select `id`,`name`,`parent_id` from tp_goods_category where parent_id='.$id);
    }

    /**
     * @param $id
     * @return mixed 暂时无用
     */
    public function getCategory($id)
    {
        //return Category::find('select `id`,`name`,`parent_id` from tp_goods_category where id='.$id);
        return Category::find($id);
    }
}
