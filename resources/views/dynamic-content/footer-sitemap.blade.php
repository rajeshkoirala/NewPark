@extends('layout-master')
@section('title')
	Site Map - Olive Safety
@stop
@section('seo_detail')
	<meta name="description" content="A comprehensive sitemap for various links in Olive Safety website.">
	<meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
	<meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
	<meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section('content')
	@php

		$courseRepo = new \App\Repositories\CourseRepository();
        $onlineCourse = $courseRepo->getCourseByCourseType(1);
        $offlineCourse = $courseRepo->getCourseByCourseType(2);
        $onlineCoursefooter = $courseRepo->getCourseByCourseTypeFooter(1);
        $PopularonlineCourse = $courseRepo->getPopularCourse(1);//online courses

        $Categories= $courseRepo->getCategories();



	@endphp
      <main class="om-main-content">
        <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({{URL::asset('public/frontend/dist/images/slider/slider3.png')}})">
                <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li><a href="{{ URL::to('/footer-sitemap') }}">Site map</a></li>
                        </ol>
                        <h2>Site Map</h2>
                    </div>
                </div>
            </div>
        </div>
    <div class="footer-info">
    	<div class="container">
    		<h2>About Safety</h2>
    		<div class="row">
    			<div class="col-md-12">
    				<ul>
    					<li><a href="{{URL::to('about-us')}}">About Us</a></li>
    					<li><a href="{{URL::to('news')}}">News</a></li>
    				</ul>
    			</div>
    		</div>

				<h2>Categories Courses</h2>
    		<div class="row">
				@foreach ($Categories as $CategoryList)
					@php
						$SafetyCourses= $courseRepo->getCourseByCategories($CategoryList->category_name);
					@endphp
    			<div class="col-xs-12 col-sm-6 col-md-3">
    				<h3>{{$CategoryList->category_name}}</h3>
    				<ul>
						@foreach ($SafetyCourses as $CoursesSafety)
    					<li><a href="{{URL::to('course-detail/'.$CoursesSafety->id."/".slugify($CoursesSafety->course_name))}}">{{$CoursesSafety->course_name }}</a></li>
						@endforeach
    				</ul>
    			</div>
				@endforeach

    		</div>

    		<h2>Courses Type</h2>
    		<div class="row">
    			<div class="col-xs-12 col-sm-6 col-md-3">
    				<h3>Oline Courses</h3>
    				<ul>
						@foreach ($onlineCourse as $onCourses)
							<li>
								<a href="{{URL::to('course-detail/'.$onCourses->id."/".slugify($onCourses->course_name))}}">{{$onCourses->course_name }}</a>
							</li>

						@endforeach
    				</ul>
    			</div>

    			<div class="col-xs-12 col-sm-6 col-md-3">
    				<h3>Offline Courses</h3>
    				<ul>
						@foreach ($offlineCourse as $offCourses)
							<li>
								<a href="{{URL::to('course-detail/'.$offCourses->id."/".slugify($offCourses->course_name))}}">{{$offCourses->course_name }}</a>
							</li>

						@endforeach
    				</ul>
    			</div>
    		</div>
				
				<h2>Online Training</h2>
    		<div class="row">
    			<div class="col-md-3">
    				<ul>
    					<li><a href="{{URL::to('otelearning/E-learning')}}">E-learning</a></li>
    					<li><a href="{{URL::to('otelearning/academy')}}">Academy HQ</a></li>
    				</ul>
    			</div>
    		</div>

    		<h2>Safety Management</h2>
    		<div class="row">
    			<div class="col-md-12">
    				<ul>
    					<li><a href="{{URL::to('safetymanagemenet/consultancy')}}">Consultancy</a></li>
    					<li><a href="{{URL::to('safetymanagemenet/audits')}}">Health and Safety Audits</a></li>
    					<li><a href="{{URL::to('safetymanagemenet/psdppscs')}}">PSDP + PSCS</a></li>
    				</ul>
    			</div>
    		</div>

    		<h2>Employment Solutions</h2>
    		<div class="row">
    			<div class="col-md-12">
    				<ul>
    					<li><a href="{{URL::to('upskill')}}">Upskills</a></li>
    				</ul>
    			</div>
    		</div>

    	</div>
    </div>
@stop