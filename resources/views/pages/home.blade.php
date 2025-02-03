@extends('layouts.master')
@section('content')
<style type="text/css">
    #image-orange {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 30px;
        height: 30px;
    }
</style>
<div class="main">
    <!-- Banner -->
    {{-- <div class="online_banner d-none">
        <div class="container-fluid">
        <div class="main_head">
          <h3>Study at your pace, study at your place</h3>
        </div>
        <div class="owl-carousel new_banner owl-theme">
          <div class="item">
            <div class="itm_img">
              <img src="https://picsum.photos/200/300" alt="img" />
            </div>

            <p>This is a example text to show the ui</p>
          </div>
          <div class="item">
            <div class="itm_img">
              <img src="https://picsum.photos/200/300" width="100" height="50" alt="img" />
            </div>

            <p>This is a example text to show the ui</p>
          </div>
          <div class="item">
            <div class="itm_img">
              <img src="https://picsum.photos/200/300" width="100" height="50" alt="img" />
            </div>

            <p>This is a example text to show the ui</p>
          </div>
          <div class="item">
            <div class="itm_img">
              <img src="https://picsum.photos/200/300" width="100" height="50" alt="img" />
            </div>

            <p>This is a example text to show the ui</p>
          </div>
          <div class="item">
            <div class="itm_img">
              <img src="https://picsum.photos/200/300" width="100" height="50" alt="img" />
            </div>

            <p>This is a example text to show the ui</p>
          </div>
          <div class="item">
            <div class="itm_img">
              <img src="https://picsum.photos/200/300" width="100" height="50" alt="img" />
            </div>

            <p>This is a example text to show the ui</p>
          </div> 
        </div>
        <div class="main_bottom">
          <div class="bottom_in">
            <img src="{{ asset('assets/new_ui_assets/images/book_icon.png') }}" alt="icon" />
            <a href="">CA</a>
          </div>
          <div class="bottom_in">
            <img src="{{ asset('assets/new_ui_assets/images/book_icon.png') }}" alt="icon" />
            <a href="">CS</a>
          </div>
          <div class="bottom_in">
            <img src="{{ asset('assets/new_ui_assets/images/book_icon.png') }}" alt="icon" />
            <a href="">junior college(mh)</a>
          </div>
        </div>
      </div>
      </div> --}}
    <!-- Banner -->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-aos="fade-up">
       {{-- <ol class="carousel-indicators">
            @foreach($banners as $id => $banner)
            <li data-target="#carouselExampleCaptions" data-slide-to="{{ $id }}" class="  @if ($id == 0) active @endif"></li>
            @endforeach
        </ol> --}}
        <div class="carousel-inner">
            @foreach($banners as $id => $banner)
            <div class="carousel-item @if ($id == 0) active @endif">
                <div class="banner-content">
                    <div class="banner-inner">
                        <div class="banner-container">
                               {{-- <div class="col-lg-5 col-md-6 col-sm-12 d-none">
                                    <div class="banner-info">
                                        <h1>Study at Your Place,</h1>
                                        <h1>Study at Your Pace</h1>
                                        <ul>
                                            @foreach($courses['data'] as $course)
                                            <li>
                                                <img src="{{ asset('assets/new_ui_assets/images/entypo_book.png') }}" alt="">
                                                <a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&price=high') }}">
                                                    <h5>{{ $course['name'] }}</h5>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @if (! request()->session()->has('access_token'))
                                        <a class="join-today-btn" id="join-today-btn" href="#">Enroll Now</a>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                                    <div class="banner-image">
                                        <a href="{{@$banner['title_url']}}">
                                            <img src="{{ $banner['image_url'] }}" loading="lazy" alt="">
                                        </a>
                                    </div>
                                </div>
                        </div>
                        {{-- <div class="banner-container">
                            <div class="row">
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <div class="banner-info">
                                        <h1>Study at Your Place,</h1>
                                        <h1>Study at Your Pace</h1>
                                        <ul>
                                            @foreach($courses['data'] as $course)
                                            <li>
                                                <img src="{{ asset('assets/new_ui_assets/images/entypo_book.png') }}" alt="">
                                                <a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&price=high') }}">
                                                    <h5>{{ $course['name'] }}</h5>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @if (! request()->session()->has('access_token'))
                                        <a class="join-today-btn" id="join-today-btn" href="#">Enroll Now</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <div class="banner-image">
                                        <a href="{{@$banner['title_url']}}">
                                            <img src="{{ $banner['image_url'] }}" loading="lazy" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{-- <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-aos="fade-up">--}}
    {{-- <ol class="carousel-indicators">--}}
    {{-- <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>--}}
    {{-- <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>--}}
    {{-- <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>--}}
    {{-- </ol>--}}
    {{-- <div class="carousel-inner">--}}
    {{-- @foreach($banners as $id => $banner)--}}
    {{-- <div class="carousel-item @if ($id == 0) active @endif">--}}
    {{-- <img src="{{ $banner['image_url'] }}" class="d-block w-100" />--}}
    {{-- </div>--}}
    {{-- @endforeach--}}
    {{-- <div class="carousel-item">--}}
    {{-- <img src="{{ asset('assets/new_ui_assets/images/banner1.png') }}" class="d-block w-100" alt="...">--}}

    {{-- </div>--}}
    {{-- <div class="carousel-item">--}}
    {{-- <img src="{{ asset('assets/new_ui_assets/images/banner1.png') }}" class="d-block w-100" alt="...">--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">--}}
    {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
    {{-- <span class="sr-only">Previous</span>--}}
    {{-- </a>--}}
    {{-- <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">--}}
    {{-- <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
    {{-- <span class="sr-only">Next</span>--}}
    {{-- </a>--}}
    {{-- </div>--}}
    <!-- pages -->
    <div class="container">
        <ul class="page_refs">
              @foreach($courses['data'] as $course)
            <li>
                <a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&price=high') }}">
                    <h6>{{ $course['name'] }}</h6>
                    <p class="mb-0">ENROLL NOW<i class="fa fa-chevron-right"></i></p>
                </a>
            </li>
            @endforeach
            <!-- <li>
                <a href="">
                    <h6>CS</h6>
                    <p class="mb-0">ENROLL NOW<i class="fa fa-chevron-right"></i></p>
                </a>
            </li>
            <li>
                <a href="">
                    <h6>JUNIOR COLLEGE(MH)</h6>
                    <p class="mb-0">ENROLL NOW<i class="fa fa-chevron-right"></i></p>
                </a>
            </li> -->
        </ul>
    </div>
    <!-- pages -->
    <div class="counter">
        <div class="container count">
            @php
            $counts = explode('|',$file_data);
            @endphp
            <div class="first">
                <h1>{{@$counts[0]}}+</h1>
                <p>Courses Purchased</p>
            </div>
            <span class="v-line"></span>
            <div class="second">
                <h1>{{@$counts[1]}}+</h1>
                <p>Students Enrolled</p>
            </div>
            <span class="v-line hide"></span>
            <div class="second">
                <h1>{{@$counts[2]}}+</h1>
                <p>Uploaded Videos</p>
            </div>
            <span class="v-line"></span>
            <div class="second">
                <h1>{{@$counts[3]}}+</h1>
                <p>Listed Courses</p>
            </div>
        </div>
    </div>

    <!--  -->
   {{-- <div class="access">
        <img src="{{ asset('assets/new_ui_assets/images/web_banner.jpg') }}" loading="lazy" alt="" />
         <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-7">
        <!-- <h1>Now Access Classes from Anywhere, Anytime</h1> -->
        <a href="{{ route('packages.index') }}" class="btn all-course">View All Courses</a>
    </div>
</div>
</div> --}}
<div class="container pt-1 pb-4">
    <div class="choose-us">
        <h1>Why Choose Us</h1>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/ALL SUBJECTS UNDER ONE ROOF.png') }}" alt="">
                        <span>All Subjects Under One Roof</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/HD STUDIO RECORDED LECTURES.png') }}" alt="">
                        <span>HD Studio Recorded Lectures</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/CHOICE OF PROFESSOR.png') }}" alt="">
                        <span>Choice Of Professor</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/CHOICE OF LANGUAGE.png') }}" alt="">
                        <span>Choice Of Language</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/SEAMLESS STREAMING ACROSS ALL DEVICES.png') }}" alt="">
                        <span>Seamless Streaming Across All Devices</span>
                    </div>
                    
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/OPT ANY CHAPTER, SUBJECT.png') }}" alt="">
                        <span>Opt Any Chapter, Subject</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/UNIQUE LECTURE FORMAT.png') }}" alt="">
                        <span>Unique Lecture Format</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/UNIFIED SYSTEM FOR DOUBT SOLVING.png') }}" alt="">
                        <span>Unified System for Doubt Solving</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <a href="/about-us">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/PERSONALISED STUDY PLAN.png') }}" alt="">
                        <span>Personalised Study Plan</span>
                    </div>
                </a>
            </div>
            <!-- <div class="col-lg-3 col-md-4 col-sm-12">
                    <a href="/about-us">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/wcu-1.png') }}" alt="">
                            <span>Multiple Payment Options</span>
                        </div>
                    </a>
                </div>                -->
        </div>
    </div>
</div>
<div class="explore" id="explore">
    <div class="container ">
        <h1>Explore most popular Courses</h1>
        <p class="base-title">Best online video lectures for CA</p>
        <!-- <div class="row" data-aos="fade-up">
                 <ul class="nav" id="pills-tab" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link active" id="showall-tab" data-toggle="pill" href="#showall" role="tab"
                             aria-controls="showall" aria-selected="true">Show All</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="healthcare" data-toggle="pill" href="#health" role="tab"
                             aria-controls="health" aria-selected="false">CA Foundation</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="voip" data-toggle="pill" href="#voips" role="tab"
                             aria-controls="voip" aria-selected="false">CA Full Course</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="e-learning" data-toggle="pill" href="#learning" role="tab"
                             aria-controls="learning" aria-selected="false">CA Final</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="mobile" data-toggle="pill" href="#mobile-tech" role="tab"
                             aria-controls="mobile" aria-selected="false">CA Final Lecture wise</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="fy-jc" data-toggle="pill" href="#fyjc" role="tab"
                             aria-controls="fy-jc" aria-selected="false">FYJC</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="sy-jc" data-toggle="pill" href="#syjc" role="tab"
                             aria-controls="sy-jc" aria-selected="false">SYJC</a>
                     </li>
                 </ul>
             </div> -->
        <div id="course-slider" class="owl-carousel owl-theme">

            @foreach($sections as $key => $section)
            @if($loop->first)
            <div class="item">
                <a class="course-active" id="showall-tab" data-toggle="pill" href="#showall" role="tab" aria-controls="showall" aria-selected="true">{{ $section['name'] }}</a>
            </div>
            @else
            <div class="item @if($loop->first) course-active @endif">
                <a class="showSingle" target="{{ $key+1 }}">{{ $section['name'] }} </a>
            </div>
            @endif
            @endforeach
        </div>
        <div class="container">
            <div class="tab-content" id="pills-tabContent">
                <div id="loader-orange" style="padding-bottom: 30px;">
                    <img src="{{ asset('dist/images/loader-orange.gif') }}" id="image-orange">
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('packages.index') }}" class="btn all-course">View All Courses</a>
</div>

<div class="faculty">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="grid">
                <ul id="list-hexa">
                    @foreach($professors as $professor)
                    @if ($loop->index <= 13) <li class="content-hex">
                        <div class="hexIn">
                            <a class="hexLink" href="{{ route('ca-faculty.show', $professor['id']) }}">
                                <div class='img' style='background-image: url({{$professor['image'] ?? 'assets/images/avatar.png'}});'>
                                </div>
                                <h1 id="demo1">{{ $professor['name'] }}</h1>
                                <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                        </li>
                        @endif
                        @endforeach

                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-2.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-3.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-4.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-5.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-6.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-3.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-6.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-4.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}

                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image:url(assets/new_ui_assets/images/p-1.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-2.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-2.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-1.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                        {{-- <li class="content-hex">--}}
                        {{-- <div class="hexIn">--}}
                        {{-- <a class="hexLink" href="#">--}}
                        {{-- <div class='img' style='background-image: url(assets/new_ui_assets/images/p-3.png);'>--}}
                        {{-- </div>--}}
                        {{-- <h1 id="demo1">Mayuresh Kunkalienkar</h1>--}}
                        {{-- <i id="prof-details" class="fa fa-arrow-right" aria-hidden="true"></i>--}}
                        {{-- </a>--}}
                        {{-- </div>--}}
                        {{-- </li>--}}
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="prof">
                <div class="prof-content">
                    <h1>Our CA Faculty Members/Professors</h1>
                    <a href="{{ route('ca-faculty.index') }}" class="btn all-prof">View All Professors</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
@if($testimonials)
<div class="testimonials">
    <h3 class="testimonial_title">Testimonials</h3>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme" id="testimonials">
            @foreach($testimonials as $testimonial)
            <div class="item">
                <div class="testimonial-info">
                    <div class="testimonial-profile">
                        <img src="{{ $testimonial['image'] ?? url('/assets/images/avatar.png') }}">
                    </div>
                    <div class="testimonial-inner">
                        <h5 class="name">{{$testimonial['name']}}</h5>
                        <div class="testimonial-content">
                            <p>{{substr($testimonial['testimonial'],0,140)}} <a href="{{url('/testimonials')}}" style="color:#e78c60;font-weight:bold;">...READ MORE</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endif

<!-- Testimonials -->



{{-- <div class="process">
        <div class="row">
            <div class="col-lg-5 col-md-5 cl-sm-12">
                <div class="teaching">
                    <h1>Our Teaching Process</h1>
                    <ul>
                        <li>
                            <span>
                                <img src="{{asset('assets/new_ui_assets/images/concept-based.png') }}" alt="">
</span>
<p>Concept Based - Teaching Technique</p>
</li>
<li class="odd">
    <p>No Video Lectures, Only Live Lectures</p>
    <span>
        <img src="{{asset('assets/new_ui_assets/images/only-live.png') }}" alt="">
    </span>
</li>
<li>
    <span>
        <img src="{{asset('assets/new_ui_assets/images/timely.png') }}" alt="">
    </span>
    <p>Timely Completion Of Syllabus</p>
</li>
<li class="odd">
    <p>Comprehensive Test Series</p>
    <span>
        <img src="{{asset('assets/new_ui_assets/images/comprehensive.png') }}" alt="">
    </span>
</li>
</ul>
</div>
</div>
<div class="col-lg-1 col-md-1 cl-sm-12">
    <div class="line text-center">
        <span class="v-line"></span>
    </div>
</div>
<div class="col-lg-5 col-md-5 cl-sm-12">
    <div class="doubts">
        <h1>Solve Your Doubts Easily</h1>
        <ul>
            <li>
                <span>
                    <img src="{{asset('assets/new_ui_assets/images/teachers.png') }}" alt="">
                </span>
                <p>Qualified Teachers</p>
            </li>
            <li class="odd">
                <p>Highest No. Of College And Board Toppers</p>
                <span>
                    <img src="{{asset('assets/new_ui_assets/images/toppers.png') }}" alt="">
                </span>
            </li>
            <li>
                <span>
                    <img src="{{asset('assets/new_ui_assets/images/seminars.png') }}" alt="">
                </span>
                <p>Seminar By Experts For Career Guidance</p>
            </li>
            <li class="odd">
                <p>24x7 Helpline For Last Minute Query</p>
                <span>
                    <img src="{{asset('assets/new_ui_assets/images/helpline.png') }}" alt="">
                </span>
            </li>
        </ul>
    </div>
</div>
</div>
</div> --}}

{{-- <div class="modal fade" id="dhoom" tabindex="-1" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
       <img src="{{asset('assets/new_ui_assets/images/dandiya.jpg')}}" class="w-100" alt="">
</div>
</div>
</div>
</div>--}}

<!-- Footer -->
@endsection
@push('script')
<script>
    $(window).on("load", function() {
        @if($flag == true)
        $("#modal-signup").modal('show');
        @endif
        $('#loader-orange').show();
        $.ajax({
            type: 'get',
            url: '{{ route('getPopularCourses') }}',
            data: {
                '_token': '{{ csrf_token() }}',
            },
            success: function(response) {
                $('#loader-orange').hide();
                $("#pills-tabContent").html(response);
                $('#showall-tab').click();
            }
        });

    });
    $(document).ready(function() {
        $(".join-today-btn").click(function(e) {
            e.preventDefault();
            $("#modal-signup").modal('show');
        });

        $('.buy-now-login').click(function(e) {
            e.preventDefault();
            var packageID = $(this).attr('data-package');
            $("#package-id").val(packageID);
            $(this).removeClass('is-active');
            $("#login-modal").show();
        });

        $('.cart-save-for-later').click(function() {
            let packageID = $(this).attr('data-id');
            if ($(this).hasClass("is-active")) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('save-for-later.remove') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'package_id': packageID
                    },
                    success: function(response) {
                        if (response.exist == 1) {
                            $("#toast-exist-in-wishlist").toast('show');
                        } else {
                            $('#toast-save-for-later').toast('show');
                        }
                    }
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('save-for-later.remove') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'package_id': packageID
                    },
                    success: function(response) {
                        if (response) {
                            $("#toast-remove-wishlist").toast('show');
                        }
                    }
                });
            }
        });


    });

    // $(document).ready(function () {
    //     $('#dhoom').modal();
    // });
</script>
@endpush