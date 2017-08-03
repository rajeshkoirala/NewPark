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
                        $item1=kmGetData('slider','image1');
                        $item2=kmGetData('slider','image2');
                        $item3=kmGetData('slider','image3');


                        $courseRepo = new \App\Repositories\HomeRepository();
                        $newsRepo = new \App\Repositories\NewsRepository();

                        $CourseByRandom = $courseRepo->getCourseByRandom();
                        $i=1;
                    @endphp

                    @php($data = kmGetLoopData('slider', array('slider_image','slider_title','slider_description','slider_button_link')))
                    @foreach($data as $item)
                        <div class="item"><img src="{!!URL::asset('km_lib/uploads/'.$item['slider_image']) !!}"   width="1600" height="626" alt="{!!$item['slider_title'] !!}">
                            <div class="carousel-caption">
                                <h1 data-animation="animated bounceInLeft">{{$item['slider_title']}}</h1>
                                <p>{!!$item['slider_description']!!}</p>
                                <a class="btn btn-theme btn-theme-transparent btn-icon-left banner-send-btn"
                                   href="{!!URL::to($item['slider_button_link'])!!}">Book Now</a>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
        @php

            $CoursePopular = $courseRepo->getCourseOffline();
            $CategoryPopular = $courseRepo->getCategoryPopular();

            $i=1;
            $today = date("Y-m-d", time()+86400);
        @endphp

        <div class="banner-tabs">
            <div id="exTab3" class="container">
                <ul class="nav nav-pills">
                    @foreach ($CoursePopular as $offCourses)
                        @php
                            $popCourseID=$offCourses->id;
                            $popCourseName=$offCourses->course_name;
                        @endphp
                        <li class="active"><a href="#1b" data-toggle="tab"><i class="fa fa-life-ring"
                                                                              aria-hidden="true"></i> {{$offCourses->course_name}}
                            </a>
                        </li>
                    @endforeach
                    @foreach ($CategoryPopular as $popularCategory)
                        @php
                            $popCategoryID=$popularCategory->id;
                        @endphp
                        <li ><a href="#2b" data-toggle="tab"><i class="fa fa-diamond"
                                                                aria-hidden="true"></i> {{$popularCategory->category_name}}
                            </a></li>
                        <li><a href="#3b" data-toggle="tab"><i class="fa fa-globe" aria-hidden="true"></i> Online
                                Courses</a></li>
                    @endforeach
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1b">
                        <div class="row">
                            <form action="{{ url('course-selection/select') }}" method="post" id="safepass">
                                {{ csrf_field() }}
                                <input type="hidden" name="course_id" id="safepass_course_id" value="{{@$popCourseID}}"/>
                                <input type="hidden" name="safepass_course_name" id="safepass_course_name" value="{{@$popCourseName}}"/>
                                <div class="col-md-8">
                                    <div class="form-group course-date-field">
                                        <label for="course-date-1b">Course Date</label>
                                        <div class="form-group">
                                            <div class="input-group date form_date col-md-5" data-date=""
                                                 data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                                                 data-link-format="yyyy-mm-dd">
                                                <input id="course-date-1b" name="selection_date" class="form-control" size="16"
                                                       type="text" value="{{$today}}" readonly > <span
                                                        class="input-group-addon"><i class="fa fa-calendar"
                                                                                     aria-hidden="true"></i></span>
                                            </div>
                                            <input type="hidden" id="dtp_input2" value=""/></div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                     <div class="form-group course-seat-field">
                                         <label for="no-of-seats-1b">No. of Seats</label>
                                         <div class="rail-select">
                                             <div class="select-side"><i class="fa fa-angle-down color"></i></div>

                                             <select class="form-control" id="no-of-seats-1b" name="no-of-seats">
                                                 @php
                                                     $i = 1;
                                                     $no_of_seat = $courseRepo->getSeat($popCourseID,$today);
                                                 @endphp
                                                 @while($i <=$no_of_seat[0]->no_of_seat)
                                                     <option value="{{$i}}">{{ $i }}</option>
                                                     @php($i++)
                                                 @endwhile
                                             </select>
                                         </div>
                                         <!--<input type="text" class="form-control" id="course-name" placeholder="Occupational First Aid">-->
                                     </div>
                                 </div>--}}


                                <div class="col-md-2">
                                    <div class="form-group course-button">
                                        <button type="submit" id="submit1" class="form-control">Book Now</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group course-button">
                                        <button type="button" id="button1" class="form-control" onclick="goSafepassDetail()">View Course</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="2b">
                        <div class="row">
                            <form action="{{ url('course-selection/select') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-4">
                                    <div class="form-group course-field">
                                        <label for="course-idv">Course</label>
                                        <div class="rail-select">
                                            <div class="select-side"><i class="fa fa-angle-down color"></i></div>
                                            @php

                                                $CourseByCategory = $courseRepo->getCourseByCategory('Safety Courses');
                                                $find=0;
                                            @endphp
                                            <select class="form-control" name="course_id" id="course_idv" onchange="goChange()">
                                                @foreach($CourseByCategory as $oncourse)
                                                    @php
                                                        if($find==0){
                                                        $no_of_seat = $courseRepo->getSeat($oncourse->id,$today);
                                                        }
                                                        $find++;
                                                    @endphp
                                                    <option value="{{$oncourse->id}}">{{$oncourse->course_name}}</option>

                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group course-date-field">
                                        <label for="course-date-2b">Course Date</label>
                                        <div class="form-group">
                                            <div class="input-group date form_date col-md-5" data-date=""
                                                 data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                                                 data-link-format="yyyy-mm-dd">
                                                <input class="form-control" name="selection_date" id="course-date-2b" size="16"
                                                       type="text" value="{{$today}}"  readonly> <span
                                                        class="input-group-addon"><i class="fa fa-calendar"
                                                                                     aria-hidden="true"></i></span>
                                            </div>
                                            <input type="hidden" id="course-name" value=""/></div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-2">
                                     <div class="form-group course-seat-field">
                                         <label for="no-of-seats-2b">No. of Seats</label>
                                         <div class="rail-select">
                                             <div class="select-side"><i class="fa fa-angle-down color"></i></div>
                                             <select class="form-control" id="no-of-seats-2b" name="no-of-seats">
                                                 @php($i = 1)
                                                 @while($i <=$no_of_seat[0]->no_of_seat)
                                                     <option value="{{$i}}">{{ $i }}</option>
                                                     @php($i++)
                                                 @endwhile
                                             </select>
                                         </div>
                                     </div>
                                 </div>--}}
                                <div class="col-md-2">
                                    <div class="form-group course-button">
                                        <button type="submit" id="submit2" class="form-control">Book Now</button>


                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group course-button">
                                        <button type="button" id="button2" class="form-control" onclick="goDetail()">View Course</button>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="3b">
                        <div class="row">
                            <form action="{{ url('course-selection/select') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-8">
                                    <div class="form-group course-field">
                                        <label for="course_idm">Course</label>
                                        <div class="rail-select">
                                            <div class="select-side"><i class="fa fa-angle-down color"></i></div>
                                            <select class="form-control tab3-course-name" name="course_id" id="course_idm">
                                                @foreach($courseOnline as $oncourse)
                                                    <option value="{{$oncourse->id}}">{{$oncourse->course_name}}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group course-button">
                                        <button type="submit" class="form-control">Buy Now</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group course-button">
                                        <button type="button" class="form-control" onclick="goOnlineDetail()">View Course </button>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="company-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 first-content">
                        <div class="company-info ">
                            <div class="company-info-heading">
                                <div class="icon-sec"><img
                                            src="{{URL::asset('public/frontend/dist/images/icons/worker-silhouette.png')}}"
                                            width="41" height="61" class="img-responsive"
                                            alt="Work Silhousette Image"></div>
                            </div>
                            <div class="company-info-content">
                                <h4>We are Experts in Health and Safety</h4>
                                <p>Since our birth in 2006 we have become the leading providers of Health and Safety training courses in Ireland.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 second-content">
                        <div class="company-info ">
                            <div class="company-info-heading">
                                <div class="icon-sec"><img
                                            src="{{URL::asset('public/frontend/dist/images/icons/safety-shirt.png')}}"
                                            width="67" height="58" class="img-responsive" alt="Safety Shirt Image">
                                </div>
                            </div>
                            <div class="company-info-content">
                                <h4>We are fully accredited</h4>
                                <p>You can be assured that any of our courses viable of accreditation are
                                    accredited by their respective certified bodies; Solas (Formerly FAS), QQI (formerly FETAC) and RoSPA.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 third-content">
                        <div class="company-info ">
                            <div class="company-info-heading">
                                <div class="icon-sec"><img
                                            src="{{URL::asset('public/frontend/dist/images/icons/protection-gloves.png')}}"
                                            width="52" height="60" class="img-responsive"
                                            alt="Protection Gloves Image"></div>
                            </div>
                            <div class="company-info-content">
                                <h4>We love our customers</h4>
                                <p>At Olive Safety we do our utmost to ensure you have the most pleasant experience whilst engaging in our services.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="safety-details-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="global-heading">
                            <h2>All of Your Safety Needs</h2>
                            <hr>
                            <div class="description">
                                <p>At Olive Safety we have the facilities to provide you with just a single training
                                    course, multiple training courses, or an entire safety management package. So no
                                    matter what your health and safety needs are, please do not hesitate to contact
                                    us and we will be able to provide you with a solution.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $news = $newsRepo->getHomeNewsDisplay();
        @endphp
        <div class="news-sec parallax">
            <div class="container">
                <div id="owl-news-shortcut" class="owl-carousel owl-theme">
                    @foreach($news as $newsDisplay)

                        <div class="row item">
                            <div class="col-md-10">
                                <div class="news-details">
                                    <p class="news-date"><i class="fa fa-clock-o"
                                                            aria-hidden="true"></i> {{date('d M Y',strtotime($newsDisplay->posted_date))}}
                                    </p>
                                    <h3 class="news-heading">{{strip_tags($newsDisplay->news_title)}}</h3>
                                    <p class="news-content">{{substr(strip_tags($newsDisplay->description),0,300)}}
                                        ...</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="news-button">
                                    <a href="{{URL::to('news/'.$newsDisplay->id.'/details')}}" class="btn btn-default read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="course-listing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="global-heading">
                            <h2>List of courses</h2>
                            <hr>
                            <div class="description">
                                <p>Browse through our extensive range of recent courses below to see what suits your
                                    personal interests.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row courses-row" id="courses">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div itemscope itemtype="http://schema.org/Product" class="thumbnail no-border no-padding single-course">
                            <div class="media">
                                <a class="media-link" href="{{URL::to('course-detail/{id}/{course_name_slug}')}}">
                                    {image_loading_section}
                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span> </a>
                            </div>
                            <div class="caption caption-details">
                                <h4 class="caption-title"><a itemprop="url" href="{{URL::to('course-detail/{id}/{course_name_slug}')}}"><span itemprop="name">{course_name}</span></a></h4>
                                <div class="desc">
                                    <p itemprop="description"> {course_short_desc}</p>
                                </div>

                                <div class="buttonandinclude">
                                    <div class="row">
                                        <div class=" col-xs-8 col-sm-8 col-md-8 f-btn-sec">
                                            <div class="buttons">
                                                <a class="btn btn-theme btn-theme-transparent btn-icon-left"
                                                   href="{{URL::to('course-selection/{id}/{course_name_slug}')}}">
                                                    <span>Buy Course</span>
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 f-price-sec">
                                            <div class="rateandprice">
                                                <div class="price">
                                                    <ins itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency">{{kmGetData('payment-setting','price_unit')}}</span><span itemprop="price">{price}</span></ins>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div>
                    <div class="row" id="shorting-cat"></div>
                </div>


            </div>
        </div>
        <div class="facts-sec">
            <section id="about-section" class="about-section parallax">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 about-section-right no-pad">
                            <div class="about-section-text no-pad">
                                <div class="about-main-heading">
                                    <h2>{!! kmGetData('chooseUs','question') !!}</h2>
                                    <p>{!! kmGetData('chooseUs','labal') !!}</p>
                                </div>
                                @php($data = kmGetLoopData('chooseUs', array('percentage','title')))
                                @foreach($data as $item)
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="about-section-content">
                                            <p><span class="timer">{!! $item['percentage'] !!}</span>%</p>
                                            <h3> {!! $item['title'] !!}</h3></div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="tc-padding white-bg">
            <div class="container">
                <!-- Main Heading -->
                <div class="main-heading style-2 add-p osafety-contact-form">
                    <h2>Leave a Message</h2>
                    <p>Please fill out this form and we will get in touch with you shortly.</p>
                    <br>
                    <br></div>
                {!! Form::open(['url' => 'home/send-mail', 'class' => 'row','id'=>'contact-form']) !!}
                <div class="col-md-4 col-xs-12 mui-textfield mui-textfield--float-label">
                    <input name="name" id="name" type="text" class="mui--is-empty mui--is-pristine mui--is-touched">
                    <label class="control-label new-label">Your Name *</label>
                </div>
                <!--<div class="col-sm-4 col-xs-12 r-full-width">
                 <div class="form-group">
                     <input name="name" id="name" type="text">
                     <label class="control-label">Your Name *</label><i class="bar"></i></div>
             </div>-->
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="text" name="email" id="email" class="mui--is-empty mui--is-pristine mui--is-touched">
                    <label class="control-label new-label">Email *</label><i class="bar"></i>
                </div>

                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="text" name="phone" id="phone" >
                    <label class="control-label new-label">Phone *</label><i class="bar"></i>
                </div>
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">

                    <input type="text" name="company_name" id="company_name">
                    <label class="control-label new-label">Company Name </label><i class="bar"></i>
                </div>
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <select name="course_interested" class="form-control" >
                        <option value="" selected>Choose Course</option>
                        @foreach ($allCourse as $allcourse)
                            <option value="{{$allcourse->course_name}}">{{$allcourse->course_name}}</option>
                        @endforeach
                    </select>
                    <label class="control-label new-label new-label-select">Course Interested In </label><i class="bar"></i>
                    {{--<input type="text" name="course_interested" id="course_interested">--}}
                    {{--<label class="control-label">Course Interested In *</label><i class="bar"></i>--}}
                </div>
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">

                    <input type="text" name="heard_from" id="heard_from">
                    <label class="control-label new-label">Heard From </label><i class="bar"></i>
                </div>
                <div class="col-sm-12 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <textarea name="message" id="message"></textarea>
                    <label class="control-label new-label">Message </label><i class="bar"></i>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <p>(*) Mandatory</p>
                    <button type="submit" class="btn blue z-depth-1">Send Message<i class="fa fa-send"></i></button>
                </div>


            {!! Form::close() !!}<!-- Form -->
                <!-- Form -->
            </div>
        </div>
        </div>
    </main>
