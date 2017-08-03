<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/8/2017
 * Time: 11:32 AM
 */

namespace App\Repositories;

use DB;

class CourseDetailRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT c.course_name,c.course_short_desc,c.academy_course_id,c.id,ct.course_type_name FROM course c ,courses_type ct WHERE c.course_type_id=ct.id LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,courses_type ct WHERE c.course_type_id=ct.id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function findAllFrontPage($offset, $limit, $courseTypeID)
    {

        if ($courseTypeID == 0)
            $extraSQL = " AND ";
        if ($courseTypeID == 1)
            $extraSQL = " AND c.course_type_id='1' AND ";
        if ($courseTypeID == 2)
            $extraSQL = " AND c.course_type_id='2' AND ";


        $sql = "SELECT c.course_name,c.course_short_desc,c.academy_course_id,c.id,p.price,p.currency_type 
                FROM course c ,price p 
                        WHERE 1=1 $extraSQL  c.id=p.course_id LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM course c ,price p WHERE 1=1 $extraSQL c.id=p.course_id";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getSeo($courseID)
    {
        $sql = "SELECT * FROM seo WHERE type_id='$courseID' and type='COURSE'";
        $seoDetail = DB::select($sql);

        return $seoDetail;
    }
    public function getCourseDetail($courseID)
    {
        $sql = "SELECT *, CASE WHEN image_name <> '' AND image_name IS NOT NUll THEN image_name ELSE 'demo.gif' END AS image_name FROM course WHERE id='$courseID'";
        $courseDetail = DB::select($sql);

        return $courseDetail;
    }

    public function getRelatedCourses($courseID)
    {
         $sql = "SELECT rel_course_id,(SELECT course_name FROM course WHERE id=related_courses.rel_course_id) AS course_name,
             
               (SELECT image_name FROM course WHERE id=related_courses.rel_course_id) AS img_name
                FROM related_courses WHERE course_id='$courseID'";
        $relatedCourse = DB::select($sql);
        return $relatedCourse;
    }
    public function getRelatedCoursesCount($courseID)
    {
        $sql = "SELECT count(*) as cnt
                FROM related_courses WHERE course_id='$courseID'";
        $relatedCourse = DB::select($sql);
        return $relatedCourse;
    }
    public function getModules($courseID)
    {
        $sql = "SELECT * FROM modules WHERE course_id='$courseID'";
        $modules = DB::select($sql);

        return $modules;
    }

}