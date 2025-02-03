@extends('layouts.master')
@push('style')
    <style>
        .the_wheel1 > canvas
        {
            background-image: url('{{ asset('assets/images/wheel_back.png') }}');
            background-position: center;
            background-repeat: no-repeat;
            /*padding-top: 10rem !important;*/
        }

        .blink_me {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
        .gradient{
            background: rgb(57,168,239);
            background: linear-gradient(90deg, rgba(57,168,239,1) 0%, rgba(60,148,246,1) 41%, rgba(58,122,246,1) 57%, rgba(49,114,246,1) 96%);
        }

        /* Modal Popup Styles */
        .navbar {
        z-index: 9999;
        }

        .modal {
        display: none;
        position: fixed;
        z-index: 9990;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        width: 80%;
        /* max-width: 600px; */
        height: 60%;
        border-radius: 10px;
        }

        #pdf-container{
            margin: 8% auto;
            height: 70%;
        }

        #pdf-container .popup-submit-button {
            background-color: #201c6d;
        }

        #pdfIframe {
        width: 100%;
        height: 85%;
        border: 1px solid black;
        }

        #scrollCheckboxDiv {
        margin-top: 10px;
        }

        #scrollCheckboxDiv label {
        display: flex;
        justify-content: center;
        margin-bottom: 5px;
        cursor: pointer;
        }

        #scrollCheckboxDiv label input {
        position: unset;
        margin-right: 1rem;
        }

        .popup-submit-button{
        border-radius: 10px;
        background-color: #491288;
        border-color: #491288;
        }

        .popup-submit-button:hover {
        background-color: #201c6d; /* Apply suitable hover color */
        border-color: #201c6d; /* Apply suitable hover color */
        }

        /* Checkbox Styles */
        #scrollCheckboxDiv label input[type="checkbox"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 3px solid #201c6d;
        width: 20px;
        height: 20px;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
        left: 0;
        }

        #scrollCheckboxDiv label input[type="checkbox"]:checked {
        border-color: #201c6d;
        }

        #scrollCheckboxDiv label input[type="checkbox"]:checked:after {
        content: '\2713'; /* Tick mark character */
        position: absolute;
        top: 25%;
        left: 75%;
        transform: translate(-50%, -50%);
        font-size: 30px;
        color: #491288;
        }


    </style>
