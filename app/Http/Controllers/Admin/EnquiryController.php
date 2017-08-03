<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Enquiry;
use App\Classes\Log;

use App\Repositories\EnquiryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class EnquiryController extends Controller
{
    private $enquiryRepo;

    public function __construct()
    {
        $this->enquiryRepo = new EnquiryRepository();
    }

    public function index()
    {
        Log::add('View', 'Inquiry module is viewed');
        return view('admin.enquiry.index');

    }

    public function listAll(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');

        echo json_encode($this->enquiryRepo->findAll($offset, $limit));
    }

    public function view($id="")
    {
        $request = request();

        if ($request->get('id')) {

            $id = $request->get('id');
        }
        $this->enquiryRepo->setViewed($id);
        $enquiry = Enquiry::findorNew($id);
        return view('admin.enquiry.view', compact('enquiry'));
    }


    public function delete(Request $request)
    {

        $id = $request->get('id');
        $enquiry = Enquiry::findOrFail($request->get('id'));
        DB::table('enquiry')->where('id', '=', $id)->delete();
        Log::add('Delete', 'Enquiry  associated, Email: '.'<a href="mailto:'.$enquiry->email.'">'.$enquiry->email.'</a>'.' is deleted.');
        Session::flash('flash_message', "Enquiry Deleted");
        return redirect('admin/enquiry');
    }

}
