<?php

session_start();
global $km_loop_counter;
global $main_counter;
$_SESSION['km_token'] = md5(rand(999, 99999));

$main_counter = 1;
$km_loop_counter = -1;

function raBuild($name)
{
    global $form_key;
    global $km_loop_counter;

    $value = getRaData($form_key, $name);

    $name_postfix = "";
    if ($km_loop_counter > -1) {
        $name_postfix = "[]";
    }

    return array($name_postfix, $value);
}

function kmText($name, $attribute = array())
{
    $build = raBuild($name);

    $attr = "";
    foreach ($attribute as $atKey => $atVal) {
        $attr .= " $atKey = '$atVal' ";
    }

    if (count($attribute) == 0) {
        $attr = "class='form-control'";
    }

    $html = "<input type='text' name='$name$build[0]' value='$build[1]' $attr/>";

    return $html;
}

function kmTextArea($name, $attribute = array())
{
    $build = raBuild($name);

    $attr = "";
    foreach ($attribute as $atKey => $atVal) {
        $attr .= " $atKey = '$atVal' ";
    }

    if (count($attribute) == 0) {
        $attr = "class='form-control'";
    }

    $html = "<textarea name='$name$build[0]' $attr rows='5'>$build[1]</textarea>";

    return $html;
}

function kmImage($name, $value = "")
{
    $build = raBuild($name);
    $preview = "";

    if ($value != "" && $value != null) {

        $build[0] = "";
        $build[1] = $value;
    }
    global $km_global_config;
    $base_url = url('/');

    if ($build[1] != "") {
        $preview = "<img src='$base_url/km_lib/uploads/" . $build[1] . "'  height = '100'/>";
        $preview .= '<button type="button" onclick="kmBtnImageClose(this)" class="km-btn-image-close">x</button>';
    }

    $html = '<div class="km-image-wrapper-section"><input type="hidden" name="' . $name . $build[0] . '" value="' . $build[1] . '"/>';

    if ($preview == '') {
        $html .= '<div class="km_image_upload_btn_wrapper">
                    <input type="button" onclick="km_file_upload_triger(this)" value="Choose" class="km-btn-image-choose"/>
                    <input style="display:none;" onchange="km_image_upload(this)" type="file"/>
                    <span class="km-image-uploading-progress"></span>
                   </div>';
    }
    $html .= '<div class="km_image_preview_wrapper">
                <span class="km_image_preview">' . $preview . '</span>
              </div>
              </div>';

    return $html;
}

function kmEditor($name)
{
    $build = raBuild($name);
    $html = "<textarea class='editor' rows='10' name='$name$build[0]'>$build[1]</textarea>";

    return $html;
}

function kmBegin($unique_key)
{
    global $form_key;
    global $km_global_config;
    $form_key = $unique_key;
    $base_url = url('/');

    $headerMessage = "";
    if ($km_global_config['debug']) {
        $status = raFormKeyExistCheck($form_key);
        if ($status) {
            $headerMessage = "<span style='background-color: red;color: whitesmoke;padding: 3px'>You are in editing mode</span>";
        }

    }
    $html = "<form method='post' action='" . $base_url . "/km_lib/km_response_handler.php' id='$unique_key-form'>$headerMessage";
    $html .= "<input type='hidden' name='form_key' value='$unique_key'/>";
    $html .= "<input type='hidden' name='km_token' value='" . $_SESSION["km_token"] . "'/>";
    return $html;
}

function kmEnd()
{
    $html = "</form>";
    return $html;
}

function kmBtnClose()
{
    $html = '<button type="button" onclick="kmBtnSectionClose(this)" class="km-btn-section-close">x</button>';
    //$html .= '<button type="button" onclick="kmBtnCloneSection(this)" class="km-btn-section-clone">+</button>';

    return $html;
}

function kmLoop()
{
    global $km_looping;
    global $main_counter;
    global $km_loop_counter;

    $main_counter++;
    $km_loop_counter++;

    if ($main_counter > 50) die('Excess loop');

    if ($km_loop_counter == 0) {
        echo '<div class="km_sortable">';
        echo '<button type="button" onclick="kmBtnCloneSection(this)" class="km-btn-section-clone"><i class="fa fa-plus fa-fw"></i> Add</button>';
        $km_looping = true;
        return true;
    }

    if (!$km_looping) {
        global $km_loop_counter;
        global $main_counter;

        if ($km_loop_counter != 1) {
            echo "<div class='km_removing_field'>removing div</div>";
            echo "</div>";
        }

        $main_counter = -1;
        $km_loop_counter = -1;

    }

    return $km_looping ? true : false;
}

function kmSelectBox($name, $option, $attribute = array())
{
    $build = raBuild($name);

    $attr = "";
    foreach ($attribute as $atKey => $atVal) {
        $attr .= " $atKey = '$atVal' ";
    }

    if (count($attribute) == 0) {
        $attr = "class='form-control'";
    }

    $html = "<select name='$name$build[0]' $attr>";
    if (is_array($option)) {
        foreach ($option as $key => $value) {
            $sel = "";
            if ($key == $build[1]) $sel = "selected='selected'";
            $html .= "<option value='$key' $sel>$value</option>";
        }
    }
    $html .= "</select>";

    return $html;
}

function kmRadio($name, $option, $attribute = array())
{
    $build = raBuild($name);

    $attr = "";
    foreach ($attribute as $atKey => $atVal) {
        $attr .= " $atKey = '$atVal' ";
    }

    if (count($attribute) == 0) {
        $attr = "class='form-control'";
    }

    $html = "";

    if (is_array($option)) {
        foreach ($option as $key => $value) {
            $chk = "";
            if ($key == $build[1]) $chk = "checked='checked'";
            $html .= "<div class='km-check-box'><input type = 'radio' name = '$name$build[0]' value='$key' $chk /> $value </div>";
        }
    }

    return $html;
}

function kmCustomData($name)
{
    $data = raBuild($name);

    return $data[1];
}

function kmSubmit($value = "Save", $attribute = array('class' => 'btn btn-primary'))
{
    $attr = "";
    foreach ($attribute as $atKey => $atVal) {
        $attr .= " $atKey = '$atVal' ";
    }

    return '<input type="button" onclick="kmSubmitForm(this)" value="' . $value . '" ' . $attr . '/><span class="km-submit-message"></span>';
}