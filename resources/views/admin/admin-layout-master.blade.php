<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{url('public/img/favicon.png')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/font-awesome/css/font-awesome.css')}}">
    {{--<link rel="stylesheet" href="{{url('public/css/plugins/toastr/toastr.min.css')}}">--}}
    <link rel="stylesheet" href="{{url('public/js/plugins/gritter/jquery.gritter.css')}}">
    <link rel="stylesheet" href="{{url('public/css/plugins/iCheck/custom.css')}}">
    <link rel="stylesheet" href="{{url('public/css/plugins/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" href="{{url('public/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">

    <link rel="stylesheet" href="{{URL::asset('public/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/css/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/calendar/css/mdp.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/calendar/css/prettify.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/css/validationEngine.jquery.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('km_lib/css/km-style.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('public/Ladda-master/dist/ladda.min.css')}}" />

    @yield('styles')
</head>
{{--@php
    $enquiryRepo = new \App\Repositories\EnquiryRepository();
    $noenquiry= $enquiryRepo->getNotViewedEnquiry();
    $enquiryController = new App\Http\Controllers\EnquiryController();
@endphp--}}
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu sidebar-nav" id="side-menu">
                <li class="nav-header" style="background: #F3F3F4; border-right: 1px solid rgba(177, 177, 177, 0.39); opacity: .8">
                    <div class="dropdown profile-element">
                        <a href="{{ url('admin/') }}">
                            <img alt="image" class="img-circle img-no-circle" src="{{url('public/img/new_park_logo.png')}}" width="150">
                        </a>
                    </div>
                    <div class="logo-element">
                        <a href="{{ url('admin/') }}">
                            <img src="{{url('public/img/favicon.png')}}" alt="Olive Media" height="24px"
                                 data-toggle="tooltip"
                                 data-placement="right" title="Invision">
                        </a>
                    </div>
                </li>

                {{--<li class="menu-dashboard">
                    <a href="{{ URL::to('admin/dashboard') }}">
                        <i class="fa fa-dashboard"></i><span class="nav-label">Dashboard</span>
                    </a>
                </li>--}}
                @php
                    $userType=Auth::user()->user_type;

                @endphp
                @if($userType==1)
                <li class="menu-user-management">
                    <a href="{{ URL::to('admin/user-management') }}">
                       <i class="fa fa-user"></i>
                        <span class="nav-label">   User Management</span>
                    </a>
                </li>
                @endif




                <li class="menu-faq menu-pages  contact-about-us choose-us saftey-consultancy contact-us saftey-health-safe saftey-psdp-pscs employment-up-skill">
                    <a href="#"><i class="fa fa-leanpub" aria-hidden="true"></i>
                        <span class="nav-label">Nav Pages</span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                       {{-- <li class="contact-us">
                            <a href="{{ URL::to('admin/contact-us') }}">
                                <i class="fa fa-file-text-o"></i>contact Us
                            </a>
                        </li>--}}
                        <li class="contact-about-us">
                            <a href="{{ URL::to('admin/about-us') }}">
                                <i class="fa fa-file-text-o"></i>About Us
                            </a>
                        </li>

                        <li class="menu-faq">
                            <a href="{{ URL::to('admin/home-page') }}">
                                <i class="fa fa-file-text-o"></i>
                                Home Page
                            </a>
                        </li>



                    </ul>
                </li>

                <li class="activity-log">
                    <a href="{{ URL::to('admin/activity-log') }}">
                        <i class="fa fa-bar-chart  fa-fw"></i><span class="nav-label">Activity Log</span>
                    </a>
                </li>
                <li class="menu-footer">
                    <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span class="nav-label">Footer Section</span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li class="menu-terms-of-use">
                            <a href="{{ URL::to('admin/terms-of-use') }}">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                Terms of Use
                            </a>
                        </li>
                        <li class="menu-privacy-security">
                            <a href="{{ URL::to('admin/privacy-and-security') }}">
                                <i class="fa fa-indent" aria-hidden="true"></i>
                                Privacy and Security
                            </a>
                        </li>
                        <li class="menu-policy">
                            <a href="{{ URL::to('admin/policy') }}">
                                <i class="fa fa-file-text-o"></i>
                                Policy
                            </a>
                        </li>
                    </ul>
                </li>
                <li><hr></li>
                <li class="menu-general">
                    <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i>
                        <span class="nav-label"> General </span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li class="slider">
                            <a href="{{ URL::to('admin/slider') }}">
                                <i class="fa fa-sliders"></i>Slider
                            </a>
                        </li>
                        <li class="site-config">
                            <a href="{{ URL::to('admin/site-config') }}">
                                <i class="fa fa-cog"></i>Site Config
                            </a>
                        </li>
                        <li class="contact-details">
                            <a href="{{ URL::to('admin/contact-details') }}">
                                <i class="fa fa-address-card"></i>Contact Details
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-6">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary"><i class="fa fa-bars"></i> </a>
                           
                                <div class="navbar-form-custom form-group">
                                    @yield('search_box')
                                </div>
                            
                        </div>
                    </div>
                   {{-- <div class="col-md-5 col-sm-6 col-xs-6">
                        <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                        <a href="{{ url('/') }}" target="_blank">visit site</a>
                        </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"> <i class="fa fa-envelope"></i> <span class="label label-warning">{{count($noenquiry)}}</span> </a>

                                    <ul class="dropdown-menu dropdown-messages">
                                        @if($noenquiry)
                                            @php ($i = 1)
                                            @php ($divider = '<li class="divider"></li>')

                                            @foreach($noenquiry as $noenquiry)

                                                @if($i != 1)
                                                    {!! $divider !!}
                                                @endif

                                                    <li>
                                                        <div class="dropdown-messages-box">
                                                            <div class="media-body"><a href="{{ url('/admin/enquiry/'.$noenquiry->id.'/view') }}"><strong>{{$noenquiry->name}}({{$noenquiry->email}})</strong></a>has an <strong>Enquiry</strong>.
                                                                <br>--}}{{-- <small class="text-muted">{{$enquiryController->humanTiming($noenquiry->created_at)}} --}}{{--at {{date("g:i a",strtotime($noenquiry->created_at))}} on {{date("j-m-Y",strtotime($noenquiry->created_at))}}</small> </div>
                                                        </div>
                                                    </li>
                                                    @php ($i++)
                                            @endforeach
                                            @else
                                            <p>No Any New Enquiries.</p>
                                        @endif
                                    </ul>

                            </li>

                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                    <img alt="image" class="img-circle img-32 live" src="{{url('public/img/a7.jpg')}}">
                                </a>
                                <ul class="dropdown-menu dropdown-profile fadeInRight">
                                    <!-- User image -->
                                    <li class="user-header"><img src="{{url('public/img/user2-160x160.jpg')}}"
                                                                 class="img-circle"
                                                                 alt="User Image">
                                        <p> {{ Auth::user()->full_name }}
                                            <br>
                                            <small>Member
                                                since {{ date('F, Y', strtotime(Auth::user()->created_at)) }}</small>
                                        </p>
                                    </li>
                                <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{URL::to('admin/user-management/change-password')}}" class="btn  btn-xs btn-primary"> <i class="fa fa-lock"></i>Change Password</a>
                                            --}}{{--<a class="btn btn-w-m btn-success btn-bitbucket" onclick="ShowLargeModalForm('Change Password', '{{URL::to('admin/user-management/change-password')}}')">--}}{{--
                                                --}}{{--<i class="fa fa-lock"></i>--}}{{--
                                                --}}{{--Change Password--}}{{--
                                            --}}{{--</a>--}}{{--
                                        </div>
                                        <div class="pull-right">
                                            --}}{{--<a class="btn btn-w-m btn-success btn-bitbucket" onclick="ShowLargeModalForm('Change Password', '{{URL::to('admin/user-management/change-password')}}')"> <i class="fa fa-lock"></i> Change Password </a>--}}{{--
                                            <a href="{{ url('admin/logout') }}"
                                               class="btn btn-w-m btn-danger btn-bitbucket">
                                                <i class="fa fa-sign-out"></i> Sign Out </a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>
                            </li>
                            --}}{{--<li>
                                <a class="right-sidebar-toggle"> <i class="fa fa-ellipsis-v"></i> </a>
                            </li>--}}{{--
                        </ul>
                    </div>--}}
                </div>
            </nav>
        </div>
        <div class="row wrapper border-bottom gray2-bg page-heading">
            <div class="col-sm-4">
                <h2>@yield('title')</h2>
                @yield('breadcrumb')
                {{--<ol class="breadcrumb">
                    <li><a href="{{ url('admin/') }}">Home</a></li>
                    <li class="active"><strong>@yield('title')</strong></li>
                </ol>--}}
            </div>
            <div class="col-sm-8">
                <div class="title-action"> @yield('action_button') </div>
            </div>
        </div>


        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(Session::has('flash_message'))
            <br>
            <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle" aria-hidden="true"></i> {{ Session::get('flash_message') }}
                        </div>
                    </div>
            </div>
        @endif

        {{--All pages contents--}}
        @yield('content')

        <div class="footer">
            {{--<div class="pull-right"> {{ round((disk_total_space('/')-disk_free_space("/"))/(1024*1024*1024), 2) }}GB of
                <strong>{{ round(disk_total_space('/')/(1024*1024*1024),2) }}GB</strong></div>--}}
            <div><strong>Copyright</strong> &copy; Olive Media Pvt. Ltd. &copy; {{ date('Y') }}</div>
        </div>
    </div>
    <!--        Right Sidebar Setting -->
    <div id="right-sidebar">
        <div class="sidebar-container">
            <div class="tab-content">
                <div class="sidebar-title">
                    <h3><i class="fa fa-gears"></i> Settings</h3>
                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                </div>
                <div class="setings-item"> <span>
                        Show notifications
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                            <label class="onoffswitch-label" for="example"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item"> <span>
                        Disable Chat
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox"
                                   id="example2">
                            <label class="onoffswitch-label" for="example2"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item"> <span>
                        Enable history
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                            <label class="onoffswitch-label" for="example3"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item"> <span>
                        Show charts
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                            <label class="onoffswitch-label" for="example4"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item"> <span>
                        Offline users
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                   id="example5">
                            <label class="onoffswitch-label" for="example5"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item"> <span>
                        Global search
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                   id="example6">
                            <label class="onoffswitch-label" for="example6"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item"> <span>
                        Update everyday
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                            <label class="onoffswitch-label" for="example7"> <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="sidebar-content">
                    <h4>Settings</h4>
                    <div class="small"> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                        since the 1500s. Over the years, sometimes by accident, sometimes on purpose (injected humour
                        and the like).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="{{url('public/js/jquery-2.1.1.js')}}"></script>
