<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/7/2017
 * Time: 11:50 AM
 */

namespace App\Http\Controllers\Admin;
use App\Admin\Settings;
use App\Repositories\SettingsRepository;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;


class SettingsController extends Controller
{
    private $SettingsRepository;

    public function __construct()
    {
        $this->SettingsRepository= new SettingsRepository();

        dd(Auth::user());

        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        echo substr(str_shuffle($str),0 , 4). "-".substr(str_shuffle($str),0 , 4)."-".substr(str_shuffle($str),0 , 4)."-".substr(str_shuffle($str),0 , 4);
    }

    public function index()
    {   $id= 1;
       $result= $this->SettingsRepository->findAll($id);

        $this->SettingsRepository->username = $result->username;


       return view('admin.settings.form', compact('data'));
    }

}