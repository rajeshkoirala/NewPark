<?php

namespace App\Classes;
use App\ActivityLog;
use Auth;

class Log
{
    public static function add($action,$description)
    {
        $useragent= request()->server('HTTP_USER_AGENT');
        $ip=request()->ip();
        $uid= Auth::user()->id;
        $log = array(
            'action' => $action,
            'description'=>$description,
            'ip_address'=>$ip,
            'user_agent'=> $useragent,
            'user_id' => $uid,
        );
        ActivityLog::create($log);
        //$message = "Category Successfully Created";
    }

}