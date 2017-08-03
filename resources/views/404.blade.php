<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OilveMedia | 404 Error</title>

    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">

    <link rel="stylesheet" href="{{url('public/css/animate.css')}}">

</head>

<body class="gray-bg">
<div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">Page Not Found</h3>
    <p> The Web Server cannot find the file or script you asked for. Please check the URL to ensure that it is correct.</p>
    <p>Please contact the server's administrator if this problem persists.</p>
    {{--<form class="form-inline m-t" role="form">--}}
        {{--<div class="form-group">--}}
            {{--<input type="text" class="form-control" placeholder="Search for page">--}}
        {{--</div>--}}
      {{--<button type="submit" class="btn btn-primary">Search</button>--}}
    {{--</form>--}}
    <br>
    <a class="btn btn-white btn-bitbucket" href="{{ URL::to('/') }}">
        <i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Home
    </a>

</div>

</div>
</body>

</html>