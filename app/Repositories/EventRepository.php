<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/21/2017
 * Time: 11:53 AM
 */

namespace App\Repositories;

use DB;
class EventRepository
{
    public function findAll($offset, $limit,$filter)
    {

        $extSql = "";
        if($filter) {

            $event_name = $filter['event_name'];

            if($event_name != "") {
                $extSql = " AND event_name LIKE '%".$filter["event_name"]."%'";
            }
        }

        $sql = "SELECT *,DATE_FORMAT(start_date, '%Y-%m-%d') AS start_date,DATE_FORMAT(end_date, '%Y-%m-%d') AS end_date FROM events WHERE 1=1 $extSql LIMIT $offset, $limit";
        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM events WHERE 1=1 $extSql";
        $count = DB::select($sql);
        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function deleteExistingDate($eventID) {
        $sql = "DELETE FROM events_multiple_duration WHERE event_id = '$eventID'";
        DB::statement($sql);
    }

    public function getCourses($id)
    {

        $sql = "SELECT course_name,course_detail_desc,image_name FROM course WHERE 1=1 and id='$id'";

        $course = DB::select($sql);

        return $course;
    }

    public function getCurrency()
    {
        $sql = "SELECT currency FROM clients WHERE id='$this->clientID'";

        $currency = DB::select($sql);

        return $currency;

    }

    public function getLatestEventByCourseID($courseID, $date = "")
    {
        $bookedDate = " AND booked_date = CURRENT_DATE";
        $extSql = "";

        if($date != "" && $date != null) {
            $date = str_replace('/','-',$date);
            $date = date('Y-m-d', strtotime($date));

            $extSql .= " AND available_date = '$date' ";
            $bookedDate = " AND booked_date = '$date'";
        }

        $sql = "SELECT 
                    *,
                    (SELECT event_name FROM events WHERE id = events_multiple_duration.event_id) As event_name,
                    (SELECT course_name FROM course WHERE id = events_multiple_duration.course_id) As course_name,
                    IFNULL((SELECT no_of_seat FROM events WHERE id = events_multiple_duration.event_id), 0) - (SELECT IFNULL(SUM(no_seats), 0) FROM booking WHERE course_id = events_multiple_duration.course_id $bookedDate) AS no_of_seat,
                    (SELECT event_time_start FROM events WHERE id = events_multiple_duration.event_id) As event_time_start,
                    (SELECT event_time_end FROM events WHERE id = events_multiple_duration.event_id) As event_time_end,
                    (SELECT price FROM price WHERE course_id = events_multiple_duration.course_id) As course_price
                FROM events_multiple_duration WHERE course_id = '$courseID' AND available_date >= CURRENT_DATE $extSql ORDER BY available_date";
//echo $sql;exit;
        $data = DB::select($sql);

        return $data;
    }

    public function getEventListing($av_month)
    {
         $sql = "SELECT course.course_name,eve.course_id,eve.event_name,eve.event_desc,eve.event_time_start,eve.event_time_end,
                      DATE_FORMAT(eve_mul.available_date,'%M') AS showMonth,
                       DATE_FORMAT(eve_mul.available_date,'%d') AS showDay,
                      DATE_FORMAT(eve_mul.available_date,'%M %D ,%Y') AS fullDate,cours.price,eve_mul.available_date
                      FROM events eve ,events_multiple_duration eve_mul,price cours ,course course
                WHERE eve.id=eve_mul.event_id AND eve_mul.course_id=cours.course_id AND course.id=eve_mul.course_id AND eve_mul.available_date<>'' 
                AND DATE_FORMAT(eve_mul.available_date,'%M')='$av_month' 
                GROUP BY eve_mul.available_date ASC";
        $events = DB::select($sql);

        return $events;
    }
    public function getMonthListing()
    {
        $sql = "SELECT DISTINCT DATE_FORMAT(eve_mul.available_date,'%M') AS displayMonth
                FROM events eve ,events_multiple_duration eve_mul,price cours ,course course
                WHERE eve.id=eve_mul.event_id AND eve_mul.course_id=cours.course_id AND course.id=eve_mul.course_id 
                AND eve_mul.available_date<>''
                GROUP BY eve_mul.available_date ASC";
        $months = DB::select($sql);

        return $months;
    }
    public function getPrice($courseID)
    {
        $sql = "SELECT price from price where course_id='$courseID'";
        $price = DB::select($sql);

        return $price;
    }



}