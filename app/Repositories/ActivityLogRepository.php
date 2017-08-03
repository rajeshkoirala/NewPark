<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 5:24 PM
 */

namespace App\Repositories;

use DB;

class ActivityLogRepository
{
    public function findAll($offset, $limit, $filter)
    {

        $extSql = "";

        if ($filter) {

            $action = $filter['action'];
            $start_date = $filter['start_date'] . ' 00:00:00';
            $end_date = $filter['end_date'] . ' 23:59:59';
            $user_id = $filter['user_id'];

            if ($filter["start_date"] != "") {
                $extSql = " AND a.updated_at LIKE '" . $filter['start_date'] . "%'";
            }
            if ($filter["end_date"] != "") {
                $extSql = " AND a.updated_at LIKE '" . $filter['end_date'] . "%'";
            }


            if ($user_id != "") {

                $extSql = " AND a.user_id = '" . $filter["user_id"] . "'";
            }
            if ($filter["start_date"] != "" && $user_id != "") {
                $extSql = " AND a.updated_at LIKE '" . $filter['start_date'] . "%' AND a.user_id = '" . $filter["user_id"] . "'";
            }
            if ($filter["end_date"] != "" && $user_id != "") {
                $extSql = " AND a.updated_at LIKE '" . $filter['end_date'] . "%' AND a.user_id = '" . $filter["user_id"] . "'";
            }

            if ($action != "") {
                $extSql = " AND action = '" . $filter["action"] . "'";

            }
            if ($action != "" && $filter["user_id"] != "") {
                $extSql = " AND action = '" . $filter["action"] . "' AND a.user_id = '" . $filter["user_id"] . "'";

            }

            if ($action != "" && $filter["user_id"] != "" && $filter["start_date"] != "" && $filter["end_date"] != "") {
                $extSql = " AND action = '" . $filter["action"] . "' AND a.user_id = '" . $filter["user_id"] . " AND a.updated_at BETWEEN '" . $start_date . "' AND '" . $end_date . "'";

            }


            if ($filter["start_date"] != "" && $filter["end_date"] != "") {
                $extSql = " AND a.updated_at BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
            }

            if ($filter["action"] != "" && $filter["start_date"] != "" && $filter["end_date"] != "") {
                $extSql = " AND action = '" . $filter["action"] . "' AND a.updated_at BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
            }

        }


        $sql = "SELECT a.id, a.action, a.description,a.ip_address,a.user_agent,a.updated_at,u.full_name FROM activity_log a 
          , users u WHERE 1 = 1 AND a.user_id = u.id  $extSql ORDER BY a.id DESC LIMIT $offset, $limit";

        /*        $sql= "SELECT a.id, a.action, a.description,a.ip_address,a.user_agent,a.updated_at,u.full_name FROM activity_log a
                  LEFT JOIN users u ON a.user_id = u.id WHERE 1 = 1 $extSql ORDER BY a.id DESC LIMIT $offset, $limit";*/


        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM activity_log a , users u WHERE 1 = 1 AND a.user_id = u.id  $extSql";

        //$sql = "SELECT COUNT(*) AS rowCount FROM activity_log WHERE 1=1 $extSql";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getUserName()
    {
        $sql = "SELECT * FROM users WHERE user_type=1";
        $user = DB::select($sql);

        return $user;
    }

}