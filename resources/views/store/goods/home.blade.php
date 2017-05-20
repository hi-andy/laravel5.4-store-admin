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
                    <a href="#">商品列表</a>
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
                                <th>ID</th>
                                <th>商品名称</th>
                                <th>商品类型</th>
                                <th>分类</th>
                                <th>价格</th>
                                <th>库存</th>
                                <th>审核状态</th>
                                <th>销售状态</th>
                                <th>是否显示</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

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
        $(document).ready(function() {
            $('.datatable').DataTable({
                "bStateSave": true, //保存每页显示条数状态
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-12'i><'col-md-12 center-block'p>>",
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "抱歉， 没有找到",
                    "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                    "sInfoEmpty": "没有数据",
                    "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
                    "oPaginate": {
                        "sFirst": "首页",
                        "sPrevious": "上一页",
                        "sNext": "下一页",
                        "sLast": "尾页"
                    },
                    "sZeroRecords": "没有检索到数据",
                    "sProcessing": '<i class="fa fa-coffee"></i> 正在加载数据...',
                },
                serverSide: true,
                processing: true,
                ajax: '/store/goods/data',
                columns: [
                    {data: 'goods_id'},
                    {data: 'goods_name'},
                    {data: 'is_special'},
                    {data: 'cat_id'},
                    {data: 'shop_price'},
                    {data: 'store_count'},
                    {data: 'is_audit'},
                    {data: 'is_on_sale'},
                    {data: 'is_show'},
                    {data: 'action', orderable: true, searchable: false}
                ]
            });

        });
    </script>
@endsection
