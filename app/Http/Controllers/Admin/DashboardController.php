<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Log;
use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class DashboardController extends Controller
{
    private $dashboardRepository;

    /**
     * CategoriesController constructor.
     */
    public function __construct()
    {
        $this->dashboardRepository = new DashboardRepository();
    }

    public function index()
    {

        $OffcourseCount = $this->dashboardRepository->getOfflineCoursesCount();
        $OncourseCount = $this->dashboardRepository->getOnlineCoursesCount();
        $AllcourseCount = $this->dashboardRepository->getAllCoursesCount();
        $AvailableEvent = $this->dashboardRepository->getAvailableEvent();
        $PaymentHistory = $this->dashboardRepository->getPaymentHistory();
        $visitRecord = $this->dashboardRepository->getVisitCount();

        Log::add('View', 'Dashboard module is viewed');

        return view('admin.dashboard.index', compact('AvailableEvent','AllcourseCount','OffcourseCount','OncourseCount','PaymentHistory', 'visitRecord'));
    }


}
