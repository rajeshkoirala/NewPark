<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 5:24 PM
 */

namespace App\Repositories;

use DB;

class DashboardRepository
{
    public function getAvailableEvent()
    {

        $todayDate = date('Y-m-d');
        $afterTwoMonthDate = date('Y-m-d', strtotime("+2 months", strtotime($todayDate)));

        $sql = "SELECT 	*,COUNT(id) AS no_of_event,
(SELECT event_name FROM `events` WHERE id = events_multiple_duration.`event_id`) AS event_name,
(SELECT event_desc FROM `events` WHERE id = events_multiple_duration.`event_id`) AS event_desc
                FROM `events_multiple_duration` WHERE available_date>='$todayDate' 
                AND available_date<='$afterTwoMonthDate' GROUP BY available_date ORDER BY available_date LIMIT 5";
        $event = DB::select($sql);

        return $event;
    }


    public function getOnlineCoursesCount()
    {

        $sql = "SELECT COUNT(*) AS rowCount FROM course where course_type_id = 1";
        $count = DB::select($sql);
        return $count[0]->rowCount;

    }

    public function getOfflineCoursesCount()
    {

        $sql = "SELECT COUNT(*) AS rowCount FROM course where course_type_id = 2";
        $count = DB::select($sql);
        return $count[0]->rowCount;

    }

    public function getAllCoursesCount()
    {

        $sql = "SELECT COUNT(*) AS rowCount FROM course WHERE course_type_id IN (1,2)";
        $count = DB::select($sql);
        return $count[0]->rowCount;

    }

    public function getPaymentHistory()
    {
        $sql = "SELECT db_date as paid_date, (SELECT IFNULL(SUM(paid_amount), 0) FROM payment_history WHERE DATE(created_at) = time_dimension.`db_date`) AS paid_amount FROM `time_dimension` WHERE db_date BETWEEN CURRENT_DATE - INTERVAL 15 DAY AND CURRENT_DATE;";
        $result = DB::select($sql);
        $data = array();

        foreach ($result as $item) {

            $data['paid_date'][] = $item->paid_date;
            $data['paid_amount'][] = $item->paid_amount;
        }

        return $data;

    }

    public function getVisitCount()
    {
        $sql = "SELECT * FROM `site_visit` ORDER BY visit_date DESC LIMIT 20";
        $result = DB::select($sql);

        $data = array();

        foreach ($result as $item) {

            $data['visit_date'][] = $item->visit_date;
            $data['visit_count'][] = $item->visit_count;
        }

        return $data;
    }


}