<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/31/2017
 * Time: 11:05 AM
 */

namespace App\Repositories;
use DB;



class CustomerRepository
{
    public function findAll($offset, $limit)
    {

        $sql = "SELECT c.id,c.last_4,u.username,u.full_name,c.email,u.phone_no,u.country,u.state,u.address,c.created_at FROM users u ,customer_details c WHERE u.id=c.user_id ORDER BY c.created_at DESC LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);


        $sql = "SELECT COUNT(*) AS rowCount FROM users u ,customer_details c WHERE u.id=c.user_id";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }


}