<script src="{{url('public/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{url('public/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- Custom and plugin javascript -->
<script src="{{url('public/js/olivemedia.js')}}"></script>
<script src="{{url('public/js/plugins/pace/pace.min.js')}}"></script>
<script src="{{url('public/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{url('public/js/plugins/gritter/jquery.gritter.min.js')}}"></script>
{{--<script src="{{url('public/js/plugins/toastr/toastr.min.js')}}"></script>--}}
<!-- iCheck -->
<script src="{{url('public/js/plugins/iCheck/icheck.min.js')}}"></script>
<!-- jQuery UI custom -->
<script src="{{url('public/js/jquery-ui.custom.min.js')}}"></script>
<!-- Sweet alert -->
<script src="{{url('public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{ URL::asset('public/js/ajax-table-1.0.js') }}"></script>
<script src="{{URL::asset('public/js/ajax-grid-2.1.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/calendar/js/jquery-ui-1.11.1.js')}}"></script>
<script src="{{ URL::asset('public/js/script.default.js') }}"></script>
<script src="{{ URL::asset('public/js/moment.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/js/daterangepicker.js') }}"></script>
{{--<script type="text/javascript" src="{{URL::asset('public/js/jquery.validationEngine-en.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/jquery.validationEngine.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/jquery.validationEngine.js')}}"></script>--}}
<script type="text/javascript" src="{{URL::asset('public/calendar/js/prettify.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/calendar/js/lang-css.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/calendar/jquery-ui.multidatespicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/bootstrap-select.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
<script>var km_base_url = "{{ url('/') }}"; </script>
<script src="{{URL::asset('km_lib/js/km-scripts.js')}}"></script>

