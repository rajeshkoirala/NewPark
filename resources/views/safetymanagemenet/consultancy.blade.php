@extends("layout-master")
@section('title')
     {!!kmGetData('consultancy','meta_title')  !!}
@stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('consultancy','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('consultancy','meta_description')  !!}">
    <meta name="keywords" content="{!!kmGetData('consultancy','meta_keyword')  !!}">
   {{-- <meta name="msvalidate.01" content="{!!kmGetData('faq','bing-site-verification')  !!}">
    <meta name="google-site-verification" content="{!!kmGetData('faq','google-site-verification')  !!}">--}}
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section("content")
    <main class="om-main-content">
        <div class="main courses-main">
            <div class="slider">
                <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('site-config','consultancy_background_image') )!!})">

                <div class="container">
                        <div class="inner-wrapper">
                            <ol class="breadcrumb">
                                <li><a href="{{ URL::to('/') }}">Home</a></li>
                                <li><a href="{{ URL::to('/safetymanagemenet/consultancy') }}">Safety Management</a></li>
                                <li><a href="{{ URL::to('/safetymanagemenet/consultancy') }}">Consultancy</a></li>
                            </ol>
                            <h2>Consultancy</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="common-section-one">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="global-heading">
                                <h2>{!! kmGetData('consultancy','title') !!}</h2>
                                <hr>
                            </div>

                            <div class="description">
                                {!! kmGetData('consultancy','description') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="common-section-two">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="global-heading">
                                <h2>{!! kmGetData('consultancy','question') !!}</h2>
                                <hr>
                            </div>
                        </div>
                        @php($data = kmGetLoopData('consultancy', array('icon','answer_title', 'answer_description')))
                        @foreach($data as $item)
                            <div class="col-sm-6 col-md-3">
                                <div class="description matchHeight">
                                    <div class="circle">
                                        <i class="{!! $item['icon'] !!}" aria-hidden="true"></i>
                                    </div>
                                    <h3>{!! $item['answer_title'] !!}</h3>
                                    {!! $item['answer_description'] !!}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="common-section-three">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="global-heading">
                                <h2>{!! kmGetData('consultancy','offer_title') !!}</h2>
                                <hr>
                            </div>
                        </div>

                        <div class="col-md-12">

                            @php($data = kmGetLoopData('consultancy', array('offer_name','percentage')))

                            @foreach($data as $item)
                                @php
                                    if(@$class=="" ||@$class!="progress-bar progress-bar-success" ) $class="progress-bar progress-bar-success";
                                    else $class="progress-bar progress-bar-warning";
                                @endphp
                                <div class="progress skill-bar ">
                                    <div class="{{$class}}" role="progressbar" aria-valuenow="{!! $item['percentage'] !!}"
                                         aria-valuemin="0" aria-valuemax="100">
                                    <span class="skill"><a href="#" target="_blank">{!! $item['offer_name'] !!}</a> <i
                                                class="val">{!! $item['percentage'] !!}%</i></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@stop
@section("script")
    <script type="text/javascript">
        $(function () {
            $('.matchHeight').matchHeight();
        });

        $(window).scroll(function () {
            $('.progress .progress-bar').css("width",
                    function () {
                        return $(this).attr("aria-valuenow") + "%";
                    }
            )
        });
    </script>
@stop
