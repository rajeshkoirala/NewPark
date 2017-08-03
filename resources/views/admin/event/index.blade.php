@extends('admin.admin-layout-master')

@section('title')
    Events
@stop


@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/event') }}">Events</a></li>

    </ol>
@stop
@section('action_button')
    <a href="{{url('admin/event/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> Add</a>
@stop

@section('search_box')
    <input type="text" name="event_name" id="event_name" class="form-control" value="" autocomplete="off" placeholder="Search By Event Name"
           onkeyup="filter_event()"/>
@stop

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="course-table" class="table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Event Name</th>
                                <th style="width: 32%;">Event Description</th>
                                <th style="width: 10%;">Start Date</th>
                                <th style="width: 10%;">End Date</th>
                                <th style="width: 10%;">No of Seats</th>

                                <th style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="image-loader"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop



@section('script')
    <script>

        $(".sidebar-nav").find(".menu-event").addClass('active');
        $('#course-table').ajaxTable({
            url: "{{url('admin/event/list-all')}}",
            columns: [
                {data: "event_name"},
                {data: "event_desc"},
                {data: "start_date"},
                {data: "end_date"},
                {data: "no_of_seat"},

                {
                    mRender: function (row) {

                        var btn_edit = '<a href="{{URL::to('admin/event')}}/' + row.id + '/create" class="btn  btn-xs btn-primary">Edit</a>';
                        var btn_del = '<a href="{{URL::to('admin/event/delete?id=')}}' + row.id + '" class="btn btn-danger btn-xs delevent" >Delete</a>';
                        return ' <div class="btn-group">' + btn_edit + " " + btn_del + '</div>';
                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                }
            ],
            loadingClass: ".image-loader"
        });

        function filter_event() {

            var event_name = $("#event_name").val();
            $('#course-table').trigger('refreshGrid', {
                event_name: event_name,

            });
        }

        $('.delevent').click(function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted!", "success");
                        setTimeout(function () {
                            window.location = link;
                        }, 2000);
                        return true;
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                        return false;
                    }
                });
        });

    </script>
@stop
