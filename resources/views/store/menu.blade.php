@extends('layouts.app')
@section('menu')
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/store" style="width: auto;">
                <span style="font-size:20px;">{{ Auth::user()->store_name }} </span> &nbsp;&nbsp;的店铺管理后台</a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> {{ Auth::user()->merchant_name }}</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">账户设置</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">退出登录</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                            class="hidden-sm hidden-xs"> 切换主题</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> 经典配色</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> 天蓝色</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> 赛博格</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> 极简色</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> 深色</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> 流光色</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> 石板色</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> 深空灰</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> 橙色</a></li>
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li style="display: none;"><a href="#"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
                <li class="dropdown" style="display: none;">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Dropdown <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li style="display: none;">
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
    <div class="ch-container">
        <div class="row">

            <!-- left menu starts -->
            <div class="col-sm-2 col-lg-2">
                <div class="sidebar-nav">
                    <div class="nav-canvas">
                        <div class="nav-sm nav nav-stacked">

                        </div>
                        <ul class="nav nav-pills nav-stacked main-menu">
                            <li class="nav-header">Main</li>
                            <li><a class="ajax-link" href="./store"><i class="glyphicon glyphicon-home"></i><span> 后台主页</span></a>
                            </li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> 订单管理</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="/store/order">订单列表</a></li>
                                    <li><a href="#">发货单列表</a></li>
                                    <li><a href="#">退货单列表</a></li>
                                </ul>
                            </li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> 商品管理</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">添加商品</a></li>
                                    <li><a href="#">商品列表</a></li>
                                    <li><a href="#">商品规格</a></li>
                                </ul>
                            </li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> 优惠券管理</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">添加优惠券</a></li>
                                    <li><a href="#">优惠券列表</a></li>
                                </ul>
                            </li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> 提现管理</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">申请提现</a></li>
                                    <li><a href="#">提现记录</a></li>
                                </ul>
                            </li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> 上传助手</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">帮助文档</a></li>
                                </ul>
                            </li>

                            {{--<li><a class="ajax-link" href="form.html"><i
                                            class="glyphicon glyphicon-edit"></i><span> Forms</span></a></li>
                            <li><a class="ajax-link" href="chart.html"><i class="glyphicon glyphicon-list-alt"></i><span> Charts</span></a>
                            </li>
                            <li><a class="ajax-link" href="typography.html"><i class="glyphicon glyphicon-font"></i><span> Typography</span></a>
                            </li>
                            <li><a class="ajax-link" href="gallery.html"><i class="glyphicon glyphicon-picture"></i><span> Gallery</span></a>
                            </li>
                            <li class="nav-header hidden-md">Sample Section</li>
                            <li><a class="ajax-link" href="table.html"><i
                                            class="glyphicon glyphicon-align-justify"></i><span> Tables</span></a></li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Accordion Menu</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Child Menu 1</a></li>
                                    <li><a href="#">Child Menu 2</a></li>
                                </ul>
                            </li>
                            <li><a class="ajax-link" href="calendar.html"><i class="glyphicon glyphicon-calendar"></i><span> Calendar</span></a>
                            </li>
                            <li><a class="ajax-link" href="grid.html"><i
                                            class="glyphicon glyphicon-th"></i><span> Grid</span></a></li>
                            <li><a href="tour.html"><i class="glyphicon glyphicon-globe"></i><span> Tour</span></a></li>
                            <li><a class="ajax-link" href="icon.html"><i
                                            class="glyphicon glyphicon-star"></i><span> Icons</span></a></li>
                            <li><a href="error.html"><i class="glyphicon glyphicon-ban-circle"></i><span> Error Page</span></a>
                            </li>
                            <li><a href="login.html"><i class="glyphicon glyphicon-lock"></i><span> Login Page</span></a>
                            </li>--}}
                        </ul>
                        <label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
                    </div>
                </div>
            </div>
            <!--/span-->
            <!-- left menu ends -->

            <noscript>
                <div class="alert alert-block col-md-12">
                    <h4 class="alert-heading">Warning!</h4>

                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                        enabled to use this site.</p>
                </div>
            </noscript>

            @yield('content')
        </div><!--/fluid-row-->



        <hr>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Settings</h3>
                    </div>
                    <div class="modal-body">
                        <p>Here settings can be configured...</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="row">
            <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://pinquduo.cn" target="_blank">拼趣多</a> 2012 - 2015</p>

            <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                        href="http://pinquduo.cn" target="_blank">拼趣多</a></p>
        </footer>

    </div><!--/.fluid-container-->
@endsection