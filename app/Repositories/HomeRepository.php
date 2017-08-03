<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 1:47 PM
 */

namespace App\Repositories;

use DB;

class HomeRepository
{
    public function getAllHomePageCourses($offset, $limit, $filter)
    {


        $extra_sql = "";

        if ($filter) {
            $search_text = $filter['search_text'];
            $extra_sql .= " AND c.course_name LIKE '%" . $search_text . "%'";

        }


        $sql = "SELECT c.course_name,c.course_short_desc,c.academy_course_id,c.id,ct.course_type_name,p.price,p.currency_type,c.image_name FROM course c ,courses_type ct,price p 
                        WHERE c.course_type_id=ct.id AND c.id=p.course_id $extra_sql LIMIT $offset, $limit";


        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,courses_type ct,price p WHERE c.course_type_id=ct.id AND c.id=p.course_id $extra_sql";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getSeat($id,$availDate)
    {
        $sql = "SELECT max(IFNULL((SELECT no_of_seat FROM events WHERE id = events_multiple_duration.event_id), 0) - 
                      (SELECT IFNULL(SUM(no_seats), 0) FROM booking WHERE course_id = events_multiple_duration.course_id 
                        AND booked_date = '$availDate')) AS no_of_seat
                        FROM events_multiple_duration WHERE course_id = '$id'  AND available_date >= '$availDate' ORDER BY available_date";
         $no_of_seat = DB::select($sql);
         return $no_of_seat;
    }

    public function getOnlineCourse($courseTypeID)
    {
        $sql = "SELECT course_name,id FROM course WHERE course_type_id='$courseTypeID'";
        $course = DB::select($sql);
        return $course;
    }

    public function getCourseByRandom()
    {

        $sql = "SELECT course_name,id,course_short_desc FROM course WHERE id in(SELECT course_id FROM price GROUP BY course_id ORDER BY COUNT(course_id) DESC) LIMIT 0,3";
        $course = DB::select($sql);
        return $course;
    }

    public function getCoursePopular()
    {
        $sql = "SELECT course_name,id,course_short_desc FROM course WHERE course_type_id='1' LIMIT 0,1";

        $course = DB::select($sql);

        return $course;
    }

    public function getCourseOffline()
    {
        $sql = "SELECT course_name,id,course_short_desc FROM course WHERE course_type_id='2' LIMIT 0,1";

        $course = DB::select($sql);

        return $course;
    }

    public function getCategoryPopular()
    {
        $sql = "SELECT category_name,id FROM categories LIMIT 0,1";

        $category = DB::select($sql);

        return $category;
    }

    public function getCourseByCategory($categoryName)
    {
        $sql = "SELECT course_name,id FROM course WHERE  category_id IN(SELECT id FROM categories WHERE category_name='$categoryName')";

        $course = DB::select($sql);

        return $course;
    }


}