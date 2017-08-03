<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    private $courseRepo;

    public function __construct()
    {
        $this->courseRepo = new CourseRepository();
    }

    public function index($courseTypeID = "")
    {
        $request = request();

        if ($request->get('courseTypeID')) {

            $courseTypeID = $request->get('courseTypeID');
        }


        $relatedCourses = $this->courseRepo->getRelatedCoursesFront($courseTypeID);


        return view('course.index', compact('relatedCourses', 'courseTypeID'));
    }


    public function courseSearch()
    {
        $request = request();
        if ($request->get('searchTxt')) {

            $searchTxt = $request->get('searchTxt');
        }

        $courseTypeID="";
        $relatedCourses = $this->courseRepo->getRelatedCoursesSearch($searchTxt);
        return view('course.index', compact('relatedCourses', 'courseTypeID','searchTxt'));
    }



    public function onlineCourseMenu()
    {

        $onlineCoursesMenu = $this->courseRepo->getRelatedCoursesFront('1');
        return view('layout-master', compact('onlineCoursesMenu'));
    }

    public function listAll($courseTypeID = "")
    {
        $request = request();
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        if ($request->get('courseTypeID')) {

            $courseTypeID = $request->get('courseTypeID');
        }

        echo json_encode($this->courseRepo->findAllFrontPage($offset, $limit,$request, $courseTypeID));
    }

    public function listSearch()
    {
        $request = request();
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $filter = $request->get('filter');

        echo json_encode($this->courseRepo->findSearchCourseFrontPage($offset, $limit, $filter));

    }




}