@stop

@section("script")



    <script>
        $('#courses').ajaxGrid({
            "limit": 6,
            "url": "{{url('home/listAll')}}",
            "columns": [
                {"data": "id"},
                {
                    mRender: function (row) {
                        var a = {};
                        a['image_loading_section'] = '<img itemprop="image" alt="'+row.course_name+'" src="{{ URL::asset('km_lib/uploads/')}}/'+row.image_name+'" height="170" width="360" alt=""/>';

                        if (row.image_name != "")
                            a['image_name'] = row.image_name;
                        else
                            a['image_loading_section'] = '<img itemprop="image" alt="{{ URL::asset('km_lib/uploads/demo.gif')}}" src="{{ URL::asset('km_lib/uploads/demo.gif')}}" height="170" width="360" alt=""/>';

                        a['course_name_slug'] = strSlugGenerate(row.course_name);
                        return a;

                    }
                },

                {"data": "course_name"},
                {
                    mRender: function (row) {
                        var a = {};
                        a['price']=row.price;
                        return a;

                    }
                },

                {
                    mRender: function (row) {
                        var a = {};
                        a['course_short_desc'] = row.course_short_desc.substring(0, 100) + ' .... <a href="{{URL::to('course-detail')}}/' + row.id + '/'+ strSlugGenerate(row.course_name) +'">Read More</a>';
                        return a;
                    }
                }
            ],
            "loadingClass": ".load-container",
            "loadMore": true,

        });
        function filter_course_details() {

            var search_text = $("#searchTxt").val();
            $('#courses').trigger('refreshGrid', {search_text: search_text});

            if ($(window).width() > 992) {
                $('html, body').animate({
                    scrollTop: 1800
                }, 800);
            }

            return false;
        }
    </script>
    <script>

        $(document).ready(function () {

            $("#owl-news-shortcut").owlCarousel({

                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true,
                autoPlay: true,
                navigationText: ["", ""],
                stopOnHover: true

            });

        });
        $("#contact-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true
                }
            }
        });
        function goDetail() {
            var e = document.getElementById("course_idv");
            var courseID = e.options[e.selectedIndex].value;
            var courseName = e.options[e.selectedIndex].text;
            window.location.href = 'course-detail/' + courseID + '/' + strSlugGenerate(courseName);

        }

        function goOnlineDetail() {
            var e = document.getElementById("course_idm");
            var courseID = e.options[e.selectedIndex].value;
            var courseName = e.options[e.selectedIndex].text;
            window.location.href = 'course-detail/' + courseID + '/' + strSlugGenerate(courseName);

        }
        function goSafepassDetail() {
            var courseName=document.forms["safepass"]["safepass_course_name"].value
            var courseID=document.forms["safepass"]["safepass_course_id"].value

            window.location.href = 'course-detail/' + courseID + '/' + strSlugGenerate(courseName);

        }

        /*  function goChange() {
         var e = document.getElementById("course_idv");
         var courseID = e.options[e.selectedIndex].value;
         var course_date = $("#course-date-2b").val();
         if (courseID) {
         $.ajax({
         url: "home/noOfseat/" + courseID +"/"+ course_date,
         type: "GET",
         dataType: "json",
         success: function (data) {
         var no_of_seat = 0;
         if(data.no_of_seat != null){
         no_of_seat = data.no_of_seat;
         }
         $('select[id="no-of-seats-2b"]').empty();
         for(var i=1;i<=no_of_seat;i++)
         {

         $('select[id="no-of-seats-2b"]').append('<option value="' + i + '">' + i + '</option>');
         }
         if(no_of_seat==0){
         $('select[id="no-of-seats-2b"]').append('<option value="0">0</option>');
         }

         var no_of_seats_2b = $("#no-of-seats-2b").val();

         if(no_of_seats_2b==0){
         $("#submit2").prop('disabled', true);
         $("#button2").prop('disabled', true);
         }else{
         $("#submit2").prop('disabled', false);
         $("#button2").prop('disabled', false);
         }
         }
         });
         } else {
         $('select[id="no-of-seats-2b"]').empty();
         }



         }
         */
        /* function goChange_safepass() {
         var courseID = $("#safepass_course_id").val();
         var course_date = $("#course-date-1b").val();
         if (courseID) {
         $.ajax({
         url: "home/noOfseat/" + courseID +"/"+ course_date,
         type: "GET",
         dataType: "json",
         success: function (data) {
         var no_of_seat = 0;
         if(data.no_of_seat != null){
         no_of_seat = data.no_of_seat;
         }
         $('select[id="no-of-seats-1b"]').empty();
         for(var i=1;i<=no_of_seat;i++)
         {

         $('select[id="no-of-seats-1b"]').append('<option value="' + i + '">' + i + '</option>');
         }
         if(no_of_seat==0){
         $('select[id="no-of-seats-1b"]').append('<option value="0">0</option>');
         }
         var no_of_seats_1b = $("#no-of-seats-1b").val();

         if(no_of_seats_1b==0){
         $("#submit1").prop('disabled', true);
         $("#button1").prop('disabled', true);
         }else{
         $("#submit1").prop('disabled', false);
         $("#button1").prop('disabled', false);
         }
         }
         });
         } else {
         $('select[id="no-of-seats-1b"]').empty();
         }
         }
         */
    </script>
@stop