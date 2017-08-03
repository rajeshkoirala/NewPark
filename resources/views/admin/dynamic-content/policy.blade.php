@extends('admin.admin-layout-master')
@section('title')
    Policy
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/policy') }}">Policy</a></li>

    </ol>
@stop
@section('content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                {!! kmBegin('policy') !!}
                <div class="ibox-content">
                    @while (kmLoop())
                        <div class="km-loop-div">
                            {!! kmBtnClose() !!}
                    <div class="form-group">
                        <label>Title</label>
                        {!! kmText('title') !!}
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        {!! kmEditor('description') !!}
                    </div>
                        </div>
                    @endwhile
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

                       {{-- <div class="form-group">
                            <label>Google Site Verification</label>
                            {!! kmText('google-site-verification') !!}
                        </div>
                        <div class="form-group">
                            <label>Bing validation</label>
                            {!! kmText('bing-site-verification') !!}
                        </div>--}}

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label>Background Image</label>
                            {!! kmImage('background_image') !!}

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
    $(".sidebar-nav").find(".menu-footer").addClass('active').find('.menu-policy').addClass('active');
</script>

@stop