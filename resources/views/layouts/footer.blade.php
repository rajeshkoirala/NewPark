<footer class="footer">
    <!-- Footer Columns -->
    <div class="footer-inner">
        <div class="footer-column">
            <div class="container">
                <div class="row">
                    <!-- Colunm Widget -->
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="f-column-widget">
                            <h4>Contact New Park Centre</h4> <i class="fa fa-phone" aria-hidden="true"></i>
                            <div class="address-widget">
                                <p>{!! kmGetData('contact-details','address') !!}</p>
                                <ul class="address-list">
                                    <li><i class="fa fa-phone"></i>{!! kmGetData('contact-details','phone_number') !!}
                                    </li>
                                    {{--<li><i class="fa fa-fax"></i>{!! kmGetData('contact-details','fax_number') !!}</li>--}}
                                    <li>
                                        <i class="fa fa-envelope"></i>{!! kmGetData('contact-details','contact_email') !!}
                                    </li>
                                </ul>
                                <ul class="social-icons">
                                    <li>
                                        <a class="fa fa-twitter"
                                           href="{!! kmGetData('contact-details','twitter_link') !!}"></a>
                                    </li>
                                    <li>
                                        <a class="fa fa-facebook"
                                           href="{!! kmGetData('contact-details','facebook_link') !!}"></a>
                                    </li>
                                    <li>
                                        <a class="fa fa-instagram"
                                           href="{!! kmGetData('contact-details','instagram_link') !!}"></a>
                                    </li>
                                    <li>
                                        <a class="fa fa-google-plus"
                                           href="{!! kmGetData('contact-details','google_plus_link') !!}"></a>
                                    </li>
                                    <li>
                                        <a class="fa fa-dribbble"
                                           href="{!! kmGetData('contact-details','dribble_link') !!}"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @php

                    // $courseRepo = new \App\Repositories\CourseRepository();
                     //$onlineCourse = $courseRepo->getCourseByCourseType(1);

                    // $offlineCourse = $courseRepo->getCourseByCourseType(2);
                    // $onlineCoursefooter = $courseRepo->getCourseByCourseTypeFooter(1);
                    //$PopularonlineCourse = $courseRepo->getPopularCourse();//online courses

                    // $Categories= $courseRepo->getCategories();



                @endphp
                {{-- <div class="col-lg-3 col-md-3 col-sm-6">
                     <div class="f-column-widget">
                         <h4>Courses</h4> <i class="fa fa-book" aria-hidden="true"></i>
                         <ul class="courses-list-link">
                             @foreach ($onlineCoursefooter as $onCourses)
                                 <li>
                                     <a href="{{URL::to('course-detail/'.$onCourses->id.'/'.slugify($onCourses->course_name))}}">{{$onCourses->course_name }}</a>
                                 </li>

                             @endforeach
                         </ul>
                     </div>
                 </div>--}}
                <!-- Colunm Widget -->
                    <!-- Colunm Widget -->
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="f-column-widget">
                            <h4>Newsletter</h4> <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            <div class="newslatter">
                                <p>Enter your email and we'll send you more information of courses and scholarship.</p>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="subscriber-email"
                                           placeholder="Your Email..." required></div>
                                <button class="btn blue sm newsletter-btn" onclick="NewsletterSubscriber()">Subscribe
                                </button>
                                <div class="subscriber-message" style="color: #ffffff;margin-top:2px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Colunm Widget -->
                    <!-- Colunm Widget -->
                {{-- <div class="col-lg-3 col-md-3 col-sm-6">
                     <div class="f-column-widget">
                         <h4>Popular Courses</h4> <i class="fa fa-trophy" aria-hidden="true"></i>
                         <ul class="courses-list-link">
                             @foreach ($PopularonlineCourse as $CoursesSafety)
                                 <li>
                                     <a href="{{URL::to('course-detail/'.$CoursesSafety->id.'/'.slugify($CoursesSafety->course_name))}}">{{$CoursesSafety->course_name }}</a>
                                 </li>

                             @endforeach
                         </ul>
                         --}}{{--</div>--}}{{--
                     </div>
                 </div>--}}
                <!-- Colunm Widget -->
                </div>
            </div>

        </div>
        <!-- Footer Columns -->
        <!-- Sub Footer -->
        <div class="sub-footer">
            <div class="container">
                <p>&copy; Copyright 2017. Powered by <a href="{{url('/')}}">Olive Media</a>.</p>
                <ul class="sub-footer-nav">
                    <li><a href="{{url('/terms-of-use')}}">Terms of Use</a></li>
                    <li><a href="{{url('/privacy-and-security')}}">Privacy and Security</a></li>
                    <li><a href="{{url('/policy')}}">Policy</a></li>
                    <li><a href="{{url('/frequently-asked-questions')}}">FAQ<span class="lowercase">s</span></a></li>
                    <li><a href="{{url('/footer-sitemap')}}">Sitemap</a></li>
                </ul>
            </div>
        </div>
        <!-- Sub Footer -->
    </div>
