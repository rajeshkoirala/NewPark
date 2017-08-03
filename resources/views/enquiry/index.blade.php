@extends("layout-master")
@section('title')
    Enquiry
@stop
@section("content")
<main class="om-main-content">
    <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({{URL::asset('public/frontend/dist/images/slider/slider3.png')}})"> 
                <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/course-enquiry')}}">Enquiry</a></li>
                        </ol>
                        <h2>Enquiry</h2>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="map-wrapper">--}}
            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9533.195450988544!2d-6.364209!3d53.320002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670cafe08c1afd%3A0x7c5116749ac4a38c!2sRed+Cow+Business+Park%2C+Robinhood+Rd%2C+Fox-And-Geese%2C+Dublin+22%2C+Ireland!5e0!3m2!1sen!2sus!4v1490163037261" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
        {{--</div>--}}

        <div class="tc-padding white-bg">
            <div class="container">
                <!-- Main Heading -->
                <div class="main-heading style-2 add-p osafety-contact-form">
                    <h2>Leave a Message</h2>
                    <br>
                    <br>
                </div>
                <!-- Main Heading -->
                <!-- Form -->
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
                        <label class="control-label new-label">Course Interested In *</label><i class="bar"></i>
                </div>
                <div class="col-sm-4 col-xs-12 r-full-width mui-textfield mui-textfield--float-label">
                    <input type="text" name="heard_from">
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
@stop @section("script")
<script type="text/javascript">
    $('.map-wrapper').click(function () {
        $('.map-wrapper iframe').css("pointer-events", "auto");
    });

    $( ".map-wrapper" ).mouseleave(function() {
        $('.map-wrapper iframe').css("pointer-events", "none");
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
               message: {
                   required: true
               }
           }
       });
</script>
@stop