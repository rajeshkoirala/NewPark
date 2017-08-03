/**
 * Created by Kiran on 12/3/2016.
 */

function showEditForm(title, url, id)
{
    $("#myModalLabel").html('');
    $("#modalBody").html('Loading...');

    $.ajax({
        url:url,
        method:"get",
        data:{id:id},
        success:function (response) {
            $("#myModalLabel").html(title);
            $("#modalBody").html(response);
        }
    });


    $('#myModal').modal();
}