<script>

    setTimeout(function () {
        $('body').find('.alert').remove();
    }, 5000);

    function common_image_upload_trigger(thisObj) {
        $(thisObj).parent().find("input[type='file']").trigger("click");
    }

    function common_file_upload_trigger(thisObj) {
        $(thisObj).parent().find("input[type='file']").trigger("click");
    }

    $(document).on("change", ".common_image_upload", function () {

        var maximum_upload_limit = "{{ ini_get('max_file_uploads') }}";
        var thisObj = $(this);
        var file_data = thisObj.prop('files')[0];

        if (file_data.type != "image/png" && file_data.type != "image/jpeg") {
            thisObj.parent().find('input[type="hidden"]').val("");
            thisObj.parent().find('span').html("Image file type not supported");
            return;
        }

        if (file_data.size / (1024 * 1024) > maximum_upload_limit) {
            thisObj.parent().find('input[type="hidden"]').val("");
            thisObj.parent().find('span').html("File is huge. Maximum allowed is upto " + maximum_upload_limit + "MB");
            return;
        }

        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: '{{ url("admin/common/file-upload") }}',
            dataType: 'text',
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status != false) {
                    thisObj.parent().find('input[type="hidden"]').val(result.name);

                    thisObj.parent().find('span').html('<img src="" height="100"/>');
                    thisObj.parent().find('img').attr('src', '{{ url('public/uploads') }}/' + result.name);

                } else {

                    thisObj.parent().find('input[type="hidden"]').val("");
                    thisObj.parent().find('span').html(result.message);

                }
            }
        });
    });

    $(document).on("change", ".common_file_upload", function () {

        var maximum_upload_limit = "{{ ini_get('max_file_uploads') }}";
        var thisObj = $(this);
        var file_data = thisObj.prop('files')[0];

        if (file_data.size / (1024 * 1024) > maximum_upload_limit) {
            thisObj.parent().find('input[type="hidden"]').val("");
            thisObj.parent().find('span').html("File is huge. Maximum allowed is upto " + maximum_upload_limit + "MB");
            return;
        }

        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: '{{ url("admin/common/file-upload2") }}',
            dataType: 'text',
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status != false) {
                    thisObj.parent().find('input[type="hidden"]').val(result.name);

                    thisObj.parent().find('span').html('<img src="" height="100"/>'+result.name);
                    thisObj.parent().find('img').attr('src', '{{ url('public/img/acrobatpdf.jpg') }}');

                } else {

                    thisObj.parent().find('input[type="hidden"]').val("");
                    thisObj.parent().find('span').html(result.message);

                }
            }
        });
    });