</footer>
<nav class="om-nav">
    <ul id="om-primary-nav" class="om-primary-nav is-fixed">
        <li><a href="{{url('/')}}">Home</a></li>
        <li class="has-children mini-dropdown"><a href="#">Types of Care</a>
            <ul class="om-secondary-nav is-hidden">
                <li class="go-back"><a href="#">Menu</a></li>
                <li><a href="{{url('/about-us')}}">Long Term Care</a></li>
                <li><a href="{{url('/news')}}">Dementia Care</a></li>
                <li><a href="{{url('/news')}}">Short Term Care</a></li>
            </ul>
        </li>

        <li class="has-children mini-dropdown"><a href="#">Therapies</a>
            <ul class="om-secondary-nav is-hidden">
                <li class="go-back"><a href="#">Menu</a></li>
                <li><a href="{{url('/physiothyrapy')}}">Physiothyrapy</a></li>
                <li><a href="{{url('/activities')}}">Activities</a></li>
            </ul>
        </li>

        <li class="has-children mini-dropdown"><a href="#">Gallery</a>
            <ul class="om-secondary-nav is-hidden">
                <li class="go-back"><a href="#">Menu</a></li>
                <li><a href="{{url('/Bedrooms')}}">Bedrooms</a></li>
                <li><a href="{{url('/Communal Area')}}">Communal Area</a></li>
            </ul>
        </li>




        @if(@Auth::user()->username=="")
            <li class="hide-sign-inup"><a class="sign-in-btn" href="#" data-toggle="modal" data-target="#at-login"><i
                            class="fa fa-sign-in"
                            aria-hidden="true"></i>
                    Sign in</a></li>
            <li class="hide-sign-inup"><a class="sign-up-btn" href="#" data-toggle="modal"
                                          data-target="#at-signup-filling"><i
                            class="fa fa-user-circle-o" aria-hidden="true"></i>
                    Sign up</a></li>
            <li class="hide-sign-inup"><a class="om-cart-trigger" href="{{ URL::to('course-checkout') }}"><i
                            class="fa fa-shopping-cart fa-2" aria-hidden="true"></i>
                    Cart ({{ count(\Gloudemans\Shoppingcart\Facades\Cart::content()) }})</a></li>
        @else
        <!--<li class="hide-sign-inup"><a class="sign-in-btn" href="#" data-toggle="modal" data-target="#at-login"><i
                            class="fa fa-sign-in" aria-hidden="true"></i></a>
                    <a href="{{url('/client-info')}}">{{ @Auth::user()->username}}</a></li>-->
            <li class="os-user-name hide-sign-inup">
                <a href="{{url('/client-info')}}"><i class="fa fa-user-o"
                                                     aria-hidden="true"></i> {{ @Auth::user()->username}} </a>
            </li>


            <li class="hide-sign-inup">
                <a class="sign-up-btn" href="{{url('login/logout')}}" data-toggle="modal"
                ><i class="fa fa-sign-out"
                    aria-hidden="true"></i>
                    Sign out</a></li>
            <li class="hide-sign-inup show-cp-1199">
                <div>
                    <a class="change-password-btn" href="#" data-toggle="modal"
                       data-dismiss="modal"
                       data-target="#at-reset-pswd">Change Password </a>
                </div>
            </li>
        @endif

    </ul>


    <!-- primary-nav -->
