@extends('layouts.master')

@section('title', 'Home')

@push('meta-tags')
    <meta property="og:url" content="https://online.jkshahclasses.com/">
    <meta property="og:image" content="https://online.jkshahclasses.com/assets/images/logo.png">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="CA Inter - Professional CA Online Coaching Classes In Mumbai | JK Shah Online">
    <meta property="og:locale" content="en-IN">
    <meta property="og:title" content="CA Inter - Professional CA Online Coaching Classes In Mumbai | JK Shah Online"/>
    <meta property="og:description" content="JK Shah is India's No.1 Commerce & CA coaching classes since 1983. Our online platform offers students to get the best CA Final & Inter CA coaching, live doubt solving sessions, personalised study plans & more. Enrol Now!"/>
    <meta property="og:country-name" content="in"/>
@endpush

@section('content')
    <main role="main">
        <div id="carouselExampleIndicators" class="carousel slide bg-primary-half bg-left" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($banners as $id => $banner)
                    <div class="carousel-item @if ($id == 0) active @endif">

                        <img src="{{ $banner['image_url'] }}" class="d-block w-100" alt="{{ $banner['alt'] }}">

                        @if($banner['youtube_id'] != '')

                            <div class="position-absolute w-100 d-flex align-items-center "
                                 style="top: 0; bottom: 0; left: 0;">

                                <div class="container-fluid px-lg-4 py-3">
                                    <div class="row justify-content-start">
                                        <div class="col-md-4">
                                            <div class="card bg-dark border border-white border-radius text-white shadow-lg" style="border-width: 4px !important;">
                                                <img class="img-fluid border-radius w-100" src="https://img.youtube.com/vi/{{$banner['youtube_id']}}/mqdefault.jpg">
                                                <div class="card-img-overlay" >
                                                    <a class="rounded-circle text-center bg-primary text-light
                                                border border-primary-400 popup-youtube"
                                                       href="http://www.youtube.com/watch?v={{$banner['youtube_id']}}"
                                                       style="position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
                                                   width: 60px; height: 60px; line-height: 60px;">
                                                        <i class="fas fa-play fa-1x"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="carousel-caption d-none d-md-block">
                            <h1><a class="text-decoration-none text-secondary mt-3" target="_blank" href="{{$banner['title_url']}}">{{$banner['title']}}</a> </h1>
                        </div>
                    </div>
                @endforeach
            </div>

            {{--            <div class="position-absolute w-100 d-none d-md-flex align-items-end"--}}
            {{--                             style="top: 0; bottom: 50px; left: 0; pointer-events: none;">--}}
            {{--                <div class="container-fluid">--}}
            {{--                    <div class="row justify-content-end">--}}
            {{--                        <div class="col-md-4">--}}
            {{--                            <div class="card bg-dark text-white" style="border-radius: 15px; pointer-events: auto;">--}}
            {{--                                <div class="card-body">--}}
            {{--                                    <h4>What Do You Want to Learn Today?</h4>--}}
            {{--                                    <div class="form-group mt-4">--}}
            {{--                                        <div class="input-group" style="border-radius: 10px; !important;">--}}
            {{--                                            <input  id="search-input-home"   type="text" class="form-control border-0" placeholder="Search..."--}}
            {{--                                                    aria-label="Search..." aria-describedby="basic-addon2">--}}
            {{--                                            <div class="input-group-append">--}}
            {{--                                            <span  class="input-group-text bg-white text-primary search-btn"><i--}}
            {{--                                                        class="fa fa-search"></i></span>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        --}}{{--                                                    <!--<input type="text" class="form-control" placeholder="Search..." style="border-radius: 10px; !important;">-->--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="" style="height: 30px;">
                <ol class="carousel-indicators carousel-indicators-circle my-2">
                    @foreach($banners as $id => $banner)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $id }}" class="@if ($id == 0) active @endif"></li>
                    @endforeach
                </ol>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        @if($preBookCourses['data'])
            <section class="bg-primary-half bg-right">
                <div class="container-fluid py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mr-auto ml-5 mb-0 text-secondary">Pre Book Courses</h3>
                        </div>
                        {{--<div class="col-auto">--}}
                        {{--<a href="{{ url('packages?package_type=pre-book')}}" class="text-white mr-5">view more <i class="fas fa-chevron-right"></i></a>--}}
                        {{--</div>--}}
                    </div>
                    <div class="mx-5">
                        @if (isset($user['role']) &&  $user['role'] == 6)
                            @include('includes.associate-pre-book-carousel', ['packages' => $preBookCourses])
                        @else
                            @include('includes.prebook-packages-carousel', ['packages' => $preBookCourses])
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if($crashCourses['data'])
            <section class="bg-primary-half bg-right">
                <div class="container-fluid py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="mr-auto ml-5 mb-0 text-secondary custom-package">Online CA Coaching Classes</h1>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('packages?package_type=crash')}}" class="text-white mr-5">view more <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="mx-5">
                        @if (isset($user['role']) &&  $user['role'] == 6)
                            @include('includes.associate-crash-packages-carousel', ['packages' => $crashCourses])

                        @else
                            @include('includes.crash-packages-carousel', ['packages' => $crashCourses])
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if($packages['data'])
            <section class="bg-primary-half bg-right">
                <div class="container-fluid py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="mr-auto ml-5 mb-0 text-secondary custom-package">Courses</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('packages/')}}" class="text-white mr-5">view more <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="mx-5">
                        @if (isset($user['role']) && $user['role'] == 6)
                            @include('includes.associate-packages-carousel', ['packages' => $packages])
                        @else
                            @include('includes.packages-carousel', ['packages' => $packages])
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if($miniPackages['data'])
            <section class="bg-primary-half bg-right">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col">
                            <h2 class="mr-auto ml-5 mb-0 text-secondary custom-package">Chapters of CA Final & CA Inter Groups 1 & 2</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('packages?package_type=mini')}}" class="text-white mr-5">view more <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="mx-5">
                        @if (isset($user['role']) &&  $user['role'] == 6)
                            @include('includes.associate-mini-packages-carousel', ['packages' => $miniPackages])
                        @else
                            @include('includes.mini-packages-carousel', ['packages' => $miniPackages])
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{--  @if(isset($event))
          <section class="bg-primary-half bg-right">
              <div class="container-fluid py-3">
                  <div class="row">
                      <div class="col">
                          <h2 class="mr-auto ml-5 mb-0 text-secondary custom-package">Quiz</h2>
                      </div>
                      <div class="col-auto">
                          <!-- <a href="{{ url('packages?package_type=mini')}}" class="text-white mr-5">view more <i class="fas fa-chevron-right"></i></a> -->
                      </div>
                  </div>
                  <div class="mx-5">
                      @foreach($event as $key=>$events)
                      <a class="btn btn-sm btn-primary text-nowrap" role="button" href="{{ url('/test/'.$events->id)}}" class="text-secondary mr-5">{{$events->name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;

                      @endforeach
                  </div>
              </div>
          </section>
          @endif  --}}

        <section class="bg-primary-half bg-right bg-secondary-alpha-10">
            <div class="container-fluid py-3">
                <div class="row">
                    <div class="col">
                        <h2 class="mr-auto ml-5 text-secondary custom-package">CA Faculty / Professors</h2>
                    </div>
                </div>
                <div class="mx-5">
                    <div id="carousel-professors" class="owl-carousel owl-theme clearfix">
                        @foreach($professors as $professor)
                            <div class="item">
                                <div class="mx-2 mt-3 mb-4">
                                    <div class="d-flex justify-content-center align-items-start px-2">
                                        <img src="{{ $professor['image'] ?? 'assets/images/avatar.png' }}" class="img-thumbnail shadow mx-5" alt="{{ $professor['alt'] }}" title="{{ $professor['title_tag'] }}">
                                    </div>
                                    <div class="bg-white p-4 shadow"
                                         style="margin-top: -20px; z-index: 1; position: relative;">
                                        <a href="{{ route('ca-faculty.show', $professor['id']) }}"><h5 class="card-title">{{ $professor['name'] }}</h5></a>
                                        <span>{{ $professor['experience'] }} Years</span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        @if ($professor['rating'] && $professor['rating'] > 0)
                                            <span class="bg-dark text-white py-1 px-3 position-relative"
                                                  style="border-radius: 16px; margin-top: -16px; z-index: 2;">
                                                <i class="fa fa-star text-warning"></i> {{ $professor['rating'] }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-primary-half bg-right">
            <div class="container py-3">
                <div class="bg-white p-4 shadow">
                    <h2 class="text-primary text-center custom-package">Why Learn on JK Shah Online?</h2>

                    <div class="row">
                        <div class="col-1 d-none d-md-block"></div>
                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/ALL_SUBJECTS_UNDER_1roof.jpg') }}" alt="All CA Subjects Under One Roof - JK Shah Online" title="All CA Subjects Under One Roof - JK Shah Online">
                                </a>
                            </div>
                            <span class="mt-2 text-center">All subjects under one roof</span>
                        </div>

                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/CHOICE-OF-LANGUAGE.jpg') }}" alt="Choice Of Language For CA Online Lectures" title="Choice Of Language For CA Online Lectures">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Choice of language</span>

                        </div>

                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/LECTURES-RECORDED-SPECIALLY.jpg') }}" alt="Online Video Lectures Recorded Specially" title="Online Video Lectures Recorded Specially">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Lectures recorded specially</span>
                        </div>

                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/OPT-FOR-ANY-GROUP.jpg') }}" alt="Opt For Any Group - JK Shah Online" title="Opt For Any Group">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Opt for any group</span>
                        </div>

                        <div class="col-1 d-none d-md-block"></div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-sm-8 col-md-6">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/INOmyr9E7fs?rel=0"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-1 d-none d-md-block"></div>
                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img  title="Personlised Study Plan For CA Final & Inter Exams" alt="Personlised Study Plan For CA Final & Inter Exams - JK Shah " src="{{ url('assets/images/PERSONALISED-STUDY-PLAN.jpg') }}">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Personalised study plan</span>
                        </div>

                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/REGULAR-TESTS.jpg') }}" alt="Regular CA Tests - JK Shah Online" title="Regular CA Tests">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Regular Tests</span>
                        </div>

                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/STREAM-ON-ANY-DEVICE.jpg') }}" alt="Stream Online CA Lectures On Any Device" title="Stream Online CA Lectures On Any Device">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Stream on any device</span>
                        </div>

                        <div class="col-6 col-md mt-4 d-flex flex-column align-items-center">
                            <div class="border text-center">
                                <a href="{{url('about-us')}}">
                                    <img src="{{ url('assets/images/UNIQUE-LECTURE-FORMAT.jpg') }}" alt="Unique Online CA Lecture Format - JK Shah Online" title="Unique Online CA Lecture Format">
                                </a>
                            </div>
                            <span class="mt-2 text-center">Unique lecture format</span>
                        </div>

                        <div class="col-1 d-none d-md-block"></div>
                    </div>

                    {{--<div class="row pt-4">--}}
                    {{--<div class="col-1 d-none d-md-block"></div>--}}
                    {{--<div class="col-6 col-md mt-4 d-flex flex-column align-items-center">--}}
                    {{--<h5 class="text-center text-primary">18657</h5>--}}
                    {{--<span class="mt-2 text-center">Happy Students</span>--}}
                    {{--</div>--}}

                    {{--<div class="col-6 col-md mt-4 d-flex flex-column align-items-center">--}}
                    {{--<h5 class="text-center text-primary">18657</h5>--}}
                    {{--<span class="mt-2 text-center">Hours of Live Learning</span>--}}
                    {{--</div>--}}

                    {{--<div class="col-6 col-md mt-4 d-flex flex-column align-items-center">--}}
                    {{--<h5 class="text-center text-primary">18657</h5>--}}
                    {{--<span class="mt-2 text-center">Cities Worldwide</span>--}}
                    {{--</div>--}}

                    {{--<div class="col-6 col-md mt-4 d-flex flex-column align-items-center">--}}
                    {{--<h5 class="text-center text-primary">18657</h5>--}}
                    {{--<span class="mt-2 text-center">Avg. Teacher Rating</span>--}}
                    {{--</div>--}}

                    {{--<div class="col-1 d-none d-md-block"></div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </section>

        @if (count($testimonials) > 0)
            <section class="student-testimonial-section bg-primary-half-md bg-right">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col">
                            <h3 class="mr-auto ml-5 text-secondary">Testimonials</h3>
                        </div>
                    </div>
                </div>
                <div class="container-fluid diamond-background">
                    <div class="mx-5">
                        <div id="carousel-testimonials" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators carousel-indicators-circle-sm">
                                <li class="border-white active" data-target="#carousel-testimonials" data-slide-to="0">
                                </li>
                                <li class="border-white" data-target="#carousel-testimonials" data-slide-to="1"></li>
                                <li class="border-white" data-target="#carousel-testimonials" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner pb-3">
                                @foreach($testimonials as $testimonial)
                                    <div class="carousel-item @if($loop->first) active @endif ">
                                        <div class="card-student-testimonial">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="card-student-testimonial-rectangle-background"></div>
                                                </div>
                                                <div class="col-md-4 d-flex justify-content-center align-items-start justify-content-md-end">
                                                    <div class="card-student-testimonial-image">
                                                        <img src="{{ $testimonial['image'] ?? url('/assets/images/avatar.png') }}"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 text-white">
                                                    <blockquote class="blockquote">
                                                        <i class="fa fa-quote-left"></i>
                                                        <p class="mb-0 ml-4">{{ $testimonial['testimonial'] }}</p>
                                                        <i class="fa fa-quote-right fa-pull-right"></i>
                                                        <div class="clearfix mb-3"></div>
                                                        <footer class="blockquote-footer text-white text-right">{{ $testimonial['name']}}</footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{--        @include('includes.back-to-top')--}}
        {{--        @include('includes.call-me')--}}
    </main>
    <div id="modal-reminder" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-secondary">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 p-3">
                            <div class="text-center">
                                <i class="fas fa-tools fa-2x text-center text-white mb-3"></i>
                            </div>
                            <h5 class="text-white text-center">Dear Students, We will be under maintenance on Sunday, 31st Jan 2021 starting from 8:00 PM to Monday, 1st Feb 2021 6:00 AM. The site will not be available during this period. We regret the inconvenience.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {

            // if (! localStorage.getItem('downtime-reminder')) {
            //     $('#modal-reminder').modal('toggle');
            //
            //     $('#modal-reminder').on('hidden.bs.modal', function () {
            //         localStorage.setItem('downtime-reminder', 'true');
            //     });
            // }

            $('#carousel-professors').owlCarousel({
                margin: 10,
                loop: false,
                nav: true,
                dots: false,
                navText: [
                    '<i class="fa fa-chevron-left">',
                    '<i class="fa fa-chevron-right">'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                }
            });

            $('.btn-add-to-cart').click(function (e) {
                e.preventDefault();

                var url = '{{ url('cart') }}';
                var packageId = $(this).data('id');

                $.post(url, {
                    package_id: packageId
                }).done(function (data) {

                    if (!data.data) {
                        $('#toast-already-exist').toast('show');
                    } else {
                        $('#toast-added-to-cart').toast('show');
                    }
                    $('body').trigger('change.cart');

                }).fail(function () {
                    alert("Error while adding to cart");
                });
            });

            /* $('.cart-save-for-later').click(function () {
                 alert('asdas');
                 let packageID = $(this).data('id');

                 $.ajax({
                     type:'POST',
                     url:'{{ route('save-for-later.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'package_id': packageID
                    },
                    success:function(data) {
                        if (!data) {
                            $('#toast-already-exist').toast('show');
                        } else {
                            $('#toast-save-for-later').toast('show');
                        }
                    }
                });
            });*/

            {{--$('.buy-now').click(function (e) {--}}
            {{--e.preventDefault();--}}

            {{--var url = '{{ url('cart') }}';--}}
            {{--var packageId = $(this).data('id');--}}
            {{--$.post(url, {--}}
            {{--package_id: packageId--}}
            {{--}).done(function (data) {--}}
            {{--if (!data.data) {--}}
            {{--$('#toast-already-exist').toast('show');--}}
            {{--} else {--}}
            {{--$('#toast-added-to-cart').toast('show');--}}
            {{--}--}}

            {{--$('body').trigger('change.cart');--}}
            {{--}).fail(function () {--}}
            {{--alert("Error while adding to cart");--}}
            {{--});--}}
            {{--});--}}


            $('.search-btn').click(function () {

                var search = $('#search-input').val();
                var url = '{{ url('packages?search=') }}'+search;
                window.location.href = url;
            });

        });

        $(function() {
            $(".carousel").on("slide.bs.carousel", function(e) {
                var prev = $(this)
                    .find(".active")
                    .index();
                var next = $(e.relatedTarget).index();
                var video = $("#video-player")[0];
                var videoSlide = $("#video-player")
                    .closest(".carousel-item")
                    .index();
                if (next === videoSlide) {
                    if (video.tagName == "IFRAME") {
                        player.playVideo();
                    } else {
                        createVideo(video);
                    }
                } else {
                    if (typeof player !== "undefined") {
                        player.pauseVideo();
                    }
                }
            });
        });

        function createVideo(video) {
            var youtubeScriptId = "youtube-api";
            var youtubeScript = document.getElementById(youtubeScriptId);
            var videoId = video.getAttribute("data-video-id");

            if (youtubeScript === null) {
                var tag = document.createElement("script");
                var firstScript = document.getElementsByTagName("script")[0];

                tag.src = "https://www.youtube.com/iframe_api";
                tag.id = youtubeScriptId;
                firstScript.parentNode.insertBefore(tag, firstScript);
            }

            window.onYouTubeIframeAPIReady = function() {
                window.player = new window.YT.Player(video, {
                    videoId: videoId,
                    playerVars: {
                        autoplay: 1,
                        modestbranding: 1,
                        controls:0,
                        disablekb:1,
                        playerVars: {rel: 0, showinfo: 0, ecver: 2},
                        rel: 0
                    }
                });
            };
        }
    </script>
@endpush
