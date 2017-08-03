<?php

namespace App\Libraries;

use DB;

class KM
{
    public static function setField($params)
    {
        $div = '<div class="form-group">';
        $div .= "<div class='col-md-2'>";
        $div .= "<label>" . $params["label"] . "</label>";
        $div .= "</div>";

        if ($params["type"] == "text") {
            $div .= "<div class='col-md-10'>";
            $div .= '<input type="text" value="' . self::getField($params["key"], $params["field_name"]) . '" element-type="text" meta-key="' . $params["field_name"] . '" class="form-control km-field"/>';
            $div .= "</div>";
        }

        if ($params["type"] == "textarea") {

            $div .= "<div class='col-md-10'>";
            $div .= '<textarea rows="10" element-type="textarea" class="form-control km-field editor" meta-key="' . $params["field_name"] . '" >' . get_km_option($params["page_id"], $params["field_name"]) . '</textarea>';
            $div .= "</div>";
        }

        if ($params["type"] == "image") {

            $preview = "";
            $value = self::getField($params["key"], $params["field_name"]);
            if ($value != "") {
                $preview = "<img src='" . base_path() . "uploads/" . $value . "'  height = '100'/>";
            }
            $div .= "<div class='col-md-10'>";
            $div .= '<input type="hidden" element-type="image" class="km-field" meta-key="' . $params["field_name"] . '" value="' . $value . '"/>
                    <input type="button" onclick="km_file_upload_triger(this)" value="Select" class="btn btn-primary"/>
                    <input style="display:none;" onchange="km_image_upload(this)" type="file" class="form-control"/>
                    <span class="km_image_preview">' . $preview . '</span>
                    </div>';
        }

        $div .= '</div>';

        return $div;

    }

    public static function setRepeater()
    {

    }

    public static function getField($key, $field_name)
    {
        $sql = "SELECT * FROM km WHERE `key` = '$key' AND meta_key = '$field_name'";
        $result = DB::select($sql);
        return isset($result[0]->meta_value) ? $result[0]->meta_value : "";
    }

    public static function getRepeater()
    {

    }

    public static function submitButton($key, $returnUrl)
    {
        $form = '<form action="'.url("KmController/attribute_save_or_update").'" method="post">
                    <input type="hidden" name="all_fields" id="all_fields" value="">
                    <input type="hidden" name="return_url" id="return_url" value="' . $returnUrl . '">
                    <input type="submit" id="page-save-submit" value="submit" style="display: none"/>
                </form>';
        $form .= '<button type="button" onclick="send_json(this, \'' . $key . '\')" class="btn btn-success"><i class="fa fa-save"></i> Save</button>';

        return $form;
    }

    public static function delete($table, $key)
    {
        $sql = "DELETE FROM $table WHERE `key` = '$key'";
        DB::statement($sql);
    }

}