@endpush
@section('content')
    <!-- Modal Popup HTML -->
    <div id="pdfPopup" class="modal">
        <div class="modal-content" id='pdf-container'>
            <div class="row justify-content-center">
                <h3 id='rulebook-title'>
                    {{ isset($agreeTnC['show_rulebook']) ? $agreeTnC['show_rulebook']['title'] : 'Rulebook' }}
                </h3>
            </div>
            <iframe id="pdfIframe" src="{{ isset($agreeTnC['show_rulebook']) ? $agreeTnC['show_rulebook']['s3_url'] : '' }}#toolbar=0&view=FitH"></iframe>
            <form action="{{ route('agreeTnC.save')}}" method="POST">
                @csrf
                <div id="scrollCheckboxDiv">
                    <div class="row justify-content-center">
                        <label for="scrollCheckbox">
                            <input type="checkbox" id="scrollCheckbox" name="agreeTnC" value="{{ isset($agreeTnC['show_rulebook']) ? $agreeTnC['show_rulebook']['id'] : '' }}" required>
                            I Accept the above Terms and Conditions
                        </label>
                    </div>
                    <div class="row justify-content-end m-0">
                        <input type="submit" value="Submit" placeholder="Submit" class="btn btn-primary popup-submit-button">
                    </div>
                </div>
                <div id="viewBox" style="padding:10px;display:none;">
                    <div class="row justify-content-end m-0">
                        <input type="button" value="Close" placeholder="Submit" class="btn btn-primary popup-submit-button pdfPopupClose">
                    </div>
                </div>
            </form>
        </div>
    </div>  
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
        @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="welcome">
                        <div class="wel-inner">
                            <h4>Welcome back {{ $user['name'] }}</h4>
                            <img src="{{ asset('assets/new_ui_assets/images/dashboard/shake_hand.svg') }}" alt="">
                        </div>
                        <h6>Continue learning where you left off...</h6>
                    </div>


                    <div class="overview">
                        <h1>Overview</h1>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="overview-list " id="progress">
                                    <h5>Courses in Progress</h5>
                                    <div class="overv-inner">
                                        <h1>@if($courseDetails){{ $courseDetails['total_purchased_courses'] }}@else 0 @endif</h1>
                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/Activity.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="overview-list " id="c_courses">
                                    <h5>Completed Courses</h5>
                                    <div class="overv-inner">
                                        <h1>@if($courseDetails){{ $courseDetails['total_completed_courses'] }}@else 0 @endif</h1>
                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/completed_courses.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="overview-list " id="watch_time">
                                    <h5>Total Watch Time</h5>
                                    <div class="overv-inner">
                                        <h1>@if($courseDetails)<span>{{ $courseDetails['total_time_watched'] }}</span>@else 0 @endif</h1>
                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/watch_time.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="overview-list " id="total_purchased">
                                    <h5>Total Courses Purchased</h5>
                                    <div class="overv-inner">
                                        <h1>@if($courseDetails){{ $courseDetails['total_purchased'] }}@else 0 @endif</h1>
                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/total_purchased.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="attempt-year" name="attempt-year" value="{{ $user['student']['attempt_year'] }}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="dash_all_courses">
                                <form id="filter_courses" action="" method="GET" >
                                    <div class="all_course_title">
                                        <h1>All Courses</h1>
                                        <select id="recent_view" name="recent_view">
                                            <option value="1" @if (request()->has('recent_view')) @if (1 == request()->input('recent_view')) selected @endif @endif>Recently Viewed</option>
                                            <option value="2" @if (request()->has('recent_view')) @if (2 == request()->input('recent_view')) selected @endif @endif>1 week</option>
                                            <option value="3" @if (request()->has('recent_view')) @if (3 == request()->input('recent_view')) selected @endif @endif>1 Month</option>
                                        </select>
                                    </div>
                                    <div class="all_courses_search">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <input type="search" placeholder="Search your courses" id="filter" name="filter"
                                               value="@if(request()->has('filter')){{ request()->input('filter') }}@endif">
                                    </div>
                                </form>
                                <div class="dash_course_list">
                                    <ul class="course-container">
                                        @foreach($orderItems as $orderItem)
{{--                                            @if($loop->index <= 5)--}}
                                                <li class="course-item" style="display: none">
                                                    <div class="dash_course_details">
                                                        <div class="course_details_outer">
                                                            <div class="outer_image">
                                                                <a href="{{ url('video-contents') . '/?order_item=' . $orderItem['id'] . '&package=' . $orderItem['package']['id'] ?? '' }}" >
                                                                    <img src="{{ $orderItem['package']['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="course_details_inner">
{{--                                                                @if( $orderItem['package']['videos'])--}}
                                                                    <h2>
                                                                        <a href="{{ url('video-contents') . '/?order_item=' . $orderItem['id'] . '&package=' . $orderItem['package']['id'] ?? '' }}">
                                                                            {{$orderItem['package']['name']}}
                                                                        </a>
                                                                    </h2>
{{--                                                                @endif--}}
                                                                <div class="course_details_sub_inner">
                                                                    <h4>Prof.@if($orderItem['package']['professors'])
                                                                            {{$orderItem['package']['professors'][0]['name']}} @endif</h4>
                                                                    <span></span>
                                                                    <h4><i class="fa fa-play" aria-hidden="true"></i>{{ $orderItem['package']['total_videos'] }}</h4>
                                                                    <span></span>
                                                                    <div class="sub_inner_time">
                                                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/time.svg') }}" alt="">

                                                                        <h4>
                                                                        {{ $orderItem['package']['total_duration_formatted'] }}  @if($orderItem['package']['bonus_duration_formatted']) 
                                                                   + {{  $orderItem['package']['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif 
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
{{--                                                    @if( $orderItem['package']['videos'])--}}
                                                    <a href="{{ url('video-contents') . '/?order_item=' . $orderItem['id'] . '&package=' . $orderItem['package']['id'] ?? '' }}">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </a>
{{--                                                    @endif--}}
                                                </li>
{{--                                            @endif--}}
                                        @endforeach
                                        @if(count($orderItems) > 6)
                                            <button class="btn course-view">view all</button>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="dash_study_plans course-container mb-5">
                                <div class="study_plans_title">
                                    <h1>Rulebook</h1>
                                </div>
                                <table class="table table-borderless table-hover table-sm">
                                    <tbody >
                                    @if($agreeTnC['show_popup'] && $agreeTnC['success'])
                                        @foreach($agreeTnC['all_rulebooks'] as $rulebook)
                                        @php
                                            if(isset($agreeTnC['show_rulebook']['id']) && $agreeTnC['show_rulebook']['id'] == $rulebook['id'] ){
                                                continue; // skip rulebook that has not been agreed
                                            }
                                        @endphp
                                        <tr class="course-item" style="display: none">
                                            <td><i class="fa fa-book" style="font-size:36px" aria-hidden="true"></i></td>
                                            <td><span>{{ $rulebook['title'] }}</span></td>
                                            <td><a href="javascript:void(0);" data-url='{{ $rulebook['s3_url'] }}' data-title={{ $rulebook['title'] }} class="view_rulebook"><img src="{{ asset('assets/new_ui_assets/images/dashboard/views.svg') }}" alt=""></a> </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="dash_study_plans course-container">
                                <div class="study_plans_title">
                                    <h1>Study Plans</h1>
{{--                                    <select id="">--}}
{{--                                        <option value="">Subject</option>--}}
{{--                                        <option value="">Lorem</option>--}}
{{--                                        <option value="">Lorem</option>--}}
{{--                                    </select>--}}
                                </div>
                                <table class="table table-borderless table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Study Material</th>
                                        <th>Course</th>
                                        <th></th>
                                    </tr></div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                    </thead>
                                    <tbody >
                                    @foreach($studyMaterials as $studyMaterial)
                                        <tr class="course-item" style="display: none">
                                            <td>{{ $studyMaterial['title'] }}</td>
                                            <td>{{ $studyMaterial['file_name'] }}</td>
                                            <td><span>CA</span></td>
                                            <td><a href="{{ url($studyMaterial['file_url']) }}" target="_blank"><img src="{{ asset('assets/new_ui_assets/images/dashboard/download.svg') }}" alt=""></a> </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @if(count($studyMaterials) > 6)
                                     <button class="btn course-view">view all</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
<div class="modal fade" id="spinwheel-modal" tabindex="-1" role="dialog" aria-modal="true" >
    <div class="modal-dialog">
        <div class="modal-content ">
        <h3 class="modal-title" style="text-align:center">{{@$spinWheel['title']}}</h3>
            <div class="modal-body">
                <div class="row p-0">
                    <div class="col-12">
                    <div class="d-flex justify-content-center  align-items-center the_wheel1">
                            <canvas id="canvas" width="438" height="582"
                                    data-responsiveMinWidth="180"
                                    data-responsiveScaleHeight="true"
                                    data-responsiveMargin="50">
                                <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                            </canvas>
                        </div>
                        <div class="row">
                        <div class="col-6">
                            @if(@$spinWheel['allow_respin'] && @$spinned_count >0)
                        <button type="submit" name="respin" id="respin" class="btn btn-block btn-secondary" >RESPIN</button>
                        
                        @else
                        <button type="submit" name="spin" id="spin" class="btn btn-block btn-secondary" >SPIN</button>
                        @endif
                        </div>
                        <div class="col-6">
                        <button type="button" name="close-spin" id="close-spin" class="btn btn-block btn-secondary" >CLOSE</button>
                        </div>
                        @if(@$spinWheel['allow_respin'] && @$spinned_count >0)
                        <div class="col-12">
                        <span>{{ @$spinWheel['jkoin_required'] }} Jkoins will be debited from your Jkoins for respin</span>
                        </div>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-secondary" style="position: relative;">
                <div class="modal-body text-center" >
                    <div class="p-5">
                        <h3 class="text-light blink_me modal-head"></h3>
                    </div>
                    <p style="display: none" class="text-light modal-signup">
                        <a data-toggle="modal" data-target="#modal-signup"  class="btn btn-primary" href="#" id="result-modal-button-sign-up">Signup</a>
                    </p>
                    
                    <p style="display: none" class="text-light modal-home">
                        <a class="btn btn-primary" href="{{ url('/') }}" id="result-modal-button-sign-up">Home</a>
                    </p>
                    @if(@$spinWheel['allow_respin'])
                    <p style="display: none" class="text-light modal-redeem">
                        <a class="btn btn-primary" id="respin">Respin</a>
                       
                    </p>
                    @endif
                    <p style="display: none" class="text-light modal-message-1"></p>
                    <p style="display: none" class="text-light modal-message-2"></p>
                </div>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 10px;">
                    <span aria-hidden="true" id="close-succ">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
      <!-- JavaScript -->
        // Open the modal popup
        function openPopup() {
            document.getElementById("pdfPopup").style.display = "block";
            document.body.style.overflow = "hidden"; // Prevent scrolling of the background content
        }
        
        // Automatically open the popup when the page loads
        @if($agreeTnC['show_popup'] && !$agreeTnC['success'])
        window.addEventListener("load", function() {
            openPopup();
        });
        @endif

        $(document).ready(function() {
            @if(request()->session()->has('cannotfind') && request()->session()->get('cannotfind')=='1')
            $("#feedback_collct").modal('show');
            @endif
            {{request()->session()->forget('cannotfind')}}
            
            var attemptYear = $('#attempt-year').val();

            if(!attemptYear) {

                $('#attempt-year-modal').modal('show');

            }

            // login-attempt-year-submit

            $('.course-container').each(function () {
                $(this).find('.course-item').slice(0, 6).show();
            });

            $('.course-view').click(function() {
                // alert('hello');
                if ($(this).text() == 'view all')
                {
                    let element = $(this).closest('.course-container').find('.course-item:hidden');
                    element.slice().slideDown();

                    $(this).text('Show Less');
                }
                else {
                    let element = $(this).closest('.course-container').find('.course-item');
                    element.slice(6).slideUp();

                    $(this).text('view all');
                }

            });
        });

        $(function() {
            $('#filter').on('keyup', function (e) {
                // alert('up')
                var length = $('#filter').val().length;
                if (length > 4) {
                    $("#filter_courses").submit();
                }
            });
            $('#recent_view').on('change', function (e) {
                $("#filter_courses").submit();
            });
            $(".view_rulebook").click(function(){
                var rulebookUrl = $(this).data('url')+'#toolbar=0&view=FitH';
                var rulebookTitle = $(this).data('title');
                $("#pdfIframe").attr("src", rulebookUrl);
                $("#rulebook-title").text(rulebookTitle);
                $(".pdfPopupClose").show();
                $("#scrollCheckboxDiv").hide();
                $("#viewBox").show();
                $("#pdfPopup").show();
            });
            $(".pdfPopupClose").click(function(){
                $(".pdfPopupClose").hide();
                $("#scrollCheckboxDiv").show();
                $("#viewBox").hide();
                $("#pdfPopup").hide();
            });
        });
    </script>
    @if(isset($spinWheel['id']))
    <script>
         $(document).ready(function() {

            if(@json($spinWheel)){
            $('#spinwheel-modal').modal('show');
            }
            $('#close-spin').click(function() {
                let confirmation = confirm("Are you sure to close this?You may get next chance to spin only on next day till campaign expires");
                if(confirmation){
                $.ajax({
                url: '{{ url('temp-campaigns-register') }}',
                type: 'POST',
                data: {
                    campaign_id: '{{ $spinWheel['id'] }}',
                },
                async: false
            }).done(function(response) {
                
            });
            $('#spinwheel-modal').modal('hide');
           
             }
            });

            $('#close-succ').click(function(){
                $('#spinwheel-modal').modal('hide');
            });

        });
        </script>
          <script>
          
        let responseSegments = @json($spinWheel['spin_wheel_segments']);
        segments = [];

        responseSegments.forEach(function (segment) {
            segments.push({ 'fillStyle': '#' + segment.color_code, 'text': segment.title, 'point': segment.point, 'segment_value':segment.value, 'segment_value_type':segment.value_type,'segment_id':segment.id })
        });


        let audio = new Audio('{{ asset('assets/tick.mp3') }}');  // Create audio object and load tick.mp3 file.
    
        function playSound()
        {
            // Stop and rewind the sound if it already happens to be playing.
            audio.pause();
            audio.currentTime = 0;

            // Play the sound.
            audio.play();
        }

        let isChancesLeft = true;


        function alertPrize(indicatedSegment)
        {
           
            $.ajax({
                url: '{{ url('temp-campaigns-points') }}',
                type: 'POST',
                data: {
                    campaign_registration_id: '{{ session()->get('campaign_registration_id') }}',
//                    campaign_registration_id: 10,
                    campaign_id: '{{ $spinWheel['id'] }}',
                    segment_value: indicatedSegment.segment_value,
                    segment_value_type: indicatedSegment.segment_value_type,
                    expire_at: '{{ $spinWheel['point_validity'] }}',
                },
                async: false
            }).done(function(response) {
                let noOfChances = '{{ $spinWheel['no_of_chances'] }}';
                noOfChances = parseInt(noOfChances);
                let totalChances = parseInt(response);
            });

            $('.modal-signup').hide();
            $('.modal-home').hide();
            $('.modal-head').hide();
            $('.modal-message-1').hide();
            $('.modal-message-2').hide();
            $('.modal-redeem').hide();

            // Registered Only
            @if (!request()->session()->has('access_token') && request()->session()->has('campaign_registration_id'))

            if(indicatedSegment.segment_value_type == 4){

                $('.modal-signup').show();

                $('.modal-head').text('More contests in the near future. Stay tuned!').show();

                $('.modal-message-1').text('Join JK Shah Online to learn from anywhere, anytime!').show();

            }else{
                $('.modal-signup').show();

                if (indicatedSegment.segment_value_type == 1) {
                    $('.modal-head').text('Congratulations! You have won '+indicatedSegment.segment_value+' points.').show();
                }

                if(indicatedSegment.segment_value_type == 5) {
                    $('.modal-head').text('Congratulations! You have won Lucky draw.You will receive more details shortly').show();
                }
                
                $('.modal-message-1').text(' {{ $spinWheel['jkoin_required'] }} Jkoins will be debited from your Jkoins for respin').show();
                
                $('.modal-message-2').text('You will see the reward in the JMoney in your dashboard and will be able to use it while checking out.').show();
            }

            @endif


            // Signup Completed.
            @if (request()->session()->has('access_token') )

                if(indicatedSegment.segment_value_type == 4){
                    $('.modal-redeem').show();

                    $('.modal-head').text('More contests in the near future. Stay tuned!').show();
                    $('.modal-message-1').text('{{ $spinWheel['jkoin_required'] }} Jkoins will be debited from your Jkoins for respin').show();

                    $('.modal-message-2').text('Join JK Shah Online to learn from anywhere, anytime!').show();

                }else{

                $('.modal-redeem').show();

                if (indicatedSegment.segment_value_type == 1) {
                    $('.modal-head').text('Congratulations! You have won '+indicatedSegment.segment_value+' points.').show();
                }
                if(indicatedSegment.segment_value_type == 5) {
                    $('.modal-redeem').show();
                    $('.modal-head').text('Congratulations! You have won Lucky draw.You will receive more details shortly').show();
                    $('.modal-message-1').text('{{ $spinWheel['jkoin_required'] }} Jkoins will be debited from your Jkoins for respin').show();
                }

               
                $('.modal-message-1').text('{{ $spinWheel['jkoin_required'] }} Jkoins will be debited from your Jkoins for respin').show();
                
                $('.modal-message-2').text('You will see the reward in the JMoney in your dashboard and will be able to use it while checking out.').show();
            }

            @endif

           

            $('#resultModal').modal('show');
        }

        let wheelPower    = 0;
        let wheelSpinning = false;


        function powerSelected(powerLevel)
        {
            // Ensure that power can't be changed while wheel is spinning.
            if (wheelSpinning == false) {
                // Reset all to grey incase this is not the first time the user has selected the power.
                document.getElementById('pw1').className = "";
                document.getElementById('pw2').className = "";
                document.getElementById('pw3').className = "";

                // Now light up all cells below-and-including the one selected by changing the class.
                if (powerLevel >= 1) {
                    document.getElementById('pw1').className = "pw1";
                }

                if (powerLevel >= 2) {
                    document.getElementById('pw2').className = "pw2";
                }

                if (powerLevel >= 3) {
                    document.getElementById('pw3').className = "pw3";
                }

                // Set wheelPower var used when spin button is clicked.
                wheelPower = powerLevel;

                // Light up the spin button by changing it's source image and adding a clickable class to it.
                document.getElementById('spin_button').src = "spin_on.png";
                document.getElementById('spin_button').className = "clickable";
            }
        }


        function startSpin()
        {
//        $('#resultModal').modal('show');
//        return;
//        $('#exampleModal').modal('show');
            // Ensure that spinning can't be clicked again while already running.
            if (wheelSpinning == false) {
                // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                // to rotate with the duration of the animation the quicker the wheel spins.
                if (wheelPower == 1) {
                    theWheel.animation.spins = 3;
                } else if (wheelPower == 2) {
                    theWheel.animation.spins = 8;
                } else if (wheelPower == 3) {
                    theWheel.animation.spins = 15;
                }

                // Disable the spin button so can't click again while wheel is spinning.
//            document.getElementById('spin_button').src       = "spin_off.png";
//            document.getElementById('spin_button').className = "";

                // Begin the spin animation by calling startAnimation on the wheel object.
                theWheel.startAnimation();

                // Set to true so that power can't be changed and spin button re-enabled during
                // the current animation. The user will have to reset before spinning again.
                wheelSpinning = true;
            }
        }

        // -------------------------------------------------------
        // Function for reset button.
        // -------------------------------------------------------
        function resetWheel()
        {
            theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheel.draw();                // Call draw to render changes to the wheel.

            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.

            if (isChancesLeft) {
                $(':input[name="spin"]').prop('disabled', false);
            }
        }

        // Create new wheel object specifying the parameters at creation time.
        let theWheel = new Winwheel({
//        'responsive':true,
            'numSegments'  : segments.length,     // Specify number of segments.
            'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
            'textFontSize' : 15,    // Set font size as desired.
            'segments'     : segments,
            'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 8,
                    'spins'    : 8,
                    'callbackFinished' : alertPrize,
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin',        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
            'pins' :
                {
                    'outerRadius' : 5,
                    'fillStyle'   : '#ffffff',
                    'strokeStyle' : '#aaaaaa',
                    'number' : 16   // Number of pins. They space evenly around the wheel.
                }
        });


        $('#spin').on('click', function () {
            if('{{$spinWheel['allow_respin']}}'){
            $('#spin').prop('disabled', false);
            }
            // $(':input[name="spin"]').prop('disabled', true);
            $.ajax({
                url: '{{ url('campaigns/spin-wheels/calculate-price') }}',
                data: {
                    campaign_id: '{{ $spinWheel['id'] }}',
                    respin:2
                },
                'success' : function(data) {
                    let segmentNumber = data;   // The segment number should be in response.

                    if (segmentNumber) {
                        // Get random angle inside specified segment of the wheel.
                        let stopAt = theWheel.getRandomForSegment(segmentNumber);

                        // Important thing is to set the stopAngle of the animation before stating the spin.
                        theWheel.animation.stopAngle = stopAt;

                        // Start the spin animation here.
                        theWheel.startAnimation();
                    }
                },
                dataType : 'json'
            });
            // startSpin();
        });
        $('#respin').on('click', function () {
            $('#spin').prop('disabled', true);
            $('.modal-signup').hide();
            $('.modal-home').hide();
            $('.modal-head').hide();
            $('.modal-message-1').hide();
            $('.modal-message-2').hide();
            $('.modal-redeem').hide();
            $('#resultModal').modal('hide');
            // $(':input[name="spin"]').prop('disabled', true);
            $.ajax({
                url: '{{ url('campaigns/spin-wheels/calculate-price') }}',
                data: {
                    campaign_id: '{{ $spinWheel['id'] }}',
                    respin:1
                },
                'success' : function(data) {
                    if(data==false){
                        $('.modal-message-1').text('Insufficient JKoins to respin').show();
                        $('#resultModal').modal('show');
                        $('#respin').prop('disabled', true);
                    }
                    else{
                    let segmentNumber =data;   // The segment number should be in response.

                    if (segmentNumber) {
                        // Get random angle inside specified segment of the wheel.
                        let stopAt = theWheel.getRandomForSegment(segmentNumber);

                        // Important thing is to set the stopAngle of the animation before stating the spin.
                        theWheel.animation.stopAngle = stopAt;

                        // Start the spin animation here.
                        theWheel.startAnimation();
                    }
                }
                },
                dataType : 'json'
            });
            
        });

        $('#resultModal').on('hidden.bs.modal', function () {
            resetWheel();
        });
        </script>
        @endif
@endpush
