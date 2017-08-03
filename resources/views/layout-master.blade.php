<!DOCTYPE html>
<html lang="en">

@include('layouts.header')


<body class="">
<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 top-address-sec">
                    <div class="top-header-address">
                        <p>{!! kmGetData('contact-details','address') !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 top-socio-sec">
                    <div class="social-links">
                        <ul>
                            <li><a class="twitter-icon" href="{!! kmGetData('contact-details','twitter_link') !!}"
                                   target="_blank"><i
                                            class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a class="instagram-icon" href="{!! kmGetData('contact-details','instagram_link') !!}"
                                   target="_blank"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a class="facebook-icon" href="{!! kmGetData('contact-details','facebook_link') !!}"
                                   target="_blank"><i
                                            class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a class="googleplus-icon"
                                   href="{!! kmGetData('contact-details','google_plus_link') !!}" target="_blank"><i
                                            class="fa fa-google" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mid-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-4 logo_sec">
                    <div class="logo"><a href="{{url('/')}}"><img
                                    src="{{URL::asset('km_lib/uploads/'.kmGetData('site-config','image'))}}"
                                    alt="" class="img-responsive"></a></div>

                </div>
                <div class="col-md-6 col-sm-8 col-xs-12 mid-header-contacts pull-right">
                    <div class="mid-header-left-section">
                        <div class="contact-details">
                            <div class="contact contact-phone">
                                <p class="contact-phone-heading"><i class="fa fa-phone" aria-hidden="true"></i> Call Us
                                </p>
                                <p class="contact-phone-content">{!! kmGetData('contact-details','phone_number') !!}</p>
                            </div>
                            <div class="contact contact-mail">
                                <p class="contact-mail-heading"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mail
                                    Us
                                </p>
                                <p class="contact-phone-content"><a
                                            href="mailto:{!! kmGetData('contact-details','contact_email') !!}"
                                            target="_top">
                                        {!! kmGetData('contact-details','contact_email') !!}</a></p>
                            </div>
                        </div>
                        <div class="signup-login">
                            <div class="cart view_more_768">
                             <ul class="bdr">
                              @if(@Auth::user()->username==!"")
                                 <li>
                                   <a class="change-password-btn" href="#" data-toggle="modal"
                                               data-dismiss="modal"
                                               data-target="#at-reset-pswd">Change Password </a>
                                </li>
                                @endif
                                 <li class="cart-li-sec">
                                    <a href="javascript:void(0)" class="cartblock">
                                        <i class="fa fa-shopping-cart fa-2" aria-hidden="true"></i>
                                        Cart({{ count(\Gloudemans\Shoppingcart\Facades\Cart::content()) }})


                                    </a>
                                    <div class="cart_block block exclusive">
                                        <div class="block_content">
                                        <!-- block list of products -->
                                        <div class="cart_block_list">
                                            @php($myCart = \Gloudemans\Shoppingcart\Facades\Cart::content() )
                                            @php($totalPrice = 0)
                                            @if(count($myCart) > 0)
                                                @foreach($myCart as $ct)
                                                    <dl class="products">
                                                        <dt data-id="cart_block_product_1_1_0" class="first_item">
                                                            <a class="cart-images" href="#" title="Product">
                                                                <img src="{{URL::asset('km_lib/uploads/'.$ct->options['image'])}}"
                                                                     alt="{{ $ct->name }}">
                                                            </a>
                                                        <div class="cart-info">
                                                            <div class="product-name">
                                                            <span class="quantity-formated">({{ kmGetData('payment-setting', 'price_unit') }}{{$ct->price}}
                                                                x {{ $ct->options['no_seats'] }})</span>
                                                                <a class="cart_block_product_name" href="#"
                                                                   title="Course Image">{{ $ct->name }}</a>
                                                            </div>
                                                            <span class="price">{{ kmGetData('payment-setting', 'price_unit') }}{{ $ct->price*$ct->options['no_seats'] }}
                                                                ({{$ct->options['course_type']}})<div
                                                                        class="hookDisplayProductPriceBlock-price"></div></span>
                                                        </div>
                                                        <span class="remove_link">
                                                            <a class="ajax_cart_block_remove_link"
                                                               href="{{ URL::to('course-checkout/remove-item/'.$ct->rowId) }}"
                                                               rel="nofollow"
                                                               title="remove this product from my cart">
                                                                <i class="fa fa-times" aria-hidden="true"></i></a>
                                                        </span>
                                                        </dt>
                                                        <dd data-id="cart_block_combination_of_1_1_0"
                                                            class="first_item"></dd>
                                                    </dl>
                                                    @php($totalPrice += $ct->price*$ct->options['no_seats'])
                                                @endforeach
                                            @else
                                                <p class="cart_block_no_products unvisible">No products</p>
                                            @endif

                                            <div class="cart-prices">
                                                {{--<div class="cart-prices-line first-line">
                                                    <span class="price cart_block_shipping_cost ajax_cart_shipping_cost">$15.52</span>
                                                    <span>Sub-total</span>
                                                </div>--}}
                                                <div class="cart-prices-line last-line">
                                                    <span class="price cart_block_total ajax_block_cart_total">{{ kmGetData('payment-setting', 'price_unit') }}{{ $totalPrice }}</span>
                                                    <span>Total</span>
                                                </div>
                                            </div>
                                            <p class="cart-buttons">
                                                <a id="button_order_cart"
                                                   class="btn btn-default button button-small button_order_cart"
                                                   href="{{ URL::to('/') }}" title="Check out" rel="nofollow">
                                                    <span>Continue Shopping</span>
                                                </a> <a id="button_order_cart01"
                                                        class="btn btn-default button button-small button_order_cart"
                                                        href="{{ URL::to('course-checkout') }}" title="Check out"
                                                        rel="nofollow">
                                                    <span>Check out</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    </div>
                                </li>
                             </ul>
                                
                            </div>
                            <ul class="bdr">

                                @if(@Auth::user()->username=="")
                                    <li><a class="sign-in-btn" href="#" data-toggle="modal" data-target="#at-login"><i
                                                    class="fa fa-sign-in"
                                                    aria-hidden="true"></i>
                                            Sign in</a></li>
                                    <li><a class="sign-up-btn" href="#" data-toggle="modal"
                                           data-target="#at-signup-filling"><i
                                                    class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            Sign up</a></li>
                                @else
                                    <li class="os-user-name"><a href="{{url('/client-info')}}"><i class="fa fa-user-o"
                                                                                                  aria-hidden="true"></i> {{ @Auth::user()->username}}
                                        </a>
                                        <!--<div class="client_info block exclusive">
                                            <a class="change-password-btn" href="#" data-toggle="modal"
                                               data-dismiss="modal"
                                               data-target="#at-reset-pswd">Change Password </a>
                                        </div>-->
                                    </li>
                                    <li><a href="{{url('login/logout')}}"><i class="fa fa-sign-out"
                                                                             aria-hidden="true"></i>
                                            Sign out</a></li>
                                @endif
                            </ul>
                            <div class="cart view_less_768">
                                <a href="javascript:void(0)">
                                    <i class="fa fa-shopping-cart fa-2" aria-hidden="true"></i>
                                    Cart({{ count(\Gloudemans\Shoppingcart\Facades\Cart::content()) }})
                                </a>
                                <div class="cart_block block exclusive">
                                    <div class="block_content">
                                        <!-- block list of products -->
                                        <div class="cart_block_list">
                                            @php($myCart = \Gloudemans\Shoppingcart\Facades\Cart::content() )
                                            @php($totalPrice = 0)
                                            @if(count($myCart) > 0)
                                                @foreach($myCart as $ct)
                                                    <dl class="products">
                                                        <dt data-id="cart_block_product_1_1_0" class="first_item">
                                                            <a class="cart-images" href="#" title="Product">
                                                                <img src="{{URL::asset('km_lib/uploads/'.$ct->options['image'])}}"
                                                                     alt="{{ $ct->name }}">
                                                            </a>
                                                        <div class="cart-info">
                                                            <div class="product-name">
                                                            <span class="quantity-formated">({{ kmGetData('payment-setting', 'price_unit') }}{{$ct->price}}
                                                                x {{ $ct->options['no_seats'] }})</span>
                                                                <a class="cart_block_product_name" href="#"
                                                                   title="Course Image">{{ $ct->name }}</a>
                                                            </div>
                                                            <span class="price">{{ kmGetData('payment-setting', 'price_unit') }}{{ $ct->price*$ct->options['no_seats'] }}
                                                                ({{$ct->options['course_type']}})<div
                                                                        class="hookDisplayProductPriceBlock-price"></div></span>
                                                        </div>
                                                        <span class="remove_link">
                                                            <a class="ajax_cart_block_remove_link"
                                                               href="{{ URL::to('course-checkout/remove-item/'.$ct->rowId) }}"
                                                               rel="nofollow"
                                                               title="remove this product from my cart">
                                                                <i class="fa fa-times" aria-hidden="true"></i></a>
                                                        </span>
                                                        </dt>
                                                        <dd data-id="cart_block_combination_of_1_1_0"
                                                            class="first_item"></dd>
                                                    </dl>
                                                    @php($totalPrice += $ct->price*$ct->options['no_seats'])
                                                @endforeach
                                            @else
                                                <p class="cart_block_no_products unvisible">No products</p>
                                            @endif

                                            <div class="cart-prices">
                                                {{--<div class="cart-prices-line first-line">
                                                    <span class="price cart_block_shipping_cost ajax_cart_shipping_cost">$15.52</span>
                                                    <span>Sub-total</span>
                                                </div>--}}
                                                <div class="cart-prices-line last-line">
                                                    <span class="price cart_block_total ajax_block_cart_total">{{ kmGetData('payment-setting', 'price_unit') }}{{ $totalPrice }}</span>
                                                    <span>Total</span>
                                                </div>
                                            </div>
                                            <p class="cart-buttons">
                                                <a id="button_order_cart02"
                                                   class="btn btn-default button button-small button_order_cart"
                                                   href="{{ URL::to('/') }}" title="Check out" rel="nofollow">
                                                    <span>Continue Shopping</span>
                                                </a> <a id="button_order_cart03"
                                                        class="btn btn-default button button-small button_order_cart"
                                                        href="{{ URL::to('course-checkout') }}" title="Check out"
                                                        rel="nofollow">
                                                    <span>Check out</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container">
            <ul class="om-header-buttons">
                <li><a class="om-search-trigger" href="#om-search">Search<span></span></a></li>
                <li><a class="om-nav-trigger" href="#om-primary-nav">Menu<span></span></a></li>
            </ul>
        </div>
    </div>
</header>
<!-- Login Details -->
<section class="at-login-form">
    <!-- MODAL LOGIN -->
    <div class="modal fade" id="at-login" tabindex="-1" role="dialog" aria-labelledby="at-login">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"
                                                                                                   aria-hidden="true"></i>
                    </button>
                    <div class="modal-login-heading">
                        <h2>User Login</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="os-global-form" action="{{url('login/dologin')}}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input class="form-control" name="username" type="text"/>
                            <label class="control-label new-label">User Name</label>
                            <i class="bar"></i>
                        </div>
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input type="password" name="password" class="form-control" id="password"/>
                            <label class="control-label new-label">Password</label>
                            <i class="bar"></i>
                        </div>
                        <button type="submit" class="btn-lgin">Login</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="frgt-pswd" data-toggle="modal" data-dismiss="modal"
                               data-target="#at-forgot-pwd"> Forgot Password ?</p>
                        </div>
                        <div class="col-md-8">
                            <p class="ta-l">Don't have an account ? <a class="btn-gst btn btn-link" data-toggle="modal"
                                                                       data-dismiss="modal"
                                                                       data-target="#at-signup-filling">Create one
                                </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL LOGIN ENDS -->

    <!-- MODAL SIGNUP -->
    <div class="modal fade" id="at-forgot-pwd" tabindex="-1" role="dialog" aria-labelledby="at-forgot-pwd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"
                                                                                                   aria-hidden="true"></i>
                    </button>
                    <div class="modal-login-heading">
                        <h2>Forgot password</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="os-global-form" id="reset-form" action="{{url('resetPassword/send-link')}}"
                          method="post">
                        {{ csrf_field() }}


                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input type="text" name="email" id="semail" class="form-control required"/>
                            <div class="col-sm-12 col-xs-12 uni-message_semail hidden"></div>
                            <label class="control-label new-label">Email</label>
                            <i class="bar"></i>
                        </div>
                        <button type="submit" name="submit" value="Send reset link" class="btn-lgin" id="subtn">Send
                            reset link
                        </button>
                        <p>By sending, you will receive a reset email for your password.</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn-gst" data-toggle="modal" data-dismiss="modal" data-target="#at-login">Go
                                back to Login panel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL SIGNUP FORM FILLING -->
    <div class="modal fade" id="at-signup-filling" tabindex="-1" role="dialog" aria-labelledby="at-signup-filling">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"
                                                                                                   aria-hidden="true"></i>
                    </button>

                    <div class="modal-login-heading">
                        <h2>Create User Account </h2>
                    </div>
                </div>
                <div class="modal-body">
                    {{--<p>Sign up with <a href="#">Facebook</a>  or <a href="#">Google</a></p>--}}

                    <form class="os-global-form" id="contact-form1" action="{{url('login/signUp')}}"
                          method="post">
                        {{ csrf_field() }}
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input class="form-control" id="full_name" name="full_name" type="text"/>
                            <label class="control-label new-label">Full Name</label>
                            <i class="bar"></i>
                        </div>
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input class="form-control" name="email" id="uemail" type="text"/>
                            <label class="control-label new-label">Email</label>
                            <div class="col-sm-12 col-xs-12 uni-message_uemail"></div>
                            <i class="bar"></i>
                        </div>
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input class="form-control" name="username" id="username" type="text"/>
                            <label class="control-label new-label">Username</label>
                            <div class="col-sm-12 col-xs-12 uni-message_user"></div>
                            <i class="bar"></i>
                        </div>

                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input class="form-control" name="password" type="password"/>
                            <label class="control-label new-label">Password</label>
                            <i class="bar"></i>
                        </div>

                        <button type="submit" id="submitted" class="btn-lgin" onclick="SubmitThisForm(this)">Signup
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="ta-l sign-up-center">Already a Member?
                                <button class="btn-gst" data-toggle="modal" data-dismiss="modal"
                                        data-target="#at-login">
                                    Login
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL SIGNUP FORM FILLING -->
    <!-- MODAL FORGOT PASSWORD -->
    <div class="modal fade" id="at-reset-pswd" tabindex="-1" role="dialog" aria-labelledby="at-reset-pswd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"
                                                                                                   aria-hidden="true"></i>
                    </button>
                    <div class="modal-login-heading">
                        <h2>Change Password</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="os-global-form" action="{{url('login/change-password')}}"
                          id="change-password" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ @Auth::user()->id }}">

                        <div class="col-md-12 r-full-width">
                            <p> Please, confirm the password associated with your account.</p>
                        </div>
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input type="password" name="password2" class="form-control required" id="password2"/>
                            <label class="control-label new-label">New Password</label>
                            <i class="bar"></i>
                        </div>
                        <div class="col-md-12 r-full-width mui-textfield mui-textfield--float-label">
                            <input type="password" name="confirm_password2" class="form-control required"
                                   id="confirm_password2"/>
                            <label class="control-label new-label">Confirm Password</label>
                            <i class="bar"></i>
                        </div>
                        <button type="submit" class="btn-lgin">Change password</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

</section>
<div class="om-overlay"></div>
@yield('content')
@include('layouts.footer')
</body>

</html>