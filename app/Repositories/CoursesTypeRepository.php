<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 5:24 PM
 */

namespace App\Repositories;

use DB;

class CoursesTypeRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT * FROM courses_type LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM courses_type";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }
}