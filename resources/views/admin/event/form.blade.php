@extends('admin.admin-layout-master')

@section('title')
    Events
@stop
@section('styles')
    <link rel="stylesheet" href="{{URL::asset('public/css/plugins/select2/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('public/date-picky-2.0/css/date-picky.css')}}">
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/event') }}">Events</a></li>
        @if( $event->id>0)
            <li class="active"><a href="{{ url('admin/event/'.$event->id.'/create') }}">Edit</a></li>
        @else
            <li class="active"><a href="{{ url('admin/event/create') }}">Add </a></li>
        @endif
    </ol>
@stop
@if( $event->id>0)
@section('action_button')
    <a href="{{url('admin/event/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> Add More</a>
@stop
@endif

@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    {!! Form::open(['url' => 'admin/event/save-or-update','id'=>'event-form']) !!}
                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <div class="ibox-title">
                        <h5>New Event</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Event Name</label>
                                    <input type="text" name="event_name" class="form-control validate[required]"
                                           value="{{ $event->event_name }}"/>
                                </div>
                                <div class="form-group">
                                    <label>Event Description</label>
                                    <textarea name="event_desc" class="form-control"
                                              rows="6">{{ $event->event_desc }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Of Seat</label>
                                            <select name="no_of_seat" class="form-control">
                                                @for($i = 1; $i <= 20; $i++)
                                                    <option value="{{$i}}" {!! selected($event->no_of_seat, $i) !!}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select name="course_id" class="select-courses form-control">
                                                <option value="">Select Course</option>
                                                @foreach($course as $item)
                                                    <option value="{{ $item->id }}" {!! selected($item->id, $event->course_id) !!}>{{ $item->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Time Start</label>
                                            <input type="text" name="event_time_start" id="start_time"
                                                   class="form-control validate[required]"
                                                   value="{{ $event->event_time_start }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Time End</label>
                                            <input type="text" name="event_time_end" id="end_time"
                                                   class="form-control validate[required]"
                                                   value="{{ $event->event_time_end }}"/>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                @if($event->id > 0)
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="reset_event_check" value=""
                                                       onclick="return ResetConfirmation(this)">
                                                <span style="color: red;">Want to reset event dates?</span></label>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group" id="calendar_wrapper">
                                    <label>Events Dates</label>
                                    <div id="multi-select-calendar" class="box select-calendar"></div>
                                    <input type="hidden" name="event_dates" id="event_dates" value="{{$eventsDate}}">
                                </div>
                                <div class="repeat-event-section" @if($event->id > 0) style="display: none" @endif>
                                    <div class="checkbox">
                                        {{--<label>--}}
                                        {{--<input type="checkbox" name="repeat_event_check" value="1" id="repeat" @if($event->repeat_event != "") checked="checked"--}}
                                        {{--@endif onclick="repeatClick(this)"/>--}}
                                        {{--Repeat this event--}}
                                        {{--</label>--}}

                                        <label class="control control--checkbox"> &nbsp; Repeat this event
                                            <input type="checkbox" name="repeat_event_check" value="1" id="repeat"
                                                   @if($event->repeat_event != "") checked="checked"
                                                   @endif onclick="repeatClick(this)"/>
                                            <div class="control__indicator"></div>
                                        </label>

                                    </div>
                                    <br/>
                                    <div class="form-group" id="re-occurance">
                                        <label>Re Occurance</label>
                                        <p style="color: red">*Please check the scheduled date carefully if not </p>
                                        <select name="repeat_event" class="form-control">
                                            <option value="EVERY_WEEK" {!! selected($event->repeat_event, 'EVERY_WEEK') !!}>
                                                Every Week
                                            </option>
                                            <option value="EVERY_MONTH" {!! selected($event->repeat_event, 'EVERY_MONTH') !!}>
                                                Every Month
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="end_date_wrapper">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" id="end_date"
                                               class="form-control validate[required]"
                                               value="{{ $event->end_date }}"/>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer clearfix">
                        <button type="submit" name="submit" value="Save" class="btn btn-primary pull-right">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script src="{{URL::asset('public/js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('public/date-picky-2.0/js/date-picky.js')}}"></script>

    <script type="text/javascript">

        $(".sidebar-nav").find(".menu-event").addClass('active');
        $(".select-courses").select2();

        /*function SubmitEventForm(e) {
            //e.preventDefault();
            var newDates = $('#multi-select-calendar').find('td.ui-state-highlight');

            var savingDate = [];
            newDates.each(function (d) {
                var year = $(this).attr('data-year');
                var month = parseInt($(this).attr('data-month')) + 1;
                var day = $(this).find('a').text();
                savingDate.push(year + "-" + month + "-" + day);
            });

            //console.log(savingDate);

            $("#event_dates").val(savingDate.toString());
        }*/

        var highlitedDate = [];

        function ResetConfirmation(thisObj) {

            var cnf = confirm('Are you sure want to do this?');

            if (cnf) {

                $("#event_dates").val('');
                highlitedDate = [];
                $("#calendar_wrapper").find('#multi-select-calendar').next('.datePicker').remove();
                $("#calendar_wrapper").append('<div id="multi-select-calendar" class="box select-calendar"></div>');

                var options1 = {
                    multipleDate: true,
                    showCurrentDateButton: false,
                    preDates: [],
                    preDatesClickable: true,
                    activation: 'alwaysOn',
                    singleCalendarMode: false,
                    showCurrentDate: true,
                    callback: function (date) {

                        var index = highlitedDate.indexOf(date);

                        if (index > -1) {
                            highlitedDate.splice(index, 1);
                        } else {
                            highlitedDate.push(date)
                        }
                        $("#event_dates").val(highlitedDate.toString());

                    },
                    format: 'DD/MM/YYYY',
                    setWeekHoliday: false,
                    holiday: 'saturday',
                    preDatesOnlyClickable: false

                    //minDate: '1/3/2017', // dd/mm/yyyy
                    //maxDate: '3/3/2017',
                    //animation: 'flipInY',
                };

                $('#multi-select-calendar').datePicky(options1);

                //$(thisObj).attr('readonly', true);

                $(".repeat-event-section").show();
            }

            return cnf;
        }


        var highlightingDates = $("#event_dates").val();


        if(highlightingDates != "" && highlightingDates != null) {
            highlitedDate = highlightingDates.split(',');
        }

        /*var options1 = {
            multipleDate: true,
            showCurrentDateButton: false,
            preDates: highlitedDate,
            /!*preDatesClickable: true,*!/
            activation: 'alwaysOn',
            singleCalendarMode: false,
            showCurrentDate: true,
            callback: function (date) {

                var index = highlitedDate.indexOf(date);

                if (index > -1) {
                    highlitedDate.splice(index, 1);
                } else {
                    highlitedDate.push(date)
                }
                $("#event_dates").val(highlitedDate.toString());

            },
            format: 'DD/MM/YYYY',
            setWeekHoliday: false,
            holiday: 'saturday',
            preDatesOnlyClickable: false,
            disableClickToggle: false

            //minDate: '1/3/2017', // dd/mm/yyyy
            //maxDate: '3/3/2017',
            //animation: 'flipInY',
        };*/
        var options1 = {
            multipleDate : true,
            preDates: highlitedDate,//yyyy-mm-dd
            showCurrentDateButton: false,
            activation: 'alwaysOn',
            singleCalendarMode: false,
            showCurrentDate: false,
            callback: function(date, activeDates){
                console.log(date);

               /* var index = highlitedDate.indexOf(date);

                if (index > -1) {
                    highlitedDate.splice(index, 1);
                } else {
                    highlitedDate.push(date)
                }
*/
                $("#event_dates").val(activeDates.toString());
            },
//        format: 'DD/MM/YYYY',
            setWeekHoliday: false,
            holiday: 'saturday',
            disableClickToggle: false

            //minDate: '1/3/2017', // dd/mm/yyyy
            //maxDate: '3/3/2017',
            //animation: 'flipInY',
        };

        $('#multi-select-calendar').datePicky(options1);

        repeatClick($("#repeat"));

        function repeatClick(thisObj) {
            if ($(thisObj).is(':checked')) {
                $("#re-occurance").show();
                $("#end_date_wrapper").show();
            } else {
                $("#re-occurance").hide();
                $("#end_date_wrapper").hide();
            }
        }


        $('#start_time,#end_time').datetimepicker({
            format: 'LT'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

    </script>

@stop