</nav>
<div id="om-search" class="om-search">


    <input style="margin: 0" class="search-box" id="search" type="text" name="searchTxt" onkeyup="SearchCourse(this)"
           autocomplete="off"
           placeholder="Search your course..."/>

    <div class="quick-search-wrapper" style="display:block;">
        <div class="quick-search-autocomplete" id="common-course-search-list">

            <div class="inner-wrapper">
                <div class="course-details-thumbnail"><a
                            href="{{URL::to('course-detail')}}/{course_id}/{course_name_slug}">
                        {loading_image}</a>
                </div>
                <div class="course-details-content">
                    <h2 class="course-details-heading"><a
                                href="{{URL::to('course-detail')}}/{course_id}/{course_name_slug}">{course_name}</a>
                    </h2>
                </div>

            </div>

        </div>
    </div>
</div>

<a href="#" class="scrollToTop"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<script src="{{URL::asset('public/frontend/dist/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/plugin/swipe-box/js/jquery-2.1.0.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/modernizr.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/plugin/swipe-box/js/jquery.swipebox.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('public/frontend/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/custom.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/countries.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/jquery.mobile.custom.min.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/jquery.inview.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/jquery.matchHeight.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/main.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/datepicker.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/i18n/datepicker.en.js')}}"></script>
{{--<script src="{{URL::asset('public/frontend/dist/js/timeline.js')}}"></script>--}}
<script src="{{URL::asset('public/js/script.default.js')}}"></script>
<script src="{{URL::asset('public/date-picky/js/date-picky.js')}}"></script>
<script src="{{URL::asset('public/js/ajax-grid-2.1.js')}}"></script>
<script src="{{URL::asset('public/toaster/js/jquery.toast.js')}}"></script>
<script src="{{url('public/js/plugins/validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/dist/js/mui.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/frontend/dist/js/jquery.slimscroll.min.js')}}"></script>
@yield("script")

