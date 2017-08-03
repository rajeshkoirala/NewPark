<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/8/2017
 * Time: 11:32 AM
 */

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;

class CourseRepository
{
    public function findAll($offset, $limit, $filter)
    {


        $extra_sql = "";

        if ($filter) {

            $search_text = $filter['course_name'];


            //echo $search_text;

            if ($search_text != "" && $search_text != null) {
                $extra_sql .= " AND c.course_name LIKE '%" . $search_text . "%'";
            }


        }


        $sql = "SELECT *, c.id as course_id, preety_date(c.created_at) as created_at, CASE WHEN trim(image_name) <> '' AND image_name IS NOT NUll THEN image_name ELSE 'demo.gif' END AS image_name FROM course c ,courses_type ct WHERE c.course_type_id=ct.id $extra_sql ORDER BY c.created_at DESC LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,courses_type ct WHERE c.course_type_id=ct.id $extra_sql";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function searchAll($offset, $limit, Request $request)
    {

        $filter = $request->get('filter');

        $extra_sql = "";

        if ($filter) {

            $search_text = $filter['search_text'];


            //echo $search_text;

            if ($search_text != "" && $search_text != null) {
                $extra_sql .= " AND c.course_name LIKE '%" . $search_text . "%'";
            }


        }


        $sql = "SELECT c.course_name,c.course_short_desc,c.image_name,c.academy_course_id,c.id as course_id,ct.course_type_name FROM course c ,courses_type ct WHERE c.course_type_id=ct.id $extra_sql LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,courses_type ct WHERE c.course_type_id=ct.id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function findAllFrontPage($offset, $limit, $request, $courseTypeID)
    {

        if ($courseTypeID == 0)
            $extraSQL = " AND ";
        if ($courseTypeID == 1)
            $extraSQL = " AND c.course_type_id='1' AND ";
        if ($courseTypeID == 2)
            $extraSQL = " AND c.course_type_id='2' AND ";


        $filter = $request->get('filter');

        $extra_sql = "";

        if ($filter) {

            $search_text = $filter['search_text'];


            //echo $search_text;

            if ($search_text != "" && $search_text != null) {
                $extra_sql .= "   course_name LIKE '%" . $search_text . "%' AND ";
            }

            $categoryIDs = implode(',', json_decode($filter['categoryIDs']));

            if ($categoryIDs != "" && $categoryIDs != null) {

                $extra_sql .= "   category_id IN($categoryIDs) AND ";
            }


        }


        $sql = "SELECT c.course_name,c.course_short_desc,c.academy_course_id,c.id,p.price,p.currency_type,c.image_name 
                FROM course c ,price p 
                        WHERE 1=1 $extraSQL $extra_sql   c.id=p.course_id  LIMIT $offset, $limit";
//echo $sql;exit;
        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,price p WHERE 1=1 $extraSQL $extra_sql  c.id=p.course_id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function findSearchCourseFrontPage($offset, $limit, $filter)
    {

        $extra_sql = "";

        if ($filter) {
            $search_text = $filter['search_text'];
            $extra_sql .= " AND course_name LIKE '%" . $search_text . "%' AND ";

        } else
            $extra_sql .= " AND ";


        $sql = "SELECT c.course_name,c.course_short_desc,c.academy_course_id,c.id,p.price,p.currency_type,c.image_name 
                FROM course c ,price p 
                        WHERE 1=1 $extra_sql  c.id=p.course_id LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,price p WHERE 1=1 $extra_sql c.id=p.course_id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }
    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $categories = DB::select($sql);

        return $categories;
    }

    public function getRelatedCoursesIDs($courseID)
    {
        $sql = "SELECT * FROM related_courses WHERE course_id = '$courseID'";
        $courses = DB::select($sql);

        $courseIDArray = array();

        if (count($courses) > 0) {
            foreach ($courses as $course) {
                $courseIDArray[] = $course->rel_course_id;
            }
        }
        
        return $courseIDArray;
    }

//    public function getSubscribers()
//    {
//        $sql = "SELECT * FROM newsletter_subscribers";
//        $subscribers = DB::select($sql);
//
//        $subscribersArray = array();
//
//        if (count($subscribers) > 0) {
//            foreach ($subscribers as $subscrib) {
//                $subscribersArray[] = $subscrib->subscriber_email;
//            }
//        }
//
//        return $subscribersArray;
//    }

    public function getCourseType()
    {
        $sql = "SELECT * FROM courses_type";
        $coursesType = DB::select($sql);

        return $coursesType;
    }

    public function getRelatedCourses($courseID)
    {
        $sql = "SELECT * FROM related_courses where course_id='$courseID'";
        $relatedCourse = DB::select($sql);

        return $relatedCourse;
    }


    public function deleteRelatedCourses($courseID)
    {
        $sql = "DELETE FROM related_courses WHERE course_id = '$courseID'";
        DB::statement($sql);
    }

    public function getRelatedCoursesFront($courseTypeID)
    {
        if ($courseTypeID == 0)
            $extraSQL = " AND ";
        if ($courseTypeID == 1)
            $extraSQL = " AND c.course_type_id='1' AND ";
        if ($courseTypeID == 2)
            $extraSQL = " AND c.course_type_id='2' AND ";

        $sql = "SELECT c.course_name,c.id,p.price,c.image_name, c.course_short_desc FROM course c,related_courses r,price p
                WHERE 1=1 $extraSQL c.id=r.rel_course_id AND c.id=p.course_id";

        return $relatedCourse = DB::select($sql);

    }

    public function getRelatedCoursesSearch($courseName)
    {


        $sql = "SELECT c.course_name,c.id,p.price,c.image_name FROM course c,related_courses r,price p
                WHERE c.id=r.rel_course_id AND c.id=p.course_id AND course_name LIKE '%$courseName%'";

        return $relatedCourse = DB::select($sql);

    }

    public function getCourseByCourseType($courseTypeID)
    {
        $sql = "SELECT course_name,id,image_name FROM course WHERE course_type_id='$courseTypeID'";

        $course = DB::select($sql);

        return $course;
    }

    public function getCourseByCourseTypeFooter($courseTypeID)
    {
        $sql = "SELECT course_name,id FROM course WHERE course_type_id='$courseTypeID' LIMIT 0,5";
        $course = DB::select($sql);

        return $course;
    }

    public function getPopularCourse()
    {

        $sql = "SELECT course_name,id,image_name,(SELECT price FROM price WHERE course_id=course.id ) AS price_amt 
              FROM course WHERE id in(SELECT course_id FROM price GROUP BY course_id ORDER BY COUNT(course_id) DESC) LIMIT 0,5";
        $course = DB::select($sql);

        return $course;
    }


    public function getCourseByCategories($categoryType)
    {
        $sql = "SELECT course_name,id FROM course WHERE category_id IN(
                    SELECT id FROM categories WHERE category_name='$categoryType')";

        $course = DB::select($sql);

        return $course;
    }


}