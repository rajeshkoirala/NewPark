$('.km_removing_field').prev().remove();
$('.km_removing_field').remove();

function kmBtnCloneSection(thisObj) {

    destroy_instance();
    var clone = $(thisObj).next().clone();

    clone.find("input").val("").end();
    clone.find('.km_image_preview').html('');
    clone.find('.km_image_upload_btn_wrapper').remove();
    clone.find('.km-image-wrapper-section').append('<div class="km_image_upload_btn_wrapper"> <input type="button" onclick="km_file_upload_triger(this)" value="Choose" class="km-btn-image-choose"> <input style="display:none;" onchange="km_image_upload(this)" type="file" class=""> <span class="km-image-uploading-progress"></span></div>');
    clone.find('textarea').val('');
    clone.addClass('background-highlight');
    $(thisObj).after(clone);
    create_instance();
}

function kmBtnSectionClose(thisObj) {
    $(thisObj).parent().remove();
}

function km_file_upload_triger(thisObj) {

    $(thisObj).parent().find("input[type='file']").trigger('click');
}

function km_image_upload(thisObj) {

    var file_data = $(thisObj).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
        url: km_base_url + '/km_lib/km_file_upload_handler.php',
        dataType: 'text',
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            var parent = $(thisObj).parents('.km-image-wrapper-section');

            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    //console.log(percentComplete);
                    parent.find('.km-image-uploading-progress').html(percentComplete+"%");
                    if (percentComplete === 100) {
                        parent.find('');
                    }

                }
            }, false);

            return xhr;
        },
        success: function(response){
            var result = JSON.parse(response);
            var parent = $(thisObj).parents('.km-image-wrapper-section');
            if(result.status != false) {
                parent.find('input[type="hidden"]').val(result.image_name);
                parent.find(".km_image_preview").html('<img src="" height="100"/>');
                parent.find(".km_image_preview img").attr('src', km_base_url + '/km_lib/uploads/'+result.image_name);
                parent.find('.km_image_upload_btn_wrapper').remove();
                parent.find('.km_image_preview_wrapper .km_image_preview').append('<button type="button" onclick="kmBtnImageClose(this)" class="km-btn-image-close">x</button>');
            } else {
                parent.find(".km_image_preview").html(result.message);
            }
        }
    });
}

var km_idnr = 0;
$(function () {
    create_instance();
});

function create_instance() {

    $('.editor').each(function () {
        var id = "ts_"+km_idnr;
        km_idnr++;
        $(this).attr('id',id);
        CKEDITOR.replace(id, {
            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"links","groups":["links"]},
                {"name":"paragraph","groups":["list","blocks"]},
                {"name":"document","groups":["mode"]},
                {"name":"styles","groups":["styles"]},
                {"name":"about","groups":["about"]}
            ],
            height: 100,
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });
    });
}

function destroy_instance() {
    for(name in CKEDITOR.instances)
    {
        CKEDITOR.instances[name].destroy();
    }
}

function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}

function kmBtnImageClose(thisObj) {
    var parent = $(thisObj).parents('.km-image-wrapper-section');
    parent.find('.km_image_preview_wrapper .km_image_preview').html('');
    parent.find('input[type=hidden]').val('');

    parent.append('<div class="km_image_upload_btn_wrapper"> ' +
        '<input type="button" onclick="km_file_upload_triger(this)" value="Choose" class="km-btn-image-choose"/> ' +
        '<input style="display:none;" onchange="km_image_upload(this)" type="file" class=""/> ' +
        '<span class="km-image-uploading-progress"></span> ' +
        '</div>');
}

function kmSubmitForm(thisObj) {
    CKupdate();
    var form = $(thisObj).parents('form');
    var url = form.attr('action');

    $('.km-submit-message').html('<span class="km-saving-message">Saving...</span>');
    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        success: function (response) {
            if (response == 'success') {
                setTimeout(function () {
                    $('.km-submit-message').html('<span class="km-save-message">Successfully saved</span>');
                    setTimeout(function () {
                        $('.km-submit-message').html('');
                    }, 2000);
                }, 1000);
            } else {
                $('.km-submit-message').html('Unable to save form');
            }
        },
        error: function () {
            $('.km-submit-message').html('Unable to save form');
        }
    });
}

$(".km_sortable").sortable();