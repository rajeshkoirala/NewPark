{!! Form::open(['url' => 'admin/user/save-or-update', 'class' => 'form-horizontal','id'=>'useraddform']) !!}
<input type="hidden" name="id" value="{{ $user->id }}">


<div>

    <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" class="form-control validate[required]" value="{{ $user->full_name }}"/>

    </div>

      <div class="form-group">
        <label>User Name</label>


          <input type="text" name="username" id="username"
                 class="validate[required{{iff($user->id == null,',ajax[username]', '')}}] form-control input-sm"
                 {{ iff($user->id>0 , 'readonly', '') }} value="{{ $user->username }}"/>
    </div>


   @if($user->id>0)
        <div class="form-group">
            <div>
                <label for="category_name">Change Password</label>
            </div>
            <div>
                <input type="checkbox" name="change_password" value="CHANGE_PASSWORD"
                       onclick="change_pw(this)">
            </div>
        </div>
    @endif
    @if($user->id>0)
        <div  style="display:none" class="password-field">
    @else
        <div class="password-field">
    @endif

                    {{--<div  {{iff($user->id>0 style='display:none, '')}} class="password-field">--}}
        <div class="form-group">
            <div >
                <label for="category_name" class="required">Password</label>
            </div>
            <div>
                <input type="password" name="password" id="password"
                       class="form-control input-sm validate[required]"
                       value=""/>
            </div>
        </div>

        <div>
            <label for="category_name" class="required">Confirm Password</label>
        </div>
        <div>
            <input type="password" name="confirm_password" id="confirm-password"
                   class="form-control input-sm validate[required,equals[password]]"
                   value=""/>
        </div>
    </div>


    <div class="form-group">
        <div>
            <label for="category_name" class="required">User Type</label>
        </div>
        <div>

            <input type="text" name="user_type" class="form-control" value="1" readonly/>
            {{--<select name="user_type" class="validate[required] form-control selectpicker show-tick">--}}
                {{--<option value="">Select</option>--}}
                {{--<option value="1" {{ selected("1", $user->user_type)}}>Admin--}}
                {{--</option>--}}
                {{--<option value="2" {{ selected("2", $user->user_type)}}>Staff--}}
                {{--</option>--}}
                {{--<option value="3" {{ selected("3", $user->user_type)}}>User--}}
                {{--</option>--}}
            {{--</select>--}}
        </div>
    </div>


                <button type="submit" name="submit" value="Save" class="btn btn-primary" >Save <i class="fa fa-floppy-o" aria-hidden="true"></i>
                </button>
</div>

{!! Form::close() !!}

<script>

    function change_pw(thisObj) {
        if ($(thisObj).is(':checked')) {
            $(".password-field").show();
        } else {
            $(".password-field").hide();
        }
    }



</script>
