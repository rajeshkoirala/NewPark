@extends('admin.admin-layout-master')

@section('title')
    User Management
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/user-management') }}">User Management</a></li>

    </ol>
@stop
@section('panel_head')
User Management
@stop

@section('search_box')
    <input type="text" name="user_name" id="user_name" class="form-control" value="" autocomplete="off" placeholder="Search User Name"
           onkeyup="filter_user()"/>
@stop
@section('content')

@section('action_button')
    <a href="{{url('admin/user-management/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> Add</a>
@stop

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="font-bold">User List</h3>
                <div class="table-responsive">
                    <table id="ad-table" class="footable table table-stripped toggle-arrow-tiny">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name </th>
                            <th>User Name</th>
                            {{--<th>User Type</th>--}}
                            <th style="width: 13%;">Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
    <script>
        $(".sidebar-nav").find(".menu-user-management").addClass('active');
        $('#ad-table').ajaxTable({
            url: "{{url('admin/user-management/list-all')}}",
            columns: [
                {data: "full_name"},
                {data: "username"},

                {
                    mRender: function (row) {
                        if(row.id != '{{ Auth::user()->id }}') {
                            var btn_edit = '<a href="{{URL::to('admin/user-management')}}/' + row.id + '/edit" class="btn  btn-xs btn-primary">Edit</a>';
                            var btn_del = '<a  href="{{URL::to('admin/user-management/delete?id=')}}' + row.id + '" class="btn btn-danger btn-xs delcategory" >Delete</a>';
                            return '<div class="btn-group">' + btn_edit + " " + btn_del + '</div>';
                        } else {
                            return '';
                        }
                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                }
            ]
        });
        function filter_user() {

            var user_name = $("#user_name").val();
            $('#ad-table').trigger('refreshGrid', {
                user_name: user_name,

            });
        }
        $('.delcategory').click(function (e) {
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
