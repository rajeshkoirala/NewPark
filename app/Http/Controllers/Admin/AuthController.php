<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Classes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function showLogin()
    {
        if (Auth::check()) {
            return Redirect::to('admin/dashboard');
        }
        // show the form
        return view('admin.auth.login');
    }


    public function forgotPassword(){

        return view('admin.auth.forgot-password');

    }

    public function doLogin()
    {
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($userdata)) {
            Log::add('Login','Login Successful');
            Session::flash('flash_message', 'Welcome ' . Auth::user()->full_name . "!! login is successful");
            //if(Auth::user()->user_type == 1)
            return Redirect::to('admin/dashboard');

        } else {

            Session::flash('flash_message', 'Username or password incorrect');
            return Redirect::to('admin/login');

        }
    }

    public function doLogout()
    {
        Log::add('Logout','User Logged Out');
        Auth::logout();
        return Redirect::to('admin/login');
    }



    public function settings(){

        return view('admin.settings.form');

    }


    public function saveOrUpdate(Request $request)
    {
        //Log::add('Update','User Information Updated');
        $Auth = User::findOrFail($request->get('id'));
        $input = $request->all();

        $Auth->fill($input)->save();
        $message = "Password Successfully Updated";

        Log::add('Update','User Information Updated');
        Session::flash('flash_message', $message);

        return redirect('admin/user-management');
    }



}