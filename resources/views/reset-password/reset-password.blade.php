@extends('layout-master')
@section('styles')
    <style> 
    </style>
@stop
@section('title')
    Change Password
@stop
@section('content')
   <main class="om-main-content">
       <div class="main courses-main">
        <div class="slider">
            <div class="container">
        <div class="row reset-password-section">
            <div class="course-select-title shopping-cart-title">
                <h2>Change Password </h2>
            </div>
            {!! Form::open(['url' => 'login/reset-password', 'class' => 'os-global-form','id'=>'useraddform1']) !!}


            <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="password" name="password1" id="password1" class="form-control required"
                           autocomplete="false" value=""/>
                    <label class="control-label new-label">New Password</label>
                    <i class="bar"></i>
            </div>
            <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="password" name="confirm_password1" id="confirm_password1" class="form-control required"
                           autocomplete="false" value=""/>
                    <label class="control-label new-label">Confirm Password</label>
                    <i class="bar"></i>
            </div>

            <button type="submit" id="save-card-details" name="submit" value="Save"
                    class="btn btn-primary blue z-depth-1 submit">
                Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button>


            {!! Form::close() !!}
        </div>
    </div>
        </div>
       </div>
</main>
@stop
@section("script")
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

@stop