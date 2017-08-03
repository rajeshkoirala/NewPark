@extends('admin.admin-layout-master')
@section('title')
    Site Config
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/site-config') }}">Site Config</a></li>

    </ol>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Site Config</h5>
                    </div>
                    {!! kmBegin('site-config') !!}
                    <div class="ibox-content">
                        <div class="form-group">
                            <label>Image Logo</label>
                            {!! kmImage('image') !!}
                        </div>
                        <div class="form-group">

                            <label>Title</label>
                            {!! kmText('title') !!}
                        </div>

                        <div class="form-group">
                            <label>Short Description</label>
                            {!! kmEditor('short_desc') !!}
                        </div>


                        <div class="hr-line-dashed"></div>

                        <h2>SEO Details</h2>
                        <div class="form-group">
                            <label>SEO Title</label>
                            {!! kmText('meta_title') !!}
                        </div>

                        <div class="form-group">
                            <label>SEO Meta Description</label>
                            {!! kmTextArea('meta_description') !!}
                        </div>
                        <div class="form-group">
                            <label>Google Site Verification</label>
                            {!! kmText('google-site-verification') !!}
                        </div>
                        <div class="form-group">
                            <label>Bing validation</label>
                            {!! kmText('bing-site-verification') !!}
                        </div>
                        <div class="form-group">
                            <label>Google Analytics Script</label>
                            {!! kmTextArea('google_analytic_script') !!}
                        </div>
                        <div class="form-group">
                            <label>Meta Geo Region</label>
                            {!! kmText('meta_geo_region') !!}
                        </div>

                        <div class="form-group">
                            <label>Meta Geo Position</label>
                            {!! kmText('meta_geo_position') !!}
                        </div>

                        <div class="form-group">
                            <label>Meta ICBM</label>
                            {!! kmText('meta_icbm') !!}
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row all-top-header-background">




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
        $(".sidebar-nav").find(".menu-general").addClass('active');
        $(".sidebar-nav").find(".site-config").addClass('active');
    </script>
@stop