</script>

@yield('script')

<script>
    $(document).ready(function () {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $('.demo3').click(function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });



        /*setTimeout(function () {
         toastr.options = {
         closeButton: true
         , progressBar: true
         , positionClass: 'toast-bottom-left'
         , showMethod: 'slideDown'
         , timeOut: 4000
         };
         toastr.success('Message goes here', 'Welcome to OliveMedia');
         }, 1300);*/

        // Typehead ----------------------------
        /*$('.typeahead_1').typeahead({
         source: ["item 1", "item 2", "item 3"]
         });
         $.get('js/api/typehead_collection.json', function (data) {
         $(".typeahead_2").typeahead({
         source: data.countries
         });
         }, 'json');
         $('.typeahead_3').typeahead({
         source: [
         {
         "name": "Afghanistan"
         , "code": "AF"
         , "ccn0": "040"
         }
         , {
         "name": "Land Islands"
         , "code": "AX"
         , "ccn0": "050"
         }
         , {
         "name": "Albania"
         , "code": "AL"
         , "ccn0": "060"
         }
         , {
         "name": "Algeria"
         , "code": "DZ"
         , "ccn0": "070"
         }
         ]
         });*/


        // Add slimscroll to element
        $('.scroll_content').slimscroll({
            height: '200px'
        })


    });

</script>
