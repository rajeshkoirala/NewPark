<?php
function video_uploader($field_name, $field_value = "")
{
    $html = "<input type='hidden' name='$field_name' value='$field_value' />
            <input type='button' value='Select' class='btn btn-primary'
                   onclick='common_video_upload_trigger(this)'>
            <input type='file' class='common_video_upload'
                   style='width:100%; display:none;'/>
            <span class='common_image_thumb'>";

    if ($field_value != "") {
        $html .= '<video width="320" height="240" controls>
                    <source src="' . URL::to('uploads') . '/' . $field_value . '" type="video/mp4">
                </video>';

    }
    $html .= "</span>";
    return $html;
}

function image_uploader($field_name, $field_value = "")
{
    $html = "<input type='hidden' name='$field_name' value='$field_value' />
            <input type='button' value='Select' class='btn btn-primary'
                   onclick='common_image_upload_trigger(this)'>
            <input type='file' class='common_image_upload'
                   style='width:100%; display:none;'/>
            <span class='common_image_thumb'>";

    if ($field_value != "") {

        $html .= "<img src=" . URL::to('public/uploads'). '/' . $field_value . " height='100'/>";
    }

    $html .= "</span>";
    return $html;
}

function file_uploader($field_name, $field_value = "")
{
    $html = "<input type='hidden' name='$field_name' value='$field_value' />
            <input type='button' value='Select' class='btn btn-primary'
                   onclick='common_file_upload_trigger(this)'>
            <input type='file' class='common_file_upload'
                   style='width:100%; display:none;'/>
            <span class='common_file_thumb'>";

    if ($field_value != "") {

        $html .= "<img src=" . URL::to('public/img/acrobatpdf.jpg'). " height='100'/>".$field_value;
    }

    $html .= "</span>";
    return $html;
}



function iff($condition, $true, $false)
{
    if ($condition) return $true;
    return $false;
}
function selected($compare1, $compare2)
{
    if($compare1 == $compare2) {
        return 'selected="selected"';
    }
}

function checked($compare1, $compare2)
{
    if($compare1 == $compare2) {
        return 'checked="checked"';
    }
}

function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}