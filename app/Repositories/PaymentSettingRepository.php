<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/8/2017
 * Time: 11:32 AM
 */

namespace App\Repositories;

use DB;

class PaymentSettingRepository
{
    public function show($id=1)
    {


        $sql = "SELECT * FROM payment_setting WHERE id = '$id'";
        $paymentsetting = DB::select($sql);
        return $paymentsetting;
    }


    public function findAll($offset, $limit, $filter)
    {

        $extSql = "";
        /*       if($filter) {
                   $extSql = " AND action = '".$filter["action"]."'";
               }*/

        if($filter) {

            //$action = $filter['action'];
            $start_date = $filter['start_date'].' 00:00:00';
            $end_date = $filter['end_date'].' 00:00:00';

            if ($filter["start_date"] != "" && $filter["end_date"] != "") {
                // $extSql = " AND assigned_date BETWEEN '" . $filter['fromDate'] . "' AND '" . $filter['toDate'] . "'";
                $extSql = " AND created_at BETWEEN '" . $start_date. "' AND '" . $end_date . "'";
            }



        }


        $sql= "SELECT * FROM payment_history WHERE 1 = 1 $extSql ORDER BY id DESC LIMIT $offset, $limit";

        /*        $sql= "SELECT a.id, a.action, a.description,a.ip_address,a.user_agent,a.updated_at,u.full_name FROM activity_log a
                  LEFT JOIN users u ON a.user_id = u.id WHERE 1 = 1 $extSql ORDER BY a.id DESC LIMIT $offset, $limit";*/


        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM payment_history WHERE 1 = 1 $extSql";

        //$sql = "SELECT COUNT(*) AS rowCount FROM activity_log WHERE 1=1 $extSql";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

}