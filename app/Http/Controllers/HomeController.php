<?php

namespace App\Http\Controllers;
use App\Courses;
use App\Admin\Enquiry;
use App\Repositories\HomeRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPMailerAutoload;
use PHPMailer;
use phpmailerException;
use App\Libraries\MailSender;

class HomeController extends Controller
{
   /* private $homeRepo;

    public function __construct()
    {
        $this->homeRepo = new HomeRepository();
    }*/

    public function index()
    {


        return view('home.index');
    }
    public function noOfseat($courseID,$availDate)
    {

        $no_of_seat = $this->homeRepo->getSeat($courseID,$availDate);


        return json_encode($no_of_seat[0]);
    }
    public function listAll(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $filter = $request->get('filter');


        echo json_encode($this->homeRepo->getAllHomePageCourses($offset, $limit,$filter));
    }


    public function sendEmail(Request $request){

        $input = $request->all();
        $enquiry = Enquiry::create($input);
        $enquiry->fill($input)->save();

        $name = $request->input('name');
        $sender_email = $request->input('email');
        $phone = $request->input('phone');
        $company_name = $request->input('company_name');
        $interested_course = $request->input('course_interested');
        $heard_from = $request->input('heard_from');
        $message = $request->input('message');
        $subject='Enquiry From Olive safety';
        $Mailsender= new MailSender();
        $message_body='';
        $message_body.='Sender Name:'.$name.'<br> Sender Email:'.$sender_email.'<br>Sender Phone:'.$phone.'<br>Company Name:'.$company_name.'<br>Interested Course:'.$interested_course.'
        <br>Heard From:'.$heard_from.' <br>Message:'.$message.'';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Olive Safety <info@olivesafety.ie>" . "\r\n";

        $Mailsender->send($sender_email, $subject, $message_body, $headers);
        MailSender::send($sender_email, $subject, $message_body, $headers);
        MailSender::send('kmulmi@olivemedia.co', $subject, $message_body, $headers);



        Session::flash('flash_message', 'Your Enquiry has been successfully done.We will contact you soon');

        return redirect()->back();
    }

}
