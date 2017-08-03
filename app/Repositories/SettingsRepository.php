<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/7/2017
 * Time: 11:47 AM
 */

namespace App\Repositories;
use DB;

class SettingsRepository
{

    public function findAll($id){
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $packet = DB::select($sql);

        return $packet;

    }

}