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
            <div class="course-select-title shopping-cart-title">
                <h2>Change Password </h2>
            </div>
            {!! Form::open(['url' => 'admin/user-management/set-password', 'class' => 'form-horizontal os-global-form','id'=>'useraddform1']) !!}


            <div class="col-md-12 r-full-width">
                <div class="form-group">
                    <input type="password" name="password1" id="password1" class="form-control required"
                           autocomplete="false" value="" />
                    <label class="control-label">New Password</label>
                    <i class="bar"></i>
                </div>
            </div>
            <div class="col-md-12 r-full-width">
                <div class="form-group">
                    <input type="password" name="confirm_password1" id="confirm_password1" class="form-control required"
                           autocomplete="false" value="" />
                    <label class="control-label">Confirm Password</label>
                    <i class="bar"></i>
                </div>
            </div>

            <button type="submit" id="save-card-details" name="submit" value="Save"
                    class="btn btn-primary blue z-depth-1 submit">
                Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button>


            {!! Form::close() !!}
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
<script src="{{url('public/js/jquery-2.1.1.js')}}"></script>
    <script src="{{url('public/js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{url('public/js/plugins/bootstrap-show-password/bootstrap-show-password.min.js')}}"></script>
    <script type="text/javascript">

        $("#useraddform1").validate({
            rules: {
                password1: {
                    required: true,
                    minlength: 3
                },
                confirm_password1: {
                    equalTo: "#password1"
                }
            }
        });

        $("#password1, #confirm_password1").password('toggle');

        /* function change_pw(thisObj) {
         if ($(thisObj).is(':checked')) {
         $(".password-field").show();
         } else {
         $(".password-field").hide();
         }
         }*/
    </script>

