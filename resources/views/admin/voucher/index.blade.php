@extends('admin.admin-layout-master')

@section('title')
    Voucher Code
@stop

@section('panel_head')
    Voucher Code
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/voucher') }}">Voucher</a></li>

    </ol>
@stop
@section('action_button')
    <a href="{{url('admin/voucher/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus fa-fw"></i>
        Add</a>
@stop

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="font-bold">Voucher Code List</h3>
                    <div class="table-responsive">
                        <table id="voucher-table" class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Voucher Code</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Usage Limit</th>
                                <th>Is Active</th>
                                <th>Usage Times</th>
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
        $(".sidebar-nav").find(".menu-voucher").addClass('active');

        $('#voucher-table').ajaxTable({
            url: "{{url('admin/voucher/list-all')}}",
            columns: [
//                {data: "code"},
                {
                    mRender: function (row) {

                        var vouchercode = '<code>' + row.code + '</code>';
                        return vouchercode;
                    },
                },
                {data: "amount"},
                {data: "type"},
                {data: "usage_limit"},
                {
                    mRender: function (row) {
                        if (row.is_active == 1) {
                            return "Active";
                        } else {
                            return "Inactive"
                        }
                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                },
                {data: "used_times"},
                {
                    mRender: function (row) {
                        var btn_edit = '<a href="{{URL::to('admin/voucher')}}/' + row.id + '/edit" class="btn  btn-xs btn-primary">Edit</a>';
                        var btn_del = '<a href="{{URL::to('admin/voucher/delete?id=')}}' + row.id + '" class="btn btn-danger btn-xs delcode" >Delete</a>';
                        return '<div class="btn-group">' + btn_edit + " " + btn_del + '</div>';
                    },
                    attr: 'cellspaging = "1" cellpadding = "1"'
                }
            ]
        });

//        $('.delcategory').click(function () {
//            var r = confirm("Are you sure to delete ? once deleted it cannot be undone.");
//            if (r == true) {
//                return true;
//            } else {
//                return false;
//            }
//        });

        $('.delcode').click(function (e) {
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
