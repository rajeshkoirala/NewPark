<?php

namespace App\Http\Controllers;


use App\Libraries\KM;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class KmController extends Controller
{
    public function attribute_save_or_update(Request $request)
    {
        $fields = json_decode($request->get("all_fields"));
        KM::delete('km', $fields[0]->key);

        foreach ($fields as $field) {

            if (is_array($field->meta_value)) {
                $field->meta_value = json_encode($field->meta_value);
            }
            DB::table('km')->insert($field);
        }

        Session::flash('flash_message', "Successfully saved");
        redirect($request->get('return_url'));
    }

    public function uploadFile()
    {
        $upload_path = "uploads/";
        $response = array(
            'status' => false,
            'image_name' => '',
            'message' => '',
            'uploaded_path' => '',
        );

        if (isset($_FILES["file"])) {
            if (0 < $_FILES['file']['error']) {
                $response["message"] = 'Error: ' . $_FILES['file']['error'];
            } else {
                $file_name = rand(10000, 9999999) . "-" . rand(10000, 9999999) . "-" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $file_name);

                $response["status"] = true;
                $response["image_name"] = $file_name;
                $response["uploaded_path"] = $upload_path;
                $response["message"] = "Image successfully uploaded";
            }

        } else {

            $response["message"] = "maximum upload size crossed its limit";
        }

        echo json_encode($response);
    }
}