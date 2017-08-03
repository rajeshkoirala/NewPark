<?php

namespace App\Http\Controllers;
use App\Classes\Log;
use App\User;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Hash;

use App\Repositories\UserManagementRepository;
use Validator;


class LoginController extends Controller
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserManagementRepository();
    }
    public function index()
    {

        return view('sign-up.login');
    }
    public function showLogin()
    {
        if (Auth::check()) {
            return Redirect::to('/home');
        }
        // show the form
        return view('/home');
    }

    public function doLogin()
    {

        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'user_type' => 3
        );

        if (Auth::attempt($userdata)) {


            Log::add('Login', 'Login Successful');
            Session::flash('success_message', 'Welcome ' . Auth::user()->username . "!! login is successful");

             return Redirect::to('client-info');

        } else {

            Session::flash('error_message', 'Username or password incorrect');
            return Redirect::to('/home');

        }

    }
    public function checkUser(Request $request)
    {
        $username = $request->get('username');
        $result = DB::table('users')->select('username')->where('username', $username)->first();

        if($result==null) echo json_encode(true);
        else echo json_encode(false);
        exit();
    }

    public function checkEmail(Request $request)
    {
        $email = $request->get('email');
        $result = DB::table('users')->select('email')->where('email', $email)->first();

        /*if($result==null) echo "";
        else echo "Email Already Exists";*/
        if($result==null) echo json_encode(true);
        else echo json_encode(false);
        exit();
    }




    public function doLogout()
    {
        Log::add('Logout','User Logged Out');
        Auth::logout();
        return Redirect::to('/home');
    }


    public function saveOrUpdate(Request $request)
    {

           $rules = array(
                'full_name' => 'required',
                'email' => 'required | unique:users',
                'username' => 'required | between:3,15 | unique:users'

            );
            $input = Input::all();
            $validation = Validator::make($input, $rules);

            $validator = $validation;

            if ($validation->fails()) {

                return redirect('/home')->withErrors($validator);
            }
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);
            $input['user_type'] = '3';
            $user = User::create($input);
            $message = "User Successfully Created";


        Session::flash('success_message', $message);

        return redirect('/home');
    }
    public function changePassword(Request $request)
    {

        $user = User::findOrFail($request->get('id'));
        $input = $request->all();
        $input['password'] = Hash::make($input['password2']);
        $user->fill($input)->save();
        $message = "Password Successfully Updated";
        Session::flash('success_message', $message);

        return redirect('/client-info');

    }

    public function resetPassword(Request $request)
    {
        $user_id=Session::get('reset_user_id');
        $chkAdmin=Session::get('chk_admin');
        $user = User::findOrFail($user_id);
        $input = $request->all();
        $input['password'] = Hash::make($input['password1']);
        $user->fill($input)->save();
        $message = "Password Successfully Updated";
        Session::flash('success_message', $message);
        Session::forget('reset_user_id');
        Session::forget('chk_admin');

        $redirect = 'home';
        if ($chkAdmin == "y") $redirect = 'admin';

        return redirect($redirect);


    }
}
