@extends('admin.admin-layout-master')
@section('styles')

@stop
@section('title')
    Change Password
@stop
@section('content')


<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Change new password</h5>
                </div>
                {!! Form::open(['url' => 'admin/user-management/changepassword', 'class' => 'form-horizontal','id'=>'useradd-form']) !!}
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Password*</label>
                                <div class="col-lg-9">
                                    <input type="password" name="password" id="password" class="form-control required"
                                           data-toggle="password" autocomplete="false" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Confirm Password*</label>
                                <div class="col-lg-9">
                                    <input type="password" name="confirm_password" id="confirm_password" data-toggle="password"
                                           class="form-control required" autocomplete="false" value=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-footer clearfix">
                    <div class="pull-right">
                        <button type="submit" name="submit" value="Save" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>  Save
                        </button>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    <script src="{{url('public/js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{url('public/js/plugins/bootstrap-show-password/bootstrap-show-password.min.js')}}"></script>

<script type="text/javascript">

    $("#useradd-form").validate({
        rules: {
              password: {
                required: true,
                minlength: 3
            },
            confirm_password: {
                equalTo: "#password"
            }
        }
    });

    $("#password, #confirm_password").password('toggle');

    function change_pw(thisObj) {
        if ($(thisObj).is(':checked')) {
            $(".password-field").show();
        } else {
            $(".password-field").hide();
        }
    }
</script>
@stop