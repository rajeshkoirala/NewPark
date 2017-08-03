@extends('admin.admin-layout-master')
@section('styles')

@stop
@section('title')
    User Management
@stop



@section('action_button')
    @if( $user->id > 0)
        <a href="{{url('admin/user-management/create')}}" class="btn btn-primary pull-right"><i
                    class="fa fa-plus fa-fw"></i> Add More</a>

    @endif
@stop
@section('content')


    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>New User</h5>
                    </div>
                    {!! Form::open(['url' => 'admin/user-management/save-or-update', 'class' => 'form-horizontal','id'=>'useraddform', 'autocomplete'=>'off']) !!}
                    <input type="hidden" name="id" value="{{ $user->id }}"/>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Full Name*</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="full_name" class="form-control required"
                                               value="{{ $user->full_name }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">User Name*</label>
                                    <div class="col-lg-9">
                                        @if($user->username=="")
                                        <input type="text" name="username" id="username" class="form-control required"
                                               value="{{ $user->username }}" />
                                        <span style="color: red; padding: 3px;" class="uni-message_user"></span>
                                        @endif
                                            @if($user->username!="")
                                                <input type="text" name="husername" id="husername" class="form-control required"
                                                       value="{{ $user->username }}" />
                                                <span style="color: red; padding: 3px;" class="uni-message_user"></span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email*</label>
                                    <div class="col-lg-9">
                                        @if($user->email=="")
                                        <input class="form-control required" name="email" id="email" type="email"
                                               value="{{ $user->email }}"/>
                                        <span style="color: red; padding: 3px;" class="uni-message_uemail"></span>
                                        @endif
                                            @if($user->email!="")
                                                <input class="form-control required" name="hemail" id="hemail" type="email"
                                                       value="{{ $user->email }}"/>
                                                <span style="color: red; padding: 3px;" class="uni-message_uemail"></span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($user->id>0)
                            <div style="display:none" class="password-field">
                                @else
                                    <div class="password-field">
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Password*</label>
                                                    <div class="col-lg-9">
                                                        <input type="password" name="password" id="password"
                                                               class="form-control required" data-toggle="password"
                                                               autocomplete="false" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Confirm Password*</label>
                                                    <div class="col-lg-9">
                                                        <input type="password" name="confirm_password"
                                                               id="confirm_password" data-toggle="password"
                                                               class="form-control required" autocomplete="false"
                                                               value=""/>
                                                        {{--<input type="password" name="confirm_password" id="confirm-password" class="form-control input-sm validate[required,equals[password]]" value=""/>--}}
                                                        {{--<span class="help-block m-b-none">Example block-level help text here.</span>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-12">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label class="col-lg-3 control-label">User Type*</label>--}}
                                    {{--<div class="col-lg-9">--}}
                                    {{--<input type="text" name="user_type" class="form-control" value="1" readonly/>--}}
                                    {{--<span class="help-block m-b-none">Example block-level help text here.</span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                            </div>
                            <div class="clearfix"></div>

                            <div class="ibox-footer">
                                <div class="pull-right">
                                    <button type="submit" name="submit" value="Save" class="btn btn-primary" id="subtn">
                                        Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                </div>

                                <div class="pull-left">
                                    @if($user->id>0)
                                        <label class="control control--checkbox">Change Password
                                            <input type="checkbox" id="category_name" name="change_password"
                                                   value="CHANGE_PASSWORD" onclick="change_pw(this)"/>
                                            <div class="control__indicator"></div>
                                        </label>
                                     @endif
                                </div>

                                <div class="clearfix"></div>
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
                $(".sidebar-nav").find(".menu-user-management").addClass('active');


                $("#useraddform").validate({
                    rules: {
                        full_name: {
                            required: true,
                            maxlength: 30
                        },
                        username: {
                            required: true,
                            minlength: 3,
                            remote: {
                                url: '{{ URL::to('login/check-user') }}',
                                type: 'get',
                                data: {
                                    username: function () {
                                        return $('#username').val()
                                    }
                                },
                            }
                        },
                        email: {
                            required: true,
                            remote: {
                                url: '{{ URL::to('login/check-email') }}',
                                type: 'get',
                                data: {
                                    email: function () {
                                        return $('#email').val()
                                    }
                                }
                            }

                        },
                        password: {
                            required: true,
                            minlength: 3
                        },
                        confirm_password: {
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        email: {
                            remote: "This email is already taken"
                        },
                        username: {
                            remote: "This username is already taken"
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

                function SubmitThisForm(thisObj) {
                    $(thisObj).submit();
                }
            </script>
@stop