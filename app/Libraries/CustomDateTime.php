<?php

namespace App\Libraries;

use DB;

class CustomDateTime
{
    public static function currentTimestamp()
    {
        $sql = "SELECT CURRENT_TIMESTAMP as dateTime";
        $result = DB::select($sql);

        return $result[0]->dateTime;
    }

}