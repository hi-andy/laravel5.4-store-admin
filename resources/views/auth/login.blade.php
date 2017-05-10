@extends('layouts.app')

@section('content')
    <div class="ch-container">
        <div class="row">

            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2>欢迎回来！</h2>
                </div>
                <!--/span-->
            </div><!--/row-->

            <div class="row">
                <div class="well col-md-5 center login-box">
                    <div class="alert alert-info">
                        请使用您的用户名和密码登录。
                    </div>
                    <form class="form-horizontal" action="{{ route('login') }}" method="post">
                        {!! csrf_field() !!}
                        <fieldset>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                <input type="text" class="form-control" name="merchant_name" placeholder="用户名">
                            </div>
                            <div class="clearfix"></div><br>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="密码">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend">
                                <label class="remember" for="remember" />
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我</label>
                            </div>
                            <div class="clearfix"></div>

                            <p class="center col-md-5">
                                <button type="submit" class="btn btn-primary">登录</button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </p>

                        </fieldset>
                    </form>
                </div>
                <!--/span-->
            </div><!--/row-->
        </div><!--/fluid-row-->

    </div><!--/.fluid-container-->
@endsection
