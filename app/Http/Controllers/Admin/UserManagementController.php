<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Classes\Log;
use App\Repositories\UserManagementRepository;
use App\User;
use DB;
use App\ResetPassword;
use App\Libraries\MailSender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class UserManagementController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserManagementRepository();
    }

    public function index()
    {
        Log::add('View', 'User management module is viewed');
        $userType = Auth::user()->user_type;

        if ($userType == 1)
            return view('admin.user-management.index');

    }

    public function listAll(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $filter = $request->get('filter');


        echo json_encode($this->userRepository->findAll($offset, $limit, $filter));
    }

    public function form($id = "")
    {
        $request = request();
        if ($request->get('id')) {

            $id = $request->get('id');
        }
        $userType = Auth::user()->user_type;
        if ($userType == 1) {
            $user = User::findOrNew($id);
            return view('admin.user-management.form', compact('user'));
        } else
            return redirect('admin/dashboard');

    }

    public function changePasswordForm()
    {

        return view('admin.user-management.changepassword');

    }


    public function saveOrUpdate(Request $request)
    {

        $cid = $request->get('id');

        if ($request->get('id') > 0) {

            $user = User::findOrFail($request->get('id'));
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user->fill($input)->save();
            Log::add('Update', 'User ' . $user->username . ' is updated');
            $message = "User Successfully Updated";

        } else {

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['user_type'] = '2';
            $user = User::create($input);
            $cid = $user->id;
            Log::add('Insert', 'User ' . $user->username . ' is created');
            $message = "User Successfully Created";
        }

        Session::flash('flash_message', $message);

        return redirect('admin/user-management/' . $cid . '/edit');
    }

    public function changePassword(Request $request)
    {
        $user = User::findOrFail($request->get('id'));
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user->fill($input)->save();
        Log::add('Update', 'User Password Changed, ID=' . $request->get('id'));
        $message = "Password Successfully Updated";
        Session::flash('flash_message', $message);

        return redirect('admin/dashboard');

    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        DB::table('users')->where('id', '=', $id)->delete();
        Log::add('Delete', 'User Deleted,ID=' . $id);
        Session::flash('flash_message', "User successfully deleted");
        return redirect('admin/user-management');
    }

    function usernameValidation(Request $request)
    {
        $username = $request->get("username");

        $status[] = "username";
        $status[] = $this->userRepository->check_user_already_exists($username);
        echo json_encode($status);
    }

    public function resetPassword(Request $request)
    {
        $token = $request->get('reset_token');


        $result = DB::table('password_resets')->select('email')->where('token', $token)->first();
        $email = $result->email;
        $result = DB::table('users')->select('id', 'username')->where('email', $email)->first();
        $user_id = $result->id;
       // DB::table('password_resets')->where('email', '=', $email)->delete();
        Session::set('reset_user_id', $user_id);


        return view('admin/user-management.reset-password');
    }

    public function setPassword(Request $request)
    {
        $user_id = Session::get('reset_user_id');

        $user = User::findOrFail($user_id);
        $input = $request->all();
        $input['password'] = Hash::make($input['password1']);

        $user->fill($input)->save();

        $message = "Password Successfully Updated";
        Session::flash('flash_message', $message);
        Session::forget('reset_user_id');


        $redirect = 'admin';

        return redirect($redirect);


    }

    public function sendLink(Request $request)
    {

        $input = $request->all();

        $token = csrf_token();
        DB::table('password_resets')->where('email', '=', $input['email'])->delete();

        $input['token'] = $token;
        ResetPassword::create($input);

        $url = url('admin/user-management/reset-password?reset_token=') . $token;


        MailSender::send($input['email'], 'Reset Password', 'Here is your password reset link<br/>url: ' . $url);

        $redirect = 'admin';

        return redirect($redirect);

    }

}
