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
<style type="text/css">
    .btnsecveiwmore
    {
        padding: 62px;
    }
</style>
@endpush
@section('content')
    <main role="main" class="main-section">

        <!-- Page Title -->
        <section class="page-title-section style-2 dark-bg ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-2 text-center">
                    </div>
                    <div class="col-sm-8 text-white text-center titlesecinner">
                        <h1>Practice</h1>
                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor<br/> nibh, sit amet tempor nibh finibus et. Aenean eu enim justo.</h3>
                    </div>

                    <div class="col-sm-2 text-center no-gutters title-right-icon">
                        <img src="{{ asset('dist/images/Aim-icon.png') }}">
                    </div>
                </div>
            </div>
        </section>
        <!-- /Page Title -->


        <section class="subject-topsec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="sub-listicon row  d-flex justify-content-center flex-wrap align-items-center">
                                <div class="col-sm-10 sublist-inner">

                                    <div class="first-list">
                                       @foreach($subject as $key =>$value)
                                            @if($value->color == NULL || $value->icon == NULL)
                                                <a herf="#" style="background-color: #bf78e0;">{{$value->name}}<img src="{{ asset('dist/images/eng.jpg') }}"></a>
                                            @else
                                        <a herf="#" style="background-color: {{$value->color}};">{{$value->name}}  <img src="{{$value->icon}}"> </a>
                                            @endif

                                        @endforeach
                                    </div>
{{--                                    <div class="secnd-list">--}}
{{--                                        <a herf="#;" class="sm" style="background-color: #fb8d69;">Biology<img src="/dist/images/bio.jpg"></a>--}}

{{--                                        <a herf="#;" style="background-color: #bf78e0;">English<img src="/dist/images/eng.jpg"></a>--}}

{{--                                        <a herf="#;" class="sm" style="background-color: #becb0c;">Biology</a>--}}

{{--                                        <a herf="#;" style="background-color: #61d4e0;">Civics<img src="/dist/images/civics.jpg"></a>--}}

{{--                                        <a herf="#;" class="sm" style="background-color: #4aa56e;">Biology</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="third-list">--}}
{{--                                        <a herf="#;" class="sm" style="background-color: #7f7c74;">Chemistry</a>--}}

{{--                                        <a herf="#;" style="background-color: #e76a6a;">General<br/> Knowledge<img src="/dist/images/gk.jpg"></a>--}}

