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
                    <a href="#"> 申请提现</a>
                </li>
            </ul>
        </div>


        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> 申请提现</h2>

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
                        <form role="form" method="post" action="{{ url('/store/withdrawal/store') }}">
                            {!! csrf_field() !!}
                            <br><br><br>
                            <div class="form-group col-md-8">
                                <label for="name" class="col-sm-2 control-label">店铺名称</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="store_name" id="name" value="{{ Auth::user()->store_name }}" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">提现金额</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="withdrawal_money" placeholder="当天只能提现一次，且提现金额该为500的倍数">

                                    可提现金额：￥ <span style="color:#f30;">{{ $amount_money }}</span> 元
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">提现方式</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="withdrawal_type" readonly="readonly">
                                        <option value="支付宝" selected="selected">支付宝</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group col-md-8">
                                <label class="col-sm-2 control-label">提现账号</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="withdrawal_code" placeholder="请正确输入提现账号">
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

</script>
@endsection
