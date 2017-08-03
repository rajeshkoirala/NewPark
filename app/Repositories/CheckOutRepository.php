<?php

namespace App\Repositories;

use App\Libraries\Encryption;
use App\Libraries\MailSender;
use App\User;
use Illuminate\Http\Request;

class CheckOutRepository
{
    public function registerUserIfNotExists(Request $request)
    {
        if(\Auth::check()) {

            /*return \Auth::user();
            $email = \Auth::user()->email;

            $userData = User::where(array('email' => $email))->get();*/
            $returnUser = \Auth::user();

        } else if($request->get('email')){

            $encrypt = new Encryption();

            $username = $encrypt->getUsername($request->get('first_name').$request->get('last_name'));
            $password = $encrypt->getComplexPassword();

            $user = array(
                'username' => $username,
                'full_name' => ucwords($request->get('first_name').' '.$request->get('last_name')),
                'email' => $request->get('email'),
                'password' => \Hash::make($password),
                'user_type' => 3,
                'phone_no' => $request->get('phone_no'),
                'country' => $request->get('country'),
                'state' => $request->get('state'),
                'address' => $request->get('billing_street'),
                'zip_code' => $request->get('zip_code'),
                'additional_info' => $request->get('additional_info'),
            );

            $returnUser = User::create($user);

            $messageBody = "<h2>Welcome to Olive Safety</h2>
                            Thank you for your course purchase,<br/>
                            Here are your login credentials <br/>
                            Username: <b>$username</b>
                            Password: <b>$password</b>
                            Link: http://olivesafety.ie";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Olive Safety Team <" . kmGetData('contact-details', 'contact_email') . ">" . "\r\n";

            MailSender::send($request->get('email'), 'Olive Safety New user', $messageBody, $headers);
        } else {
            die("some terrible error");
        }

        return $returnUser;
    }
}