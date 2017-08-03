<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function fileUpload(Request $request)
    {
        $upload_path = "public/uploads/";
        $response = array(
            'status' => false,
            'name' => '',
            'message' => '',
            'type' => '',
            'uploaded_path' => '',
        );

        if (isset($_FILES["file"])) {


            if (0 < $_FILES['file']['error']) {
                $response["message"] = 'Error: ' . $_FILES['file']['error'];
            } else {
                $file_name = rand(10000, 9999999) . "-" . rand(10000, 9999999) . "-" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], 'public/uploads/' . $file_name);

                $response["status"] = true;
                $response["name"] = $file_name;
                $response["type"] = $_FILES["file"]["type"];
                $response["uploaded_path"] = $upload_path;
                $response["message"] = "Successfully uploaded";
            }
        } else {
            $response["message"] = "maximum upload size crossed its limit";
        }
        echo json_encode($response);
    }

    public function fileUpload2(Request $request)
    {
        $upload_path = "public/uploads/";
        $response = array(
            'status' => false,
            'name' => '',
            'message' => '',
            'type' => '',
            'uploaded_path' => '',
        );

        if (isset($_FILES["file"])) {


            if (0 < $_FILES['file']['error']) {
                $response["message"] = 'Error: ' . $_FILES['file']['error'];
            } else {
                $file_name = rand(10000, 9999999) . "-" . rand(10000, 9999999) . "-" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], 'public/uploads/' . $file_name);

                $response["status"] = true;
                $response["name"] = $file_name;
                $response["type"] = $_FILES["file"]["type"];
                $response["uploaded_path"] = $upload_path;
                $response["message"] = "Successfully uploaded";
            }
        } else {
            $response["message"] = "maximum upload size crossed its limit";
        }
        echo json_encode($response);
    }
}
