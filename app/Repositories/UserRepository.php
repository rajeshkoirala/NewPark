<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 5:24 PM
 */

namespace App\Repositories;

use DB;

class UserRepository
{
    public function getUsers($idsArray)
    {
        $courseIds = implode(',', $idsArray['user']);

        $sql = "SELECT * FROM users WHERE id in ($courseIds)";
        $course = DB::select($sql);

        return $course;
    }
    public function findAll($offset, $limit)
    {
        $sql = "SELECT * FROM users LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM users";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function check_user_already_exists($username)
    {
        $sql = "SELECT COUNT(*) as row_count FROM users WHERE username = '$username'";
        $result = DB::select($sql);
         return $result[0]->row_count > 0 ? false : true;

    }
}