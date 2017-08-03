@extends('admin.admin-layout-master')
@section('title')
    Dashboard
@stop
@section('content')
    <div class="row border-bottom  dashboard-header animated fadeIn clearfix">
        <div class="col-lg-8">
            <h2>Welcome Olivesafety</h2>
            <small>Olivesafety message for dashboard</small>
            <div class="statistic-box">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                {{--<span class="label label-primary pull-right">Today</span>--}}
                                <h5>Offline Courses</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{$OffcourseCount}}</h1>
                                <small>Available Courses</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                {{--<span class="label label-info pull-right">Monthly</span>--}}
                                <h5>Online Courses</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $OncourseCount }} </h1>
                                <small>Available Courses</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                {{--<span class="label label-warning pull-right">Annual</span>--}}
                                <h5>Total Courses</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $AllcourseCount }}</h1>
                                <small>All Total Courses</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h3>Our Site Visists</h3>
                <canvas id="lineChart2" height="130"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins" style="margin-top: 100px;">
                <div class="ibox-content olive-timeline">
                    <h3 class="font-bold no-margins">
                        Upcoming Events
                        <hr>
                    </h3>
                    @foreach($AvailableEvent as $event)
                        @php
                        $no_of_event=$event->no_of_event;
                        @endphp
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-calendar"></i>
                                    {{$event->available_date }}
                                </div>
                                <a href="{{ URL::to('admin/event') }}"
                                   class="col-xs-7 content event-text no-top-border">
                                    <p class="m-b-xs"><strong>{{$event->event_name }}: <label
                                                    class="label label-info">{{$event->no_of_event }}</label></strong>
                                    </p>
                                    <p>{{ substr($event->event_desc, 0, 50)}}...</p>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Payment History</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="dashboard-payment-table" class="footable table table-stripped toggle-arrow-tiny">

                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Course Name</th>
                                        <th>Paid Amount</th>
                                        <th>Discount</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Contact No.</th>
                                        <th>Billing Details</th>
                                    </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{url('public/js/plugins/chartJs/Chart.min.js')}}"></script>

    <script>

        $('#dashboard-payment-table').ajaxTable({
            url: "{{url('admin/payment-history/list-all')}}",
            limit : 5,
            columns: [
                {data: "course_name"},
                {data: "paid_amount"},
                {data: "discount"},
                {data: "customer_name"},
                {
                    mRender: function (row) {

                        var email = '<a href="mailto:'+ row.customer_email + '" >' + row.customer_email + '</a>';
                        return email;
                    },
                },
                {data: "contact_no"},
                {data: "billing_details"}

            ],
            loadingClass: ".image-loader"
        });


        var visitDate = new Array();
        var visitCount = new Array();

        @foreach($visitRecord['visit_date'] as $key => $val)
            visitDate.push('{{ $val }}');
        @endforeach

        @foreach($visitRecord['visit_count'] as $key => $val)
            visitCount.push('{{ (int)$val }}');
        @endforeach


        $(function () {

            var lineData2 = {
                labels: visitDate,
                datasets: [
                    {
                        label: "Our Site Visits",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: visitCount
                    }
                ]
            };

            var lineOptions2 = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };

            var ctx2 = document.getElementById("lineChart2").getContext("2d");
            var myNewChart2 = new Chart(ctx2).Line(lineData2, lineOptions2);


            var polarData = [
                {
                    value: '{{ $AllcourseCount }}',
                    color: "#21b9bb",
                    highlight: "#1ab394",
                    label: "Total Courses"
                },
                {
                    value: '{{ $OncourseCount }}',
                    color: "#1b2d5a",
                    highlight: "#337ab7",
                    label: "Online Courses"
                },
                {
                    value: '{{$OffcourseCount}}',
                    color: "#ec4758",
                    highlight: "#1ab394",
                    label: "Offline Courses"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,

            };

            var ctx = document.getElementById("polarChart").getContext("2d");
            var myNewChart = new Chart(ctx).PolarArea(polarData, polarOptions);


        });

    </script>
@stop