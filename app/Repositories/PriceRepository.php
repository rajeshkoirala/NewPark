<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/8/2017
 * Time: 11:32 AM
 */

namespace App\Repositories;

use DB;

class PriceRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT c.course_name,r.id,r.price FROM course c,price r where c.id=r.course_id LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c,price r where c.id=r.course_id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getCourses()
    {
        $sql = "SELECT * FROM course";
        $categories = DB::select($sql);

        return $categories;
    }
}