<script>
    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }

    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

    $(document).ready(function () {

        @if(Session::has('success_message'))

        $.toast({
            heading: 'Success',
            icon: 'success',
            text: '{{ Session::get('success_message') }}',
            position: 'bottom-right',
            stack: false,
            loader: false
        });

        @endif

        @if(Session::has('error_message'))

        $.toast({
            heading: 'Error',
            icon: 'error',
            text: '{{ Session::get('error_message') }}',
            position: 'bottom-right',
            stack: false,
            loader: false
        });

        @endif

        /* Placeholder Typewriter */
        var placeholderText = [
            "Search Courses..."
            , "Offline courses?"
            , "Online courses?"
            , "Recent courses?"
        ];
        $('#search').placeholderTypewriter({
            text: placeholderText
        });
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })

    });

    $(function () {
        $('.tab-wrapper .filter-button').on('click', function () {
            $(this).parent().find('button.active').removeClass('active');
            $(this).addClass('active');
        });
    });

    function NewsletterSubscriber() {

        var $email = $('#subscriber-email');

        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

        if ($email.val() == '' || !re.test($email.val())) {
            $('.subscriber-message').html('<span style="color: #ff5b5b">Please enter a valid email address</span>');
            return false;
        }

        $.ajax({
            'url': '{{ url('newsletter-subscriber') }}',
            'type': 'get',
            'data': {'email': $email.val()},
            'success': function (response) {
                $('.subscriber-message').text(response);
            }
        });
    }

    $(".os-global-form").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true

            }
        }
    });


    $("#contact-form1").validate({
        rules: {
            username: {
                required: true,
                remote: {
                    url: '{{ URL::to('login/check-user') }}',
                    type: 'get',
                    data: {
                        username: function () {
                            return $('#username').val()
                        }
                    },
                }
            },
            password: {
                required: true

            },
            full_name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: '{{ URL::to('login/check-email') }}',
                    type: 'get',
                    data: {
                        email: function () {
                            return $('#uemail').val()
                        }
                    }
                }
            }
        },
        messages: {
            email: {
                remote: "Thie email is already taken"
            },
            username: {
                remote: "This username is already taken"
            }
        }
    });

    $('div.cart li.cart-li-sec').hover(
        function () {
            $(".cart_block").addClass('active');

        }, function () {
            $(".cart_block").removeClass('active');
        }
    );
    /*$("li.os-user-name").hover(
     function () {
     $(".client_info").addClass('active');

     }, function () {
     $(".client_info").removeClass('active');
     }
     );*/

    $(document).ready(function () {
        var navpos = $('#om-primary-nav').offset();
        $(window).bind('scroll', function () {
            if ($(window).width() > 1024) {
                if ($(window).scrollTop() > navpos.top) {
                    $('div.main-nav').addClass('make-om-fixed');
                    $('div#om-search').addClass('move-up-fixed');
                }
                else {
                    $('div.main-nav').removeClass('make-om-fixed');
                    $('div#om-search').removeClass('move-up-fixed');
                }
            }
        });
        //Check to see if the window is top if not then display button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            }
            else {
                $('.scrollToTop').fadeOut();
            }
        });
        //Click event to scroll to top
        $('.scrollToTop').click(function () {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    $('#common-course-search-list').ajaxGrid({
        "init": true,
        "limit": 10,
        "url": "{{ url('search/courses') }}",
        "columns": [
            {
                "data": "course_id"
            },
            {
                "data": "course_name"
            },
            {
                mRender: function (row) {
                    var a = {};

                    a['loading_image'] = '<img src="{{URL::asset('km_lib/uploads/demo.gif')}}" alt="' + row.course_name + '">';
                    if (row.image_name != "")
                        a['loading_image'] = '<img src="{{URL::asset('km_lib/uploads')}}/' + row.image_name + '" alt="Fire and Safety Awareness">';

                    a['course_name_slug'] = strSlugGenerate(row.course_name);


                    return a;

                }
            },

        ],
        "previous": "&larr; Newer",
        "next": "Older &rarr;",
        "loadMore": true,
        "scrollLoad": true,
        "loadingClass": ".loader-wrapper"
    });

    function SearchCourse(thisObj) {
        var searchText = $(thisObj).val();
        $('#common-course-search-list').trigger('refreshGrid', {search_text: searchText});

    }

    function strSlugGenerate(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }
    $("#semail").on('focusout', function () {
        $.ajax({
            url: '{{ URL::to('login/check-email') }}',
            type: 'get',
            data: {email: $('#semail').val()},
            success: function (output) {

                $('.uni-message_semail').html(output);


            }
        });
    });

    $("#subtn").on('click', function () {

        var error_email_msg = $('.uni-message_semail').html();

        if (error_email_msg == "" || error_email_msg == null)
            return false;
        else
            return true;
    });

    /** Modal animation fix **/
    var fixedCls = 'body';
    var oldSSB = $.fn.modal.Constructor.prototype.setScrollbar;
    $.fn.modal.Constructor.prototype.setScrollbar = function () {
        oldSSB.apply(this);
        if (this.bodyIsOverflowing && this.scrollbarWidth)
            $(fixedCls).css('padding-right', this.scrollbarWidth);
    }

    var oldRSB = $.fn.modal.Constructor.prototype.resetScrollbar;
    $.fn.modal.Constructor.prototype.resetScrollbar = function () {
        oldRSB.apply(this);
        $(fixedCls).css('padding-right', '');
    }


    $("#change-password").validate({
        rules: {
            password2: {
                required: true
            },
            confirm_password2: {
                equalTo: "#password2"
            }
        }
    });
    $("#reset-form").validate({
        rules: {
            semail: {
                required: true,
            }
        }
    });


    function change_pw(thisObj) {
        if ($(thisObj).is(':checked')) {
            $(".password-field").show();
        } else {
            $(".password-field").hide();
        }
    }

    function SubmitThisForm(thisObj) {
        $(thisObj).submit();
    }

    $(document).ready(function () {
        if ($(window).width() > 1199) {
            $('.om-primary-nav .custom-scroll').slimScroll({
                color: '#1b2d5a'
            });
        }
    });

    {!!kmGetData('site-config','google_analytic_script')  !!}

    if ($(window).width() > 1199) {
        if ($('.cart.view_more_768 ul.bdr').children('li').length === 1) {
            $('.cart.view_more_768 ul.bdr').children('li').css({
                padding: '19px 0 20px', border: '0'
            });
        }
    }
</script>