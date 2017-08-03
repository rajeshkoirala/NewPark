@extends('layout-master')
@section('title'){!!kmGetData('terms-of-use','meta_title')  !!} @stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('terms-of-use','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('terms-of-use','meta_description')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
    {{--<meta name="keywords" content="{!!kmGetData('terms-of-use','meta_keyword')  !!}">--}}
    {{--<meta name="msvalidate.01" content="{!!kmGetData('terms-of-use','bing-site-verification')  !!}">--}}
    {{--<meta name="google-site-verification" content="{!!kmGetData('terms-of-use','google-site-verification')  !!}">--}}
@stop
@section("content")

@section('content')
   <main class="om-main-content">
        <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('terms-of-use','background_image') )!!})">
            <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li><a href="{{ URL::to('/aboutus') }}">Terms of use</a></li>
                        </ol>
                        <h2>Terms of use</h2>
                    </div>
                </div>
            </div>
        </div>
    <div class="footer-info">
    	<div class="container">
			@php($data = kmGetLoopData('terms-of-use', array('title','description')))
			@foreach($data as $item)
    		<h2>{!! $item['title'] !!}</h2>
				{!! $item['description'] !!}			@endforeach
    	    	</div>
    </div>
       </div>
</main>
@stop