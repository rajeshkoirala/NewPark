<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Classes\Log;
use App\Repositories\UserRepository;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        return view('admin.user.index');
    }
    public function listAll(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');

        echo json_encode($this->userRepository->findAll($offset, $limit));
    }
    public function form(Request $request)
    {
        $user = User::findOrNew($request->get('id'));
        return view('admin.user.form', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveOrUpdate(Request $request)
    {
        if ($request->get('id') > 0) {

            $voucher = User::findOrFail($request->get('id'));
            $input = $request->all();
            $input['password'] =  Hash::make($input['password']);
            $voucher->fill($input)->save();
            Log::add('Update','User Information Updated');
            $message = "User Successfully Updated";

        } else {

            $input = $request->all();
            $input['password'] =  Hash::make($input['password']);

            User::create($input);
            Log::add('Insert','User created');
            $message = "User Successfully Created";
        }

        Session::flash('flash_message', $message);

        return redirect('admin/user');
    }
public function changePassword(Request $request)
{
    $user = User::findOrFail($request->get('id'));
    $input = $request->all();
    $input['password'] =  Hash::make($input['password']);
    $user->fill($input)->save();
    Log::add('Update','User Password Changed');
    $message = "Password Successfully Updated";
    Session::flash('flash_message', $message);

    return redirect('admin/user-management');

}
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {

        $id=$request->get('id');
        DB::table('users')->where('id', '=', $id)->delete();
        Log::add('Delete','User Deleted');
        Session::flash('flash_message', "User successfully deleted");
        return redirect('admin/user');
    }
    function usernameValidation(Request $request)
    {
        $username =  $request->get("username");
        $status[] = "username";
        $status[] = $this->userRepository->check_user_already_exists($username);
         echo json_encode($status);
    }
}
