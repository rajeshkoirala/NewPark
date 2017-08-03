@extends('admin.admin-layout-master')
@section('title')
    Slider
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/slider') }}">Slider</a></li>

    </ol>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Slider</h5>
                    </div>
                    {!! kmBegin('slider') !!}
                    <div class="ibox-content">
                        @while (kmLoop())
                            <div class="km-loop-div">
                                {!! kmBtnClose() !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Slider Image</label> {!! kmImage('slider_image') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Title</label> {!! kmText('slider_title') !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label> {!! kmTextArea('slider_description') !!}
                                        </div>
                                        <label>Button Link</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon3">{!! url('/') !!}/</span>
                                            {!! kmText('slider_button_link') !!}
                                        </div>
                                        {{--<div class="input-group">
                                            <label>Button Link</label> <span class="input-group-addon" id="basic-addon2">{!! url('/') !!}</span>/{!! kmText('slider_button_link') !!}
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endwhile


                    </div>

                    <div class="ibox-footer clearfix">
                        <div class="pull-right">
                            <div class="form-group last-save-btn">
                                {!! kmSubmit() !!}
                            </div>
                        </div>
                    </div>
                    {!! kmEnd() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(".sidebar-nav").find(".menu-general").addClass('active');
        $(".sidebar-nav").find(".slider").addClass('active');
    </script>
@stop