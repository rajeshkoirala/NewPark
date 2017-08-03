<?php

function km_field($params)
{
    $div = '<div class="form-group">';
    $div .= "<div class='col-md-2'>";
    $div .= "<label>" . $params["label"] . "</label>";
    $div .= "</div>";

    if ($params["type"] == "text") {
        $div .= "<div class='col-md-10'>";
        $div .= '<input type="text" value="' . get_km_option($params["page_id"], $params["field_name"]) . '" element-type="text" meta-key="' . $params["field_name"] . '" class="form-control km-field"/>';
        $div .= "</div>";
    }

    if ($params["type"] == "textarea") {
        $div .= "<div class='col-md-10'>";
        $div .= '<textarea rows="10" element-type="textarea" class="form-control km-field editor" meta-key="' . $params["field_name"] . '" >' . get_km_option($params["page_id"], $params["field_name"]) . '</textarea>';
        $div .= "</div>";
    }

    if ($params["type"] == "image") {
        $preview = "";
        $value = get_km_option($params["page_id"], $params["field_name"]);
        if($value != "") {
            $preview = "<img src='".url()."uploads/thumb/".$value."'  height = '100'/>";
        }
        $div .= "<div class='col-md-10'>";
        $div .= '<input type="hidden" element-type="image" class="km-field" meta-key="' . $params["field_name"] . '" value="'.$value.'"/>
                <input type="button" onclick="km_file_upload_triger(this)" value="Select" class="btn btn-primary"/>
                <input style="display:none;" onchange="km_image_upload(this)" type="file" class="form-control"/>
                <span class="km_image_preview">'.$preview.'</span>
                </div>';
    }

    if ($params["type"] == "video") {
        $preview = "";
        $value = get_km_option($params["page_id"], $params["field_name"]);
        if($value != "") {
            $preview = '<video width="320" height="240" controls>
                            <source src="'.url().'uploads/'.$value.'" type="video/mp4">
                        </video>';
            //$preview = "<img src='".url()."uploads/".$value."'  height = '300'/>";
        }
        $div .= "<div class='col-md-10'>";
        $div .= '<input type="hidden" element-type="image" class="km-field" meta-key="' . $params["field_name"] . '" value="'.$value.'"/>
                <input type="button" onclick="km_file_upload_triger(this)" value="Select" class="btn btn-primary"/>
                <input style="display:none;" onchange="km_image_upload(this)" type="file" class="form-control"/>
                <span class="km_image_preview">'.$preview.'</span>
                </div>';
    }

    $div .= '</div>';

    echo $div;
}

function km_group($group)
{
    $res = get_km_all_repeater_option($group["page_id"], $group["field_name"]);
    if ($res == "") {
        echo "<div class='km-repeater-parent clearfix' meta-key='" . $group["field_name"] . "'>";
        km_field_repeater($group);
        echo '</div>';
    } else {
        foreach ($res as $result) {
            $result = json_decode($result->meta_value);
            $group["fields"] = (array)$result;
            echo "<div class='km-repeater-parent clearfix' meta-key='" . $group["field_name"] . "'>";
            km_field_repeater($group);
            echo '</div>';
        }
    }

}

