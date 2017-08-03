@extends('admin.admin-layout-master')
@section('title')
    Contact Details
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/contact-details') }}">Contact Details</a></li>

    </ol>
@stop
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Contact Details</h5>
                    </div>
                    {!! kmBegin('contact-details') !!}
                    <div class="ibox-content clearfix">

                        <div class="col-md-6">
                            <h3>Basic Details</h3>
<!--
                            <div class="form-group">
                                <label>Address</label>
                                {!! kmText('address') !!}
                            </div>
-->
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</span>
                               {!! kmText('address') !!}
                            </div>
                            <br>                        
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-phone" aria-hidden="true"></i> Phone No.</span>
                              {!! kmText('phone_number') !!}
                            </div>
                            <br>
                           <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-fax" aria-hidden="true"></i> Fax No.</span>
                              {!! kmText('fax_number') !!}
                            </div>
                                <br>                            
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-envelope-o" aria-hidden="true"></i> eMail</span>
                              {!! kmText('contact_email') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Social Links</h3>
                            
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</span>
                              {!! kmText('facebook_link') !!}
                            </div>
                            <br>
                           <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</span>
                              {!! kmText('twitter_link') !!}
                            </div>
                            <br>
                            
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram </span>
                              {!! kmText('instagram_link') !!}
                            </div>
                            <br>
                           <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-google-plus-square" aria-hidden="true"></i> Google Plus </span>
                              {!! kmText('google_plus_link') !!}
                            </div>
                            <br>
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-dribbble" aria-hidden="true"></i> Dribble </span>
                               {!! kmText('dribble_link') !!}
                            </div>
                        </div>

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
                            <label>Map Latitude</label>
                            {!! kmText('latitude') !!}
                        </div>
                        <div class="form-group">
                            <label>Map Longitude</label>
                            {!! kmText('longitude') !!}
                        </div>
                        <div class="form-group">
                            <label>Map Zoom</label>
                            {!! kmText('map_zoom') !!}
                        </div>
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
        $(".sidebar-nav").find(".contact-details").addClass('active');

        $(".sidebar-nav").find(".menu-general").addClass('active');
    </script>

@stop