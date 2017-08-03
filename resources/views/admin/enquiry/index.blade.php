@extends('admin.admin-layout-master')

@section('title')
   Enquiry
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/enquiry') }}">Enquiry</a></li>

    </ol>
@stop
@section('content')

    <div class="clearfix"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="font-bold">Enquiry List</h3>
                    <div class="table-responsive">
                        <table id="enquiry-table" class="table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company Name</th>
                                <th>Course Interested</th>
                                <th style="width: 13%;">Action</th>
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

        $(".sidebar-nav").find(".menu-enquiry-management").addClass('active');

        $('#enquiry-table').ajaxTable({
            url: "{{url('admin/enquiry/list-all')}}",
            columns: [
                {
                    mRender: function (row) {

                        var name = row.name;
                        if(row.is_viewed == 0) {
                            name = '<span style="background: #d2d2d2; padding: 5px; border-radius: 3px;">' + row.name + '</span>';
                        }
                        return name;
                    },
                },
                {
                    mRender: function (row) {

                        var email = '<a href="mailto:'+ row.email + '" >' + row.email + '</a>';
                        return email;
                    },
                },

                {data: "phone"},
                {data: "company_name"},
                {data: "course_interested"},



                {
                    mRender: function (row) {
                        var btn_view = '<a href="{{URL::to('admin/enquiry')}}/' + row.id + '/view" class="btn btn-xs btn-primary">View</a>';
                        var btn_del = '<a href="{{URL::to('admin/enquiry/delete?id=')}}' + row.id + '" class="btn btn-xs btn-danger delenquiry" >Delete</a>';
                        return '<div class="btn-group">' + btn_view + " " + btn_del + '</div>';

                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                }
            ],
            loadingClass: ".image-loader"
        });

        $('.delenquiry').click(function (e) {
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
                function(isConfirm){
                    if (isConfirm){
                        swal("Deleted!", "Your imaginary file has been deleted!", "success");
                        setTimeout(function () {
                            window.location = link;
                        },2000);
                        return true;
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                        return false;
                    }
                });
        });

    </script>
@stop