function km_field_repeater($repeater)
{
    foreach ($repeater["fields"] as $params) {

        $params = (array)$params;

        $div = '<div class="form-group">';
        $div .= "<div class='col-md-2'>";
        $div .= "<label>" . $params["label"] . "</label>";
        $div .= "</div>";

        if ($params["type"] == "text") {
            $div .= "<div class='col-md-10'>";
            $div .= '<input type="text" value="' . $params["field_value"] . '" element-label="' . $params["label"] . '" element-type="text" meta-key="' . $params["field_name"] . '" class="form-control km-repeater-child"/>';
            $div .= "</div>";
        }

        if ($params["type"] == "textarea") {
            $div .= "<div class='col-md-10'>";
            $div .= '<textarea rows="10" element-label="' . $params["label"] . '" element-type="textarea" meta-key="' . $params["field_name"] . '" class="form-control km-repeater-child editor" >' . $params["field_value"] . '</textarea>';
            $div .= "</div>";
        }

        if ($params["type"] == "editor") {
            $div .= "<div class='col-md-10'>";
            $div .= '<textarea rows="10" element-label="' . $params["label"] . '" element-type="editor" meta-key="' . $params["field_name"] . '" class="form-control km-repeater-child editor" >' . $params["field_value"] . '</textarea>';
            $div .= "</div>";
        }

        if ($params["type"] == "image") {

            $preview = "";
            $value = $params["field_value"];//get_km_option($repeater["page_id"], $repeater["field_name"]);
            if ($value != "") {
                $preview = "<img src='" . url() . "uploads/thumb/" . $value . "'  height = '100'/>";
            }
            $div .= "<div class='col-md-10' style='padding-left: 0'>";
            $div .= '<input type="hidden" element-label="' . $params["label"] . '" element-type="image" class="form-control km-repeater-child" meta-key="' . $params["field_name"] . '" value="' . $value . '"/>
                    <div class="col-md-1">
                    <input type="button" onclick="km_file_upload_triger(this)" value="Select" class="btn btn-primary"/>
                    <input style="display:none;" onchange="km_image_upload(this)" type="file" class="form-control"/>
                    </div>
                    <div class="col-md-8">
                    <span class="km_image_preview">' . $preview . '</span>
                    </div>';
            $div .= "</div>";
        }
        echo "<div class='clearfix'></div>";
        $div .= '</div>';

        echo $div;
    }
}

function km_repeater($repeater)
{
    $res = get_km_all_repeater_option($repeater["page_id"], $repeater["field_name"]);
    if ($res == "") {
        echo "<div class='km-repeater-parent clearfix' meta-key='" . $repeater["field_name"] . "'>";
        km_field_repeater($repeater);
        echo '<input type="button" value="+" class="btn btn-success pull-right" onclick="dynamic_div_generate(this)"></div>';
    } else {

        $loop = 0;
        foreach ($res as $result) {
            $result = json_decode($result->meta_value, true);

            $i = 0;

            foreach ($result as $rs) {
                $repeater["fields"][$i]["field_value"] = $rs["field_value"];
                $i++;
            }

            echo "<div class='km-repeater-parent clearfix' meta-key='" . $repeater["field_name"] . "'>";
            km_field_repeater($repeater);
            if ($loop == 0)
                echo '<input type="button" value="+" class="btn btn-success pull-right" onclick="dynamic_div_generate(this)"></div>';
            else
                echo '<input type="button" value="+" class="btn btn-success pull-right" onclick="dynamic_div_generate(this)"><input type="button" value="-" class="btn btn-danger pull-right" style="margin-left: 2px;margin-right: 2px;" onclick="dynamic_div_destroy(this)"/></div>';

            $loop++;
        }
    }
}

function get_km_option($page_id, $field_name)
{
    $ci =& get_instance();
    $sql = "SELECT * FROM page_meta WHERE page_id = '$page_id' AND meta_key = '$field_name'";
    $query = $ci->db->query($sql);
    $data = $query->row();
    return isset($data->meta_value) ? $data->meta_value : "";
}

function get_km_repeater_option($page_id, $field_name)
{
    $ci =& get_instance();
    $sql = "SELECT * FROM page_meta WHERE page_id = '$page_id' AND meta_key = '$field_name'";
    $query = $ci->db->query($sql);
    $data = $query->result();

    $first_phase_data = array();
    foreach ($data as $row) {
        $first_phase_data[] = $row->meta_value;
    }
    $second_phase_data = array();
    foreach ($first_phase_data as $row) {
        $second_phase_data[] = json_decode($row);
    }

    $third_phase_data = array();

    $i = 0;
    foreach ($second_phase_data as $row) {
        foreach ($row as $rw) {
            $third_phase_data[$i][$rw->field_name] = $rw->field_value;
        }
        $i++;
    }

    return $third_phase_data;
}

function get_km_all_repeater_option($page_id, $field_name)
{
    $ci =& get_instance();
    $sql = "SELECT * FROM page_meta WHERE page_id = '$page_id' AND meta_key = '$field_name'";
    $query = $ci->db->query($sql);
    $data = $query->result();
    return count($data) > 0 ? $data : "";
}

function submit_button($page_id)
{
    echo '<form action="'.url().'admin/page/page_attribute_save_or_update" method="post">
            <input type="hidden" name="all_fields" id="all_fields" value="">
            <input type="submit" id="page-save-submit" value="submit" style="display: none"/>
        </form>';
    echo '<button type="button" onclick="generate_and_submit_json(this, '.$page_id.')" class="btn btn-success"><i class="fa fa-save"></i> Save</button>';
}

