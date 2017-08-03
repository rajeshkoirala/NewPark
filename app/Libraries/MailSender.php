<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/30/2017
 * Time: 1:43 PM
 */

namespace App\Libraries;


use Exception;
use Illuminate\Support\Facades\URL;
use phpmailerException;

class MailSender
{
    public static function send($sender_email, $subject, $message_body, $headers = "")
    {

        $mail = new \PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "bs2b12345@gmail.com";
            $mail->Password = "Admin123!";
            $mail->setFrom('info@olivesafety.ie', "Olive Safety");
            $mail->addCustomHeader('MIME-Version: 1.0" . "\r\nContent-type:text/html;charset=UTF-8\r\nFrom: Olive Safety <info@olivesafety.ie>\r\n','');
            $mail->Subject = $subject;
            $mail->MsgHTML($message_body);
            $mail->addAddress($sender_email);
            $mail->send();
        } catch (phpmailerException $e) {

            dd($e);

        } catch (Exception $e) {

            dd($e);
        }
    }

    public static function sendBulk($emails, $subject, $message_body, $headers = "")
    {

        $mail = new \PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "bs2b12345@gmail.com";
            $mail->Password = "Admin123!";
            $mail->setFrom('info@olivesafety.ie', "Olive Safety");
            $mail->addCustomHeader('MIME-Version: 1.0" . "\r\nContent-type:text/html;charset=UTF-8\r\nFrom: Olive Safety <info@olivesafety.ie>\r\n','');
            $mail->Subject = $subject;
            $mail->MsgHTML($message_body);
            //$mail->addAddress("k@k.com");

            foreach ($emails as $email) {
                $mail->addBCC($email);
            }
            $mail->send();
        } catch (phpmailerException $e) {

            dd($e);

        } catch (Exception $e) {

            dd($e);
        }
    }

}