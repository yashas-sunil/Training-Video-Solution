{{--{{ dd(Session::get('power_slug')) }}--}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content=" ">
    <meta name="generator" content=" ">
    <title>Quiz</title>
    <!-- Bootstrap core Font Awsome and Slider CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('dist/css/screen.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/responsive.css') }}" rel="stylesheet">
    <style>
        .clk {
            -moz-box-shadow:
                0px 1px 1px rgba(000,000,000,0.5),
                inset 1px 2px 0px rgba(255,255,255,0.4);
            -webkit-box-shadow:
                0px 1px 1px rgba(000,000,000,0.5),
                inset 1px 2px 0px rgba(255,255,255,0.4);
            box-shadow:
                0px 1px 1px rgba(000,000,000,0.5),
                inset 1px 2px 0px rgba(255,255,255,0.4);
        }.clk:active {
            box-shadow: 0 0 5px -1px rgba(0,0,0,0.6);
        }

         .custom-radio{
             display: contents;
         }
         label{
             display: block;
             margin-bottom: 0rem;
         }

        .option-hover{
            background-image: url({{ asset('dist/images/Box_purple.png') }});
        }

         .option-hover:hover{
             background-image: url({{ asset('dist/images/Box_blue.png') }});
         }
    </style>
</head>

<body class="prectice-page" style="background-image:url({{ asset('dist/images/Base_BG_new.png') }});background-position: top center; background-size: cover; background-repeat: no-repeat;">
<!--Header Part-->
<header class="navbar header2 main-header d-flex  align-items-lg-baseline">


    <div class="container">
        <div class="row">
            <div class="practicenuber col-sm-1">
                <div class="pracnuminner">{{ $Attempted + 1 }}/{{ count($userTest->getUserQuestions) }}</div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="col-sm-11 d-flex justify-content-center">
                <nav class="main-nav2 navbar-expand-md  ">
                    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                        <ul class="navbar-nav ml-auto mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link"  style="color: white;">{{ $userQuestion->getQuestion->getSubject->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;">{{ $userQuestion->getQuestion->getChapter->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  style="color: white;">{{ $userQuestion->getUserTest->getTest->name }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>



<main role="main" class="main-section">
    <section class="top-scorebar">
        <div class="container">
            <div class="row">
                <div class=" col-sm-12 scorebox-time d-flex align-items-sm-center justify-content-between">
                    <div class="score-box">
                        <div class="score-inner" style="background-image: url({{ asset('dist/images/Score-box.png') }});">{{ $score }}</div>
                    </div>
                    <div class="progress-value">

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="question-main-sec">
        <div class="container">
            <div class="row d-flex justify-content-center ">
                <div class="col-sm-9">
                    <div class="qustion-titlle">
                        <div class="qustion-box d-flex align-items-center">
                            <div class="qustion-number">{{ $Attempted + 1 }}</div>
                            <div class="qustion-text">{!! $userQuestion->getQuestion->question !!}
                                {!! $userQuestion->getQuestion->question_desc !!}
                            </div>
                        </div>
                    </div>
                    <div class="qustionnote text-center">
                        <em>Instruction text - {!! $userQuestion->getQuestion->getInstruction->description !!}</em>
                    </div>
                </div>
                <div class="col-sm-11 qutionoption">
                    <div class="qutionoption-main-inner">
                        <div class="row">
                            @php
                            $a = array("Box_green", "Box_blue", "Box_red", "Box_purple");
                            @endphp
                            @if($test->ans_ordered == 1)
                                @php
                                    $options = $userQuestion->getQuestion->getOptions
                                @endphp
                            @else
                                @php
                                    $options = $userQuestion->getQuestion->getRandomOptions
                                @endphp
                            @endif

                            @foreach($options as $option)
                            <div class="option @if(count($userQuestion->getQuestion->getOptions) >= 4) col-sm-3 @elseif(count($userQuestion->getQuestion->getOptions) === 3) col-md-4 @endif" id="div-option-{{ $option->id }}">
{{--                                <label for="option-{{ $option->id }}"><div class="clk qutionoption-body" style="background-image: url({{ asset('dist/images/'.$a[$loop->index].'.png') }});">--}}
                                <label for="option-{{ $option->id }}"><div class="clk qutionoption-body option-hover">
                                    {!! $option->answer !!}
                                </div></label>
                                <input type="radio" class="custom-radio radio-change" name="answer" id="option-{{ $option->id }}" value="{{ $option->id }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 error-qution" style="display: none;">
                    <div class="qustion-wrong" style="background-image: url({{ asset('dist/images/Feedback_wrong.png') }});">
                        There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain
                    </div>
                    <div class="qustion-right" style="background-image: url({{ asset('dist/images/Feedback_right.png') }});">
                        There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain
                    </div>
                </div>

            </div>
        </div>
    </section>
    
<form action="{{ route('quiz.submit-question', ['ID' => encrypt($event->id)]) }}" method="POST" class="question-submit">
    @csrf
    <input type="hidden" name="option_id" id="option_id">
    <input type="hidden" name="q_id" id="q_id" value="{{ $userQuestion->getQuestion->id }}">
    <input type="hidden" name="uq_id" id="uq_id" value="{{ $userQuestion->id }}">
    <input type="hidden" name="test_id" id="test_id" value="{{ $test->id }}">
    <input type="hidden" name="utest_id" id="utest_id" value="{{ $userQuestion->user_test_id }}">
    <input type="hidden" name="module_id" id="module_id" value="{{ $test->getModules[0]->id }}">
    <input type="hidden" name="rtime" id="rtime">
    <input type="hidden" name="etime" id="etime">
    <input type="hidden" name="mil" id="mil">
    <input type="hidden" name="power_ids" id="power_id">
    <input type="hidden" name="power_slugs" id="power_slug">
</form>

<form action="{{ route('quiz.skip-question', ['ID' => encrypt($event->id)]) }}" method="POST" class="question-skip">
    @csrf
    <input type="hidden" name="q_id"  value="{{ $userQuestion->getQuestion->id }}">
    <input type="hidden" name="uq_id"  value="{{ $userQuestion->id }}">
    <input type="hidden" name="test_id"  value="{{ $test->id }}">
    <input type="hidden" name="utest_id"  value="{{ $userQuestion->user_test_id }}">
    <input type="hidden" name="module_id"  value="{{ $test->getModules[0]->id }}">
    <input type="hidden" name="power_ids" id="power_id">
    <input type="hidden" name="power_slugs" id="power_slug">
</form>
</main>

<!-- /.container -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')
</script>
<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/all.min.js') }}"></script>
<script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.countdown360.min.js') }}"></script>
<script type = "text/javascript" >
    function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };
</script>
<script>
    $(document).ready(function() {


        $('#announcement-slider').owlCarousel({
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
            .css({
                "text-align": "center",
            });
        var countdown;
        var time1 = {{ $userQuestion->getQuestion->time }};
        var qID = $('#q_id').val();
        if (sessionStorage.getItem(qID)) {
            var value = sessionStorage.getItem(qID);
            countdown = $(".progress-value").countdown360({
                radius      : 50.5,
                seconds     : value,
                strokeWidth : 2,
                fillStyle   : '#33333300',
                strokeStyle : '#ffb43e',
                fontSize    : 40,
                fontColor   : '#FFFFFF',
                autostart: false,
                smooth: true,
                onComplete  : function () { $('.question-skip').submit(); }
            });
        } else {
            countdown = $(".progress-value").countdown360({
                radius      : 50.5,
                seconds     : time1,
                strokeWidth : 2,
                fillStyle   : '#33333300',
                strokeStyle : '#ffb43e',
                fontSize    : 40,
                fontColor   : '#FFFFFF',
                autostart: false,
                smooth: true,
                onComplete  : function () { $('.question-skip').submit(); }
            });
        }
        {{--var countdown = $(".progress-value").countdown360({--}}
        {{--    radius      : 50.5,--}}
        {{--    seconds     : {{ $userQuestion->getQuestion->time }},--}}
        {{--    strokeWidth : 2,--}}
        {{--    fillStyle   : '#33333300',--}}
        {{--    strokeStyle : '#ffb43e',--}}
        {{--    fontSize    : 40,--}}
        {{--    fontColor   : '#FFFFFF',--}}
        {{--    autostart: false,--}}
        {{--    smooth: true,--}}
        {{--    onComplete  : function () { $('.question-skip').submit(); }--}}
        {{--});--}}
        countdown.start();

        var d = new Date();

        $(document.body).on('change', '.radio-change', function (){
            $(this).parent('.option').find('.qutionoption-body').removeClass('option-hover');
            $(this).parent('.option').find('.qutionoption-body').css('background-image', "url({{ asset('dist/images/Box_green.png') }})");
            $('#mil').val(d.getMilliseconds());
            countdown.stop();
            $('#option_id').val($(this).val());
            $('#rtime').val(countdown.getTimeRemaining());
            $('#etime').val(countdown.getElapsedTime());
            setTimeout(function (){
                $('.question-submit').submit();
            }, 3000);


        });

        window.onbeforeunload = function(event) {
            sessionStorage.setItem(qID, countdown.getTimeRemaining());
        }
    })

    $(document).ready(function() {


        $('#archievement-slider').owlCarousel({
            margin: 50,
            nav: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        })
    })
    $(document).ready(function() {

        var powerArray = [];
        var powerSlugArray = [];

        $('#testimonial-slider').owlCarousel({
            margin: 0,
            nav: true,
            center: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

        $('.powers').on('click',function (){
            $(this).css('pointer-events', 'none');
           var id = $(this).attr('id');
           var slug = $(this).attr('data-slug');
           alert(slug);
           var qid = $('.question-submit #q_id').val();
             powerArray.push(id);
            powerSlugArray.push(slug);
            var pa = JSON.stringify(powerArray);
            var ps = JSON.stringify(powerSlugArray);
            sessionStorage.setItem('powers', pa);
            $('.question-submit #power_id').val(pa);
            $('.question-submit #power_slug').val(ps);

            $('.question-skip #power_id').val(pa);
            $('.question-skip #power_slug').val(ps);
            if(slug === '50-50'){

                $.ajax({
                    url: "{{ route('quiz.hide5050') }}",
                    type: "POST",
                    dataType:'json',
                    data: {qid:qid,_token:$('input[name="_token"]').val()},
                    success: function(response) {
                        $.each(response, function (key, val) {
                            console.log(val.id);
                            $('#div-option-'+val.id).hide();
                        });

                    }
                });

            }else if(slug === 'stop-timer'){
                countdown.stop();
            }
        });
    });

</script>
<script>
    MathJax = {
        tex: {
            inlineMath: [['$', '$'], ['\\(', '\\)']]
        },
        svg: {
            fontCache: 'global'
        }
    };
</script>
<script type="text/javascript" id="MathJax-script" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
</script>
</body>
</html>
