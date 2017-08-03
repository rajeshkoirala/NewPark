<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/24/2017
 * Time: 12:05 PM
 */

namespace App\Repositories;

use DB;

class NewsletterRepository
{

    public function findAll($offset, $limit)
    {
        $sql = "SELECT * FROM newsletter_subscribers LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) as rowCount FROM newsletter_subscribers";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function alreadySubscribedCheck($email)
    {
        $sql = "SELECT COUNT(*) as rowCount FROM newsletter_subscribers WHERE subscriber_email = '$email'";
        $result = DB::select($sql);

        return $result[0]->rowCount > 0 ? true : false ;

    }

}