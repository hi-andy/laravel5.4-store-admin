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
                    <a href="#">添加 / 编辑优惠券</a>
                </li>
            </ul>
        </div>


        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> 添加 / 编辑优惠券</h2>

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
                        <form role="form" method="post" action="{{ url('/store/coupon/store') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                            <br><br><br>
                            <div class="form-group col-md-8">
                                <label for="name" class="col-sm-2 control-label">优惠券名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="请输入优惠券名称">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">优惠券面额</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="money" placeholder="请输优惠券面额，优惠券可抵扣金额">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">需消费金额</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="condition" placeholder="订单需满足的最低消费金额(必需为整数)才能使用">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">发放数量</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="createnum" placeholder="请输入发放数量">
                                </div>
                            </div>



                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">发放起始日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="send_start_time" data-date-format="yyyy-mm-dd" id="send_start_time" placeholder="请选择发放起始日期">
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">发放结束日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="send_end_time" id="send_end_time" data-date-format="yyyy-mm-dd" placeholder="请选择发放结束日期">
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">使用起始日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="use_start_time" id="use_start_time" data-date-format="yyyy-mm-dd" placeholder="请选择使用起始日期">
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">使用结束日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="use_end_time" id="use_end_time" data-date-format="yyyy-mm-dd" placeholder="请选择使用结束日期">
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
    <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <script src='{{ asset('/js/bootstrap-datetimepicker.min.js') }}'></script>
    <script src='{{ asset('/js/bootstrap-datetimepicker.zh-CN.js') }}'></script>
<script type="text/javascript">
    /*$('#send_start_time').datetimepicker({
        language:  'zh-CN',
        format: "yyyy-mm-dd",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('#send_end_time').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });*/
    function DatePicker(beginSelector,endSelector){
        // 仅选择日期
        $(beginSelector).datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            startDate:new Date()
        }).on("click",function(){
            $(beginSelector).datetimepicker("setEndDate",$(endSelector).val())
        });
        $(endSelector).datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            startDate:new Date()
        }).on("click",function(){
            $(endSelector).datetimepicker("setStartDate",$(beginSelector.val()))
        });
    }

    DatePicker("#send_start_time",  "#send_end_time");    // 发放时间段选择
    DatePicker("#use_start_time",   "#use_end_time");      // 可使用时间段选择


</script>
@endsection
