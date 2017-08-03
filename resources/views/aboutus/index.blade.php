@extends("layout-master")
@section('title') {!!kmGetData('about-us','meta_title')  !!} @stop
@section('seo_detail')
    <meta name="description" content="{!!kmGetData('about-us','meta_description')  !!}">
    <meta name="keywords" content="{!!kmGetData('about-us','meta_keyword')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">

@stop

@section("content")
<main class="om-main-content">
    <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('about-us','background_image') )!!})">
                   <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li><a href="{{ URL::to('/about-us') }}">About Us</a></li>
                        </ol>
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="aboutus-content">
                <div class="row">
                    <div class="col-md-6 clearfix">
                        <div class="left-single-us global-inner-heading">
                            <h1>{!! kmGetData('about-us','title') !!}</h1>
                            {!! kmGetData('about-us','description') !!}                        </div>
                            <div class="buttons tabs-course-booking-btn pull-left">
                                <a class="btn btn-default btn-theme-transparent btn-icon-left" href="{{url('/course/0/all-courses')}}"><i class="fa fa-book" aria-hidden="true"></i> {!! kmGetData('about-us','btn_link') !!}     </a>
                            </div>
                        </div>
                    <div class="col-md-6">
                        @php($data = kmGetLoopData('about-us', array('image','image_title','image_description')))
                        @foreach($data as $item)
                        <div class="single_us fix">
                            <div class="single_us_img">
                                <img src="{!!  URL::asset('km_lib/uploads/'. $item['image'] )!!}" width="116" height="150" alt="About Us Image 01">
                            </div>
                            <div class="single_us_text">
                                <h3>{!! $item['image_title'] !!}</h3>
                                {!! $item['image_description'] !!}                            </div>

                            {{--<div class="single_us fix">--}}
                                {{--<div class="single_us_img">--}}
                                    {{--<img src="{{URL::asset('public/frontend/dist/images/aboutus_safety02.png')}}" width="116" height="150" alt="About Us Image 01">--}}
                                {{--</div>--}}
                                {{--<div class="single_us_text">--}}
                                    {{--<h3>Olive Awareness</h3>--}}
                                    {{--<p>Our clients can browse through our extensive range of awareness courses in order to find what suits your personal interests.</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="single_us fix">--}}
                                {{--<div class="single_us_img">--}}
                                    {{--<img src="{{URL::asset('public/frontend/dist/images/aboutus_safety03.png')}}" width="116" height="150" alt="About Us Image 01">--}}
                                {{--</div>--}}
                                {{--<div class="single_us_text">--}}
                                    {{--<h3>Online &amp; Offline training options</h3>--}}
                                    {{--<p>Our clients have flexible options to choose courses browsing through online and offline courses according to their personal interests.</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop @section("script")
<script type="text/javascript">
</script>
@stop