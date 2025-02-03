
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit"></script>
<!-- Site Navigation Schema -->
<script type="application/ld+json">
{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Website",
		"url": "https://online.jkshahclasses.com/"
	},
{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Privacy policy",
		"url": "https://online.jkshahclasses.com/privacy"
	},
{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Terms of use",
		"url": "https://online.jkshahclasses.com/terms"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "About Us",
		"url": "https://online.jkshahclasses.com/about-us"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Free Resources",
		"url": "https://online.jkshahclasses.com/ca-demo-lectures-online"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Professors",
		"url": "https://online.jkshahclasses.com/ca-faculty"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Contact Us",
		"url": "https://online.jkshahclasses.com/contact-us"
	}
</script>

<!-- Video Schema -->
<script type="application/ld+json">
{"@context":"http://schema.org",
"@type":"VideoObject",
"name":"Our Students' Experience on Our ONLINE Lectures | Thank You Dear Students!",
"description":"Hear from our students across our 61 branches in India about their experience studying ONLINE on J.K. Shah Classes' own Learning Platform since April 2020 due to the global pandemic. Your feedback only motivates us to push further and deliver nothing but the best to all you dear students. For any Inquiries or Admissions, give a MISSED CALL on 9757 111 333",
"thumbnailUrl":"http://i3.ytimg.com/vi/INOmyr9E7fs/maxresdefault.jpg",
"uploadDate":"2020-07-09T11:53:04",
"duration":"PT11M00S",
"contentUrl":"https://www.youtube.com/watch?v=INOmyr9E7fs&feature=emb_logo&ab_channel=J.K.ShahClasses",
"url":"https://www.youtube.com/watch?v=INOmyr9E7fs&feature=emb_logo&ab_channel=J.K.ShahClasses"}
</script>
<!-- Organization Schema -->
<script type="application/ld+json">
 { "@context": "http://schema.org",
 "@type": "Organization",
 "name": "JkShah Classes",
 "legalName" : "JkShah Classes",
 "url": "https://online.jkshahclasses.com/",
 "logo": "https://online.jkshahclasses.com/assets/images/logo.png",
 "address": {
 "@type": "PostalAddress",
"streetAddress": "Shraddha, 4th floor, near Chinai college, Old nagardas road, Andheri (E), Mumbai 400069,",
 "addressLocality": "Mumbai",
 "addressRegion": "MUM",
 "postalCode": "400069",
 "addressCountry": "IND"
 },
"brand": {
    "@type": "Brand",
    "name": "JkShah Classes"
  },
"contactPoint": {
 "@type": "ContactPoint",
 "contactType": "Inquiries",
 "telephone": "+ 91 8070400900",
 "contactOption" : "TollFree",
 "email": "helpdesk@jkshahclasses.com"
 },
 "sameAs": [
 "https://www.facebook.com/officialjksc",
 "https://www.instagram.com/officialjksc/",
  "https://www.youtube.com/c/JKShahClassesOnline"
]}
</script>
<style>
#gender{
    background-image: none !important;
}
.navbar{
    top:0px;
}
.call-me.open {
    width: 375px !important;
    height: 275px !important;
}
.jk_shah_top_banner{
    color: #fff;
    text-align: center;
    font-size: 16px;
    padding: 10px 0px;
    /*background: linear-gradient(45deg, #100018 0%,#26006c 50%,#110038 100%);*/
    background: linear-gradient(180deg, #F4624E 0%, #CF2F72 100%);
    position: sticky;
    z-index: 99999999;
    top: 0px;
}
.banner_nav {
    top: 44px;
}
</style>
@if( !Request::is('videos/*'))
    @include('includes.call-me')
@endif

<!-- End Google Tag Manager (noscript) -->
@if ($notification)
    <div class="bg-secondary p-2 position-fixed notification-container" style="z-index: 2; width: 100%">
        <div class="mt-1">
            @if (strlen($notification['content']) > 40)
                <div style="width: 97%; float: left">
                    <marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="3">
                        <div class="text-white">
                            {!! $notification['content'] !!}
                        </div>
                    </marquee>
                </div>
                <div style="width: 3%; float: right">
                    <div class="text-center">
                        <a class="text-white close-notification" href="" data-notification-id="{{ $notification['id'] }}"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            @else
                <div style="width: 97%; float: left">
                    <div class="text-white text-center">
                        {!! $notification['content'] !!}
                    </div>
                </div>
                <div style="width: 3%; float: right">
                    <div class="text-center">
                        <a class="text-white close-notification" href="" data-notification-id="{{ $notification['id'] }}"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            @endif
        </div>
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
@endif
@if(env('SHOW_MAINTENANCE_BANNER',false))
<div class="jk_shah_top_banner">
This site will be temporarily unavailable on 16th August from 10am to 6pm (IST) for scheduled maintenance. Please bear with us.
</div>
@endif
<nav class="navbar navbar-expand-lg navbar-top<?php if(env('SHOW_MAINTENANCE_BANNER',false)) { ?> banner_nav<?php } ?>" data-aos="fade-down">
    <div class="upper_row">
    <a class="navbar-brand" href="/"><img src="{{ asset('assets/new_ui_assets/images/JKShah_Online.png') }}" alt=""></a>
    <button class="navbar-toggler" onclick="collapsing()" type="button" data-toggle="collapse" data-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
    <div class="mob-search">
        <div class="input-group">
            <input class="form-control py-2 border-right-0 border" placeholder="Search here" type="text" value=""
                  name="search" id="mobile_search">
            <span class="input-group-append">
                    <div class="input-group-text ">
                        <a href="#" class="btn-mobile-search" id="btn-mobile-search"><i class="fa fa-search"></i></a>
                    </div>
                </span>
            <input type="hidden" name="_token" id="_token" value="5xLmpMeveyKAUMwUAYQzV9RIxGPCBwIKSw5dLVK1">
            <input type="hidden" name="" id="g_id" value="4">
        </div>
        <!-- <i class="fa fa-shopping-cart" aria-hidden="true"></i>  -->
        <a class="nav-link d-flex align-items-center position-relative" href="{{ url('cart') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="notification_badge" style=""></span>
            </a>
    </div>
    {{--<div class="collapse navbar-collapse" id="navbarScroll">--}}
        <ul class="navbar-nav my-lg-0 navbar-nav-scroll" id="collappsed" style="max-height: 100px;">
            @if(! isset($user['role']) || (isset($user['role']) && $user['role'] != 6))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        Courses
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        @foreach($courses as $course)
                            <li><a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&price=high') }}" class="dropdown-item">{{ $course['name'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('packages?offer=new')}}">New Releases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/packages?offer=special') }}">J-Deals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#explore') }}">Most Popular</a>
                </li>
                <li class="nav-item" id="ca_link">
                    <a class="nav-link" href="{{ url('/bcom-with-ca-online') }}">B.Com with CA (Online)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ca-demo-lectures-online.index') }}">Demo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" >About Us</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li>
                        <a class="nav-link" href="{{url('/about-us')}}">Who We Are</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('ca-faculty.index') }}">Our Team</a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
                </li>
                {{--<li class="nav-item">
                    <a class="nav-link" href="{{ url('/thane-vaibhav') }}">Thane Vaibhav</a>
                </li>--}}
            @endif
        </ul>
        <form class="d-flexing" id="collappsed_form">
            <div class="search-box">
                <input type="text" class="search-txt" id="search-input" placeholder="Search here...">
                <a href="#" class="search-btn">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
            <!-- <i class="fa fa-search" aria-hidden="true"></i> -->
            <a class="nav-link position-relative" href="{{ url('cart') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="notification_badge"></span>
            </a>

            @if (!$user)
                <div class="login">Login</div>
                <a href="" data-toggle="modal" data-target="#modal-signup" class="signup">Sign Up</a>
            @else
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link" id="button-notification" href="#" style="position: relative;"--}}
{{--                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="fas fa-bell"></i>--}}
{{--                        <span class="notifications-badge" style="position: absolute; top: -1px; right: -1px; background-color: white; color: black; font-size: 10px; padding: 1px 2px; border-radius: 12px; height: 18px; min-width: 18px; text-align: center; line-height: 14px; border: 1px solid var(--primary); display: none;">0</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right p-4"--}}
{{--                         aria-labelledby="button-notification" style="width: 400px;">--}}

{{--                        @if (count($userNotifications) > 0)--}}
{{--                            @foreach ($userNotifications as $userNotification)--}}
{{--                                {{ $userNotification['notification']['title'] ?? '-' }}--}}
{{--                                @if (! $loop->last)--}}
{{--                                    <hr />--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <div class="text-center">You have no new notifications.</div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </li>--}}
                <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                    <li class="nav-item dropdown m-0" id="notifications">
                        <a class="nav-link position-relative" id="button-notification" href="#">
                            <i class="fas fa-bell"></i>
                            <span class="notifications-badge">0</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            @if (count($userNotifications) > 0)
                                @foreach ($userNotifications as $userNotification)
                                    @if($userNotification['notification'])
                                        <li>
                                            <h6 class="message_head">{{ $userNotification['notification']['title'] }}</h6>
                                            <p class="m-0">
                                            <!-- {!!html_entity_decode($userNotification['notification']['notification_body'])!!} -->
                                            {!!html_entity_decode(preg_replace('"\b(https?://\S+)"', '<a href="$1" target="_blank">$1</a>', $userNotification['notification']['notification_body']))!!}
                                            </p>

                                           <p style="color: #a59f9f;margin-top:8px;text-align:right;margin-bottom: 0px;">{{ date("d-m-Y",strtotime($userNotification['notification']['created_at'])) }}&ensp; {{ date("h:i:s",strtotime($userNotification['notification']['created_at'])) }}</p>
                                            <!-- @if (! $loop->last)
                                                <hr />
                                            @endif -->
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                <div class="text-center">You have no new notifications.</div>
                            @endif
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item dropdown m-0">
                    <a class="nav-link" href="#" id="dropdown-professors">
                        <img style="object-fit:cover" src="{{ $user['student']['image'] ?? $user['professor']['image'] ?? url('assets/images/avatar.png') }}" class="rounded-circle" width="30" height="30" align="middle" />
                        <span class="d-md-none ml-2" style="vertical-align: middle;">{{ $user['student']['name'] ?? $user['professor']['name'] ?? null }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- Level two dropdown-->
                        <li>
                            @if ($user['role'] == 5)
                                <a class="dropdown-item" href="{{ url('/student-dashboard') }}">Dashboard</a>
                            @endif
                            @if ($user['role'] == 6)
                                <a class="dropdown-item" href="{{ url('professor/profile') }}">Dashboard</a>
                            @endif
                            @if ($user['role'] == 7)
                                <a class="dropdown-item" href="{{ url('associate/dashboard') }}">Dashboard</a>
                            @endif
                            @if ($user['role'] == 11)
                                <a class="dropdown-item" href="{{ url('branch-managers/profile') }}">Dashboard</a>
                            @endif
                        </li>
                        <li>
                            @if ($user['role'] == 5)
                                <a class="dropdown-item" href="{{ url('profile') }}">Profile</a>
                            @endif
                        </li>
                        @if ($user['role'] == 5)
                            <li>
                                <a class="dropdown-item" href="{{ url('j-money') }}">J-Koins</a>
                            </li>
                        @endif
                        <li class="dropdown-divider"></li>
                        <li>
                            <a id="logout-button" class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                        </li>
                    </ul>
                </li>
                </ul>
        @endif
            <!-- <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button> -->
        </form>
    {{--</div>--}}
</nav>
    <div class="login-modal" id="login-modal" data-backdrop="false">
        <button type="button" class="close">×</button>
        {{--<div class="login-triangle"></div>--}}
        <form class="login-container" id="login" name="login" method="POST" action="{{ url('/login') }}">
            @csrf
            <input type="hidden" name="form" value="login">
            <input type="hidden" id="package-id" name="package_id">
            <input type="hidden" id="location" name="location">
            <input type="hidden" id="login_type" name="login_type" value="web">
            <div class="form-group">
                <label>Email/Mobile*</label>
                <input type="text" placeholder="Email Id" class="{{ old('form') == 'login' && $errors->has('email') ? ' is-invalid' : '' }}"
                       id="email" name="email" value="@if(old('form') == 'login'){{ old('email') }}@endif" required>
                @if (old('form') == 'login' && $errors->has('email'))
                    <span class="is-invalid invalid-feedback" role="alert" style="">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Password*</label>
                <div class="pass_word_eye d-flex align-items-center">
                <input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
                <i id="eye-icon" class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>
            {{-- <div class="form-group">
                <div class="g-recaptcha-contact" data-sitekey="{{ env('SITE_KEY')}}" id="RecaptchaField2"></div>
                <input type="hidden" class="hiddenRecaptcha" name="ct_hiddenRecaptcha" id="ct_hiddenRecaptcha">
            </div> --}}
                       
            <!-- <div class="form-group{{ $errors->has('captcha_login') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Captcha*(Kindly enter the sum)</label>
            
                        <div class="captcha_login" style="float:left;margin-bottom: .4rem">
                            <span style="float:left;margin-right:3px;">@if (Route::getCurrentRoute()->uri() == '/') {!!captcha_img()!!} @endif </span>
                            <button type="button" class="btn btn-success btn-refresh-captchalogin" style="float:left"><i class="fa fa-refresh"></i></button>
                         </div>
                         <input id="captcha_login" type="text" class="form-control" placeholder="Insert the answer" name="captcha_login">

                         <span class="help-block" style="color: red;font-size: 10px;" id="captcha_login_error"></span>
            </div> -->
            <div class="remember">
                <div class="rem-label d-flex align-items-center">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="{{ url('forgot-password') }}">Forgot password?</a>
            </div>
            <button class="l-submit " type="button">Login</button>
            {{--<h4>or</h4>--}}
            {{--<h5>Continue with</h5>--}}
            {{--<ul>--}}
                {{--<li>--}}
                    {{--<a href="">--}}
                        {{--<img src="{{ asset('assets/images/facebook_small.png') }}" alt="">--}}
                        {{--<span>facebook</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{{ url('auth/google') }}">--}}
                        {{--<img src="{{ asset('assets/images/google.png') }}" alt="">--}}
                        {{--<span>Google</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        </form>
    </div>

<div class="modal fade" id="attempt-year-modal" tabindex="-1" role="dialog" aria-modal="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="row p-0">
                    <div class="col-12">
                        <div class="signup-details">
                            <div class="s-content">
                                <form id="attempt-year-form"  method="POST" >
                                    @csrf
                                    <div id="step-attempt-year">
                                        <div class="form-group">
                                            <label>Attempt Year*</label>
                                            <input type="text" class="form-control  {{ $errors->has('attempt_year') ? ' is-invalid' : '' }} "  placeholder="Attempt Year" maxlength="4" required="required" id="login_attempt_year" name="attempt_year" value="{{ old('attempt_year') }}">
                                            @if ( $errors->has('attempt_year'))
                                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('attempt_year') }}</span>
                                            @endif

                                        </div>
                                        <div class="row justify-content-center">
                                            <button type="button" class="s-attempt-year-next " id="attempt-year-login">Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-signup" tabindex="-1" role="dialog" aria-modal="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="row p-0">
                    <div class="col-lg-6 col-md-12 col-sm-12 p-0 md-d-none">
                        <div class="sign-up-image">
                            <!-- <h1>Sign Up and Start Learning!</h1> -->
                            <div class="d-flex align-items-center justify-content-center">
                                <h6 class="mb-0 font-weight-bold">Existing User?</h6>
                                <button class="btn ml-2">Login</button>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="signup-details">
                            <div class="s-content">
                                <div class="timeliner">
                                    <i class="fa fa-check"></i>
                                    <div id="prog-cotainer">
                                        <div id="inner-bar"></div>
                                    </div>
                                    <i class="fa fa-check last"></i>
                                    <i class="fa fa-check middle"></i>
                                </div>
                                <form id="form-signup" method="POST" action="{{ url('/register') }}">
                                    @csrf
                                <div id="step-one">
                                    @csrf
                                    <input type="hidden" name="form" value="signup">
                                    <input type="hidden" name="otp_register_token" id="otp_register_token">
                                    <input type="hidden" name="otp_register_code" id="otp_register_code">
                                    @if (request()->has('referral'))
                                        <input type="hidden" name="referral" value="{{ request()->input('referral') }}">
                                    @endif
                                    <input type="hidden" value="{{ request()->is('redirect_to_home*') ? '5' : '1' }}" name="is_imported" />
                                    <!-- <div class="form-group">
                                        <label>Full Name*</label>
                                        <input type="text" placeholder="Full Name"
                                               class="{{ old('form') == 'signup' && $errors->has('name') ? ' is-invalid' : '' }}"
                                               id="signup_name" name="name" value="@if(old('form') == 'signup') {{ old('name') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div> -->
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" placeholder="First Name"
                                               class="{{ old('form') == 'signup' && $errors->has('fname') ? ' is-invalid' : '' }}"
                                               id="signup_fname" name="fname" value="@if(old('form') == 'signup') {{ old('fname') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('fname'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('fname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" placeholder="Last Name"
                                               class="{{ old('form') == 'signup' && $errors->has('lname') ? ' is-invalid' : '' }}"
                                               id="signup_name" name="lname" value="@if(old('form') == 'signup') {{ old('lname') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('lname'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>
                      
                                    <div class="form-group">
                                        <label>Gender*</label>
                                        <select class="form-control form-control-sm" name="gender" id="gender">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                      
                                        @if (old('form') == 'signup' && $errors->has('gender'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile No*</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <select class="form-control" id="s_mobile-code" name="mobile_code">
                                                    <option selected value="+91">+91</option>
                                                    <option value="+971">+971</option>
                                                </select>
                                            </div>
                                            <div class="col-8">
                                                <input type="text"  placeholder="Mobile No" class="{{ old('form') == 'signup' && $errors->has('mobile') ? ' is-invalid' : '' }}"
                                                       id="signup_mobile" name="mobile"
                                                       value="@if(old('form') == 'signup') {{ old('mobile') }} @endif">
                                                @if (old('form') == 'signup' && $errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('mobile') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Id*</label>
                                        <input type="email" placeholder="Email Id" class="{{ old('form') == 'signup' && $errors->has('email') ? ' is-invalid' : '' }}"
                                               id="signup_email" name="email"
                                               value="@if(old('form') == 'signup') {{ old('email') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('email'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password*</label>
                                        <input type="password" placeholder="Password"  value="@if(old('form') == 'signup') {{ old('password') }} @endif" class="{{ old('form') == 'signup' && $errors->has('course_id') ? ' is-invalid' : '' }}" id="signup_password" name="password">
                                        @if (old('form') == 'signup' && $errors->has('password'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Re-enter Password*</label>
                                        <input type="password" placeholder="Password" class="{{ old('form') == 'signup' && $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                               id="signup_password_confirmation" value="@if(old('form') == 'signup') {{ old('password_confirmation') }} @endif" name="password_confirmation">
                                        @if (old('form') == 'signup' && $errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
{{--                                    <button class="s-next" id="sign-up-next-button" onclick="move()">Next</button>--}}
                                    <button class="s-custom-next" id="sign-up-next-button">Next</button>
                                </div>
                                <div id="step-two">

                                    <div class="form-group">
                                        <label class="{{ old('form') == 'signup' && $errors->has('country_id') ? ' is-invalid' : '' }}">Country</label>
                                        <x-inputs.country data-model="1" id="signup_country_id" name="country_id" class="form-control form-control-sm">
                                            @if(old('form') == 'signup' && !empty(old('country_id')))
                                                <option value="{{ old('country_id') }}" selected>{{ old('country_id_text') }}</option>
                                            @endif
                                        </x-inputs.country>
                                        @if (old('form') == 'signup' && $errors->has('country_id'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>State / Province</label>
                                        <x-inputs.state data-model="1" id="signup_state_id" name="state_id" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('state_id') ? ' is-invalid' : '' }}" related="#signup_country_id">
                                            @if(old('form') == 'signup' && !empty(old('state_id')))
                                                <option value="{{ old('state_id') }}" selected>{{ old('state_id_text') }}</option>
                                            @endif
                                        </x-inputs.state>
                                        @if (old('form') == 'signup' && $errors->has('state_id'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('state_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="signup_city">City</label>
                                        <input type="text" class="{{ old('form') == 'signup' && $errors->has('city') ? ' is-invalid' : '' }}" id="signup_city" name="city" value="@if(old('form') == 'signup') {{ old('city') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('city'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="signup_pin">Pin</label>
                                        <input type="text" class="{{ old('form') == 'signup' && $errors->has('pin') ? ' is-invalid' : '' }}" id="signup_pin" name="pin" value="@if(old('form') == 'signup') {{ old('pin') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('pin'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('pin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Course*</label>
                                        <x-inputs.course data-model="1" id="signup_course_id" name="course_id" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('course_id') ? ' is-invalid' : '' }}">
                                            @if(old('form') == 'signup' && !empty(old('course_id')))
                                                <option value="{{ old('course_id') }}" selected>{{ old('course_id_text') }}</option>
                                            @endif
                                        </x-inputs.course>
                                        @if (old('form') == 'signup' && $errors->has('course_id'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('course_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Level*</label>
                                        <x-inputs.level data-model="1" id="signup_level_id" name="level_id" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('level_id') ? ' is-invalid' : '' }}" related="#signup_course_id">
                                            @if(old('form') == 'signup' && !empty(old('level_id')))
                                                <option value="{{ old('level_id') }}" selected>{{ old('level_id_text') }}</option>
                                            @endif
                                        </x-inputs.level>
                                        @if (old('form') == 'signup' && $errors->has('level_id'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('level_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="signup_attempt_year">Attempt Year*</label>
                                        <input  type="text" class="form-control  {{ old('form') == 'signup' && $errors->has('attempt_year') ? ' is-invalid' : '' }} " id="signup_attempt_year" name="attempt_year" value="@if(old('form') == 'signup') {{ old('attempt_year') }} @endif">
                                        @if (old('form') == 'signup' && $errors->has('attempt_year'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('attempt_year') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="g-recaptcha-quote" data-sitekey="{{ env('SITE_KEY')}}" id="RecaptchaField1"></div>
                                         <input type="text"  name="qt_hiddenRecaptcha" id="qt_hiddenRecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;">
                                        </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input  class="form-check-input" type="checkbox" id="signup_terms" name="terms">
                                            <label for="signup_terms">
                                                By clicking Sign Up, you agree to our <a href="{{ url('terms/')}}">terms & condition</a> and <a href="{{ url('privacy/')}}">privacy policy.</a>
                                            </label>
                                            <label class="form-check-label"></label>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group{{ $errors->has('captcha_signup') ? ' has-error' : '' }}">
                                        <label for="password" class="control-label">Captcha*(Kindly enter the sum)</label>
                                                
                                                    <div class="captcha_signup">
                                                    <span></span>
                                                    <button type="button" class="btn btn-success btn-refresh-captchasignup"><i class="fa fa-refresh"></i></button>
                                                    </div>
                                                    <input id="captcha_signup" type="text" class="form-control mt-3" placeholder="Please insert answer" name="captcha_signup">

                                                        <span class="help-block" style="color: red;font-size: 10px;" id="captcha_signup_error">
                                                            
                                                        </span>
                                    </div> -->
                                    <input id="verified_otp" type="hidden" value="0">
                                    <button class="s-next" type="button" id="btn-signup">Next</button>
                                </div>
                                </form>
                                <div id="step-three">
                                    <h1>OTP Verification</h1>
                                    @if(old('form') == 'signup' && session()->has('error'))
                                        <span class="text-danger">
                                            {{ session()->get('error') }}
                                        </span>
                                    @endif
                                    <form id="form-otp" method="POST" action="{{ url('/login') }}">
                                        <input id="otp_mobile" name="otp_mobile" type="hidden">
                                        <input id="signupemail" name="signupemail" type="hidden">
                                        <input id="otp_token" name="otp_token" type="hidden">
                                        <input id="signupname" name="signupname" type="hidden">
                                        @csrf
                                        <div class="form-group">
                                            <label>Please enter verification code just sent to your number</label>
                                            <input type="text" placeholder="Enter OTP" id="otp_code" name="otp_code">
                                        </div>
                                        <div class="form-group text-center">
                                            <span id="resend_text">Didn't get? <a id="resend" class="ml-md-auto" href="">Resend</a></span>
                                            <span id="timer"></span>
                                            <p id="otp_mess" style="color:#f11111"></p>
                                        </div>
                                        <button id="btn-otp-verify" class="s-custom-submit" type="submit">Signup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script id="script-modal-signup">
        var c_url      = window.location.href;
        $( document ).ready(function() {
                var urlParams = new URLSearchParams(window.location.search);
                if(urlParams.has('login') == true){
                    $(".login-modal").toggle();
                }
            });
        //  function captcha_login(){
        //         $.ajax({
        //         type:'GET',
        //         url:'/refresh_captcha',
        //         success:function(data){
        //             $(".captcha_login span").html(data.captcha);
        //             $('#captcha_login').val('');
        //             $('#captcha_login').removeClass('is-valid');
        //             $('#captcha_login').removeClass('is-invalid');
                  
        //         }
        //         });
        
        //     }
        //     function captcha_signup(){
        //         $.ajax({
        //         type:'GET',
        //         url:'/refresh_captcha',
        //         success:function(data){
        //             $(".captcha_signup span").html(data.captcha);
        //             $('#captcha_signup').val('');
        //             $('#captcha_signup').removeClass('is-valid');
        //             $('#captcha_signup').removeClass('is-invalid');
        //         }
        //         });        
        //     }
            
        $(document).on("keypress", "#search-input", function(e){
            if(e.which == 13){
                var search = $('#search-input').val();
                var url = '{{ url('packages?search=') }}'+search;
                window.location.href = url;
                return false;
            }
        });
        $("#attempt-year-login").click(function (e) {
            e.preventDefault();
                let attemptYear = $('#login_attempt_year').val();
               if(attemptYear) {
                   $.ajax({
                       method: 'POST',
                       url: '{{ url('/attempt-year-update') }}',
                       data: {
                           '_token': '{{ csrf_token() }}',
                           'attempt_year': attemptYear
                       },
                   }).done(function(response) {
                       toastr.success('Attempt Year Updated Successfully');
                       location.reload();
                   });
               }else{

               }
        });

        $(function () {
            'use strict';
            $('#attempt-year-form').validate({
                rules: {
                    login_attempt_year: {
                        required: true,
                        maxlength: 4,
                    }
                }
            });

            $('#login_attempt_year').datepicker({
                format: "mm-yyyy",
                startView: "months", 
                minViewMode: "months",
                startDate:new Date().getMonth+'-'+new Date().getFullYear(),
                endDate: '+4y',
                autoclose: true
       
            });
            $('#signup_attempt_year').datepicker({
                format: "mm-yyyy",
                startView: "months", 
                minViewMode: "months",
                startDate:new Date().getMonth+'-'+new Date().getFullYear(),
                endDate: '+4y',
                autoclose: true
       
            });
            // $("#email").blur(function(){
            //     $.ajax({
            //     type:'GET',
            //     url:'/refresh_captcha',
            //     success:function(data){
            //         $(".captcha_login span").html(data.captcha);
            //     }
            //     });
            //  });
            //  $("#signup_city").click(function(){
            //     $.ajax({
            //     type:'GET',
            //     url:'/refresh_captcha',
            //     success:function(data){
            //         $(".captcha_signup span").html(data.captcha);
            //     }
            //     });
            //  });

             
            $('.login-container').validate({
                onsubmit:false,
                ignore: [],
                rules: {
                    
                    email: {
                        required: true
                        // email: true,
                       
                    },
                    
                    password: {
                        required: true,
                        maxlength: 255
                        // minlength: 5
                    },
                    /*"ct_hiddenRecaptcha": {
                        required: true,
                        minlength: "255",
                        remote: {
                            url: '{{ url('/validate-captcha') }}',
                            type: 'POST',
                            data: {
                              captchaa: function () {
                              //  alert();
                               return $('#g-recaptcha-response').val();
                                },
                                _token: '{{ csrf_token() }}',
                            }
                    }
                        }*/
                    
                    // captcha_login: {
                    //     required: true,
                    //     remote: {
                    //         type: 'POST',
                    //         async:false,
                    //         dataType: 'json',
                    //         url: '{{ route('captchalogincheck') }}',
                    //     }
                    // },
                },
                messages: {
                    email: {
                        remote: 'Email already exist'
                    },
                    // captcha_login:{
                    //     remote: 'Captcha is invalid',
                    //     required : 'Captcha is required',

                    // },
                }
            });
            // let createForm = $('#form-signup');

            jQuery.validator.addMethod("validate_city", function(value, element) {
                var reg = /^[0-9a-zA-Z_.\s-]*$/;
                if (reg.test(value)) {
                    return true;
                } else {
                    return false;
                }
            }, "Only letters, numbers,space, dot(period), hyphen and underscore are allowed");

            jQuery.validator.addMethod("validate_zipcode", function(value, element) {
                var country = $('#signup_country_id').val();
                if( country ==2){
                    var reg = /^[0-9]{0,6}$/;
                }else{
                    var reg = /^[0-9]{6}$/;
                }
                
                if (reg.test(value)) {
                    return true;
                } else {
                    return false;
                }
            }, "Only 6 digits are allowed");

            $('#signup_country_id').change(function(){
                var country = $(this).val();
                if(country == 2){
                    $('#signup_pin').val('00000');
                    $('#signup_pin').attr('readonly', true);
                }else{
                    $('#signup_pin').val('');
                    $('#signup_pin').attr('readonly', false);
                }
            });

            $('#form-signup').validate({
                onsubmit:false,
                rules: {
                    name: {
                        required: true,
                        maxlength: 255,
                    },
                    attempt_year:{
                        required: true                    
                    },
                    "qt_hiddenRecaptcha": { 
                        required: true,
                        minlength: "255",
                        remote: {
                            url: '{{ url('/validate-captcha') }}',
                            type: 'POST',
                            data: {
                              captchaa: function () {
                              //  alert();
                               return $('#qt_hiddenRecaptcha').val();
                                },
                                _token: '{{ csrf_token() }}',
                            }
                        }, 
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: '{{ url('validate-email') }}',
                            type: 'POST',
                            data: {
                                email: function() {
                                    return $('#signup_email').val();
                                }
                            }
                        }
                    },
                    mobile: {
                        required: true,
                        number: true,
                     
                        // maxlength: function() {
                        //     if ($('#mobile-code').val() === '+91') {
                        //         return 10;
                        //     } else {
                        //         return 9;
                        //     }
                        // },
                        // minlength: function() {
                        //     if ($('#mobile-code').val() === '+91') {
                        //         return 10;
                        //     } else {
                        //         return 9;
                        //     }
                        // },
                        remote: {
                            url: '{{ url('validate-phone') }}',
                            type: 'POST',
                            data: {
                                mobile: function() {
                                    return $('#signup_mobile').val()
                                }
                            }
                        }
                    },
                    fname: {
                        required: true,
                        lettersonly: true 
                    },
                    lname: {
                        required: true,
                        lettersonly: true 
                    },
                    gender: {
                        required: true
                     
                    },
                    password: {
                        required: true,
                        maxlength: 255,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#signup_password"
                    },
                    course_id: {
                        required: true
                    },
                    level_id: {
                        required: true
                    },
                    country_id: {
                        required: true
                    },
                    state_id: {
                        required: true
                    },
                    city: {
                        required: true,
                        //validate_city:true,
                        lettersonly:true,
                    },
                    pin: {
                        required: true,
                        validate_zipcode :true,
                    },
                    terms: {
                        required: true
                    },
                     
                    // captcha_signup: {
                    //     required: true,
                    //     remote: {
                    //         type: 'POST',
                    //         async:false,
                    //         dataType: 'json',
                    //         url: '{{ route('captchasignupcheck') }}',
                    //     }
                    // },
                },
                messages: {
                    terms: {
                        required: "You must agree our terms & condition and our privacy policy to continue signup"
                    },
                    email: {
                        remote: 'Email already exist'
                    },
                    mobile: {
                        remote: 'Mobile number already exist'
                    },
                    // captcha_signup:{
                    //     remote: 'Captcha is invalid',
                    //     required : 'Captcha is required',

                    // },
                }
            });
//        $(window).scroll(function() {
//            var scroll = $(window).scrollTop();
//            if (scroll >= 310) {
//                $('.search-container').removeClass("d-md-none");
//            }else{
//                $('.search-container').addClass("d-md-none");
//            }
//        });

            $("#eye-icon").click(function (){
                var input = $("#password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                } else {
                    input.attr("type", "password");
                    $(this).addClass('fa-eye');
                    $(this).removeClass('fa-eye-slash');
                }
            })

            var $notificationBadge = $('.notification_badge');
            $notificationBadge.hide();
            var $wishlistNotificationBadge = $('header').find('.wishlist_notification_badge');
            $wishlistNotificationBadge.hide();

            var updateCartCount = function () {
                var url = '{{ url('cart') }}';
                $.get({
                    url: url,
                    cache: false,
                    dataType: 'json'
                }).done(function (response) {
                    var count = 0;

                    if (response.data != null) {
                        if (Array.isArray(response.data.cart.items)) {
                            count = response.data.cart.items.length;
                        }

                        $notificationBadge.text(count);

                        if (count > 0) {
                            $notificationBadge.show();
                        } else {
                            $notificationBadge.hide();
                        }
                        if (Array.isArray(response.data.wishlist)) {
                            count = response.data.wishlist.length;
                        }

                        $wishlistNotificationBadge.text(count);

                        if (count > 0) {
                            $wishlistNotificationBadge.show();
                        } else {
                            $wishlistNotificationBadge.hide();
                        }
                    }

                }).fail(function () {

                });
            };

            updateCartCount();

            $('body').on('change.cart', function () {
                updateCartCount();
            });


            /*$('.cart-save-for-later').click( function () {
                updateCartCount();
                location.reload();
            });*/


            {{--var $wishlistNotificationBadge = $('header').find('.wishlist_notification_badge');--}}
            {{--$wishlistNotificationBadge.hide();--}}

            {{--var updateWishListCount = function () {--}}
            {{--    var url = '{{ url('wishlist') }}';--}}

            {{--    $.get({--}}
            {{--        url: url,--}}
            {{--        cache: false,--}}
            {{--        dataType: 'json'--}}
            {{--    }).done(function (response) {--}}
            {{--        var count = 0;--}}

            {{--        console.log(response);--}}
            {{--        console.log(1111);--}}
            {{--        --}}
            {{--    }).fail(function () {--}}

            {{--    });--}}
            {{--};--}}

            {{--updateWishListCount();--}}

            {{--$('.cart-save-for-later').click( function () {--}}
            {{--    updateWishListCount();--}}
            {{--});--}}
        });

        $(function () {
            'use strict';

            if('ontouchstart' in document) return this; // don't want to affect chaining

            $('[data-hover="dropdown"]').find('.nav-item.dropdown').hover(function () {
                $(this).children('.dropdown-toggle').dropdown('show');
            }, function () {
                $(this).children('.dropdown-toggle').dropdown('hide');
            })
        });

        
        $('.search-btn').click(function (e) {
            var search = $('#search-input').val();
            var url = '{{ url('packages?search=') }}'+search;
            window.location.href = url;
        });

        $('.btn-mobile-search').click(function (e) {
            var search = $('#mobile_search').val();
            var url = '{{ url('packages?search=') }}'+search;
            window.location.href = url;
        });


        $('#btn-refer-and-earn').click(function() {
            $('#location').val('refer_and_earn');
        });

        @if (request()->has('refer-and-earn'))
        $('#modal-refer-and-earn').modal('toggle');
        @endif

        $(function() {
            let $notificationsBadge = $('.notifications-badge');
            $notificationsBadge.hide();

            let notifications = [];

            $.ajax({
                type: 'GET',
                url: '{{ url('user-notifications') }}',
                async: false
            }).done(function(response) {
                notifications = response;
            });
            if (notifications.length > 0) {
                $notificationsBadge.show();
                $notificationsBadge.text(notifications.length);
                $('.navbar form #notifications .dropdown-menu').css('display', 'block');
            }

            $('#button-notification').click(function() {
                var d=  $('.navbar form #notifications .dropdown-menu').css('display');
                if(d=='block'){
                    $('.navbar form #notifications .dropdown-menu').css('display', 'none');
                }else{
                    $('.navbar form #notifications .dropdown-menu').css('display', 'block');
                }

                if (notifications.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('user-notifications/mark-as-read') }}'
                    }).done(function(response) {
                        $notificationsBadge.hide();
                        $notificationsBadge.text(0);
                        notifications = [];
                    });
                }
            });
        });

        $(function () {
            $('.close-notification').click(function (e) {
                e.preventDefault();
                $('.notification-container').addClass('d-none');
                $('.navbar-top').css('padding-top', '0px');

                let notificationID = $(this).data('notification-id');

                $.ajax({
                    url: '{{ route('close-notification') }}',
                    type: 'POST',
                    data: {
                        notification_id: notificationID
                    }
                });
            });

            // $(".btn-refresh-captchalogin").click(function(){
            //     $.ajax({
            //         type:'GET',
            //         url:'/refresh_captcha',
            //          success:function(data){
            //             $(".captcha_login span").html(data.captcha);
            //             $('#captcha_login').val('');
            //             $('#captcha_login').removeClass('is-valid');
            //             $('#captcha_login').removeClass('is-invalid');
            //         }
            //     });
            // });
            // $(".btn-refresh-captchasignup").click(function(){
            //     $.ajax({
            //         type:'GET',
            //         url:'/refresh_captcha',
            //         success:function(data){
            //             $(".captcha_signup span").html(data.captcha);
            //             $('#captcha_signup').val('');
            //             $('#captcha_signup').removeClass('is-valid');
            //             $('#captcha_signup').removeClass('is-invalid');
            //         }
            //     });
            // });
           
            $('#btn-signup').click(function (e) {
                e.preventDefault();
               
                $('#form-signup').valid();
                if (!$('#form-signup').valid()) {
                    return;
                }
                if($("#form-signup").valid()){
                    $('#otp_mobile').val($('#signup_mobile').val());
                    $('#signupemail').val($('#signup_email').val());
                    let fname = $('#signup_fname').val();
                    let lname = $('#signup_name').val();
                    let fullname = fname.concat(" ",lname);
                    $('#signupname').val(fullname);
                    $('#step-two').css('display', 'none');
                    $('#step-three').css('display', 'block');
                    $('#step-one').css('display', 'none');
                    $('#inner-bar').css('width', '100%');
                    $('#inner-bar').css('height', '2px');
                    $('#inner-bar').css('background-color', '#04aa6d');
                    $('.fa-check').css('background-color', '#04aa6d');
                    $('.fa-check').css('color', 'white');
                    sendOTP();
                    
                    // $('.last').css('background-color', '#04aa6d');
                    // $('.middle').css('color', 'white');
                }

                // $('#modal-otp').modal('show');
            });
            //
            // $('#modal-otp').on('hide.bs.modal', function () {
            //     $('#form-signup').find('#otp_token').val($('#modal-otp').find('#otp_token').val());
            //     $('#form-signup').find('#otp_code').val($('#modal-otp').find('#otp_code').val());
            //
            //     $('#btn-signup').prop('disabled', true);
            //     $('#form-signup').submit();
            // });

            $('#sign-up-next-button').on('click', function(e) {
                e.preventDefault();
                if($("#form-signup").valid()){
                    $('#step-two').css('display', 'block');
                    $('#step-three').css('display', 'none');
                    $('#step-one').css('display', 'none');
                    $('#inner-bar').css('width', '50%');
                    $('#inner-bar').css('height', '2px');
                    $('#inner-bar').css('background-color', '#04aa6d');
                    $('.middle').css('background-color', '#04aa6d');
                    $('.middle').css('color', 'white');
                   //captcha_signup();
                }
            });

            var timer;

            let pad = function (value) {
                return (value < 10 ? '0' : '') + value;
            };

            let startTimer = function () {
                stopTimer();

                $('#resend_text').hide();

                var time  = 60;
                timer = setInterval(function() {
                    if (time < 0) {
                        stopTimer();
                        return;
                    }

                    $('#timer').show();
                    $('#timer').text(Math.floor(time / 60) + ':' + pad(time % 60));
                    time--;
                }, 1000);
            };

            let stopTimer = function () {
                if (timer) clearInterval(timer);
                $('#resend_text').show();
                $('#timer').hide();
            };
          
            let sendOTP = function () {
                startTimer();
                console.log('start timer');
                 // var url = '{{ env('API_URL').'/otp/send' }}';
               var url="{{ url('send-otp') }}";

                var phone = $('#signup_mobile').val();
                var email = $('#signup_email').val();
                var otp_token = $('#otp_token').val();
                var name = $('#signupname').val();
               
                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'POST',
                    data: { mobile: phone,email:email,action: 'signup', token: otp_token ,name:name}
                    /*,
                     global: false */ // set false to disable global event handler
                }).done(function (response, textStatus, jqXHR) {
                    // alert(JSON.stringify(data[0]));
                    console.log(response['data']);
                    $('#otp_token').val(response['data']);
                }).fail(function (jqXHR, textStatus, errorThrown) {

                }).always(function () {
                    //  ladda.stop();
                });
            }

            $("#resend").click(function (e) {
                e.preventDefault();
                // ('#btn-otp-verify').removeClass('s-after-submit');
                // ('#btn-otp-verify').addClass('s-custom-submit');
                sendOTP();
                $("#modal-signup").modal('show');
                $('#step-two').css('display', 'none');
                $('#step-three').css('display', 'block');
                $('#step-one').css('display', 'none');
                $('#inner-bar').css('width', '100%');
                $('#inner-bar').css('height', '2px');
                $('#inner-bar').css('background-color', '#04aa6d');
                $('.fa-check').css('background-color', '#04aa6d');
                $('.fa-check').css('color', 'white');
            });

            $('#form-otp').validate({
                rules: {
                    otp_code: {
                        required: true
                    }
                }
            });

            $('#btn-otp-verify').click(function (e) {
                $(this).attr('disabled', true);
                e.preventDefault();
                $("#verified_otp").val(1);
                if (!$('#form-otp').valid()) {
                    return;
                }
                $(this).addClass('s-after-submit');
                $(this).removeClass('s-custom-submit');
                $('#otp_register_token').val($('#otp_token').val());
                $('#otp_register_code').val($('#otp_code').val());
                var otp_token=$('#otp_token').val();
                var otp_code=$('#otp_code').val();
                $.ajax({
                type: 'POST',
                dataType: 'json',
                url:'/signup_otp_verify',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'otp_register_token':otp_token,
                    'otp_register_code':otp_code,
                },
                success: function(response) {
                    if(response.status==1){
                        $('#otp_mess').css('color', 'green');
                        $('#otp_mess').html('OTP Verified');
                        $('#form-signup').submit();

                        $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "Lead"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });
                    }
                    else{
                        $('#otp_mess').html('Invalid OTP');
                    }
                }
            });

               
            });

            $('#otp_code').on('keyup',function(){     
                $('#otp_mess').html('');   
                $('#btn-otp-verify').addClass('s-custom-submit'); 
                $('#btn-otp-verify').removeClass('s-after-submit');       
                $('#btn-otp-verify').prop('disabled', false);
            });

            @if(old('form') == 'signup')
                $(this).attr('disabled', false);
                @if (session('error'))
                    $("#modal-signup").modal('show');
                    $('#resend_text').show();
                    $('#step-two').css('display', 'none');
                    $('#step-three').css('display', 'block');
                    $('#step-one').css('display', 'none');
                    $('#inner-bar').css('width', '100%');
                    $('#inner-bar').css('height', '2px');
                    $('#inner-bar').css('background-color', '#04aa6d');
                    $('.fa-check').css('background-color', '#04aa6d');
                    $('.fa-check').css('color', 'white');
                @endif
            @endif
                @if(old('form') == 'login')
                        @if ($errors->has('email'))
                          $(".login-modal").toggle();
                        @endif
                @endif

            // $('.l-submit').click(function () {
            //         $(this).attr('disabled', true);
            //         $(this).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Logging In');
            //         $('.login-container')[0].submit();
            // });
            $('.l-submit').click(function (e) {
                e.preventDefault();
                $('.login-container').valid();
                if (!  $('.login-container').valid()) {
                    return;
                }
                if($('.login-container').valid()){
                    $(this).attr('disabled', true);
                    $(this).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Logging In');
                    $('.login-container')[0].submit();
                }

               
            });
            $('.sign-up-image .d-flex button').click(function () {
                $("#modal-signup").modal('hide');
                $(".login-modal").toggle();
            });
        });
        var CaptchaCallback = function() {
    var widgetId1;
    var widgetId2;
    var widgetId3;
    var widgetId4;
    var widgetId6;
    
    if ( $('#qt_hiddenRecaptcha').length ) {
        widgetId1 = grecaptcha.render('RecaptchaField1', {'sitekey' : '{{ env('SITE_KEY')}}', 'callback' : correctCaptcha_quote});
    }
    // if ( $('#ct_hiddenRecaptcha').length ) {
    //     widgetId2 = grecaptcha.render('RecaptchaField2', {'sitekey' : '{{ env('SITE_KEY')}}', 'callback' : correctCaptcha_contact});
    // }
    if ( $('#ft_hiddenRecaptcha').length ) {
        widgetId3 = grecaptcha.render('RecaptchaField3', {'sitekey' : '{{ env('SITE_KEY')}}', 'callback' : correctCaptcha_fgtpwd});
    }
    if ( $('#rc_hiddenRecaptcha').length ) {
        widgetId4 = grecaptcha.render('RecaptchaField4', {'sitekey' : '{{ env('SITE_KEY')}}', 'callback' : correctCaptcha_rc});
    }
    if ( $('#et_hiddenRecaptcha').length ) {
        widgetId6 = grecaptcha.render('RecaptchaField6', {'sitekey' : '{{ env('SITE_KEY')}}', 'callback' : correctCaptcha_et});
    }
};

var correctCaptcha_contact = function(response) {
    $("#ct_hiddenRecaptcha").val(response);
};

var correctCaptcha_quote = function(response) {
    $("#qt_hiddenRecaptcha").val(response);
};

var correctCaptcha_fgtpwd = function(response) {
    $("#ft_hiddenRecaptcha").val(response);

};
var correctCaptcha_rc = function(response) {
    $("#rc_hiddenRecaptcha").val(response);

};
var correctCaptcha_et = function(response) {
    $("#et_hiddenRecaptcha").val(response);

};
    </script>
    
@endpush