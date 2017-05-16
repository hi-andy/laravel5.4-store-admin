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
</body>
</html>
