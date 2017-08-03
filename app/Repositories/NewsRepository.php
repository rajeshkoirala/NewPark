<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/24/2017
 * Time: 4:08 PM
 */

namespace App\Repositories;

use DB;

class NewsRepository
{
    public function getSeo($newsID)
    {
         $sql = "SELECT * FROM seo WHERE type_id='$newsID' and type='NEWS'";
        $seoDetail = DB::select($sql);

        return $seoDetail;
    }
    public function findAll($offset, $limit, $filter)
    {
        $extra_sql = "";

        if ($filter) {

            $search_text = $filter['news_title'];

            if ($search_text != "" && $search_text != null) {
                $extra_sql .= " WHERE news_title LIKE '%" . $search_text . "%'";
            }


        }

        $sql = "SELECT *, CASE WHEN news_image <> '' AND news_image IS NOT NUll THEN news_image ELSE 'demo.gif' END AS news_image,
                    (SELECT `course_name` FROM `course` WHERE id = news.`course_id`) AS course_name,
                     (SELECT `course_type_name` FROM `courses_type` WHERE id = news.`course_typeid`) AS course_type,
                    DATE_FORMAT(posted_date, '%d') as day,
                    DATE_FORMAT(posted_date, '%M') as month,
                    DATE_FORMAT(posted_date, '%Y') as year,
                    preety_date(created_at) as created_at
                FROM news $extra_sql ORDER BY posted_date DESC LIMIT $offset, $limit";


        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM news $extra_sql";
        $count = DB::select($sql); //var_dump($count);exit();
        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getAll($offset, $limit, $filter)
    {
        $extra_sql = "";

        if ($filter) {

            $search_text = $filter['news_title'];

            if ($search_text != "" && $search_text != null) {
                $extra_sql .= "AND news_title LIKE '%" . $search_text . "%'";
            }


        }

        $sql = "SELECT *, CASE WHEN news_image <> '' AND news_image IS NOT NUll THEN news_image ELSE 'demo.gif' END AS news_image,
                    (SELECT `course_name` FROM `course` WHERE id = news.`course_id`) AS course_name,
                     (SELECT `course_type_name` FROM `courses_type` WHERE id = news.`course_typeid`) AS course_type,
                    DATE_FORMAT(posted_date, '%d') as day,
                    DATE_FORMAT(posted_date, '%M') as month,
                    DATE_FORMAT(posted_date, '%Y') as year
                FROM news WHERE posted_date <= CURDATE() $extra_sql ORDER BY posted_date DESC LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM news WHERE posted_date <= CURDATE() $extra_sql";
        $count = DB::select($sql); //var_dump($count);exit();
        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function getCourses()
    {

        $sql = "SELECT * FROM course";
        $projects = DB::select($sql);

        return $projects;

    }

    public function getCoursesType()
    {

        $sql = "SELECT * FROM courses_type";
        $projects = DB::select($sql);

        return $projects;

    }

    public function getNewsdetail($id)
    {

        $sql = "SELECT *,
        (SELECT `course_name` FROM `course` WHERE id = news.`course_id`) AS courses_name,
        (SELECT `course_type_name` FROM `courses_type` WHERE id = news.`course_typeid`) AS courses_type,
         DATE_FORMAT(posted_date, '%d') as day,
            DATE_FORMAT(posted_date, '%M') as month,
            DATE_FORMAT(posted_date, '%Y') as year,
            CASE WHEN news_image <> '' AND news_image IS NOT NUll THEN news_image ELSE 'demo.gif' END AS news_image
        FROM news WHERE `id`= $id";
        $news = DB::select($sql);

        return $news;

    }

    public function getHomeNewsDisplay()
    {

        $sql = "SELECT * FROM news WHERE posted_date <= CURDATE() ORDER BY posted_date DESC limit 0,2";
        $news = DB::select($sql);

        return $news;

    }

    public function getAllComments($id)
    {

        $sql = "SELECT * FROM comments WHERE news_id = $id";
        $comments = DB::select($sql);

        return $comments;

    }

}