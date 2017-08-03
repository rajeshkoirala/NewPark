@extends('layout-master')
@section('title'){!!kmGetData('privacy-and-security','meta_title')  !!} @stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('privacy-and-security','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('privacy-and-security','meta_description')  !!}">
    <meta name="keywords" content="{!!kmGetData('privacy-and-security','meta_keyword')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop


@section('content')
<main class="om-main-content">
        <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('privacy-and-security','background_image') )!!})">

            <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li><a href="{{ URL::to('/aboutus') }}">Privacy and security</a></li>
                        </ol>
                        <h2>Privacy and Security</h2>
                    </div>
                </div>
            </div>
        </div>
	<div class="footer-info">
		<div class="container">
			@php($data = kmGetLoopData('privacy-and-security', array('title','description')))
			@foreach($data as $item)
				<h2>{!! $item['title'] !!}</h2>
				{!! $item['description'] !!}
            @endforeach
		</div>
	</div>
    </div>
</main>
@stop