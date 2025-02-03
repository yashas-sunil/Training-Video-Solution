@extends('layouts.master')

@section('title', 'Video')

@section('content')
    <link href="{{ asset('dist/css/video-js.min.css') }}" rel="stylesheet">
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
        @include('includes.student-menu')
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 col-sm-12">
                            <div class="my_course_details_dashboard">
                                <div class="subject_heading">{{ $package['name'] }}</div>
{{--                                <video width="100%" controls>--}}
{{--                                    <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">--}}
{{--                                    Your browser does not support HTML video.--}}
{{--                                </video>--}}
                                <div id="video-play-container" class="position-relative">
                                    <div id="video-player" class="video-player-container bg-dark shadow-lg" style="min-height:  100px;display:none;">
                                    </div>
                                    <video id="video-player-js" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" style="width: 100%;min-height: 35em;height:100%;display:none;">
                                    </video>
                                </div>
                                <div class="lecture_name">
                                    <h6 id="video-title">{{ $video['title'] }}</h6>
                                </div>
                                <div class="course_content">
                                    <div class="content_header">
                                        <h4 class="content_title">Course Content</h4>
                                        <div class="content_list">
                                            <h6>{{$package['total_videos']}} Lectures</h6>
                                            <span></span>
                                            <h6>{{$package['total_duration_formatted']}}</h6>
                                        </div>
                                        <div class="content_list mt-2">
                                            @php
                                            
                                            $today = date('Y-m-d h:i:s', strtotime(date('Y-m-d')));
                                            $valid = date('Y-m-d h:i:s', strtotime($studyMaterials['expire_at']));
                                            
                                           

                                            $d1 = new DateTime($today);
                                            $d2 = new DateTime($valid);
                                            $interval = $d1->diff($d2);
                                                            
                                            $diffInMonths  = $interval->m; //4
                                            $diffHoures =  $diffInMonths*24*30 ;

$h=@$package['total_duration_formatted'];

$hrs=explode(':',$h);
// $watchedduration=@$package['order_items'][0]['total_watched_duration'];
$watchedduration=@$studyMaterials['total_watched_duration'];
$duration =(@$hrs[0]*@$studyMaterials['package_duration'])*3600;
$diffinsec=(@$duration- @$watchedduration)/3600;
$total_duration=(@$hrs[0]*@$studyMaterials['package_duration']);

$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $h);

sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

$totaldurationinsec=$time_seconds*((float) $studyMaterials['package_duration']);

$hours = floor($totaldurationinsec / 3600);
$minutes = floor(($totaldurationinsec / 60) % 60);
$seconds = $totaldurationinsec % 60;

$totaldurationInHrs=$hours.':'.$minutes.':'.$seconds;

$remainingDurationInsec=$totaldurationinsec-$watchedduration;

$hours1 = floor($remainingDurationInsec / 3600);
$minutes1 = floor(($remainingDurationInsec / 60) % 60);
$seconds1 = $remainingDurationInsec % 60;
$remainingDurationInHrs=$hours1.':'.$minutes1.':'.$seconds1;

                                            
                                            @endphp
                                           
                                            <h6>
                                             
                                            
                                            Valid till: {{date('d F Y', strtotime($studyMaterials['expire_at']))}} </h6>
                                            <span></span>
                                            <!-- <h6>{{round($total_duration)}} @if(count($hrs)==3) Hours @endif @if(count($hrs)==2) Minutes @endif -->
<h6>{{$totaldurationInHrs}}</h6>
                                        </div>
                                        <div class="content_list mt-2">
                                        <h6>Remaining hours:
                                            <!-- {{round($diffinsec)}} @if(count($hrs)==3) Hours @endif @if(count($hrs)==2) Minutes @endif -->
                                            {{$remainingDurationInHrs}}
                                        </h6>
                                      
                                        </div>
                                    </div>
                                    <div class="course_accordion" id="course_accordion">

                                        @foreach ($video['subjects'] as $key => $subject)
                                                <?php $total = 0 ?>
                                                <?php $totalTime = 0 ?>
                                            <div class="item">
                                                <div class="item-header" id="headingOne-{{$key}}">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="true" aria-controls="collapse-{{$key}}">

                                                            <div class="course_accord_list">
                                                                <h2>{{ $subject['name'] }}</h2>
                                                                <div class="accord_list_inner">
                                                                    <ul>
                                                                        <li>
                                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/play-video.svg')}}" alt="">
                                                                            <h6>
                                                                                    @foreach($subject['chapters'] as $chapter)
                                                                                        @foreach($chapter['modules'] as $module)
                                                                                            @foreach($module['videos'] as $moduleVideo)
                                                                                                <?php $total = $total+1 ?>
                                                                                            @endforeach
                                                                                    @endforeach
                                                                                @endforeach
                                                                                {{$total}}
                                                                            </h6>
                                                                        </li>
                                                                        <li>
                                                                            <span></span>
                                                                        </li>
                                                                        <li>
                                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/time-blue.svg')}}" alt="">
                                                                            <h6>
                                                                                @foreach($subject['chapters'] as $chapter)
                                                                                    @foreach($chapter['modules'] as $modules)
                                                                                        @foreach($modules['videos'] as $video)
                                                                                            <?php $totalTime = $totalTime + $video['duration'] ?>
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                @endforeach
                                                                                    <?php
                                                                                    $getHours = floor($totalTime / 3600);
                                                                                    $getMins = floor(($totalTime - ($getHours*3600)) / 60);
                                                                                    $getSecs = floor($totalTime % 60);

                                                                                    if(strlen($getHours)==1){
                                                                                        $getHours = '0'.$getHours;
                                                                                    }
                                                                                    if(strlen($getMins)==1){
                                                                                        $getMins = '0'.$getMins;
                                                                                    }
                                                                                    if(strlen($getSecs)==1){
                                                                                        $getSecs = '0'.$getSecs;
                                                                                    }
                                                                                    ?>
                                                                                {{$getHours.':'.$getMins.':'.$getSecs}}
                                                                            </h6>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <i class="fa fa-chevron-up"></i>

                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapse-{{$key}}" class="collapse show" aria-labelledby="heading-{{$key}}" data-parent="#course_accordion">
                                                    <!--Accordion Child -->
                                                    <div class="card-body" id="course_child">
                                                        @foreach($subject['chapters'] as $key => $chapter)
                                                            <div class="card">
                                                                <div class="card-header p-0">
                                                                    <button class="btn btn-link @if($key!=0) collapsed @endif"  data-toggle="collapse" data-target="#collapse{{ $chapter['id'] }}" aria-expanded="false" aria-controls="collapse{{ $chapter['id'] }}">
                                                                        <h5>{{ $chapter['name'] }}</h5>
                                                                        <i class="fa fa-chevron-up"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="card-body collapse @if($key==0) show @endif" data-parent="#course_child" id="collapse{{ $chapter['id'] }}">
                                                                    @foreach($chapter['modules'] as $module)
                                                                        <div class="course_modules">
                                                                            <div class="inner_module">
                                                                                <div class="module_title">Module : {{$module['name']}}</div>
                                                                                <ul class="module_diff">
                                                                                    @foreach($module['videos'] as $moduleVideo)
                                                                                        {{--                                                                           MODULE {{ $moduleVideo['id'] }}--}}
                                                                                        <li id="last-video-played-{{$moduleVideo['id']}}" class="last-video-played lecture_list @if($moduleVideo['id'] == $currentVideoId) continue @else play_next @endif">
                                                                                            {{--                                                                            <li class="lecture_list played">--}}
                                                                                            <a class="text-info video-link" href="#" data-video-id="{{ $moduleVideo['id'] }}" data-video-title="{{ $moduleVideo['title'] }}">
                                                                                                {{--                                                                                    @if($moduleVideo['video_histories'] && $lastWatchedVideo['video_id'] == $moduleVideo['id'])--}}
                                                                                                {{--                                                                                    VideoId{{ $moduleVideo['id'] }}--}}
                                                                                                {{--                                                                                    <div  class="progress-class">--}}
                                                                                                @if(count($moduleVideo['video_histories'])>0)
                                                                                                    @if($moduleVideo['video_histories'][0]['position'] != 0)
                                                                                                        <div id="progress-{{ $moduleVideo['id'] }}" class="lecture_progress progress-bar d-none" style=" position: absolute;
                                                                                                            width: {{ number_format($moduleVideo['video_histories'][0]['position'] *100 / (!empty($moduleVideo['video_histories'][0]['total_duration']) ? $moduleVideo['video_histories'][0]['total_duration'] : 1)) }}%;
                                                                                                            left: 0;
                                                                                                            right: 0;
                                                                                                            height: 100%;
                                                                                                            background: #58CEA4;
                                                                                                            opacity: 0.2;
                                                                                                            z-index: -1;">

                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div id="progress-{{ $moduleVideo['id'] }}" class="lecture_progress progress-bar d-none" style=" position: absolute;
                                                                                                    width:0%;
                                                                                                    left: 0;
                                                                                                    right: 0;
                                                                                                    height: 100%;
                                                                                                    background: #58CEA4;
                                                                                                    opacity: 0.2;
                                                                                                    z-index: -1;">
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @endif
                                                                                                {{--                                                                                    </div>--}}

                                                                                                <img class="play" src="{{asset('assets/new_ui_assets/images/dashboard/play_chapter.svg')}}" alt="">
                                                                                                <div class="lecture_head">
                                                                                                    <p class="last_played">Now Playing</p>
                                                                                                    <h4 class="lec_title">{{ $moduleVideo['title'] }}</h4>
                                                                                                    <ul class="module_views">
                                                                                                        <li>
                                                                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/time-blue.svg')}}" alt="">
                                                                                                            <h6>{{ $moduleVideo['formatted_duration'] }}</h6>
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            <span></span>
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/views.svg')}}" alt="">
                                                                                                            <h6 id="time-{{$moduleVideo['id']}}">@if($moduleVideo['video_histories'])
                                                                                                                    {{ gmdate("H:i:s", $moduleVideo['video_histories'][0]['position']) }} @else 00:00:00 @endif</h6>
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            <span></span>
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            <h6 id="percentage-{{$moduleVideo['id']}}">
                                                                                                                @if(count($moduleVideo['video_histories'])>0)
                                                                                                                    @if($moduleVideo['video_histories'][0]['position'] != 0)
                                                                                                                        {{ number_format($moduleVideo['video_histories'][0]['position'] *100 / (!empty($moduleVideo['video_histories'][0]['total_duration']) ? $moduleVideo['video_histories'][0]['total_duration'] : 1)) }}% Completed
                                                                                                                    @else
                                                                                                                        0% Completed
                                                                                                                    @endif
                                                                                                                @else
                                                                                                                    0% Completed
                                                                                                                @endif
                                                                                                            </h6>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <ul class="nav nav-pills mb-3 course_switch" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if(request()->input('tab') == 'notes') active @endif" id="my_notes_tab" data-toggle="pill" href="#my_notes" role="tab" aria-controls="my_notes" aria-selected="true">My Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(request()->input('tab') == 'pro_notes') active @endif" id="proff_notes_tab" data-toggle="pill" href="#notes_my_proff" role="tab" aria-controls="notes_my_proff" aria-selected="false">Professor Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(request()->input('tab') == 'question') active @endif " id="my_question_tab" data-toggle="pill" href="#my_question" role="tab" aria-controls="my_question" aria-selected="false">My Questions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="test_papers_tab" data-toggle="pill" href="#test_paper" role="tab" aria-controls="test_paper" aria-selected="false">Test Papers</a>
                                    </li>
                                </ul>
                                <hr>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade @if(request()->input('tab') == 'notes') show active @endif" id="my_notes" role="tabpanel" aria-labelledby="my_notes_tab">
                                        <form id="form-note">
                                            <input id="note-id" type="hidden">
                                            <input id="note-video-id" type="hidden">
                                            <div class="form-group">
                                                <label for="note-name">Note Title</label>
                                                <input  id="note-name" type="text" class="form-control" name="note_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="note-description">Details</label>
                                                <textarea id="note-description" name="note_description" cols="100%" rows="5"></textarea>
                                            </div>
                                            <button id="save" class="btn" type="submit">Submit</button>
                                        </form>
                                        <hr>
                                        <ul class="notes-container">

                                        </ul>

                                    </div>
                                    <div class="tab-pane fade @if(request()->input('tab') == 'pro_notes') show active @endif" id="notes_my_proff" role="tabpanel" aria-labelledby="proff_notes_tab">
                                        <ul class="professor-notes-container">

                                        </ul>
                                    </div>
                                    <div class="tab-pane fade @if(request()->input('tab') == 'question') show active @endif" id="my_question" role="tabpanel" aria-labelledby="my_question_tab">
                                        <form id="form-question">
                                            <input id="question-video-id" type="hidden">
                                            <div class="form-group">
                                                <label for="details">Ask a Question</label>
                                                <textarea onkeypress="return isAlfa(event)" name="question" id="question" cols="100%" rows="5"></textarea>
                                                <p id="charNum"></p>
                                            </div>
                                            <button class="btn" type="submit" id="ask-btn">Ask Question</button>
                                        </form>
                                        <hr>
                                        <ul class="questions-container">

                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="test_paper" role="tabpanel" aria-labelledby="test_papers_tab">
                                        @if(count($studyMaterials['package']['package_study_materials'])>0)
                                            @foreach($studyMaterials['package']['package_study_materials'] as $testPaper)
                                            <div class="test_paper">
                                                <div class="inner_paper">
    {{--                                                <img id="paper_thumbnail" src="https://picsum.photos/110/60" alt="">--}}
                                                    <h2>
                                                        {{ $testPaper['study_material']['title'] }}
                                                    </h2>
                                                </div>
                                                <a href="{{ url( $testPaper['study_material']['file_url']) }}" target="_blank">
                                                    <img id="download" src="{{asset('assets/new_ui_assets/images/dashboard/download.svg')}}" alt="">
                                                </a>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

    </div>

    <div class="modal fade" id="modal-remaining-duration-warning" tabindex="-1" role="dialog" aria-labelledby="modal-remaining-duration-warning" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center text-secondary">
                            <span><i class="far fa-clock fa-3x"></i></span>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-2 text-primary">
                            <h5 class="text-center">SORRY, YOUR WATCH LIMIT EXCEEDED!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-validity-expired-warning" tabindex="-1" role="dialog" aria-labelledby="modal-validity-expired-warning" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center text-secondary">
                            <span><i class="far fa-calendar fa-3x"></i></span>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-2 text-primary">
                            <h5 class="text-center">SORRY, YOUR PACKAGE VALIDITY HAS BEEN EXPIRED!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;">
            <li class="template-note">
                <div class="list-header">
                    <h6 class="note-created-time"></h6>
                    <div class="header-right">
                        <span class="note-created-at"></span>
                    </div>
                </div>
                <p class="note-name"></p>
                <p class="note-description"></p>
            </li>

            <li class="template-professor-note">
                <div class="list-header">
                    <h6 class="professor-note-position"></h6>
                    <div class="header-right">
                        <span class="professor-note-created-at"></span>
                    </div>
                </div>
                <p class="professor-note-name"></p>
                <p class="professor-note-description"></p>
            </li>

            <li class="template-question">
                <div class="list-header">
                    <h6 class="question-created-time"></h6>
                    <div class="header-right">
                        <span class="question-created-at"></span>
                    </div>
                </div>
                <p class="question-content"></p>
                <div class="answer-section d-none">
                    <h6 class="answer-create">Answer</h6>
                    <div class="answer-time">
                        <span class="answer-created-at" style="font-weight: bold;
    font-size: 12px;
    color: #666666;"></span>
                    </div>
                </div>
                <p class="answer-content"></p>
            </li>
    </div>
@endsection

@push('script')
    <script src="{{ $libraryUrl }}"></script>
    <script src="{{ asset('dist/js/video.min.js') }}"></script>
    <script src="{{ asset('dist/js/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('dist/js/videojs-resolution-switcher.js') }}"></script>
    <script>
        let currentVideoType = '';
        function isWhiteSpace(char) {
  return (/\s/).test(char);
}
function willCreateWhitespaceSequence(evt) {
  var willCreateWSS = false;
  if (isWhiteSpace(evt.key)) {
  
    var elmInput = evt.currentTarget;
    var content = elmInput.value;

    var posStart = elmInput.selectionStart;
    var posEnd = elmInput.selectionEnd;

    willCreateWSS = (
         isWhiteSpace(content[posStart - 1] || '')
      || isWhiteSpace(content[posEnd] || '')
    );
  }
  return willCreateWSS;
}

function isAlfa(evt) {

    if (event.target.value.substr(-1) === ' ' && event.code === 'Space') {
    return false;
    }
}

        $(function() {
            let videoType = '';
            let currentVideoID;
            let firstPlay = true;
            let durationInterval = false;
            let jwp = false;

            let playlist = @json($playlist);
            let playlistVideoIDs = [];
            $.each(playlist, function(key, val) {
                playlistVideoIDs.push(val.id);
            });

            function nextVideo(playlist, videoIDs, currentVideo) {

                let currentIndex = videoIDs.indexOf(currentVideo);

                if (currentIndex === videoIDs.length - 1) {
                    return;
                }

                let nextIndex = currentIndex + 1;
                var videoId = videoIDs[nextIndex];
                getPlayer(videoId);
                $('#video-title').text(playlist[nextIndex].title);
                nowPlaying(videoId);
            }

            function previousVideo(playlist, videoIDs, currentVideo) {
                let currentIndex = videoIDs.indexOf(currentVideo);

                if (currentIndex === 0) {
                    return;
                }

                let nextIndex = currentIndex - 1;
                var videoId = videoIDs[nextIndex];
                getPlayer(videoId);
                $('#video-title').text(playlist[nextIndex].title);
                nowPlaying(videoId);
            }

            function getPlayer(videoID) {
                $.ajax({
                    async:false,
                    url: '{{ url('videos/get-player') }}' + '/' + videoID + '/new'
                }).done(function(response) {
                    videoType = response.type;
                    currentVideoType = videoType;

                    var videojsPlayer = videojs('video-player-js');                      
                    if (videojsPlayer) {
                        videojsPlayer.dispose();
                        $('#video-play-container').append(`<video id="video-player-js" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" style="width: 100%;min-height: 35em;height:100%;display:none;"></video>`);
                    }
                    if(jwp){
                        if(jwplayer('video-player')){
                            jwplayer().stop();
                        }
                    }

                    if( videoType !== 's3' ){              
                    $('#video-player-js').hide();
                    $('#video-player').show(); 

                    if(jwp){
                    jwplayer('video-player').setup({
                        'file': response.url,
                        'autostart': "viewable"
                    });
                    }

                    let lastPosition = 0;
                    let totalDuration = 0;

                    $.ajax({
                        url: '{{ route('video-histories.index') }}',
                        data: {
                            package_id: '{{ $package['id'] }}',
                            video_id: videoID,
                            order_item_id: {{ $orderItemId }}
                        },
                        async: false
                    }).done(function(response) {
                        var positionValue;
                        @if(request()->input('position'))
                            positionValue = {{ request()->input('position') }};
                        @else
                            positionValue = null;
                        @endif
                        let history = response[0] || null;
                        if (history) {
                            if(positionValue!=null){
                                lastPosition = positionValue;
                            }
                            else {
                                lastPosition = parseInt(history.position);
                            }

                            totalDuration = parseInt(history.total_duration);
                        }
                    });

                    if(jwp){
                        jwplayer().on('firstFrame', function() {
                            if (lastPosition === totalDuration) {
                                jwplayer().seek(0);
                            } else {
                                jwplayer().seek(lastPosition);
                            }
                        });
                    }

                    $('.video-div').each(function() {
                        $(this).removeClass('bg-primary-50');
                    })

                    $(`#video-div-${videoID}`).addClass('bg-primary-50');

                    if(jwp){
                        jwplayer().on('complete', function() {
                            var current_video_index=playlistVideoIDs.indexOf(videoID);
                            var next_video_index=current_video_index +1;
                            let a =playlistVideoIDs[next_video_index];

                            $.ajax({
                                url: '{{ route('video-histories.index') }}',
                                data: {
                                    package_id: '{{ $package['id'] }}',
                                    video_id: a,
                                    order_item_id: {{ $orderItemId }}
                                }
                            });
                            nextVideo(playlist, playlistVideoIDs, videoID);
                        });
                    }

                    let remainingDuration = 0;
                    let totalPackageDuration = 0;
                    let remainingPackageDuration;
                    let isValidityExpired = false;

                    $.ajax({
                        url: '{{ url('remaining-duration') }}',
                        data: {
                            package_id: '{{ $package['id'] }}',
                            order_item_id: '{{ $orderItemId }}'
                        },
                        async: false
                    }).done(function(response) {
                        remainingDuration = response.remaining_duration || 0;
                        totalPackageDuration = response.total_duration || 0;
                        isValidityExpired = response.is_validity_expired || false;
                    });

                    if (isValidityExpired) {
                        if(jwp){
                        jwplayer().stop();
                        }
                        $('#modal-validity-expired-warning').modal('toggle');
                    }

                    function convertHMS(value) {
                        const sec = parseInt(value, 10);
                        let hours   = Math.floor(sec / 3600);
                        let minutes = Math.floor((sec - (hours * 3600)) / 60);
                        let seconds = sec - (hours * 3600) - (minutes * 60);
                        if (hours   < 10) {hours   = '0' + hours;}
                        if (minutes < 10) {minutes = '0' + minutes;}
                        if (seconds < 10) {seconds = '0' + seconds;}

                        return hours + ':' + minutes + ':' + seconds;
                    }

                    totalPackageDuration = convertHMS(totalPackageDuration >= 0 ? Math.round(totalPackageDuration) : 0);
                    remainingPackageDuration = convertHMS(remainingDuration >= 0 ? Math.round(remainingDuration) : 0);

                    $('.total-duration').text(totalPackageDuration);
                    $('.remaining-duration').text(remainingPackageDuration);
                    var _href = $("a.history").attr("href");
                    $("a.history").attr("href", _href +'&totalDuration='+totalPackageDuration + '&remainingPackageDuration='+remainingPackageDuration);


                    let i = 0;

                    setInterval(function() {
                        let state = jwplayer().getState();

                        if (state === 'playing') {
                            i++;

                            if (remainingDuration >= 0) {
                                remainingDuration--;
                            }

                            if (remainingDuration <= 0) {
                                let position = jwplayer().getPosition();

                                if (i > 0) {
                                    postVideoHistory(i, videoID, position);
                                }

                                i = 0;

                                jwplayer().stop();
                                $('#modal-remaining-duration-warning').modal('toggle');

                                $.ajax({
                                    type: 'POST',
                                    url: '{{ url('order-items/mark-as-completed') }}' + '/' + '{{ $orderItemId }}'
                                }).done(function(response) {
                                    //
                                });
                            }
                        }
                    }, 1000);

                    jwplayer().on('play', function() {
                        if (remainingDuration <= 0) {
                            jwplayer().stop();

                            if (remainingDuration <= 0 && isValidityExpired) {
                                $('#modal-validity-expired-warning').modal('toggle');
                            } else {
                                $('#modal-remaining-duration-warning').modal('toggle');
                            }
                        }

                        if (isValidityExpired) {
                            jwplayer().stop();

                            if (remainingDuration <= 0 && isValidityExpired) {
                                //
                            } else {
                                $('#modal-validity-expired-warning').modal('toggle');
                            }
                        }
                    });

                    jwplayer().on('remove', function() {
                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;
                    });

                    jwplayer().on('pause', function() {
                        // nowPlaying(videoID);
                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;
                    });

                    // window.addEventListener('beforeunload', function(event) {
                    //     console.log('I am the 1st one.');
                    // });


                    window.onbeforeunload = function() {
                        //console.log(" window.onbeforeunload");
                        saveFormData();
                        return 'Are you sure you want to leave this video?';
                    }

                    function saveFormData() {

                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;
                    }

                    jwplayer().on('seeked', function() {
                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;

                        // lastWatchedVideo();
                    });

                    jwplayer().on('ready', function(event){
                        jwplayer().addButton(
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/></svg>',
                            'Next Video',
                            function () {
                                nextVideo(playlist, playlistVideoIDs, videoID);
                            },
                            'jwp-btn-next-video',
                            'jwp-btn-next-video'
                        );

                        jwplayer().addButton(
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/></svg>',
                            'Previous Video',
                            function () {
                                previousVideo(playlist, playlistVideoIDs, videoID);
                            },
                            'jwp-btn-previous-video',
                            'jwp-btn-previous-video'
                        );

                        jwplayer().addButton(
                            '{{ url('assets/images/seek-forward.png') }}',
                            'Seek Forward',
                            function () {
                                let currentPosition = jwplayer().getPosition();

                                jwplayer().seek(currentPosition + 10);
                            },
                            'jwp-btn-seek-forward',
                            'jwp-btn-seek-forward'
                        );

                        jwplayer().addButton(
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg>',
                            'Ask a question',
                            function () {
                                $('#button-add-question').trigger('click');
                            },
                            'jwp-btn-ask-a-question',
                            'jwp-btn-ask-a-question'
                        );


                        jwplayer().addButton(
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 11h-2v3H8v2h3v3h2v-3h3v-2h-3zm1-9H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>',
                            'Add note',
                            function () {
                                $('#button-add-note').trigger('click');
                            },
                            'jwp-btn-add-note',
                            'jwp-btn-add-note'
                        );

                        var $controlbar = $('#video-player').find('.jw-controlbar');

                        $controlbar.find('.jw-icon-rewind').html('<img width="21px" src="{{ url('assets/images/seek-backward.png') }}">')
                        $controlbar.find('.jwp-btn-seek-forward').html('<img width="21px" src="{{ url('assets/images/seek-forward.png') }}">')

                        $controlbar.find('.jwp-btn-seek-forward').insertAfter($controlbar.find('.jw-icon-rewind'));
                        $controlbar.find('.jwp-btn-previous-video').insertAfter($controlbar.find('.jwp-btn-seek-forward'));
                        $controlbar.find('.jwp-btn-next-video').insertAfter($controlbar.find('.jwp-btn-previous-video'));

                        showFloatingText(event);

                        jwplayer().on('fullscreen', function(object) {
                            if (object.fullscreen) {
                                $('.jwp-btn-next-video').hide();
                                $('.jwp-btn-previous-video').hide();
                                $('.jwp-btn-ask-a-question').hide();
                                $('.jwp-btn-add-note').hide();
                            } else {
                                $('.jwp-btn-next-video').show();
                                $('.jwp-btn-previous-video').show();
                                $('.jwp-btn-ask-a-question').show();
                                $('.jwp-btn-add-note').show();
                            }
                        });
                    });

                    @if (request()->filled('position'))
                    let seekPosition = '{{ request()->input('position') }}';
                    jwplayer().seek(parseInt(seekPosition));
                    @endif

                    }else{
                        $('#video-player-js').show();
                        $('#video-player').hide();
                        var media_type = "video/mp4";
                        var extension = response.url.split('.').pop().toLowerCase();
                        if(extension == "m3u8"){
                            media_type = "application/x-mpegURL";
                        }
                        if(response.hasOwnProperty('multi_res_src') && response.multi_res_src.length > 0){
                            var source = response.multi_res_src;
                        } else {
                            var source = [{
                                src: response.url,
                                type: media_type
                            }];
                        }
                        var player = videojs('video-player-js', {
                            autoplay: true,
                            plugins: {
                                videoJsResolutionSwitcher: {
                                    default: 'auto',
                                    dynamicLabel: true
                                }
                            },
                            sources: source,
                            "playbackRates": [0.5, 1, 1.25, 1.5, 2]
                        });

                        document.addEventListener("keydown", function (event) {
                            switch (event.keyCode) {
                                case 32: // Space bar
                                    //restore original behaviour on question tab
                                    if (event.target.tagName.toLowerCase() !== 'textarea') {
                                        event.preventDefault();
                                        if (player.paused()) {
                                            player.play();
                                        } else {
                                            player.pause();
                                        }
                                    }
                                    break;
                                case 37: // Left arrow
                                    // Seek backward by 10 seconds (adjust the time as needed)
                                    player.currentTime(player.currentTime() - 10);
                                    break;
                                case 39: // Right arrow
                                    // Seek forward by 10 seconds (adjust the time as needed)
                                    player.currentTime(player.currentTime() + 10);
                                    break;
                            }
                        });

                        let lastPosition = 0;
                        let totalDuration = 0;

                        $.ajax({
                            url: '{{ route('video-histories.index') }}',
                            data: {
                                package_id: '{{ $package['id'] }}',
                                video_id: videoID,
                                order_item_id: {{ $orderItemId }}
                            },
                            async: true
                        }).done(function(response) {
                            var positionValue;
                            @if(request()->input('position'))
                                positionValue = {{ request()->input('position') }};
                            @else
                                positionValue = null;
                            @endif
                            let history = response[0] || null;
                            if (history) {
                                if(positionValue!=null){
                                    lastPosition = positionValue;
                                }
                                else {
                                    lastPosition = parseInt(history.position);
                                }

                                totalDuration = parseInt(history.total_duration);
                            }
                        });
                        
                        player.on('loadedmetadata', function() {
                            firstPlay = false;
                            if (lastPosition >= totalDuration) {
                                player.currentTime(0);
                            } else {
                                player.currentTime(lastPosition);
                            }
                        });

                        $('.video-div').each(function() {
                            $(this).removeClass('bg-primary-50');
                        })

                        $(`#video-div-${videoID}`).addClass('bg-primary-50');

                        player.on('ended', function() {
                            var current_video_index=playlistVideoIDs.indexOf(videoID);
                            var next_video_index=current_video_index +1;
                            let a =playlistVideoIDs[next_video_index];
                    
                            $.ajax({
                                url: '{{ route('video-histories.index') }}',
                            data: {
                                package_id: '{{ $package['id'] }}',
                                video_id: a,
                                order_item_id: {{ $orderItemId }}
                            }
                        });
                            nextVideo(playlist, playlistVideoIDs, videoID);
                        });

                        let remainingDuration = 0;
                        let totalPackageDuration = 0;
                        let remainingPackageDuration;
                        let isValidityExpired = false;

                        $.ajax({
                            url: '{{ url('remaining-duration') }}',
                            data: {
                                package_id: '{{ $package['id'] }}',
                                order_item_id: '{{ $orderItemId }}'
                            },
                            async: false
                        }).done(function(response) {
                            remainingDuration = response.remaining_duration || 0;
                            totalPackageDuration = response.total_duration || 0;
                            isValidityExpired = response.is_validity_expired || false;
                        });

                        if (isValidityExpired) {
                            player.pause();
                            $('#modal-validity-expired-warning').modal('toggle');
                        }

                        function convertHMS(value) {
                            const sec = parseInt(value, 10);
                            let hours   = Math.floor(sec / 3600);
                            let minutes = Math.floor((sec - (hours * 3600)) / 60);
                            let seconds = sec - (hours * 3600) - (minutes * 60);
                            if (hours   < 10) {hours   = '0' + hours;}
                            if (minutes < 10) {minutes = '0' + minutes;}
                            if (seconds < 10) {seconds = '0' + seconds;}

                            return hours + ':' + minutes + ':' + seconds;
                        }

                        totalPackageDuration = convertHMS(totalPackageDuration >= 0 ? Math.round(totalPackageDuration) : 0);
                        remainingPackageDuration = convertHMS(remainingDuration >= 0 ? Math.round(remainingDuration) : 0);

                        $('.total-duration').text(totalPackageDuration);
                        $('.remaining-duration').text(remainingPackageDuration);
                        var _href = $("a.history").attr("href");
                        $("a.history").attr("href", _href +'&totalDuration='+totalPackageDuration + '&remainingPackageDuration='+remainingPackageDuration);


                        let i = 0;

                        function checkRemainingDuration() {
                            let player = videojs('video-player-js');
                            let currentTime = player.currentTime();

                            if (player.paused()) {
                                return; // Video is paused, do nothing
                            }

                            i++;

                            if (remainingDuration >= 0) {
                                remainingDuration--;
                            }

                            if (remainingDuration <= 0) {
                                if (i > 0) {
                                postVideoHistory(i, videoID, currentTime);
                                }

                                i = 0;
                                
                                player.pause();
                                $('#modal-remaining-duration-warning').modal('toggle');

                                $.ajax({
                                type: 'POST',
                                url: '{{ url('order-items/mark-as-completed') }}' + '/' + '{{ $orderItemId }}'
                                }).done(function(response) {
                                //
                                });
                            }
                        }

                        //player.on('timeupdate', checkRemainingDuration);

                        // To start the interval when the player is playing
                        player.on('play', function() {
                            if(firstPlay == false){
                                clearInterval(durationInterval);
                            }
                            durationInterval = setInterval(checkRemainingDuration, 1000);
                        });


                        player.on('play', function() {
                            if (remainingDuration <= 0) {
                                player.pause();

                                if (remainingDuration <= 0 && isValidityExpired) {
                                $('#modal-validity-expired-warning').modal('toggle');
                                } else {
                                $('#modal-remaining-duration-warning').modal('toggle');
                                }
                            }

                            if (isValidityExpired) {
                                player.pause();

                                if (remainingDuration <= 0 && isValidityExpired) {
                                //
                                } else {
                                $('#modal-validity-expired-warning').modal('toggle');
                                }
                            }
                        });


                        player.on('dispose', function() {
                            let position = player.currentTime();

                            if (i > 0) {
                                postVideoHistory(i, videoID, position);
                            }

                            i = 0;
                        });

                        player.on('pause', function() {
                            let position = player.currentTime();

                            if (i > 0) {
                                postVideoHistory(i, videoID, position);
                            }

                            i = 0;
                        });

                        // window.addEventListener('beforeunload', function(event) {
                        //     console.log('I am the 1st one.');
                        // });


                        window.onbeforeunload = function() {
                            //console.log(" window.onbeforeunload");
                            saveFormData();
                            return 'Are you sure you want to leave this video?';
                        }

                        function saveFormData() {
                            let position = player.currentTime();

                            if (i > 0) {
                                postVideoHistory(i, videoID, position);
                            }

                            i = 0;
                        }


                        player.on('seeked', function() {
                            let position = player.currentTime();

                            if (i > 0) {
                                postVideoHistory(i, videoID, position);
                            }

                            i = 0;

                            // lastWatchedVideo();
                        });


                        player.ready(function() {
                            player.controlBar.addChild('button', {
                                text: 'Next Video',
                                el: videojs.dom.createEl('button', {
                                    className: 'vjs-control vjs-button jwp-btn-next-video',
                                    innerHTML: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/></svg>'
                                }),
                                clickHandler: function() {
                                    nextVideo(playlist, playlistVideoIDs, videoID);
                                }
                            });

                            player.controlBar.addChild('button', {
                                text: 'Previous Video',
                                el: videojs.dom.createEl('button', {
                                    className: 'vjs-control vjs-button jwp-btn-previous-video',
                                    innerHTML: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/></svg>'
                                }),
                                clickHandler: function() {
                                    previousVideo(playlist, playlistVideoIDs, videoID);
                                }
                            });

                            player.controlBar.addChild('button', {
                                text: 'Seek Backward',
                                el: videojs.dom.createEl('button', {
                                    className: 'vjs-control vjs-button jwp-btn-seek-forward',
                                    innerHTML: '<img src="{{ url('assets/images/seek-backward.png') }}" width="21px">'
                                }),
                                clickHandler: function() {
                                    let currentPosition = player.currentTime();
                                    player.currentTime(currentPosition - 10);
                                }
                            });

                            player.controlBar.addChild('button', {
                                text: 'Seek Forward',
                                el: videojs.dom.createEl('button', {
                                    className: 'vjs-control vjs-button jwp-btn-seek-forward',
                                    innerHTML: '<img src="{{ url('assets/images/seek-forward.png') }}" width="21px">'
                                }),
                                clickHandler: function() {
                                    let currentPosition = player.currentTime();
                                    player.currentTime(currentPosition + 10);
                                }
                            });

                            player.controlBar.addChild('button', {
                                text: 'Ask a question',
                                el: videojs.dom.createEl('button', {
                                    className: 'vjs-control vjs-button jwp-btn-ask-a-question',
                                    innerHTML: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg>'
                                }),
                                clickHandler: function() {
                                    $('#button-add-question').trigger('click');
                                }
                            });

                            player.controlBar.addChild('button', {
                                text: 'Add note',
                                el: videojs.dom.createEl('button', {
                                    className: 'vjs-control vjs-button jwp-btn-add-note',
                                    innerHTML: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M13 11h-2v3H8v2h3v3h2v-3h3v-2h-3zm1-9H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>'
                                }),
                                clickHandler: function() {
                                    $('#button-add-note').trigger('click');
                                }
                            });

                            // Customize the control bar icons
                            // Get the rewindButton component
                            let rewindButton = player.controlBar.getChild('rewindButton');

                            // Check if the rewindButton exists
                            if (rewindButton) {
                                // Update the innerHTML of the rewindButton
                                rewindButton.el().innerHTML = '<img width="21px" src="http://v9.jkshahclasses.com:8090/assets/images/seek-backward.png">';
                            }

                            // Get the forwardButton component
                            let forwardButton = player.controlBar.getChild('forwardButton');

                            // Check if the forwardButton exists
                            if (forwardButton) {
                                // Update the innerHTML of the forwardButton
                                forwardButton.el().innerHTML = '<img width="21px" src="http://v9.jkshahclasses.com:8090/assets/images/seek-forward.png">';
                            }


                            var nextVideoButton = player.controlBar.getChild('jwp-btn-next-video');
                            var previousVideoButton = player.controlBar.getChild('jwp-btn-previous-video');
                            var seekForwardButton = player.controlBar.getChild('jwp-btn-seek-forward');

                            // Check if the buttons exist
                            if (previousVideoButton && seekForwardButton) {
                                // Insert the previousVideoButton after the seekForwardButton
                                seekForwardButton.el().parentNode.insertBefore(previousVideoButton.el(), seekForwardButton.el().nextSibling);
                            }

                            if (nextVideoButton && previousVideoButton) {
                                // Insert the nextVideoButton after the previousVideoButton
                                previousVideoButton.el().parentNode.insertBefore(nextVideoButton.el(), previousVideoButton.el().nextSibling);
                            }

                            showFloatingText(event);

                            player.on('fullscreenchange', function() {
                                if (player.isFullscreen()) {
                                    $('.jwp-btn-next-video').hide();
                                    $('.jwp-btn-previous-video').hide();
                                    $('.jwp-btn-ask-a-question').hide();
                                    $('.jwp-btn-add-note').hide();
                                } else {
                                    $('.jwp-btn-next-video').show();
                                    $('.jwp-btn-previous-video').show();
                                    $('.jwp-btn-ask-a-question').show();
                                    $('.jwp-btn-add-note').show();
                                }
                            });
                        });


                        @if (request()->filled('position'))
                        let seekPosition = '{{ request()->input('position') }}';
                        if (typeof seekPosition !== 'undefined') {
                            player.ready(function() {
                                player.on('loadedmetadata', function() {
                                    player.currentTime(parseInt(seekPosition));
                                });
                            });
                        }
                        @endif
                    }
                });

                appendNotes(videoID);
                appendQuestions(videoID);
                appendProfessorNotes(videoID);
                $('#button-add-note').attr('data-video-id', videoID);
                $('#button-add-question').attr('data-video-id', videoID);

                $('#question-video-id').val(videoID);
                $('#note-video-id').val(videoID);
            }

            function getBrowser() {
                var navUserAgent = navigator.userAgent;
                var browserName  = navigator.appName;
                var browserVersion  = ''+parseFloat(navigator.appVersion);
                var majorVersion = parseInt(navigator.appVersion,10);
                var tempNameOffset,tempVersionOffset,tempVersion;


                if ((tempVersionOffset=navUserAgent.indexOf("Opera"))!=-1) {
                    browserName = "Opera";
                    browserVersion = navUserAgent.substring(tempVersionOffset+6);
                    if ((tempVersionOffset=navUserAgent.indexOf("Version"))!=-1)
                        browserVersion = navUserAgent.substring(tempVersionOffset+8);
                } else if ((tempVersionOffset=navUserAgent.indexOf("MSIE"))!=-1) {
                    browserName = "Microsoft Internet Explorer";
                    browserVersion = navUserAgent.substring(tempVersionOffset+5);
                } else if ((tempVersionOffset=navUserAgent.indexOf("Chrome"))!=-1) {
                    browserName = "Chrome";
                    browserVersion = navUserAgent.substring(tempVersionOffset+7);
                } else if ((tempVersionOffset=navUserAgent.indexOf("Safari"))!=-1) {
                    browserName = "Safari";
                    browserVersion = navUserAgent.substring(tempVersionOffset+7);
                    if ((tempVersionOffset=navUserAgent.indexOf("Version"))!=-1)
                        browserVersion = navUserAgent.substring(tempVersionOffset+8);
                } else if ((tempVersionOffset=navUserAgent.indexOf("Firefox"))!=-1) {
                    browserName = "Firefox";
                    browserVersion = navUserAgent.substring(tempVersionOffset+8);
                } else if ( (tempNameOffset=navUserAgent.lastIndexOf(' ')+1) < (tempVersionOffset=navUserAgent.lastIndexOf('/')) ) {
                    browserName = navUserAgent.substring(tempNameOffset,tempVersionOffset);
                    browserVersion = navUserAgent.substring(tempVersionOffset+1);
                    if (browserName.toLowerCase()==browserName.toUpperCase()) {
                        browserName = navigator.appName;
                    }
                }

// trim version
                if ((tempVersion=browserVersion.indexOf(";"))!=-1)
                    browserVersion=browserVersion.substring(0,tempVersion);
                if ((tempVersion=browserVersion.indexOf(" "))!=-1)
                    browserVersion=browserVersion.substring(0,tempVersion);

                // alert("BrowserName = " + browserName + "\n" + "Version = " + browserVersion);

                return browserName + ' - ' + browserVersion;

            }

            function postVideoHistory(i, videoID, position) {
                //console.log(" postVideoHistory");
                if(currentVideoType === 's3'){
                    var player = videojs('video-player-js');
                    var total_duration = player.duration();
                }else{
                    var total_duration = jwplayer().getDuration();
                }
                $.ajax({
                    url: '{{ route('video-histories.store') }}',
                    type: 'POST',
                    // async:false,
                    data: {
                        duration: i,
                        total_duration: total_duration,
                        video_id: videoID,
                        package_id: '{{ $package['id'] }}',
                        order_item_id: '{{ $orderItemId }}',
                        position: position,
                        browser_agent: getBrowser()
                    }
                }).done(function(response) {
                    //console.log(response.video_id);
                    let videoID = response.video_id || null;

                    if (videoID) {
                        let totalDuration = parseInt(response.total_duration);
                        let position = parseInt(response.position);
                        let progress;

                        if (totalDuration === position) {
                            progress = 100;
                        } else {
                            progress = Math.round((position / (totalDuration / 100))) || 0;
                        }
                        $("#percentage-"+videoID).text(progress+'% Completed');
                        // lastWatchedVideo()
                        // $("#last-video-played-"+videoID).addClass('played').removeClass('play_next').removeClass('continue');
                        // // $('div.progress-bar').addClass('d-none');
                        // $("#progress-"+videoID).addClass('d-none');
                        // $(`#video-div-${videoID}`).find('.progress-bar').attr('style', `width: ${progress}%`);
                        // $(`#video-div-${videoID}`).find('.progress-bar').attr('aria-valuenow', `${progress}`);
                    }
                });
            }

            getPlayer({{ $videoID }});

            $('.video-link').click(function() {
                var videoId = $(this).data('video-id')
                getPlayer(videoId);
                $('#video-title').text($(this).data('video-title'));
                lastWatchedVideo();
                nowPlaying(videoId);
                lastWatchedVideo();
                // $('li.last-video-played').removeClass('continue').addClass('play_next');
                // $("#last-video-played-"+videoId).removeClass('play_next').removeClass('played').addClass('continue');
                // $('div.progress-bar').addClass('d-none');
                // $("#progress-"+videoId).removeClass('d-none');
            });

            var $floater = $('<span id="video_floater" style="font-size:10px; position: absolute; z-index: 99999;">' +
                '{{ $user['name'].' ('.$user['phone'].')' }}</span>');

            function showFloatingText(e) {
                if(currentVideoType === 's3'){
                    $('#video-play-container .video-js').append($floater);
                    animateDiv($floater);
                }else{
                    $('#video-play-container .jwplayer').append($floater);
                    if(e.type === 'ready') animateDiv($floater);
                }
            }

            function lastWatchedVideo() {
                $.ajax({
                    url: '{{ url('get-last-watched-video') }}',
                    async:false,
                    data: {
                        order_item: {{ $orderItemId }},
                        package: {{ $package['id'] }},
                    }
                }).done(function (response) {
                    var videoId = response.LastWatchedVideo.video_id;
                    var duration = response.time;

                    // $('li.last-video-played').removeClass('continue').addClass('play_next');
                    $("#last-video-played-"+videoId).addClass('played').removeClass('play_next').removeClass('continue');
                    // $('div.progress-bar').addClass('d-none');
                    $("#progress-"+videoId).addClass('d-none');
                    $("#time-"+videoId).text(duration);
                });
            }

            function nowPlaying(videoId) {
                $('li.last-video-played').removeClass('continue').addClass('play_next');
                $('div.progress-bar').addClass('d-none');
                $("#last-video-played-"+videoId).removeClass('play_next').removeClass('played').addClass('continue');
                $("#progress-"+videoId).removeClass('d-none');
            }

            function getOffset() {
//                var $floater = $('#video_floater');
                if(currentVideoType != undefined && currentVideoType == "s3"){
                    var $jwplayer = $('#video-play-container .video-js');
                    var offset = $jwplayer.offset();
                } else {
                    var $jwplayer = $('#video-play-container .jwplayer');
                    var offset = $jwplayer.offset();
                }
                

                var topRelative = Math.floor(Math.random() * ($jwplayer.height() - $floater.height()));
                var leftRelative = Math.floor(Math.random() * ($jwplayer.width() - $floater.width()));

                topRelative = Math.max(topRelative, 0);
                leftRelative = Math.max(leftRelative, 0);

                var top = /*offset.top +*/ topRelative;
                var left = /*offset.left +*/ leftRelative;

                return {top, left};
            }

            function animateDiv(animateElem){
                var offset = getOffset();

                animateElem.animate({ top: offset.top, left: offset.left }, 10000, function(){
                    animateDiv(animateElem);
                });
            }

        });


        // NOTES

        function appendNotes(videoID) {
            $('.notes-container').html('');

            $.ajax({
                url: '{{ url('get-video-notes') }}',
                data: {
                    video_id: videoID
                }
            }).done(function(response) {
                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        let $template = $('.template-note').clone();
                        $template.removeClass('template-note');
                        $template.find('.note-name').text(val.name);
                        $template.find('.note-position').text(formatDuration(parseInt(val.time || 0)));
                        $template.find('.note-created-at').text(new Date(val.created_at).toLocaleString());

                        var hours = new Date(val.created_at).getHours();
                        var minutes = new Date(val.created_at).getMinutes();
                        var seconds = new Date(val.created_at).getSeconds();

                        var createdTime = val.time;
                        // var time = new Date();

                        // createdTime = createdTime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

                        var measuredTime = new Date(null);
                        measuredTime.setSeconds(val.time); // specify value of SECONDS
                        var MHSTime = measuredTime.toISOString().substr(11, 8);

                        var noteTime = MHSTime.slice(0, 2)
                        if(noteTime=='00'){
                            noteTime = MHSTime.slice(3)
                        }
                        $template.find('.note-created-time').text(noteTime);

                        $template.find('.note-description').text(val.description);
                        $template.find('.button-edit-note').attr('data-note-id', val.id);
                        $template.find('.button-edit-note').attr('data-note-video-id', val.video_id);
                        $template.find('.button-delete-note').attr('data-note-id', val.id);
                        $('.notes-container').append($template);
                    });
                }
            });
        }

        $('#button-add-note').click(function() {
            $('#modal-note').modal('toggle');
        });

        $('#modal-note').on('shown.bs.modal', function(e) {
            jwplayer().pause();
        });

        $('#modal-note').on('hide.bs.modal', function(e) {
            jwplayer().play();
        });

        $('#form-note').validate({
            rules: {
                note_name: {
                    required: true
                },
                note_description: {
                    required: true
                }
            }
        });

        $('#form-note').on('submit', function(e) {
            if ($(this).valid()) {
                e.preventDefault();
                var cur_time = 0;
                if(currentVideoType == "s3"){
                    var videojsPlayer = videojs('video-player-js');
                    cur_time = videojsPlayer.currentTime();
                } else {
                    cur_time = jwplayer().getPosition()
                }
                if ($('#note-id').val()) {
                    $.ajax({
                        url: '{{ url('put-video-note') }}' + '/' + $('#note-id').val(),
                        data: {
                            video_id: $('#note-video-id').val(),
                            package_id: {{ $package['id'] }},
                            name: $('#note-name').val(),
                            description: $('#note-description').val(),
                            time: parseInt(cur_time)
                        },
                        async: false
                    }).done(function() {
                        $('#form-note')[0].reset();
                        $('#note-id').val('');
                    });
                } else {
                    $.ajax({
                        url: '{{ url('post-video-note') }}',
                        data: {
                            video_id: $('#note-video-id').val(),
                            package_id: {{ $package['id'] }},
                            name: $('#note-name').val(),
                            description: $('#note-description').val(),
                            time: parseInt(cur_time)
                        },
                        async: false
                    }).done(function() {
                        $('#form-note')[0].reset();
                        $('#note-id').val('');
                    });
                }
            }

            appendNotes(parseInt($('#note-video-id').val()));
            $('#modal-note').modal('toggle');
        });

        $(document).on('click', '.button-edit-note', function() {
            $('#modal-note').modal('toggle');
            $('#note-id').val($(this).data('note-id'));
            $('#note-name').val($(this).closest('.card').find('.note-name').text());
            $('#note-description').val($(this).closest('.card').find('.note-description').text());
        });

        $(document).on('click', '.button-delete-note', function() {
            let confirmation = confirm('Delete this note?');

            if (confirmation) {
                $.ajax({
                    url: '{{ url('delete-video-note') }}' + '/' + $(this).data('note-id'),
                }).done(function() {
                    $('.notes-container').html('');
                    appendNotes($('#note-video-id').val());
                });
            }
        });

        // END NOTES

        // QUESTIONS

        function appendQuestions(videoID) {
            $('.questions-container').html('');

            $.ajax({
                url: '{{ url('get-video-questions') }}',
                data: {
                    video_id: videoID,
                    package_id: '{{ $package['id'] }}'
                }
            }).done(function(response) {
                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        let $template = $('.template-question').clone();
                        $template.removeClass('template-question');
                        $template.find('.question-content').html(val.question);
                        var d=new Date(val.created_at);
                       
                        dformat = [d.getDate(),
                                    d.getMonth()+1,
                                    d.getFullYear()].join('-')+' '+
                                    [d.getHours(),
                                    d.getMinutes(),
                                    d.getSeconds()].join(':');
                        $template.find('.question-created-at').text(dformat);
                        var measuredTime = new Date(null);
                        measuredTime.setSeconds(val.time); // specify value of SECONDS
                        var MHSTime = measuredTime.toISOString().substr(11, 8);

                        var questionTime = MHSTime.slice(0, 2)
                        if(questionTime=='00'){
                            questionTime = MHSTime.slice(3)
                        }
                        $template.find('.question-created-time').text(questionTime);
                        $template.find('.button-delete-question').attr('data-question-id', val.id);
                        if(val.answer!= null){
                            var dd=new Date(val.answer.created_at);
                       
                       ddformat = [dd.getDate(),
                                   dd.getMonth()+1,
                                   dd.getFullYear()].join('-')+' '+
                                   [dd.getHours(),
                                   dd.getMinutes(),
                                   dd.getSeconds()].join(':');
                            $template.find(".answer-section").removeClass()
                            $template.find('.answer-created-at').text(ddformat);
                            $template.find('.answer-content').html(val.answer.answer);
                        }

                        $('.questions-container').append($template);
                    });
                }
            });
        }

        $('#button-add-question').click(function() {
            $('#modal-question').modal('toggle');
        });

        $('#modal-question').on('shown.bs.modal', function(e) {
            jwplayer().pause();
        });

        $('#modal-question').on('hide.bs.modal', function(e) {
            jwplayer().play();
        });


        jQuery.validator.addMethod("validate_question", function(value, element) {
            var reg =/<(.|\n)*?>/g;
            if (reg.test(value)) {
                return false;
            } else {
                return true;
            }
        }, "HTML tags are not allowed");

        jQuery.validator.addMethod("validate_answer", function(value, element) {
            var text= value.trim();
            var words = text.split(' ');
            if (words.length > 500) {
                return false;
            } else if(value.trim()<1){
                return false;
            }else {
                return true;
            }
            }, "Maximum 500 words are allowed");

        $('#form-question').validate({
            onsubmit:false,
            rules: {
                question: {
                    required: true,
                    validate_question:true,
                    validate_answer:true,
                }
            }
        });

        $('#question').keyup(function(){
            var word = $(this).val().trim();
            var counts = word.split(' ');
            var maxLength = counts.length;
            var remaining = 500 - maxLength;
            //remaining = Math.max(0, remaining);
            if(word == '' && maxLength == 1){
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">500 words remaining</span>';
            }
            else if(remaining > 0 ){
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+remaining+' words remaining</span>';
            }else{
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+maxLength+' words</span>';
            }
        });
        // $('#ask-btn').on('click',function(){
        //     //$("#ask-btnn").html("Verifying  <i class='fa fa-spinner fa-spin'>");
        //     $('#ask-btnn').css('display','block');
        // });

        $('#form-question').on('submit', function(e) {
          
            e.preventDefault();
            let isValid = $('#form-question').valid();
            if (isValid) {
                $("#ask-btn").html("Ask Question <i class='fa fa-spinner fa-spin'>");
                setTimeout(function () {
                var cur_time = 0;
                if(currentVideoType == "s3"){
                    var videojsPlayer = videojs('video-player-js');
                    cur_time = videojsPlayer.currentTime();
                } else {
                    cur_time = jwplayer().getPosition()
                }
                $.ajax({
                    url: '{{ url('post-video-question') }}',
                    data: {
                        video_id: $('#question-video-id').val(),
                        package_id: {{ $package['id'] }},
                        question: $('#question').val(),
                        time: parseInt(cur_time)
                    },
                    async: false
                }).done(function() {
                    // $('#modal-question').modal('toggle');
                    $('#form-question')[0].reset();
                    //$("#ask-btn").html("Ask Question");
                    $("#charNum").html("");
                    appendQuestions($('#question-video-id').val());
                    $("#ask-btn").html("Ask Question");
                });
            }, 3000);
            }

        });

        $(document).on('click', '.button-delete-question', function() {
            let confirmation = confirm('Delete this question?');

            if (confirmation) {
                $.ajax({
                    url: '{{ url('delete-video-question') }}' + '/' + $(this).data('question-id'),
                }).done(function() {
                    $('.questions-container').html('');
                    appendQuestions($('#question-video-id').val());
                });
            }
        });

        // END QUESTIONS

        // PROFESSOR NOTES

        function appendProfessorNotes(videoID) {
            $('.professor-notes-container').html('');

            $.ajax({
                url: '{{ url('get-video-professor-notes') }}',
                data: {
                    video_id: videoID
                }
            }).done(function(response) {
                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        let $template = $('.template-professor-note').clone();
                        $template.removeClass('template-professor-note');
                        $template.find('.professor-note-name').text(val.name);
                        $template.find('.professor-note-position').text(formatDuration(parseInt(val.time || 0)));
                        $template.find('.professor-note-created-at').text(new Date(val.created_at).toLocaleString());
                        $template.find('.professor-note-description').text(val.description);
                        $('.professor-notes-container').append($template);
                    });
                }
            });
        }

        // END PROFESSOR NOTES

        var pad_num = function(number, size) {
            var s = String(number);
            while (s.length < (size || 2)) {s = "0" + s;}
            return s;
        };

        $('.collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            var $btn = $(this).closest('.card').find('[data-target="#'+id+'"] i');

            $btn.removeClass('fa-minus');
            $btn.addClass('fa-plus');
        });

        $('.collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            var $btn = $(this).closest('.card').find('[data-target="#'+id+'"] i');

            $btn.removeClass('fa-plus');
            $btn.addClass('fa-minus');
        });

        var formatDuration = function (durationInSeconds) {
            var hours = Math.floor(durationInSeconds / 3600);
            durationInSeconds %= 3600;
            var minutes = Math.floor(durationInSeconds / 60);
            var seconds = durationInSeconds % 60;

            var durations = [pad_num(minutes), pad_num(seconds)];

            if (hours > 0) durations.unshift(pad_num(hours));

            return durations.join(':');
        };

    </script>
@endpush
