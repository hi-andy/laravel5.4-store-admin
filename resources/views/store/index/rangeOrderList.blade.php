@extends('store.menu')
@section('content')
    <div id="content" class="col-lg-10 col-sm-10">
        <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li><a href="#">后台主页</a></li>
                <li><a href="#">欢迎</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class=" with-border">
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <form action="{{ url('/store/rangeOrderList') }}" method="post">
                                    {!! csrf_field() !!}
                                    <div class="col-xs-3" style="width: 12.7%;margin-left:20%;">
                                        <a class="btn @if($time==7) btn-primary @else  btn-default @endif margin" href="{{ asset('/store/rangeOrderList?time=7') }}">最近7天</a>
                                        <a class="btn @if($time==30) btn-primary @else  btn-default @endif margin" href="{{ asset('/store/rangeOrderList?time=30') }}">最近30天</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group margin">
                                            <div class="input-group-addon">
                                                选择时间  <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" name="timeRange" value="{{ $timeRange }}" id="start_time">
                                        </div>
                                    </div>
                                    <div class="col-xs-1"><input class="btn btn-block btn-info margin" type="submit" value="确定"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><i class="glyphicon glyphicon-list-alt"></i> &nbsp; {{ $timeRange }} &nbsp; 订单列表</h2>

                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" >商品名称</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" >订单号</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" >数量</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" >售价</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" >订单状态</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" >出售日期</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $value)
                                <tr>
                                    <td>{{ $value->order_id }}</td>
                                    <td>{{ $value->goods_name }}</td>
                                    <td>{{ $value->order_sn }}</td>
                                    <td>{{ $value->goods_num }}</td>
                                    <td>{{ $value->goods_price }}</td>
                                    <td>{{ $value->order_type }}</td>
                                    <td>{{ $value->add_time }}</td>
                                </tr>
                                @endforeach
                                <tr><td colspan="7">{!! $list->appends(['timeRange' => $timeRange])->links() !!}</td></tr>
                                </tbody>

                            </table>
                    </div>
            </div>
        </div>

        <!-- content ends -->
    </div><!--/#content.col-md-0-->
    <link href="{{ asset('/js/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <script src='{{ asset('/js/daterangepicker/moment.min.js') }}'></script>
    <script src='{{ asset('/js/daterangepicker/daterangepicker.js') }}'></script>
    <script type="text/javascript">


        // 时间范围选取
        $(document).ready(function() {
            $('#start_time').daterangepicker({
                format:"YYYY/MM/DD",
                singleDatePicker: false,
                showDropdowns: true,
                minDate:'2016/01/01',
                maxDate:'2030/01/01',
                locale : {
                    applyLabel : '确定',
                    cancelLabel : '取消',
                    fromLabel : '起始时间',
                    toLabel : '结束时间',
                    customRangeLabel : '',
                    daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
                    firstDay : 1
                }
            });
        });
    </script>
@endsection
