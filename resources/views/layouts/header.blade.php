<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('seo_detail')


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{url()->current()}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('public/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('public/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('public/img/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{URL::asset('public/img/favicons/manifest.json')}}">
    <link rel="mask-icon" href="{{URL::asset('public/img/favicons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/owl.theme.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/olive-default-style.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/plugin/swipe-box/css/swipebox.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/timeline.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/mui.css')}}">
    <link href="{{URL::asset('public/frontend/dist/css/datepicker-course.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('public/toaster/css/jquery.toast.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/styles.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/frontend/dist/css/nav-style.min.css')}}">
    @yield("style")
</head>