<?php

namespace App\Http\Controllers;

use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use App\Courses;

class EnquiryController extends Controller
{

    public function mailSend()
    {
        $message = "Mail Has been Sent";

echo $message;
//$this->relatedCourseCreateOrUpdate($cid, $request);
//
//Session::flash('flash_message', $message);
//
return redirect('/');
    }


    function enquiry(){
        $allCourse = Courses::all();
        return view('enquiry.index',compact('allCourse'));
    }

    function humanTiming( $ptime )
    {
        $estimate_time = date('Y-m-d h:i:s') - strtotime($ptime);

        //var_dump($estimate_time);

        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;

            if( $d >= 1 )
            {
                $r = round( $d );
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }



}
