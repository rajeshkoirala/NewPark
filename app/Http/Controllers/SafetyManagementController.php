<?php

namespace App\Http\Controllers;

class SafetyManagementController extends Controller
{
    public function consultancy()
    {
        return view('safetymanagemenet.consultancy');
    }
    public function audits()
    {
        return view('safetymanagemenet.audits');
    }
    public function psdppscs()
    {
        return view('safetymanagemenet.psdppscs');
    }
}
