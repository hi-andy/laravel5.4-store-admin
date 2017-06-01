<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <!--
        ===
        This comment should NOT be removed.
        Charisma v2.0.0
        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0
        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>商家后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="{{ asset('charisma/css/bootstrap-cerulean.min.css') }}" rel="stylesheet">
    <link href="{{ asset('charisma/css/charisma-app.css') }}" rel="stylesheet">
    <link href="{{ asset('charisma/bower_components/responsive-tables/responsive-tables.css') }}" rel='stylesheet'>
    <link href="{{ asset('/css/base.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="{{ asset('charisma/http://html5shim.googlecode.com/svn/trunk/html5.js') }}"></script>
    <![endif]-->
    <script src='{{ asset('/js/jquery.dataTables.min.js') }}'></script>
    <script src="{{ asset('/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/js/base.js') }}"></script>
    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>

@yield('menu')
@yield('login')
<!-- external javascript -->
<script src="{{ asset('charisma/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3></h3>
            </div>
            <div class="modal-body">
                @if(0)
                <p>{{ $message }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
                <a href="#" class="btn btn-primary" data-dismiss="modal">确定</a>
            </div>
        </div>
    </div>
</div>
<style>
    /* 此样式写到单独的文件里，会出现加载权重问题，加载不到 */
    .alert-modified {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300px;
        height: 80px;
        line-height: 50px;
        margin-left: -125px;
        margin-top: -15px;
        padding: 15px 0 30px 0;
        border: 1px solid #ddd;
        text-align: center;
        color: #444;
        font-size: 14px;
        box-shadow: 2px 2px 5px #444;
        -moz-box-shadow: 2px 2px 5px #444;
        -webkit-box-shadow: 2px 2px 5px #444;
        z-index: 9999;
    }
    .alert-modified .close{
        line-height: 0;
    }
</style>
@if (session('success'))
    <div class="alert-modified alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ session('success') }}</strong>
    </div>
@endif
@if (session('failed'))
<div class="alert-modified alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>{{ session('failed') }}</strong>
</div>
@endif
@if(session('alert'))
<div class="alert-modified alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>{{ session('alert') }}</strong>
</div>
@endif
</body>
</html>