{{--                                        <a herf="#;" style="background-color: #dbbc2a;">History <img src="/dist/images/history.jpg"></a>--}}
{{--                                    </div>--}}

                                </div>
                                <div class="rounded-gradeinner">
                                    <span>Grade</span>
                                    <p id="grade_no">{{$grade_val}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="quizmainsec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 quizbundleftsec">
                        <div class="box grey-box">
                            <div class="section-title">
                                <h2>QUIZ BUCKET</h2>
                            </div>
                            <div class="quizlist">
                                <h3>Practice</h3>
                                <div class="row post_wrap">

                                    @foreach ($test as $key => $value)
                                    <div class="col-sm-3">
                                        <div class="quilitem" >
                                        <a href="javascript:void(0);" class="passingID" data-id="{{$value->id}}" data-toggle="modal" data-target="#mathspopup" test-link="{{ route('quiz.test', ['ID' => $value->id]) }}" content-link="{{ route('quiz.content-library', ['ID' => encrypt($value->id)]) }}"> <img src="{{ asset('dist/images/tmp.png') }}">
                                            <h4>{{$value->name}}</h4></a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <br>
                                <div class="btnsecveiwmore view_less col-sm-12">
                                   <span class="message">
                                    <button class="btn btn-lg">View Less <i class="fas fa-chevron-down"></i></button>
                                </div>
                                </div>

                            </div>
                        </div>
                        <!-- <div class="btnsecveiwmore">
                           <span class="message">
                            <button class="btn btn-lg">View More <i class="fas fa-chevron-down"></i></button>
                        </div> -->
                    </div>
                    <div class="col-sm-4 quizbundrightsec">
                        <div class="box grey-box mb-5">
                            <div class="leaderboard">
                                <div class="row  no-gutters">
                                    <div class="col-sm-8">
                                        <div class="section-title">
                                            <h2>LEADERBOARD</h2>
                                        </div>
                                        <div class="ranksec ml-auto">
                                            <span>Rank</span><br/> 13<br/>
                                            <span>Badges</span>
                                        </div>
                                    </div>
                                    <div class="leaaderimg col-sm-4">
                                        <img src="{{ asset('dist/images/image09.png') }}" />
                                    </div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star grey-color"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box grey-box mb-5 statussec">
                            <div class="leaderboard">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="section-title">
                                            <h2>STATUS</h2>
                                        </div>
                                        <div class="ratingnumber">
                                            <input type="hidden" name="" value="{{$total}}" id="total">
                                            <div class="totoalnumber ratingnumberbx"><span>Total</span><br/>{{$total}}</div>
                                            <div class="complitednumber ratingnumberbx"><span>Completed</span><br/>{{$complete}}</div>
                                            <div class="notcomplitednumber ratingnumberbx"><span>Not Completed</span><br/>{{$total - $complete}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box dark-box suggetion">
                            <div class="leaderboard">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="section-title">
                                            <h2>Suggestions</h2>
                                        </div>
                                        <div class="sugtiontext">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <p>Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</p>
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
     <button type="button" style="display: none" class="btn btn-info btn-lg" id="on_grade" data-toggle="modal" data-target="#myModal">Open Modal</button>
      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
             <h4 class="modal-title">Enter Grade</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body" align="center">
            <select id="grade_select"  class="form-control">
                <option value="">Select Grade </option>
                @foreach($grade_data as $value)
                <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
            <br>
            <select id="board_select"  class="form-control">
                <option value="">Select Board </option>
                @foreach($board_data as $key =>$value)
                <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
            <!-- <input type="text" name="grade" id="grade"> -->
         </div>
        <div class="modal-footer">
          <button type="button" id="submit_grade" class="btn btn-default" data-dismiss="modal">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
    <!-- /.container -->

    <div class="modal subpopup  fade" id="mathspopup" tabindex="-1" role="dialog" aria-labelledby="mathspopup" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                <div class="modal-body subpopupcontentt">
                    <div class="row">
                        <input type="hidden" class="form-control" name="idkl" id="idkl" value="">
                        <div class="pupleft col-sm-6 popcontenr-inner greenbg relative">
                            <h2>Select Content</h2>
                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                            <div class="btnsec">
                                <a href="#" id="content-link"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="pupright col-sm-6 popcontenr-inner bluebg relative">
                            <h2>Select Test</h2>
                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                            <div class="btnsec">
                                <a href="#" id="test-link"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!---/Login Modal-->

@endsection

@push('scripts')
<script>
        $(document).ready(function() {

            @if($grade_val == 0)
                $("#on_grade").click();
            @endif

            if (sessionStorage.getItem("grade") === null) {
                var tot = $("#total").val();
                if(tot == '')
                {
                    $("#on_grade").click();
                }

            }else
            {
                var tot = $("#total").val();
                if(tot == '')
                {
                 var grade = sessionStorage.getItem("grade");
                 $('#grade_no').html(+grade);
                }

            }
           $("#submit_grade").on('click',function () {
                         var grade_select = $("#grade_select").val();
                         var board_select = $("#board_select").val();

                   sessionStorage.setItem("grade",grade_select);

                  sessionStorage.setItem("board",board_select);
                  location.replace("/practice/"+grade_select+"/"+board_select);
                   } );

             $(document).on("click", ".passingID", function () {
                 var ids =$(this).attr('data-id');
                 $("#idkl").val(ids);
                 $("#test-link").attr('href', $(this).attr('test-link'));
                 $("#content-link").attr('href', $(this).attr('content-link'));
            });


                    var $ps = $(".post_wrap").children("div");
                    $ps.slice(4).hide();
                    var lnth = $(".post_wrap").find("div").length;
                    if(lnth <= 9)
                    {
                        $('.view_less').css('display', 'none');
                    }
                    // var btn = $(".btnsecveiwmore").children("div");
                    // hide all p-tags after the first one
                    // add the read more after the first element
                    // $ps.eq(0).after($('<button type="button">Read more</button>').click(function(){
                    $ps.eq(4).after($('<br><div class="col-sm-12 btnsecveiwmore"><button class="btn btn-lg">View More <i class="fas fa-chevron-down"></i></div>').click(function(){
                    // if the read more link is clicked, remove the read more link and show all p-tags
                    $(this).remove();
                    $ps.show();
                    }));

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
        });

    </script>
@endpush
