<?php
/**
 * 商品分类控制器
 */
namespace App\Http\Controllers\Store;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    /**
     * @param $id
     * @return mixed 返回给定 id 的子分类列表
     */
    public function getSubCategory($id)
    {
        return DB::select('select `id`,`name`,`parent_id` from tp_goods_category where parent_id='.$id);
    }

    /**
     * @param $id
     * @return mixed 返回给定 id 的分类信息
     */
    public function getCategory($id)
    {
        return Category::find($id);
    }
}