?>

<script>

    var idnr = 0;
    $(function () {
        create_instance();
    });

    function generate_and_submit_json(thisObj, page_id) {
    function generate_and_submit_json(thisObj, page_id) {

        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();

        var main_data = [];
        //{'page_id', 'meta_key', 'meta_value'};
        $(".km-field").each(function (f) {
            var json_data = {};
            var element_type = $(this).attr("element-type");
            json_data["page_id"] = page_id;
            json_data["meta_key"] = $(this).attr('meta-key');
            json_data["meta_value"] = $(this).val();
            main_data.push(json_data);
        });

        //var main_data2 = [];
        $(".km-repeater-parent").each(function (f) {
            var json_data = {};
            json_data["page_id"] = page_id;
            json_data["meta_key"] = $(this).attr('meta-key');

            var child = $(this).find('.km-repeater-child');
            var darr = [];
            child.each(function (d) {
                var json_data2 = {};
                json_data2["field_name"] = $(this).attr('meta-key');
                json_data2["label"] = $(this).attr('element-label');
                json_data2["type"] = $(this).attr('element-type');
                json_data2["field_value"] = $(this).val();
                darr.push(json_data2);
            });
            json_data["meta_value"] = darr;
            main_data.push(json_data);
        });

        $("#all_fields").val(JSON.stringify(main_data));
        $("#page-save-submit").trigger('click');
        //console.log(main_data);
    }

    function make_instance() {
        destroy_instance();
        create_instance();
    }
    function create_instance() {

        $('.editor').each(function () {
            var id = "ts_"+idnr;
            idnr++;
            $(this).attr('id',id);
            CKEDITOR.replace(id);
        });
    }

    function destroy_instance() {
        for(name in CKEDITOR.instances)
        {
            CKEDITOR.instances[name].destroy(true);
        }
    }

    function km_image_upload(thisObj) {

        var file_data = $(thisObj).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'admin/page/page_image_upload',
            dataType: 'text',
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response){
                var result = JSON.parse(response);
                if(result.status != false) {
                    $(thisObj).parent().parent().find('input[type="hidden"]').val(result.image_name);
                    $(thisObj).parent().parent().find(".km_image_preview").html('<img src="" height="100"/>');
                    $(thisObj).parent().parent().find(".km_image_preview img").attr('src','uploads/thumb/'+result.image_name);
                } else {
                    $(thisObj).parent().parent().find(".km_image_preview").html(result.message);
                }
            }
        });
    }

    function dynamic_field_generate(thisObj) {
        var is_repeater = $(thisObj).val();
        var dynamic_placeholder = $(thisObj).parent().find(".dynamic_placeholder");
        var dynamic_field = "";

        if (is_repeater == "repeater") {
            repeater_div_generator(thisObj);
        }

        dynamic_placeholder.html(dynamic_field);

    }

    function dynamic_div_generate(thisObj) {

        destroy_instance();

        var div = $(thisObj).parent().clone();
        div.addClass('background-highlight');
        div.find(".btn-danger").remove();
        div.append('<input type="button" value="-"  style="margin-right: 2px;margin-left: 2px;" class="btn btn-danger pull-right" onclick="dynamic_div_destroy(this)"/>');
        $(thisObj).parent().after(div);
        create_instance();
        setTimeout(function () {
            div.removeClass('background-highlight');
        },400);
    }

    function repeater_div_generator(thisObj) {
        var div = $(thisObj).parent().parent().clone();
        div.find(".btn-danger").remove();
        div.append('<input type="button" value="-" class="btn btn-danger" onclick="dynamic_div_destroy(this)"/>');
        $(thisObj).parent().after(div);
    }

    function dynamic_div_destroy(thisObj) {
        $(thisObj).parent().addClass("background-highlight");

        setTimeout(function () {
            $(thisObj).parent().remove();
        },400);

    }

    function km_file_upload_triger(thisObj) {

        $(thisObj).parent().find("input[type='file']").trigger('click');
    }
</script>

<style>
    .background-highlight {
        background-color: antiquewhite;
        padding: 10px;
    }
</style>