<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/31/2017
 * Time: 1:00 PM
 */

namespace App\Repositories;
use DB;


class BookingRepository
{
    public function findAll($offset, $limit, $filter)
    {
        $extSql = '';
        if($filter)
        {
            $extSql = " AND u.full_name LIKE '%".$filter['booking_name']."%' ";
        }

        $sql = "SELECT b.id,u.username,u.full_name,u.email,u.phone_no,u.country,u.state,u.address,b.booked_date,c.course_name,b.no_seats FROM booking b, users u, course c WHERE u.id = b.user_id AND c.id = course_id $extSql ORDER BY b.created_at DESC LIMIT  $offset, $limit";

        //echo $sql;die();
        $packet["data"] = DB::select($sql);


        $sql = "SELECT COUNT(*) AS rowCount FROM booking b, users u, course c  WHERE u.id = b.user_id AND c.id = course_id $extSql";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

}