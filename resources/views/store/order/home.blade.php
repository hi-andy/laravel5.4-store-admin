@extends('store.menu')
@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">后台主页</a>
                </li>
                <li>
                    <a href="#">订单列表</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i> 订单列表</h2>

                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="alert alert-info" style="display: none;"> 备用 </div>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>收货人</th>
                                <th>总金额</th>
                                <th>应付金额</th>
                                <th>订单状态</th>
                                <th>支付状态</th>
                                <th>发货状态</th>
                                <th>支付方式</th>
                                <th>配送方式</th>
                                <th>下单时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->order_sn }}</td>
                                <td class="center">{{ $value->consignee }}</td>
                                <td class="center">{{ $value->total_mount }}</td>
                                <td class="center">{{ $value->pay_amount }}</td>
                                <td class="center">{{ $value->order_status }}</td>
                                <td class="center">{{ $value->pay_status }}</td>
                                <td class="center">{{ $value->shipping_status }}</td>
                                <td class="center">{{ $value->pay_name }}</td>
                                <td class="center">{{ $value->shipping_name }}</td>
                                <td class="center">{{ $value->add_time }}</td>

                                <td class="center">
                                    <a class="btn btn-success" href="#">
                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                        查看
                                    </a>
                                    <a class="btn btn-info" href="#">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        编辑
                                    </a>
                                    <a class="btn btn-danger" href="#">
                                        <i class="glyphicon glyphicon-trash icon-white"></i>
                                        删除
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/span-->

        </div><!--/row-->


        <!-- content ends -->
    </div><!--/#content.col-md-0-->
    <script type="text/javascript">
        function ajax_get_table(tab,page){
            cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type : "POST",
                url:"/Store/order/ajaxindex/p/"+page,//+tab,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#ajax_return").html('');
                    $("#ajax_return").append(data);
                }
            });
        }
    </script>
@endsection
