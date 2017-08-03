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
        @if(Session::has('flash_message'))
            <br>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-close" aria-hidden="true"></i> {{ Session::get('flash_message') }}
                    </div>
                </div>
            </div>
        @endif
        <form class="m-t" role="form" action="{{url('admin/login')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>



            <a href="{{URL::to('admin/auth/forgot-password')}}">
                <small>Forgot password?</small>
            </a>
            {{--<p class="text-muted text-center">
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
