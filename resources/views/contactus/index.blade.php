@extends("layout-master")
@section('title'){!!kmGetData('contact-details','meta_title')  !!}@stop
@section('seo_detail')
    <meta name="description" content="{!!kmGetData('contact-details','meta_description')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section("content")
    <main class="om-main-content">
        <div class="main courses-main">
            <div class="slider">
                <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('contact-details','background_image') )!!})">
                    <div class="container">
                        <div class="inner-wrapper">
                            <ol class="breadcrumb">
                                <li><a href="{{ URL::to('/') }}">Home</a></li>
                                <li><a href="{{ URL::to('/contact-us') }}">Contact Us</a></li>

                        </ol>
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="map-wrapper">
            <section id="osafety-google-map">
                <div id="google-container"></div>
                <div id="osafety-zoom-in"></div>
                <div id="osafety-zoom-out"></div>
                <address>{!!kmGetData('contact-details','address')  !!}</address>
            </section>
         </div>

        <div class="tc-padding white-bg">
            <div class="container">
                <!-- Main Heading -->
                <div class="main-heading style-2 add-p osafety-contact-form">
                    <h2>Leave a Message</h2>
                    <br>
                    <br>
                </div>
                <!-- Main Heading -->

                {!! Form::open(['url' => 'home/send-mail', 'class' => 'row','id'=>'contact-form']) !!}
                <div class="col-md-4 col-xs-12 mui-textfield mui-textfield--float-label">
                    <input name="name" id="name" type="text" class="mui--is-empty mui--is-pristine mui--is-touched">
                    <label class="new-label">Your Name *</label>
                </div>

                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="text" name="email" id="email" class="mui--is-empty mui--is-pristine mui--is-touched">
                    <label class="new-label">Email *</label><i class="bar"></i>
                </div>

                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="text" name="phone" id="phone">
                    <label class="control-label new-label">Phone *</label><i class="bar"></i>
                </div>
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="text" name="company_name" id="company_name">
                    <label class="control-label new-label">Company Name </label><i class="bar"></i>
                </div>
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <select name="course_interested" name="course_interested" class="form-control">
                        <option value="" selected>Choose Course</option>
                        @foreach ($allCourse as $allcourse)
                            <option value="{{$allcourse->course_name}}">{{$allcourse->course_name}}</option>
                        @endforeach
                    </select>
                    <label class="control-label new-label new-label-select">Course Interested In </label><i
                            class="bar"></i>
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
            </div>
        </div>

    </div>
</main>
@stop
@section("script")
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9Pmwi7uN8AT3tHgDZdm3GHBD6TYHD9bw"></script>
    <script>
        latitude=parseInt("{!!kmGetData('contact-details','latitude')  !!}");
        longitude=parseInt("{!!kmGetData('contact-details','longitude')  !!}");
        map_zoom=parseInt("{!!kmGetData('contact-details','map_zoom')  !!}");


    </script>
    <script src="{{URL::asset('public/frontend/dist/js/custom-map.js')}}"></script>
    <script type="text/javascript">
        $('.map-wrapper').click(function () {
            $('.map-wrapper #osafety-google-map').css("pointer-events", "auto");
        });

        $(".map-wrapper").mouseleave(function () {
            $('.map-wrapper #osafety-google-map').css("pointer-events", "none");
        });


    </script>
    <script>
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

    </script>
@stop