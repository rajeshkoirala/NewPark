var modalCounter = 0;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function ShowModalForm(title,url,id)
{
    $.ajax({
        url:url,
        type:"post",
        data:{id:id},
        success:function(response){
            var modal = ViewModel(title,response, "modal-md");
            modal.modal();
        }
    });
}

function ShowLargeModalForm(title,url,id) {
    $.ajax({
        url:url,
        type:"post",
        data:{id:id},
        success:function(response){
            var modal = ViewModel(title,response, "modal-lg");
            modal.modal();
        }
    });
}

function ShowSmallModalForm(title,url,id) {
    $.ajax({
        url:url,
        type:"post",
        data:{id:id},
        success:function(response){
            var modal = ViewModel(title,response, "modal-sm");
            modal.modal();
        }
    });
}

function ClearModal(thisObj)
{
    $(thisObj).remove();
}

function ViewModel(title,body, size)
{
    var modalID = modalCounter;
    modalCounter++;
    var modal =  '<div class="modal fade client-info-modal" id="exampleModal-'+modalID+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-'+modalID+'">'+
                    '<div class="modal-dialog ' + size + '" role="document">'+
                        '<div class="modal-content">'+
                            '<div class="modal-header client-info-modal-header">'+
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>'+
                                '<h4 class="modal-title" id="exampleModalLabel-'+modalID+'">'+title+'</h4>'+
                            '</div>'+
                            '<div class="modal-body" style="padding: 30px">'+ body + '</div>'+
                            '<div class="clearfix"></div>'+
/*                            '<div class="modal-footer">'+
                                '<button type="button" class="btn btn-default" data-dismiss="modal" onclick="ClearModal(\'#exampleModal-\''+modalID+')">Close</button>'+
                                '<button type="button" class="btn btn-primary" onclick="FormSubmit(this)" id="modal-submit-button">Save</button>'+
                            '</div>'+*/
                        '</div>'+
                    '</div>'+
                '</div>';

    var bd = $('body');
    bd.find('#exampleModal-'+modalID).remove();
    bd.append(modal);

    return $("#exampleModal-"+modalID);
}

/* Automatically */
$(".modal").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
});