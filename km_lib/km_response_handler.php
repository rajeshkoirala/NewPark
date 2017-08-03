<?php

session_start();


require_once "km_repository_handler.php";

$post = $_POST;
//var_dump($post);exit;
$form_key = $post['form_key'];
$km_token = $post['km_token'];

if($_SESSION['km_token'] != $km_token) {
    //exit();
}

unset($post['form_key']);
unset($post['km_token']);

$sql = "DELETE FROM km WHERE form_key = :form_key";

$stmt = raGetDbConnection()->prepare($sql);
$stmt->bindParam(':form_key', $form_key);
$stmt->execute();

foreach ($post as $pKey => $pVal) {

    $km_key = $pKey;
    $km_val = $pVal;

    if (!is_array($km_val) && $km_val != "" && $km_val != null) {
        $sql = "INSERT 
                INTO km(form_key, km_key, km_value, insert_order) 
                VALUES (:form_key, :km_key, :km_val, '0')";

        $stmt = raGetDbConnection()->prepare($sql);
        $stmt->bindParam(':form_key', $form_key);
        $stmt->bindParam(':km_key', $km_key);
        $stmt->bindParam(':km_val', $km_val);

        $stmt->execute();
    }

    if (is_array($km_val)) {

        foreach ($km_val as $k => $m) {
            /*if($m != "" && $m != null) {*/

            $sql = "INSERT 
                    INTO km(form_key, km_key, km_value, insert_order) 
                    VALUES (:form_key, :km_key, :m, :k)";

            $stmt = raGetDbConnection()->prepare($sql);
            $stmt->bindParam(':form_key', $form_key);
            $stmt->bindParam(':km_key', $km_key);
            $stmt->bindParam(':m', $m);
            $stmt->bindParam(':k', $k);

            $stmt->execute();

            /*}*/
        }
    }
}

echo "success";
exit();