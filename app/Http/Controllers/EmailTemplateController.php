<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/11/2017
 * Time: 11:11 AM
 */
namespace App\Http\Controllers;

use Illuminate\Http\File;


class EmailTemplateController extends Controller {


    public function index()
    {
       return view('email-template.index');

    }



}