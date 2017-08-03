@extends('admin.admin-layout-master')

@section('title')
    Activity Log
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/activity-log') }}">Activity Log</a></li>
    </ol>
@stop

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="font-bold">Activity Log</h3>
                    <form class="from-inline" method="post" action="{{ URL::to('admin/activity-log/export-excel') }}">
                        <div class="row">
                            <div class="col-sm-2 m-b-xs">
                            <select name="user_id" id="user_id" class="select-courses-type form-control">
                                <option value="" selected>Select User</option>
                                @foreach($userName as $us)
                                    <option value="{{ $us->id}}">{{ $us->username}}</option>
                                @endforeach
                            </select>
                                </div>
                            <div class="col-sm-2 m-b-xs">
                            {!! csrf_field() !!}
                            <select class="input-sm form-control input-s-sm inline" id="action" name="action">
                                    <option value=""> Choose an Action</option>
                                    <option value="View"> View</option>
                                    <option value="Insert"> Insert</option>
                                    <option value="Update"> Update</option>
                                    <option value="Delete"> Delete</option>
                                    <option value="Login"> Login</option>
                                    <option value="Logout"> Logout</option>
                                </select>
                        </div>

                        <div class="col-sm-7">
                            {{--<div class="input-group">--}}
                                {{--<input type="text" placeholder="Search" class="input-sm form-control">--}}
                                {{--<span class="input-group-btn">--}}
                                        {{--<button type="button" class="btn btn-sm btn-primary"> Go!</button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                            <div class="form-inline">
                                <input type="text" name="start_date" id="start_date" class="form-control validate[required]" value="" placeholder="Start Date"/>
                                <div class="input-group">
                                    <input type="text" name="end_date" id="end_date" class="form-control validate[required]" value="" placeholder="End Date"/>
                                    <span class="input-group-btn">
                            <button type="button" onclick="filter_log()" class="btn btn-warning btn_search"><i class="fa fa-search"></i> Search </button>
                                    <button type="submit" onclick="export_pdf()" class="btn btn-success btn_search"><i class="fa fa-file-excel-o"></i> Export </button>
                            </span>
                                </div>

                            </div>

                        </div>

                    </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table id="activitylog-table" class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Action</th>
                                <th>Committed by</th>
                                <th>Created at</th>
                                <th>IP Address</th>
                                <th>Action</th>
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

        $(".sidebar-nav").find(".activity-log").addClass('active');
        $('#activitylog-table').ajaxTable({
            limit: 50,
            url: "{{url('admin/activity-log/list-all')}}",
            columns: [
                {
                    mRender: function (row) {
                        return  row.description.replace('Successful', '<label class="label label-info">Successful</label>');
                    }
                },
                {data: "full_name"},
                {data: "updated_at"},
                {data: "ip_address"},
                {
                    mRender: function (row) {
                        var btn_edit = '<a href="{{URL::to('admin/activity-log')}}/' + row.id + '/view" class="btn btn-xs btn-primary">View</a>';
                        return '<div class="btn-group">' + btn_edit + '</div>';
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

        function filter_log() {

            var action = $("#action").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var user_id = $("#user_id").val();
            $('#activitylog-table').trigger('refreshGrid', {
                action: action,
                start_date: start_date,
                end_date: end_date,
                user_id: user_id
            });
        }
        $('#start_date, #end_date').datetimepicker({
            format: 'Y-MM-DD'
        });
    </script>
@stop
