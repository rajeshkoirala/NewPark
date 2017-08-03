<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Log;
use App\Http\Controllers\Controller;

class DynamicContentController extends Controller
{
    public function termsOfUse()
    {
        return view('admin.dynamic-content.terms-of-use');
    }

    public function privacyAndSecurity()
    {
        Log::add('View', 'Privacy and Security module is viewed');
        return view('admin.dynamic-content.privacy-and-security');
    }

    public function policy()
    {
        Log::add('View', 'Policy module is viewed');
        return view('admin.dynamic-content.policy');
    }

    public function contactDetails()
    {
        Log::add('View', 'Course details module is viewed');
        return view('admin.dynamic-content.contact-details');
    }

    public function aboutUs()
    {
        Log::add('View', 'About us module is viewed');
        return view('admin.dynamic-content.about-us');
    }






    public function slider()
    {
        Log::add('View', 'Slider setting module is viewed');
        return view('admin.dynamic-content.slider');
    }

    public function siteConfig()
    {
        Log::add('View', 'Site Config setting module is viewed');
        return view('admin.dynamic-content.site-config');
    }
    public function homepage()
    {
        Log::add('View', 'FAQ setting module is viewed');
        return view('admin.dynamic-content.home-page');
    }
    public function contactUS()
    {
        Log::add('View', 'Contact US setting module is viewed');
        return view('admin.dynamic-content.contact_us');
    }

}
