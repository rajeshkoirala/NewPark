<?php

namespace App\Libraries;

use Exception;

class AcademyHQApiIntegration
{

    private $app_id;
    private $app_secret_key;
    private $base_url = 'https://api.academyhq.com/api/v2';

    public function __construct()
    {
        $this->app_id = 'GXSjLh8ydDEbPPOs6TMB';
        $this->app_secret_key = 'TVwmTswqxEZ1b82uLI1xUiZPRatt4HCVY2yf33al';
    }

    public function create_learner($learner_info)
    {

        $password = substr(sha1(rand()), 0, 12);

        $url = $this->base_url . '/member/create';

        $request_parameters = array(
            'first_name' => $learner_info['first_name'],
            'last_name' => $learner_info['last_name'],
            'username' => $learner_info['username'],
            'email' => $learner_info['email'],
            'password' => $password,
            'password_confirmation' => $password,
            'app_id' => $this->app_id,
            'send_email' => 1
        );

        $app_signature = $this->generate_app_signature($url, $request_parameters);

        $request_parameters['app_signature'] = $app_signature;

        $req_param = http_build_query($request_parameters);
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_POST, true); //set true as we post
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $req_param); //post fields

        $result = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {

            throw new Exception(curl_errno($curl_handle));
        }

        curl_close($curl_handle);

        $result_array = json_decode($result, true);

        if (!isset($result_array['status']) || $result_array['status'] != 'Success') {

            throw new Exception($result_array['errors']);
        }

        $member_id = $result_array['member_id'];

        return $member_id;
    }

    public function create_enrolment($learner_id, $course_id)
    {

        $url = $this->base_url . '/enrolment/create';

        $request_parameters = array(
            'member_id' => $learner_id,
            'course_id' => $course_id,
            'app_id' => $this->app_id,
            'send_email' => 1
        );

        $app_signature = $this->generate_app_signature($url, $request_parameters);

        $request_parameters['app_signature'] = $app_signature;

        $req_parame = http_build_query($request_parameters);
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_POST, true); //set true as we post
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $req_parame); //post fields

        $result = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {

            throw new Exception(curl_errno($curl_handle));
        }

        curl_close($curl_handle);

        $result_array = json_decode($result, true);

        if (!isset($result_array['status']) || $result_array['status'] != 'Success') {

            throw new Exception($result_array['error']);
        }

        $enrolment_id = $result_array['enrolment_id'];

        return $enrolment_id;
    }

    public function check_learner($user)
    {

        $email = urlencode($user['email']);

        $url = $this->base_url . '/member_email/' . $email . '/get';
        $request_parameters = array(
            'app_id' => $this->app_id
        );

        $app_signature = $this->generate_app_signature($url, $request_parameters);

        $request_parameters['app_signature'] = $app_signature;

        $request_url = $url . '/?' . http_build_query($request_parameters, '', '&');

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $request_url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_HTTPGET, true);

        $result = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {

            throw new Exception(curl_errno($curl_handle));
        }

        curl_close($curl_handle);

        $result_array = json_decode($result, true);

        $member_id = 0;

        if (isset($result_array['status']) && strtolower($result_array['status']) == 'success') {

            $member_id = $result_array["member"]["id"];

        } else {

            $url = $this->base_url . '/member_username/' . urlencode($user['username']) . '/get';
            $request_parameters = array(
                'app_id' => $this->app_id
            );

            $app_signature = $this->generate_app_signature($url, $request_parameters);

            $request_parameters['app_signature'] = $app_signature;

            $request_url = $url . '/?' . http_build_query($request_parameters, '', '&');

            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $request_url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_handle, CURLOPT_HTTPGET, true);

            $result = curl_exec($curl_handle);

            if (curl_errno($curl_handle)) {

                throw new Exception(curl_errno($curl_handle));
            }

            curl_close($curl_handle);

            $result_array = json_decode($result, true);

            //var_dump($result_array);

            if (isset($result_array['status']) && strtolower($result_array['status']) == 'success') {
                $member_id = $result_array["member"]["id"];
            }
        }

        //exit();

        return $member_id;
    }

    private function generate_app_signature($url, $params)
    {
        $path = \parse_url($url, PHP_URL_PATH);

        ksort($params);
        $query_string = $path . '/?' . http_build_query($params, '', '&');

        return hash_hmac("sha256", $query_string, $this->app_secret_key);
    }
}