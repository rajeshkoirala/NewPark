<?php

namespace App\Http\Controllers;
use App\Courses;

class ContactUsController extends Controller
{
    public function index()
    {
        $allCourse = Courses::all();
        return view('contactus.index',compact('allCourse'));
    }
}
