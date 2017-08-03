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

<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h2 class="font-bold">Forgot password</h2>

                <p>
                    Enter your email address and your password will be reset and emailed to you.
                </p>

                <div class="row">

                    <div class="col-lg-12">
                        {!! Form::open(['url' => 'admin/user-management/send-link', 'class' => 'form-horizontal','id'=>'useradd-form']) !!}


                            <div class="form-group">
                                <input type="email" name="email" id="semail" class="form-control" required/>
                                <div class="col-sm-12 col-xs-12 uni-message_semail hidden"></div>
                            </div>

                            <button type="submit" id="subtn" class="btn btn-primary block full-width m-b">Send Reset Link</button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright Olive Media
        </div>
        <div class="col-md-6 text-right">
            <small>© 2017</small>
        </div>
    </div>
</div>
</body>
</html>
<script src="{{url('public/js/jquery-2.1.1.js')}}"></script>
<script src="{{url('public/js/plugins/validate/jquery.validate.min.js')}}"></script>
<script>
    $("#semail").on('focusout', function () {
        $.ajax({
            url: '{{ URL::to('login/check-email') }}',
            type: 'get',
            data: {email: $('#semail').val()},
            success: function (output) {

                $('.uni-message_semail').html(output);


            }
        });
    });

    $("#subtn").on('click', function () {

        var error_email_msg = $('.uni-message_semail').html();

        if (error_email_msg == "" || error_email_msg == null)
            return false;
        else
            return true;
    });
</script>