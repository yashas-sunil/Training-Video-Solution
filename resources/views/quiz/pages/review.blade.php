<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content=" ">
    <meta name="generator" content=" ">
    <title>Review</title>
    <!-- Bootstrap core Font Awsome and Slider CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('dist/css/screen.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/responsive.css') }}" rel="stylesheet">

</head>
<style type="text/css">
   .review-container p, h2{
    display: inline-block; /* display on the same line */
}

</style>
<body class="reviewbody" style="background-image: linear-gradient(to bottom, #5ac3e7, #1e7cb4); background-size: cover;background-repeat: no-repeat; height: 100vh;">
    <!--Header Part-->

    <main role="main" class="review-section ">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 review-left">
                    <!-- Page Title -->
                    <section class="page-title-section-center ">
                        <div class="container ">
                            <div class="row d-flex justify-content-center ">

                                <div class="col-sm-8 text-center text-white titlesecinner ">
                                    <h1>Review</h1>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /Page Title -->

                    <section class="reviewboxmain">

                        <div class="review-container">
                          @foreach ($userQuestion as  $value)

                            <div class="reviewinnerbox">
                                <h2><em>{{$loop->iteration}}</em></h2>
                                {!! $value->getQuestion->question !!}
                                <div class="listreview">
                                    <ul class="un-listing">

                                        <?php
                                        if($value->is_attempted == '1')
                                         {
                                          $ans =$value->getUserAnswer->option_id;
                                          // dd($value->getUserAnswer);
                                         }else
                                         {
                                            $ans='0';
                                         }
                                        ?>

                                        @foreach($value->getQuestion->getOptions as $option)
                                        <li @if($ans == $option->id) @if($value->getUserAnswer->is_correct == '1')class="blue-bg" @endif class="red-bg" @endif >{!! $option->answer !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="reviewfoter">
                                    <ul>
                                        <li>Elapsed Time <span> @if($value->is_attempted == 1) {{$value->getUserAnswer->esec}} Sec @else {{$value->getQuestion->time}} Sec @endif</span></li>
                                        <li>Max Time <span> {{$value->getQuestion->time}} Sec</span></li>
                                        <li>Max Score <span>{{$value->getQuestion->score}}</span></li>
                                        @if($test->is_feedback == 1)
                                        <li class="feedbckbtnli">
                                             <button type="button"  class="btn" data-toggle="modal" data-target="#feedback-pop{{$value->getQuestion->id}}"> Feedback</button>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </section>
                    <div class="reviewnotificaiton">
                        <button type="button"><i class="fas fa-file"></i></button>
                    </div>
                    <div class="reviewlastsec">
                        <ul>
                            <!-- <li><a class="btn" href="{{ route('quiz.content-library', ['ID' => encrypt($event->id)]) }}">Learn Again</a></li> -->
                            <li><a class="btn" href="{{ route('quiz.test', ['ID' => $event->id]) }}">Play Again</a></li>
                            <!-- <li><a class="btn" href="{{ route('quiz.practice') }}">Next Quiz</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 review-right">
                    <ul>
                        <li>
                            <h3>Rank<button style="color: white" type="button" class="btn" data-toggle="modal" data-target="#reviewpopmodal"> <i class="fas fa-exclamation-circle"></i></button><br/>
                                <span>{{ array_search($user->id, $rank) + 1 }} /{{ count($rank) }}</span></h3>
                        </li>
                        <li>
                            <h3>Score<br/>
                                <span>{{ $score }}</span></h3>
                        </li>
                        <li class="accucry">
                            @php
                            $per = $total / 5;
                            @endphp

                            <h3>Accuracy<br/>

                                <span class="selected-accurecy">
                                @if($score <= $per)
                                        <span class="red"><i class="fas fa-sort-down"></i></span><!-- 0-20% -->
                                        <span class="orange"></span><!-- 21 -40% -->
                                        <span class="green"></span><!-- 41-60% -->
                                        <span class="lightgreen"></span><!-- 61-80% -->
                                        <span class="darkgreen"></span><!-- 81-100% -->
                                @elseif($score > $per && $score <= (2 * $per))
                                        <span class="red"></span><!-- 0-20% -->
                                        <span class="orange"><i class="fas fa-sort-down"></i></span><!-- 21 -40% -->
                                        <span class="green"></span><!-- 41-60% -->
                                        <span class="lightgreen"></span><!-- 61-80% -->
                                        <span class="darkgreen"></span><!-- 81-100% -->
                                @elseif($score > (2 * $per) && $score <= (3 * $per))
                                        <span class="red"></span><!-- 0-20% -->
                                        <span class="orange"></span><!-- 21 -40% -->
                                        <span class="green"><i class="fas fa-sort-down"></i></span><!-- 41-60% -->
                                        <span class="lightgreen"></span><!-- 61-80% -->
                                        <span class="darkgreen"></span><!-- 81-100% -->
                                @elseif($score > (3 * $per) && $score <= (4 * $per))
                                        <span class="red"></span><!-- 0-20% -->
                                        <span class="orange"></span><!-- 21 -40% -->
                                        <span class="green"></span><!-- 41-60% -->
                                        <span class="lightgreen"><i class="fas fa-sort-down"></i></span><!-- 61-80% -->
                                        <span class="darkgreen"></span><!-- 81-100% -->
                                @elseif($score > (4 * $per) && $score <= (5 * $per))
                                        <span class="red"></span><!-- 0-20% -->
                                        <span class="orange"></span><!-- 21 -40% -->
                                        <span class="green"></span><!-- 41-60% -->
                                        <span class="lightgreen"></span><!-- 61-80% -->
                                        <span class="darkgreen"><i class="fas fa-sort-down"></i></span><!-- 81-100% -->
                                @endif
                                </span>
                            </h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <!---Login Modal-->
    <div class="modal fade" id="reviewpopmodal" tabindex="-1" role="dialog" aria-labelledby="reviewpopmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body reviewpopbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

                    <div class="reviewlisttable">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Score</th>
                                        <th scope="col">Rank</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($ranking as $ranks)
                                    <tr>
                                        <td scope="row"><em>{{$loop->iteration}}</em>{{$ranks->getUser->first_name}} {{$ranks->getUser->last_name}}</td>
                                        <td>{{$ranks->score}}</td>
                                        <td>{{$loop->iteration}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- rank model -->
   @foreach ($userQuestion as  $value)
    <div class="modal fade bd-example-modal-lg" id="feedback-pop{{$value->getQuestion->id}}" tabindex="-1" role="dialog" aria-labelledby="feedback-popLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body feedbackpcbody p-4">
                    <h3>Feedback</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>


                    <div class="feedbacpinner">

                        <p>
                         @if($test->feedback_type == 'question_wise')
                         @if($value->is_correct == '1')
                            {{$value->getQuestion->correct_feedback }}
                            @else
                             {{$value->getQuestion->incorrect_feedback }}
                        @endif
                        @elseif($value->is_attempted == '1' && $test->feedback_type == 'answer_wise')
                            {{$value->getUserAnswer->getAnswer->feedback }}
                        @elseif($test->feedback_type == 'option')
                            {!! $value->getQuestion->getOptions->where('is_correct','1')->first()->answer  !!}
                        @endif

                            <!-- <img src="/dist/images/image07.png" class="popfeedimg"> -->

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- rank model -->
    <!-- /.container -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script>
        window.jQuery || document.write('<script src="/js/vendor/jquery.slim.min.js "><\/script>')
    </script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/all.min.js') }}"></script>
    <script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            sessionStorage.clear();


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
                    "text-align ": "center ",
                });
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
        })
    </script>

</html>
