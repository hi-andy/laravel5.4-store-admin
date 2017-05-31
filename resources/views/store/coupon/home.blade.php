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
                    <a href="#">优惠券列表</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i> 优惠券列表</h2>

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
                                <th>优惠券名称</th>
                                <th>面额</th>
                                <th>使用条件</th>
                                <th>预发放总数</th>
                                <th>已领取</th>
                                <th>已使用</th>
                                <th>使用截止日期</th>
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
                ajax: '/store/coupon/data',
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'money'},
                    {data: 'condition'},
                    {data: 'createnum'},
                    {data: 'send_num'},
                    {data: 'use_num'},
                    {data: 'use_end_time'},
                    {data: 'action', orderable: true, searchable: false}
                ]
            });

        });
    </script>
@endsection
