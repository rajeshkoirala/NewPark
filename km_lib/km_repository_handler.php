<?php
include_once "km-config.php";
function getRaData($form_key, $name)
{
    global $km_looping;
    global $km_loop_counter;

    $limit = "";
    if ($km_looping || $km_loop_counter > 0) {
        $limit = "LIMIT $km_loop_counter, 1";
    }

    $sql = "SELECT * FROM km WHERE form_key = :form_key AND km_key = :km_key ORDER BY insert_order $limit";

    $stmt = raGetDbConnection()->prepare($sql);
    $stmt->bindParam(':form_key', $form_key);
    $stmt->bindParam(':km_key', $name);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $returnData = "";

    if ($stmt->rowCount() > 0) {
        $returnData = $data[0]["km_value"];

    } else {

        $km_looping = false;
    }

    return $returnData;
}

function kmGetData($form_key, $name)
{
    $data = raDataFetch($form_key, $name);

    return isset($data[0]['km_value']) ? $data[0]['km_value'] : '';
}

function kmGetLoopData($form_key, $nameArray)
{
    if(!is_array($nameArray)) die('some terrible error');
    $as = array();
    foreach ($nameArray as $nm) {
        $as[$nm] = "";
    }

    $returnArray = array($as);

    $i = 0;

    $maximumLimit = 0;
    $break = false;

    $insert_order = 0;
    while (1) {
        foreach ($nameArray as $name) {
            $data = raDataFetchLoop($form_key, $name, $insert_order);

            if (count($data) > 0) {

                foreach ($data as $item) {
                    $returnArray[$i][$item["km_key"]] = $item["km_value"];
                }
            } else {
                $break = true;
            }
        }

        $insert_order++;
        $i++;
        $maximumLimit++;

        if($break) {
            break;
        }

        if($maximumLimit > 50) break;
    }

    //var_dump($returnArray);exit();

    return $returnArray;
}

function raDataFetch($form_key, $name)
{
    $sql = "SELECT * FROM km WHERE form_key = :form_key AND km_key = :km_key ORDER BY insert_order";

    $stmt = raGetDbConnection()->prepare($sql);
    $stmt->bindParam(':form_key', $form_key);
    $stmt->bindParam(':km_key', $name);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function raDataFetchLoop($form_key, $name, $insert_order)
{
    $sql = "SELECT * FROM km WHERE form_key = :form_key AND km_key = :km_key AND insert_order = :insert_order ORDER BY insert_order";

    $stmt = raGetDbConnection()->prepare($sql);
    $stmt->bindParam(':form_key', $form_key);
    $stmt->bindParam(':km_key', $name);
    $stmt->bindParam(':insert_order', $insert_order);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function raGetDbConnection()
{
    global $km_global_config;
    $host = $km_global_config['database_config']['host'];
    $user = $km_global_config['database_config']['user'];
    $password = $km_global_config['database_config']['password'];
    $db = $km_global_config['database_config']['db_name'];

    $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    return $dbh;
}

function raFormKeyExistCheck($form_key)
{
    $sql = "SELECT count(*) as kmCount FROM km WHERE form_key = :form_key";

    $stmt = raGetDbConnection()->prepare($sql);
    $stmt->bindParam(':form_key', $form_key);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result[0]['kmCount'] >  0 ? true : false;
}