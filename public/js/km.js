var idnr = 0;
$(function () {
    create_instance();
});

function send_json(thisObj, page_id) {

    for (instance in CKEDITOR.instances)
        CKEDITOR.instances[instance].updateElement();

    var main_data = [];
    $(".km-field").each(function (f) {
        var json_data = {};
        var element_type = $(this).attr("element-type");
        json_data["page_id"] = page_id;
        json_data["meta_key"] = $(this).attr('meta-key');
        json_data["meta_value"] = $(this).val();
        main_data.push(json_data);
    });

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

function create_instance() {

    $('.editor').each(function () {
        var id = "ts_" + idnr;
        idnr++;
        $(this).attr('id', id);
        CKEDITOR.replace(id);
    });
}

function destroy_instance() {
    for (name in CKEDITOR.instances) {
        CKEDITOR.instances[name].destroy(true);
    }
}

function km_image_upload(thisObj) {

    var file_data = $(thisObj).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
        url: baseUrl+'km/upload-file',
        dataType: 'text',
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            var result = JSON.parse(response);
            if (result.status != false) {
                $(thisObj).parent().parent().find('input[type="hidden"]').val(result.image_name);
                $(thisObj).parent().parent().find(".km_image_preview").html('<img src="" height="100"/>');
                $(thisObj).parent().parent().find(".km_image_preview img").attr('src', baseUrl+'/uploads/thumb/' + result.image_name);
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
    }, 400);
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
    }, 400);

}

function km_file_upload_triger(thisObj) {

    $(thisObj).parent().find("input[type='file']").trigger('click');
}