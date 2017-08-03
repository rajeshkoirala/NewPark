<?php

namespace App\Libraries;
use DB;

class SiteVisit
{
    public static function registerVisits()
    {
        $sql = "SELECT * FROM site_visit WHERE visit_date = CURRENT_DATE ORDER BY visit_date DESC LIMIT 1";
        $result = DB::select($sql);

        if(isset($result[0])) {

            $id = $result[0]->id;
            $visitCount = $result[0]->visit_count + 1;

            $sql = "UPDATE site_visit SET visit_count = '$visitCount' WHERE id = '$id'";
            DB::statement($sql);

        } else {

            $sql = "INSERT INTO site_visit(visit_date, visit_count) VALUES (CURRENT_DATE, 1)";
            DB::statement($sql);
        }

    }

}