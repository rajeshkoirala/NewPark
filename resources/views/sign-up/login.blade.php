<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Olive Media | Login</title>

    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{url('public/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('public/css/style.css')}}" rel="stylesheet"/>

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <img src="{{url('public/img/olive_safety.png')}}" alt="">
        </div>
        <br>
        <h3>Welcome to Olive Safety</h3>
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" action="{{url('login/dologin')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            {{--<a href="forgot_password.html">
                <small>Forgot password?</small>
            </a>
            <p class="text-muted text-center">
                <small>Do not have an account?</small>
            </p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>--}}
        </form>
        <p class="m-t">
            <small>Olive Media &copy; {{ date('Y-m-d') }}</small>
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{url('public/js/jquery-2.1.1.js')}}"></script>
<script src="{{url('public/js/bootstrap.min.js')}}"></script>

</body>

</html>

{{--<!doctype html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/bootstrap-3.3.7/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/bootstrap-3.3.7/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/admin/loginForm.css') }}">
</head>
<body>

<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    {{ Form::open(array('url' => 'admin/login')) }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Admin Login</h2>

                                <div class="form-group" style="color: red">
                                    {{ $errors->first('username') }}
                                    {{ $errors->first('password') }}
                                </div>

                                <div class="form-group">
                                    {{ Form::text('username','', array('class' => 'form-control', 'placeholder' => 'Username')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password')) }}
                                </div>

                                <a class="form-group" href="{{URL::to('password/reset')}}" >Forgot Password</a>

                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                       class="form-control btn btn-login" value="Log In">
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Wrapper -->
</body>
</html>--}}
{{--
<div style="width: 400px; margin: 100px auto;">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
            Admin Login</h4></div>
        <div class="panel-body" style="padding: 10px">
            {{ Form::open(array('url' => 'admin/login')) }}

            <div class="form-group" style="color: red">
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
            </div>

            <div class="form-group">
                {{ Form::label('username', 'Username') }}
                {{ Form::text('username','', array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password',array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>--}}
