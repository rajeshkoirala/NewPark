<?php

namespace App\Http\Controllers;

use App\Classes\Log;
use App\Libraries\MailSender;
use App\User;
use App\ResetPassword;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Hash;

use App\Repositories\UserManagementRepository;
use Validator;


class ResetPasswordController extends Controller
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserManagementRepository();
    }

    public function index(Request $request)
    {
        $token = $request->get('reset_token');

        $chkAdmin = $request->get('adm');

        $result = DB::table('password_resets')->select('email')->where('token', $token)->first();
        $email = $result->email;
        $result = DB::table('users')->select('id', 'username')->where('email', $email)->first();
        $user_id = $result->id;
        DB::table('password_resets')->where('email', '=', $email)->delete();
        Session::set('reset_user_id', $user_id);
        Session::set('chk_admin', $chkAdmin);

        return view('reset-password.reset-password');
    }

    public function sendLink(Request $request)
    {
        $input = $request->all();

        $token = csrf_token();
        DB::table('password_resets')->where('email', '=', $input['email'])->delete();

        $chkAdmin = @$input['chk_admin'];
        $input['token'] = $token;
        ResetPassword::create($input);

        $url = url('reset-password?reset_token=') . $token;

        if ($chkAdmin == "admin")
            $url = url('reset-password?reset_token=') . $token . '&adm=y';

        MailSender::send($input['email'], 'Reset Password', 'Here is your password reset link<br/>url: ' . $url);

        Session::flash('flash_message', 'Your new password reset link has been sent to your primary email address');
        $redirect = 'home';
        if ($chkAdmin == "admin") $redirect = 'admin';

        return redirect($redirect);

    }


}
