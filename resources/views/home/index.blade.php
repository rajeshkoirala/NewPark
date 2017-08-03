@extends('layout-master')

@section('title'){!!kmGetData('site-config','meta_title')  !!}@stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('site-config','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('site-config','meta_description')  !!}">
     <meta name="msvalidate.01" content="{!!kmGetData('site-config','bing-site-verification')  !!}">
    <meta name="google-site-verification" content="{!!kmGetData('site-config','google-site-verification')  !!}">
    <meta name="geo.region" content="IE"/>
    <meta name="geo.position"
          content="{!!kmGetData('contact-details','latitude')  !!};{!!kmGetData('contact-details','longitude')  !!}"/>
    <meta name="ICBM"
          content="{!!kmGetData('contact-details','latitude')  !!};{!!kmGetData('contact-details','longitude')  !!}"/>

@stop

@section('content')

    <main class="om-main-content">
        <div class="main">
            <div class="slider">
                <div id="owl-slider-olive" class="owl-carousel owl-theme">
                    @php
                                 $i=1;
                    @endphp

                    @php($data = kmGetLoopData('home_page', array('home_page_slider_image')))
                    @foreach($data as $item)
                        <div class="item"><img src="{!!URL::asset('km_lib/uploads/'.$item['home_page_slider_image']) !!}"   width="1600" height="626" alt="">
                            <div class="carousel-caption">
                                <h1 data-animation="animated bounceInLeft">{!!kmGetData('home_page','home_page_slider_content_title')  !!}</h1>
                                <p>{!!kmGetData('home_page','home_page_slider_content_description')  !!}</p>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
            <div>
                <img
                        src="{!!URL::asset('km_lib/uploads/'.kmGetData('home_page','home_page_background_image'))!!}"
                        alt="" class="img-responsive">

            </div>
        </div>



            {!! Form::close() !!}<!-- Form -->
                <!-- Form -->
            </div>
        </div>
        </div>
    </main>
@stop

@section("script")



@stop