<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/24/2017
 * Time: 5:15 PM
 */

namespace App\Repositories;
use DB;

class ScheduleRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT * FROM schedule LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) as rowCount FROM schedule";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }
    public function getSeo($courseID)
    {
        $sql = "SELECT * FROM seo WHERE type_id='$courseID' and type='Schedule'";
        $seoDetail = DB::select($sql);

        return $seoDetail;
    }

    public function getSchedule($date)
    {
        $extSql = " DATE(schedule_date) = CURRENT_DATE ";

        if($date != "" && $date != null) {
            $extSql = " DATE(schedule_date) = '$date' ";
        }

        $sql = "SELECT * FROM `schedule` WHERE $extSql ORDER BY created_at";

        $schedule = DB::select($sql);

        return $schedule;
    }

    public function getAllScheduleDates()
    {
        $sql = "SELECT GROUP_CONCAT('',DATE_FORMAT(schedule_date, '%Y-%m-%d')) as schedule_date FROM `schedule`";

        $schedule = DB::select($sql);

        return $schedule;
    }

}