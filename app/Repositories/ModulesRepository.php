<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/8/2017
 * Time: 11:32 AM
 */

namespace App\Repositories;

use DB;

class ModulesRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT m.id,c.course_name,m.chapter_name,m.module_name FROM course c ,modules m WHERE c.id=m.course_id LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,modules m WHERE c.id=m.course_id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getCourses()
    {
        $sql = "SELECT * FROM course";
        $courses = DB::select($sql);

        return $courses;
    }
}