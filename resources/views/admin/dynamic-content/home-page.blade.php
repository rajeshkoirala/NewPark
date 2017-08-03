@extends('admin.admin-layout-master')
@section('title')
    Home Page
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/home-page') }}">Home Page</a></li>

    </ol>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>HomePage</h5>
                    </div>
                    {!! kmBegin('home_page') !!}
                    <div class="ibox-content">
                        @while (kmLoop())
                            <div class="km-loop-div">
                                {!! kmBtnClose() !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Slider Image</label> {!! kmImage('home_page_slider_image') !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endwhile

                        <div class="hr-line-dashed"></div>
                            <h2>Content Over Slider</h2>
                            <div class="form-group">
                                <label>Slider Content Title</label>
                                {!! kmText('home_page_slider_content_title') !!}
                            </div>

                            <div class="form-group">
                                <label>Slider Content Description</label>
                                {!! kmTextArea('home_page_slider_content_description') !!}
                            </div>

                        <div class="hr-line-dashed"></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label>Background Image</label>
                            {!! kmImage('home_page_background_image') !!}

                        </div>

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
        $(".sidebar-nav").find(".menu-homr_page").addClass('active');
    </script>
@stop