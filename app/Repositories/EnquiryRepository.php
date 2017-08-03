<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/28/2017
 * Time: 3:14 PM
 */

namespace App\Repositories;

use DB;


class EnquiryRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT * FROM enquiry LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) as rowCount FROM enquiry";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getNotViewedEnquiry()
    {
        $sql = "SELECT * FROM enquiry WHERE is_viewed = 0 OR is_viewed IS NULL LIMIT 5";

        $enquiry = DB::select($sql);

        return $enquiry;
    }

    public function setViewed($id)
    {

    /*    $sql = "UPDATE enquiry SET is_viewed  = 1 WHERE id = $id";*/

        $view_update = DB::table('enquiry')
            ->where('id', $id)
            ->update(array('is_viewed' => 1));

        return $view_update;
    }


}