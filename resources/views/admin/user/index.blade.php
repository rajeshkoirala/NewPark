@extends('admin.admin-layout-master')

@section('title')
    User
@stop

@section('content')

    <button class="btn btn-primary pull-right"
            onclick="ShowModalForm('User', '{{URL::to('admin/user/form')}}')">Add <i class="fa fa-plus fa-fw"></i>
    </button>
    <div class="clearfix"></div>
    <br/>
    <div class="table-responsive">
    <table id="ad-table" class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>User Name</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    </div>


@stop

@section('script')
    <script>

        $(".sidebar-nav").find(".menu-user-management").addClass('active');
        $('#ad-table').ajaxTable({
            url: "{{url('admin/user/list-all')}}",
            columns: [
                {data: "full_name"},
                {data: "username"},
//                {data: "user_type"},
                {
                    mRender: function (row) {
                        if (row.user_type == 1) {
                            return "Admin";
                        }  else if(row.user_type == 2) {
                            return "Staff";
                        }else {
                            return "User";
                        }
                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                },
//                {data: "used_times"},
                {
                    mRender: function (row) {
                        var btn_edit = '<button class="btn btn-primary" onclick="ShowModalForm(\'User\', \'{{URL::to('admin/user')}}/form\',' + row.id + ')">Edit <i class="fa fa-pencil-square-o fa-fw"></i></button>';
                        var btn_del = '<a href="{{URL::to('admin/user/delete?id=')}}' + row.id + '" class="btn btn-danger delcategory" >Delete <i class="fa fa-trash fa-fw"></i></a>';
                        return btn_edit + " " + btn_del;
                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                }
            ]
        });

        $('.delcategory').click(function () {
            var r = confirm("Are you sure to delete ? once deleted it cannot be undone.");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        });
    </script>
@stop
