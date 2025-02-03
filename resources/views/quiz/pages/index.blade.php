@extends('frontend.master-old_layouts.master')

@section('title')
@endsection

{{--SEO Tags--}}

@section('og_title')
@endsection
@section('og_url')
@endsection
@section('og_description')
@endsection
@section('og_image')
@endsection

@section('twitter_title')
@endsection
@section('twitter_site')
@endsection
@section('twitter_description')
@endsection
@section('twitter_image')
@endsection

{{--End SEO Tags--}}

@push('styles')
@endpush

@section('content')
     <main role="main" class="main-section">
        <section class="banner-part">
            <div class="container-fluid p-0">
                <div class="row ">
                    <div class="col-sm-10 ">
                        <img src="/dist/images/Banner-01.png" class="img-fluid">
                    </div>
                    <div class="col-sm-2">
                        <div class="brnr-right yellow-bg">
                            <ul class="list-unstyled d-flex justify-content-center flex-column text-center">
                                <li>
                                    <div class="videocover">
                                        <div class="video-part text-center">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="videocover">
                                        <div class="video-part text-center">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="videocover">
                                        <div class="video-part image-place text-center">
                                            <img src="dist/images/image01.png">
                                        </div>
                                    </div>
                                    <div class="imgtxt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="anouncment grey-bg">
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <h2>Announcement</h2>
                    </div>
                    <div class="owl-carousel owl-theme" id="announcement-slider">
                        <div class="item">
                            <img src="dist/images/image02.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image03.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image04.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image05.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image06.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image07.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image03.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image04.png">
                        </div>
                        <div class="item">
                            <img src="dist/images/image05.png">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="archivement grey-bg">
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <h2>Archievement</h2>
                    </div>
                    <div class="owl-carousel owl-theme" id="archievement-slider">
                        <div class="item">
                            <div class="archiveinner">
                                <div class="archiveimg">
                                    <img src="dist/images/image06.png">
                                </div>
                                <div class="archivetext">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="archiveinner">
                                <div class="archiveimg">
                                    <img src="dist/images/image06.png">
                                </div>
                                <div class="archivetext">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="archiveinner">
                                <div class="archiveimg">
                                    <img src="dist/images/image06.png">
                                </div>
                                <div class="archivetext">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="archiveinner">
                                <div class="archiveimg">
                                    <img src="dist/images/image06.png">
                                </div>
                                <div class="archivetext">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="archiveinner">
                                <div class="archiveimg">
                                    <img src="dist/images/image06.png">
                                </div>
                                <div class="archivetext">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="archiveinner">
                                <div class="archiveimg">
                                    <img src="dist/images/image06.png">
                                </div>
                                <div class="archivetext">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!---------14 jan 2021 starts------->
        <section class="quizsection">
            <div class="container-fluid">
                <h2>Quiz</h2>
             <div class="quizsection-wrapper">
                <div class="card practice">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-7 col-12 quiz-content order-2">
                                <div class="quiz-heading">  <a style="color: white" href="practice">Practice</a></div>
                                <div class="text-left quiz-description">
                                 <ul>
                                    <li>Covering entire syllabus in the form of MCQs</li>
                                    <li>Practice more to learn more</li>
                                    <li>   Perform well and get your name on the leader board</li>
                                    <li>Subject wise and class wise quizzes available </li>
                                    <li>Quizzes in Science, Maths, Social Science, English, GK and Computer Science</li>
                                    <li>Analyze your learning, preparation  and performance easily</li>
                                 </ul>

                                 </div>
                            </div>

                            <div class="col-md-5 col-12 order-1 order-md-2">
                                <img src="dist/images/q1.png" class="img-responsive" alt="q1" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quizsection-wrapper">
                <div class="card live-quiz">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 col-12 quiz-content order-2">
                                <div class="quiz-heading">Live Quiz</div>
                                <div class="quiz-description">
                                    <ul>
                                        <li>  NCERT and CBSE based live quiz sessions</li>
                                        <li>   MCQ-based engaging quizzes </li>
                                        <li>   Enthralling, short, real-time quizzes to evaluate and enhance speed and accuracy</li>
                                        <li>   Provide practice for examinations </li>
                                        <li>   A quick method to assess knowledge and check preparation of students</li>
                                        <li>   For classes 6-12</li>
                                        <li>   Evaluate your standing in competition</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col-md-5 col-12 order-1 order-md-1">
                                <img src="dist/images/q2.png" class="img-responsive" alt="q1" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quizsection-wrapper">
                <div class="card olympiad">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 col-12 quiz-content order-2">
                                <div class="quiz-heading">Olympiad</div>
                                <div class="text-left quiz-description">
                                   <ul>
                                       <li>   National level Olympiad for students</li>
                                        <li>  A multilevel contest to check your knowledge</li>
                                        <li>  Get a chance to perform on national stage</li>
                                        <li>   Win big rewards </li>
                                   </ul>
                                </div>
                            </div>
                            <div class="col-md-5 col-12 order-1 order-md-2">
                                <img src="dist/images/q3.png" class="img-responsive" alt="q1" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--------------14 jan 2021 ends----------->

        <!---------previous quiz section start------->
        <!-- <section class="quizsection">
            <div class="conteiner">
                <div class="row">
                    <img src="dist/images/quiz-section.png">
                </div>
        </section> -->
        <!--------------previous quiz section start----------->

        <section class="reeachplatform">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 section-title text-center">
                        <h2>Reach of the Platform</h2>
                    </div>
                </div>
                <div class="platform-sec">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="dist/images/icon5.png">
                                </div>
                                <div class="plattext">
                                    <h4>Students</h4>
                                    <h2>1590</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="dist/images/icon6.png">
                                </div>
                                <div class="plattext">
                                    <h4>Teachers</h4>
                                    <h2>67</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="dist/images/icon4.png">
                                </div>
                                <div class="plattext">
                                    <h4>Schools</h4>
                                    <h2>657</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="dist/images/icon1.png">
                                </div>
                                <div class="plattext">
                                    <h4>Live Quizzes</h4>
                                    <h2>1590</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="dist/images/icon3.png">
                                </div>
                                <div class="plattext">
                                    <h4>Quizzes</h4>
                                    <h2>1590</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="dist/images/icon2.png">
                                </div>
                                <div class="plattext">
                                    <h4>Olympiad</h4>
                                    <h2>657</h2>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial">
            <div class="container">
                <div class="row">
                    <div class="testimonial-innersec">
                        <div class="section-title">
                            <h2>Testimonial</h2>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="col-sm-6">
                                <div class="owl-carousel owl-theme" id="testimonial-slider">
                                    <div class="item">
                                        <div class="testinner">
                                            <div class="testimg">
                                                <img src="dist/images/image08.png">
                                            </div>
                                            <div class="test-text">
                                                <h3>Lorem ipsum</h3>
                                                <p>The mid-section is to showcase the achievements of the solution and how this platform is helping the students. The prompt to select the role and grade will appear .</p>
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
        </section>
    </main>
@endsection

@push('scripts')
@endpush
