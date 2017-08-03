<?php

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


        //$file_name = rand(10000, 9999999) . "-" .rand(10000, 9999999) . "-" . $_FILES['file']['name'];
        $file_name = km_filename_slugify($_FILES['file']['name']);

        $maxLimit = 50;
        $counter = 1;

        $f_name = $file_name;
        while(true) {

            if(!file_exists($upload_path . $file_name)) {
                break;
            }

            if($counter > $maxLimit) {
                break;
            }

            $file_name = $f_name;

            $file_name_arr = explode('.', $file_name);
            $extension = end($file_name_arr);
            $file_name = str_replace(".$extension", "($counter).$extension", $file_name);

            $counter++;
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . $file_name);

        $response["status"] = true;
        $response["image_name"] = $file_name;
        $response["uploaded_path"] = $upload_path;
        $response["message"] = "Image successfully uploaded";

    }

} else {
    $response["message"] = "maximum upload size crossed its limit";
}

function km_filename_slugify( $str ) {
    $str = strip_tags($str);
    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
    $str = preg_replace('/["\*\/\:\<\>\?\|]+/', ' ', $str);
    $str = strtolower($str);
    $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
    $str = htmlentities($str, ENT_QUOTES, "utf-8");
    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
    $str = str_replace(' ', '-', $str);
    $str = rawurlencode($str);
    $str = str_replace('%', '-', $str);
    return $str;
}

echo json_encode($response);