@extends('store.menu')
@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
                <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="/store">后台首页</a>
                </li>
                <li>
                    <a href="#">添加 / 编辑商品</a>
                </li>
            </ul>
        </div>


        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> 添加 / 编辑商品</h2>

                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                    class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                    class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>

                    <div class="box-content" style="min-height: 1000px;">
                        <br>
                        <form role="form" method="post" action="{{ url('/store/goods/update/'.$goods->goods_id) }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="control-group col-md-8">
                                <label class="control-label col-sm-2" for="selectError">商品分类</label>

                                <div class="controls col-sm-3">
                                    <select id="cat_id" data-rel="chosen" name="cat_id" onchange="get_category(this.value,'cat_id_2','0');" class="form-control col-sm-12">
                                        <option value="0">请选择一级分类</option>
                                        @foreach($category as $value)
                                            <option value="{{ $value->id }}"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="controls col-sm-3">
                                    <select id="cat_id_2" data-rel="chosen" name="cat_id_2" onchange="get_category(this.value,'cat_id_3','0');" class="form-control col-sm-12">
                                        <option value="0">请选择二级分类</option>
                                    </select>
                                </div>
                                <div class="controls col-sm-3">
                                    <select id="cat_id_3" data-rel="chosen" name="cat_id_3" class="form-control col-sm-12">
                                        <option value="0">请选择三级分类</option>
                                    </select>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-group col-md-8">
                                <label for="goods-name" class="col-sm-2 control-label">商品名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="goods_name" id="goods-name" value="{{ $goods->goods_name }}" placeholder="请输入商品名称">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">商品售价</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="shop_price" value="{{ $goods->shop_price }}" placeholder="请输入商品售价">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">开团人数</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="prom" value="{{ $goods->prom }}" placeholder="请输入开团人数，不能少于2人">
                                </div>
                            </div>

                            <br><br><br>
                            <div class="form-group col-md-8">
                                <label for="inputFile" class="col-sm-2 control-label">上传图片</label>
                                <div class="col-sm-10">

                                    <input type="file" name="list_img" id="list_img" value="{{ $goods->list_img }}" />
                                    @if($goods->list_img)
                                        &nbsp;&nbsp;
                                        <a target="_blank" href="{{ asset($goods->list_img) }}">
                                            <img width="80" src="{{ asset($goods->list_img) }}">
                                        </a>
                                    @endif
                                    <p class="help-block">商品分类列表、搜索展示图</p>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="inputFile" class="col-sm-2 control-label">上传图片</label>
                                <div class="col-sm-10">
                                    <input type="file" name="original_img" value="{{ $goods->original_img }}" />
                                    @if($goods->original_img)
                                        &nbsp;&nbsp;
                                        <a target="_blank" href="{{ asset($goods->original_img) }}">
                                            <img width="80" src="{{ asset($goods->original_img) }}">
                                        </a>
                                    @endif
                                    <p class="help-block">商品列表展示大图</p>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label  class="col-sm-2 control-label">商品简介</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="goods_remark" placeholder="简短商品描述" rows="3"> </textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label  class="col-sm-2 control-label">商品描述</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="goods_content" placeholder="详细商品描述" rows="6"> {{ $goods->goods_content }} </textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">商品规格与库存</label>
                                <div class="control-group col-md-10">

                                    <label class="control-label col-sm-2" for="selectError">规格</label>
                                    <div class="controls col-sm-10">
                                        <input type="radio" name="special" id="special1" value="1" /> <label  for="special1">单品</label>&nbsp;
                                        <input type="radio" name="special" id="special2" value="2" /> <label for="special2">一种规格</label>&nbsp;
                                        <input type="radio" name="special" id="special3" value="3" /> <label for="special3">两种规格</label>&nbsp;
                                    </div>
                                    <br />
                                    <br />
                                    <br />


                                    <label  class="col-sm-2 control-label">总库存</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="store_count" value="{{ $goods->store_count }}" placeholder="">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div><!--/row-->
        <!--/span-->
    </div><!-- content ends -->

<script type="text/javascript">
/**
 * 获取多级联动的商品分类
 */
function get_category(id,next,select_id){
    var url = '/store/category/getSubCategory/' + id;
    var html = '';
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            html = '<option value="0">请选择子分类</option>';
            for (var i=0; i<v.length; i++){
                html += "<option value='" + v[i]['id'] + "'>"+ v[i]['name'] +"</option>"
            }
            $('#'+next).empty().html(html);
            (select_id > 0) && $('#'+next).val(select_id);//默认选中
        }
    });
}

/** 以下是编辑时默认选中某个商品分类*/
$(document).ready(function(){

    // 商品分类第一个下拉菜单
    get_category('0','cat_id','{{ $category1->id }}');
    @if($category2->id > 0)
        // 商品分类第二个下拉菜单
        get_category('{{ $category1->id }}','cat_id_2','{{ $category2->id }}');
    @endif
    @if($category3->id > 0)
        // 商品分类第二个下拉菜单
        get_category('{{ $category2->id }}','cat_id_3','{{ $category3->id }}');
    @endif

});
</script>
@endsection
