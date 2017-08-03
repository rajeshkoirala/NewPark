<?php

namespace App\Http\Controllers;

class DynamicContentController extends Controller
{
    public function terms()
    {
        return view('dynamic-content.terms-of-use');
    }
    public function privacy()
    {
        return view('dynamic-content.privacy-and-security');
    }
    public function index()
    {
        return view('dynamic-content.policy');
    }
    public function sitemap()
    {
        return view('dynamic-content.footer-sitemap');
    }
    public function termOfUse()
    {
        return view('dynamic-content.terms-of-use');
    }
    public function faq()
    {
        return view('dynamic-content.frequently-asked-questions');
    }
}
