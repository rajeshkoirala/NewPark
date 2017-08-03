<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 5:24 PM
 */

namespace App\Repositories;

use DB;

class CourseRepo
{
    public function getCourse($idsArray)
    {
        $courseIds = implode(',', $idsArray['course']);

        $sql = "SELECT * FROM course WHERE id in ($courseIds)";
        $course = DB::select($sql);

        return $course;
    }

}