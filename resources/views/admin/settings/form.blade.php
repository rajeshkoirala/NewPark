
{!! Form::open(['url' => 'admin/user/changePassword', 'class' => 'form-horizontal','id'=>'usrform']) !!}
<div>
    <input type="hidden" name="id" value="{{Auth::user()->id}}">
    <div class="form-group">
        <label>Email</label>
        <input disabled type="email" name="email" value="{{Auth::user()->email}}" class="form-control"/>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" disabled name="username" value="{{Auth::user()->username}}" class="form-control" />
    </div>

 <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" id="password" class="form-control validate[required]" />
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control validate[required,equals[password]]" />
    </div>

    {{--<div class="form-group">--}}
        {{--<label>Confirm Password</label>--}}
        {{--<input type="text" name="confirm_password" class="form-control" />--}}
    {{--</div>--}}



    <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
</div>

{!! Form::close() !!}

<script type="text/javascript">


</script>