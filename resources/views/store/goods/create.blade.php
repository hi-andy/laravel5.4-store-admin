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
                        <form role="form" method="post" onsubmit="return false" action="{{ url('/goods/store') }}" enctype="multipart/form-data">
                            {{--{!! csrf_field() !!}--}}
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
                                    <input type="text" class="form-control" name="goods_name" id="goods-name" placeholder="请输入商品名称">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">商品售价</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="shop_price" placeholder="请输入商品售价">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">开团人数</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="prom" placeholder="请输入开团人数，不能少于2人">
                                </div>
                            </div>

                            <br><br><br>
                            <div class="form-group col-md-8">
                                <label for="inputFile" class="col-sm-2 control-label">上传图片</label>
                                <div class="col-sm-10">
                                    <input type="file" name="list_img" >
                                    <p class="help-block">商品分类列表、搜索展示图</p>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="inputFile" class="col-sm-2 control-label">上传图片</label>
                                <div class="col-sm-10">
                                    <input type="file" name="original_img" >
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
                                    <textarea class="form-control" name="goods_content" placeholder="详细商品描述" rows="6"> </textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-10">
                                <label class="col-sm-2 control-label">商品规格与库存</label>
                                <div class="control-group col-md-10">

                                    <label class="control-label col-sm-2" for="selectError">规格</label>
                                    <div class="controls col-sm-10">
                                        <input type="radio" name="type" checked="checked" value="1" /> <label  for="special1">单品</label>&nbsp;
                                        <input type="radio" name="type" value="2" /> <label for="special2">一种规格</label>&nbsp;
                                        <input type="radio" name="type" value="3" /> <label for="special3">两种规格</label>&nbsp;
                                    </div>

                                    <style>
                                        .specification {
                                            margin:15px;
                                            margin-bottom:20px;
                                            display: none;
                                        }
                                        .add {
                                            margin:20px;
                                        }
                                        .operationStatus {
                                            text-indent:15px;
                                            display:block;
                                            background: url("../../images/arrow_down.png") no-repeat left center;
                                        }
                                    </style>
                                    
                                    <div class="specification spec1">
                                        <label  class="col-sm-2 control-label"></label>
                                        <div class="controls col-sm-10">
                                            <select name="spec">
                                                <option value="0">请选择规格1</option>
                                                @foreach($specification as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <a href="###" class="add">+添加</a>
                                        </div>
                                    </div>
                                    <div class="specification spec2">
                                        <label  class="col-sm-2 control-label"></label>
                                        <div class="controls col-sm-10">
                                            <select name="spec">
                                                <option value="0">请选择规格2</option>
                                                @foreach($specification as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <a href="###" class="add">+添加</a>
                                        </div>
                                    </div>
                                    

                                    <style type="text/css">
                                    #special_name{
                                        /*width: 350px;*/

                                        display: none;
                                        padding: 1rem .5rem;
                                        position : absolute;
                                        background: #fff;
                                        border:1px solid #ccc;
                                        border-radius:.5rem;
                                        z-index : 9999;
                                    }
                                    </style>
                                    <div id="special_name" class="col-md-5">
                                        <input type="text" class="col-md-8 pull-left" name="name" style="height:35px;"  >
                                        <input type="button" class="btn btn-primary col-md-2 pull-left confirm" value="确认">
                                        <input type="button" class="btn btn-default col-sm-2 pull-left cancel" value="取消">
                                    </div>
                                    
                                    <label  class="col-sm-2 control-label"></label>
                                    <div class="controls col-sm-10 spec-list">
                                        <table class="table table-striped table-bordered responsive">
                                            <thead>
                                            <tr class="th">
                                                <th class="col-xs-1">当前库存</th>
                                                <th class="col-xs-1">库存增减</th>
                                                <th class="col-xs-1">团购价</th>
                                                <th class="col-xs-1">单买价</th>
                                                <th class="col-xs-1">SKU预览图</th>
                                                <th class="col-xs-1">状态</th>
                                                <th class="col-xs-1">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="tr">
                                                    <td>0</td>
                                                    <td><input type="text" style="width: 90px;" name="sku_number"></td>
                                                    <td><input type="text" style="width: 90px;" name="group_price"></td>
                                                    <td><input type="text" style="width: 90px;" name="price"></td>
                                                    <td><input type="file" style="width: 75px;" name="sku_picture"></td>
                                                    <td class="tdStatus"><input type="hidden" name="status" value="1" ><span class="status">已上架</span></td>
                                                    <td><a href="###" class="operationStatus">下架</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <br />
                                    <br />
                                    <br />

                                    <label  class="col-sm-2 control-label">总库存</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="store_count" placeholder="">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                    <label  class="col-sm-2 control-label">总库存</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="store_count" placeholder="">
                                    </div>

                            </div>


                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-default btn-primary">提交</button>
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
    var url = '/category/getSubCategory/' + id;
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

$(function () {
    var checked = 0, key = true, value = true;
    // 规格种类选择
    $('input:radio').on('click', function () {
        checked = $(this).val();
        if (checked == 1) {
            $('.specification').css('display', 'none');
        } else if(checked == 2) {
            $('.specification').css('display', 'none');
            $('.spec1').css('display', 'block');
        } else if(checked == 3) {
            $('.specification').css('display', 'none');
            $('.spec1').css('display', 'block');
            $('.spec2').css('display', 'block');
        }
    });

    // 添加规格名称按钮 弹出添加规格输入框
    $('.add').on('click', function () {
        var selected = $(this).parent().children('select').children('option:selected');
        if (selected.val() == 0) {
            alert(selected.text());
            return false;
        }

        // 显示 input
        var special_input = $('#special_name');
        special_input.css({
            'display' : 'block',
            'top' : $(this).position().top + 40,
            'left' : $(this).position().left
        });
        // 确认添加规格
        $('.confirm').on('click', function () {
            if (key) {
                var th_element = '<th class="col-xs-1">' + selected.text() + '</th>';
                $('.th').prepend(th_element);
                key = false;
            }
            var name = $(this).siblings('input[name="name"]').val();
            if (value) {
                var tr_element = '<td>' + name + '</td>';
                $('.tr').prepend(tr_element);
                value = false;
            } else {
                var tr = '<tr><td>' + name + '</td>'
                            + '<td>0</td>'
                            + '<td><input type="text" style="width: 90px;" name="sku_number"></td>'
                            + '<td><input type="text" style="width: 90px;" name="group_price"></td>'
                            + '<td><input type="text" style="width: 90px;" name="price"></td>'
                            + '<td><input type="file" style="width: 75px;" name="sku_picture"></td>'
                            + '<td class="tdStatus"><input type="hidden" name="status" value="1" ><span class="status">已上架</span></td>'
                            + '<td><a href="###" class="operationStatus">下架</a></td></tr>';

                $('.table tbody').append(tr);
            }

            $(this).parent().hide();
        });
        // 取消添加规格
        $('.cancel').on('click', function () {
            special_input.hide();
        });
    });

    // 上下架状态操作， 动态添加的元素可点击。
    $(document).on('click', '.operationStatus', function(e) {
        var status = $(this).parents().siblings('.tdStatus').children('input[type=\'hidden\']');
        if (status.val() == 1) {
            status.val(0);
            status.siblings('.status').html('已下架');
            $(this).css('background', 'url("../../images/arrow_up.png") no-repeat left center');
            $(this).html('上架');
        } else {
            status.val(1);
            status.siblings('.status').html('已上架');
            $(this).css('background', 'url("../../images/arrow_down.png") no-repeat left center');
            $(this).html('下架');
        }
    });
    $('button[type="submit"]').on('click', function () {
        create();
    })
});
function create() {
    var cat_id = $('#cat_id_3 option:selected').val() ? $('#cat_id_3 option:selected').val() : $('#cat_id_2 option:selected').val();
    $.ajax({
        url     : '/goods/ajaxStore',
        type    : 'post',
        dataType: 'json',
        data    :  {
            cat_id     : cat_id,
            goods_name : $('input[name="goods_name"]').val(),
            shop_pirce : $('input[name="shop_pirce"]').val(),
            prom       : $('input[name="prom"]').val(),
            _token     : '{{csrf_token()}}',
            special    : {
                "spec1":[
                    {
                        "spec1_key" : 1,
                        "spec1_value" : "碎花",
                        "sku_number":"20",
                        "sku_picture":"public/1.png",
                        "prom":"2",
                        "group_price":"15",
                        "shop_price" : "20",
                        "status"        : 0
                    },
                    {
                        "spec1_key" : 1,
                        "spec1_value" : "云朵",
                        "sku_number":"10",
                        "sku_picture":"public/2.png",
                        "prom":"2",
                        "group_price":"8",
                        "shop_price" : "10",
                        "status"        : 1
                    }
                ]
            }
        },
        success : function (response) {
            alert(response);
        },
        errors : function (errors) {
            alert(errors);
        }
    })
}
</script>
@endsection
