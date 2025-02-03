@extends('layouts.master')

@section('title', 'Video')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-secondary"><b>{{ $package['name'] }}</b>
                        <a class="history pl-3" href="{{ url('histories') . '/' . $video['id'] . '?package=' . $package['id'] . '&order_item=' . $orderItemId ?? '' }}">[Watch History]</a>
                    </h3>
                </div>
            </div>

            <a href="{{ url('contents') }}"><i class="far fa-arrow-alt-circle-left fa-2x text-secondary"></i></a><br>

            <div class="row mt-3">
                <div class="col-md-8">
                    <div id="video-play-container" class="position-relative">
                        <div id="video-player" class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mt-3" id="video-title">{{ $video['title'] }}</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-4 float-right">
                                <span><i class="far fa-clock"></i> Remaining Duration: <b><span class="remaining-duration">-</span> / <span class="total-duration">-</span></b></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col offset-md-1 offset-sm-0 mt-5">
                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                <li class="nav-item border-primary">
                                    <a class="nav-link active" id="my-notes-tab" data-toggle="tab" href="#my-notes" role="tab"
                                       aria-controls="my-notes" aria-selected="true">My Notes</a>
                                </li>
                                <li class="nav-item border-primary">
                                    <a class="nav-link" id="professor-notes-tab" data-toggle="tab" href="#professor-notes" role="tab"
                                       aria-controls="professor-notes" aria-selected="false">Professor Notes</a>
                                </li>
                                <li class="nav-item border-primary">
                                    <a class="nav-link" id="ask-question-tab" data-toggle="tab" href="#ask-question" role="tab"
                                       aria-controls="ask-question" aria-selected="false">Ask A Question</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10 offset-md-1 offset-sm-0">
                            <div class="tab-content container" id="myTabContent">
                                <div class="tab-pane fade show active" id="my-notes" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <button id="button-add-note" class="btn btn-sm btn-primary my-4 rounded-0">ADD</button>
                                    </div>
                                    <div class="row notes-container"></div>
                                </div>
                                <div class="tab-pane fade show" id="professor-notes" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row mt-4 professor-notes-container"></div>
                                </div>
                                <div class="tab-pane fade show" id="ask-question" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <button id="button-add-question" class="btn btn-sm btn-primary my-4 rounded-0">ADD</button>
                                    </div>
                                    <div class="row questions-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border shadow p-3">
                        @foreach ($video['subjects'] as $subject)
                            <div class="subject-heading p-1 justify-content-center">
                                <span class="subject-name tex">{{ $subject['name'] }}</span>
                            </div>
                            <div>
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="accordion student-chapters-accordion" id="student-chapters-accordion">
                                                @foreach($subject['chapters'] as $chapter)
                                                    <div class="card mt-2 border-0 rounded">
                                                        <div class="bg-secondary-100 shadow-sm d-flex flex-wrap align-items-center" id="heading0">
                                                            <span class="flex-fill py-1 px-2 text-white"><b>@if(strlen($chapter['name']) > 30) {{ substr($chapter['name'], 0, 30) . '...' }} @else {{ $chapter['name'] }} @endif</b></span>
                                                            <button class="btn btn-primary py-1" type="button" data-toggle="collapse"
                                                                    data-target="#collapse{{ $chapter['id'] }}" aria-expanded="true" aria-controls="collapse{{ $chapter['id'] }}">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <div id="collapse{{ $chapter['id'] }}" class="collapse" aria-labelledby="heading{{ $chapter['id'] }}" data-parent="#student-chapters-accordion">
                                                            @foreach($chapter['modules'] as $module)
                                                                <div class="text-center m-3">
                                                                    <h5>{{ $module['name'] }}</h5>
                                                                </div>
                                                                @foreach($module['videos'] as $video)
                                                                    <div id="video-div-{{ $video['id'] }}" class="border p-2 my-2 video-div">
                                                                        <div class="row">
                                                                            <div class="col-md-12 py-2">
                                                                                <a class="text-info video-link" href="#" data-video-id="{{ $video['id'] }}" data-video-title="{{ $video['title'] }}">{{ $video['title'] }}</a>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <span class="text-muted fs-14">
                                                                                    <i class="far fa-clock pr-1"></i> {{ $video['formatted_duration'] }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="progress">
                                                                                    <div class="progress-bar" role="progressbar" style="width: @if((isset($video['video_histories'][0]['position']) && $video['video_histories'][0]['position'] != 0) && (isset($video['duration']) && $video['duration'] != 0)) {{ round((($video['video_histories'][0]['position']) / (($video['duration']) / 100))) . '%' }} @endif" aria-valuenow="@if((isset($video['video_histories'][0]['position']) && $video['video_histories'][0]['position'] != 0) && (isset($video['duration']) && $video['duration'] != 0)) {{ round((($video['video_histories'][0]['position']) / (($video['duration']) / 100))) }} @endisset" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="modal-note" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-note">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="">NOTE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="note-id" type="hidden">
                        <input id="note-video-id" type="hidden">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Note Name</label>
                            <input id="note-name" type="text" class="form-control" name="note_name">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Detailed Note</label>
                            <textarea id="note-description" class="form-control" name="note_description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button id="save" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-question" tabindex="-1" role="dialog" aria-labelledby="modal-question" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-question">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="">ASK A QUESTION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="question-video-id" type="hidden">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Question</label>
                            <input id="question" type="text" class="form-control" name="question">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button id="save" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="display: none;">
        <div class="col-md-12 p-0 mb-4 template-note">
            <div class="card">
                <div class="card-header bg-secondary-100">
                    <div class="row">
                        <div class="col-md-8 note-name"></div>
                        <div class="col-md-4 text-md-right text-sm-left">
                            <button class="btn p-0 mr-1 button-edit-note"><i class="far fa-edit"></i></button>
                            <button class="btn p-0 mr-1 button-delete-note"><i class="far fa-trash-alt"></i></button>
                            <i class="far fa-clock"></i><span> <span class="note-position"></span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-primary-50">
                    <div class="text-muted mb-3"><strong>Created at</strong> <span class="note-created-at"></span></div>
                    <p class="card-text note-description"></p>
                </div>
            </div>
        </div>
        <div class="col-md-12 p-0 mb-4 template-professor-note">
            <div class="card">
                <div class="card-header bg-secondary-100">
                    <div class="row">
                        <div class="col-md-8 professor-note-name"></div>
                        <div class="col-md-4 text-md-right text-sm-left">
                            <i class="far fa-clock"></i><span> <span class="professor-note-position"></span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-muted mb-3"><strong>Created at</strong> <span class="professor-note-created-at"></span></div>
                    <p class="card-text professor-note-description"></p>
                </div>
            </div>
        </div>
        <div class="col-md-12 p-0 mb-4 template-question">
            <div class="card rounded-0">
                <div class="card-body bg-primary-50">
                    <div class="text-muted mb-3"><strong>Created at</strong> <span class="question-created-at"></span></div>
                    <p class="card-text question-content"></p>
                    <div class="text-md-right">
                        <button class="btn btn-sm btn-primary button-delete-question">Remove</button>
                    </div>
                </div>
            </div>
        </div>
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
@endsection

@push('script')
    <script src="{{ $libraryUrl }}"></script>
    <script>
        $(function() {
            let currentVideoID;

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

                getPlayer(videoIDs[nextIndex]);
                $('#video-title').text(playlist[nextIndex].title);
            }

            function previousVideo(playlist, videoIDs, currentVideo) {
                let currentIndex = videoIDs.indexOf(currentVideo);

                if (currentIndex === 0) {
                    return;
                }

                let nextIndex = currentIndex - 1;

                getPlayer(videoIDs[nextIndex]);
                $('#video-title').text(playlist[nextIndex].title);
            }

            function getPlayer(videoID) {
                $.ajax({
                    url: '{{ url('videos/get-player') }}' + '/' + videoID
                }).done(function(response) {
                    jwplayer('video-player').setup({
                        'file': response,
                        'autostart': "viewable"
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
                        async: false
                    }).done(function(response) {
                        let history = response[0] || null;

                        if (history) {
                            lastPosition = parseInt(history.position);
                            totalDuration = parseInt(history.total_duration);
                        }
                    });

                    jwplayer().on('firstFrame', function() {
                        if (lastPosition === totalDuration) {
                            jwplayer().seek(0);
                        } else {
                            jwplayer().seek(lastPosition);
                        }
                    });

                    $('.video-div').each(function() {
                        $(this).removeClass('bg-primary-50');
                    })

                    $(`#video-div-${videoID}`).addClass('bg-primary-50');

                    jwplayer().on('complete', function() {
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
                        jwplayer().stop();
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
                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;
                    });

                    window.onbeforeunload = function() {
                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;

                        return 'Are you sure you want to leave this video?';
                    };

                    jwplayer().on('seeked', function() {
                        let position = jwplayer().getPosition();

                        if (i > 0) {
                            postVideoHistory(i, videoID, position);
                        }

                        i = 0;
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
                $.ajax({
                    url: '{{ route('video-histories.store') }}',
                    type: 'POST',
                    data: {
                        duration: i,
                        total_duration: jwplayer().getDuration(),
                        video_id: videoID,
                        package_id: '{{ $package['id'] }}',
                        order_item_id: '{{ $orderItemId }}',
                        position: position,
                        browser_agent: getBrowser()
                    }
                }).done(function(response) {
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

                        $(`#video-div-${videoID}`).find('.progress-bar').attr('style', `width: ${progress}%`);
                        $(`#video-div-${videoID}`).find('.progress-bar').attr('aria-valuenow', `${progress}`);
                    }
                });
            }

            getPlayer({{ $videoID }});

            $('.video-link').click(function() {
                getPlayer($(this).data('video-id'));
                $('#video-title').text($(this).data('video-title'));
            });

            var $floater = $('<span id="video_floater" style="font-size:10px; position: absolute; z-index: 99999;">' +
                '{{ $user['name'].' ('.$user['phone'].')' }}</span>');

            function showFloatingText(e) {
                $('#video-play-container .jwplayer').append($floater);
                if(e.type === 'ready') animateDiv($floater);
            }

            function getOffset() {
//                var $floater = $('#video_floater');

                var $jwplayer = $('#video-play-container .jwplayer');
                var offset = $jwplayer.offset();

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

                if ($('#note-id').val()) {
                    $.ajax({
                        url: '{{ url('put-video-note') }}' + '/' + $('#note-id').val(),
                        data: {
                            video_id: $('#note-video-id').val(),
                            package_id: {{ $package['id'] }},
                            name: $('#note-name').val(),
                            description: $('#note-description').val(),
                            time: parseInt(jwplayer().getPosition())
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
                            time: parseInt(jwplayer().getPosition())
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
                        $template.find('.question-content').text(val.question);
                        $template.find('.question-created-at').text(new Date(val.created_at).toLocaleString());
                        $template.find('.button-delete-question').attr('data-question-id', val.id);
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

        $('#form-question').validate({
            rules: {
                question: {
                    required: true
                }
            }
        });

        $('#form-question').on('submit', function(e) {
            if ($(this).valid()) {
                e.preventDefault();

                $.ajax({
                    url: '{{ url('post-video-question') }}',
                    data: {
                        video_id: $('#question-video-id').val(),
                        package_id: {{ $package['id'] }},
                        question: $('#question').val(),
                        time: parseInt(jwplayer().getPosition())
                    },
                    async: false
                }).done(function() {
                    $('#modal-question').modal('toggle');
                    $('#form-question')[0].reset();

                    appendQuestions($('#question-video-id').val());
                });
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

        var pad = function(number, size) {
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

            var durations = [pad(minutes), pad(seconds)];

            if (hours > 0) durations.unshift(pad(hours));

            return durations.join(':');
        };
    </script>
@endpush
