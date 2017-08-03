@extends('layout-master')
@section('title'){!!kmGetData('policy','meta_title')  !!} @stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('policy','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('policy','meta_description')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section('content')
   <main class="om-main-content">
        <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('policy','background_image') )!!})">

            <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li><a href="{{ URL::to('/aboutus') }}">Policy</a></li>
                        </ol>
                        <h2>Policy</h2> </div>
                </div>
            </div>
        </div>
	<div class="footer-info">
		<div class="container">
			@php($data = kmGetLoopData('policy', array('title','description')))
			@foreach($data as $item)
				<h2>{!! $item['title'] !!}</h2>
				{!! $item['description'] !!}			@endforeach
		</div>
	</div>
       </div>
</main>
@stop