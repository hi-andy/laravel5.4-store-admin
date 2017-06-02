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
                                <form action="{{ url('/store') }}" method="post">
                                    {!! csrf_field() !!}
                                    <div class="col-xs-3">
                                        {{--<a class="btn btn-primary margin" href="{:U('Report/index',array('gap'=>7))}">最近7天</a>--}}
                                        {{--<a class="btn btn-default margin" href="{:U('Report/index',array('gap'=>30))}">最近30天</a>--}}
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
                    <style>
                        .data{
                            width:16.5%;
                            padding: 15px 0;
                            margin: 20px 0;
                            border-top:1px solid #ccc;
                            border-bottom:1px solid #ccc;
                            display: inline;
                            text-align:center;
                            float: left;
                        }
                    </style>
                    <div class="box-body">
                        <div>
                            <div class="data">
                                <span class="notice" notice="用户当天付款后即累计到这里，仅累计不扣除" ></span>今日销售额：￥{{ $today['today_amount'] or 0 }}
                            </div>
                            <div class="data">
                                <span class="notice" notice="用户付款后的即累计到这里，仅累计不扣除" ></span>总销售额：￥{{ $today['sign'] or 0 }}
                            </div>
                            <div class="data">
                                <span class="notice" notice="仅含已经付款的订单，未付款的不算入"></span>今日订单数：{{ $today['today_order'] or 0 }}
                            </div>
                            <div class="data">
                                <span class="notice" notice="买家拉取订单后尚未付款，3分钟后将自动取消该订单，或由买家手动取消"></span>今日取消订单：{{ $today['cancel_order'] or 0 }}
                            </div>
                            <div class="data">
                                <span class="notice" notice="待发货订单包含单买发货订单和团购发货订单"></span>待发货订单：<span style="color:red;">{{ $today['undelivered_order'] or 0 }}</span>
                            </div>
                            <div class="data">
                                <span class="notice" notice="待处理的退换货订单"></span>待售后订单：<span style="color:red;">{{ $today['service_order'] or 0 }}</span>
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
                        <h2><i class="glyphicon glyphicon-list-alt"></i> 销售额走势</h2>

                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="statistics" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><i class="glyphicon glyphicon-list-alt"></i> 销售表格概览</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="list-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>时间</th>
                                <th>订单数</th>
                                <th>今日销售额</th>
                                <th>该时间段总销售额</th>
                                <th>查看</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $key=>$value )
                                <tr role="row" align="center">
                                    <td>{{ $value['day'] }}</td>
                                    <td>{{ $value['order_num'] }}</td>
                                    <td>{{ $value['amount'] }}</td>
                                    <td>{{ $value['all'] }}</td>
                                    <td><a href="{:U('Report/saleList',array('begin'=>$vo['day'],'end'=>$vo['end']))}">订单列表</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- content ends -->
    </div><!--/#content.col-md-0-->
    <script src='{{ asset('/js/echart/echarts.min.js') }}'></script>
    <script src='{{ asset('/js/echart/macarons.js') }}'></script>
    <script src='{{ asset('/js/echart/china.js') }}'></script>
    <link href="{{ asset('/js/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <script src='{{ asset('/js/daterangepicker/moment.min.js') }}'></script>
    <script src='{{ asset('/js/daterangepicker/daterangepicker.js') }}'></script>
    <script type="text/javascript">
        var res = {!! $result !!};
        var myChart = echarts.init(document.getElementById('statistics'),'macarons');
        option = {
            tooltip : {
                trigger: 'axis'
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : true,
            legend: {
                data:['今日销售额','订单数','总销售额']
            },
            xAxis : [
                {
                    type : 'category',
                    data : res.time
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    name : '今日销售额',
                    axisLabel : {
                        formatter: '{value} ￥'
                    }
                },
                {
                    type : 'value',
                    name : '总销售额',
                    axisLabel : {
                        formatter: '{value} '
                    }
                }
            ],
            series : [
                {
                    name:'今日销售额',
                    type:'bar',
                    data:res.amount
                },
                {
                    name:'订单数',
                    type:'bar',
                    data:res.order
                },
                {
                    name:'总销售额',
                    type:'line',
                    yAxisIndex: 1,
                    data:res.all
                }
            ]
        };
        myChart.setOption(option);

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
