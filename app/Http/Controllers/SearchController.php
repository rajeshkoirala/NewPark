<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/27/2017
 * Time: 10:32 AM
 */

namespace App\Http\Controllers;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    private $courseRepository;

    public function __construct()
    {
        $this->courseRepository = new CourseRepository();
    }
    public function index()
    {
        //$newslist = $this->newsRepository->getNewslist();
        return view('layout-master');
    }

    public function listAll(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');

        echo json_encode($this->courseRepository->searchAll($offset, $limit,$request));
    }

}