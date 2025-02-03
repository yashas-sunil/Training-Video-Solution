@extends('old_layouts.mobile.master')

@section('title', 'Video')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">
            <h3 class="text-secondary"><b>{{ $video['title'] }}</b></h3>
            <div class="row mt-3">
                <div class="col-md-8">
                    @if ($video['is_purchased'])
                        <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                            <script type='text/javascript' src='{{ $video['player_url'] }}'></script>
                        </div>
                        <h3>{{ $video['title'] }}</h3>
                        <div class="row">
                            <div class="col offset-md-1 offset-sm-0">
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
                                        <a class="nav-link" id="ask_question-tab" data-toggle="tab" href="#ask_question" role="tab"
                                           aria-controls="profile" aria-selected="false">Ask A Question</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-10 offset-md-1 offset-sm-0">
                                <div class="tab-content container" id="myTabContent">
                                    <div class="tab-pane fade show active" id="my-notes" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row" id="student-notes-container">
                                            <div class="col p-0">
                                                <a id="btn-add-note" href="#" class="btn btn-sm btn-primary my-4 rounded-0">Add Note</a>
                                            </div>
                                            @foreach($video['student_notes'] as $studentNote)
                                                <div class="col-md-12 p-0 mb-4" id="student-note-{{ $studentNote['id'] }}">
                                                    <div class="card">
                                                        <div class="card-header bg-secondary-100">
                                                            <div class="row">
                                                                <div class="col-md-8">{{ $studentNote['name'] }}</div>
                                                                <div class="col-md-4 text-md-right text-sm-left">
                                                                    <span data-id="{{ $studentNote['id'] }}" class="student-note-remove"><i class="far fa-trash-alt pr-1"></i></span>
                                                                    <i class="far fa-clock pr-1"></i>0:0 Hours
                                                                    <i class="far fa-edit pr-1"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body bg-primary-50">
                                                            <div class="text-muted text-md-right text-sm-left">Created {{ date("d-m-Y", strtotime($studentNote['created_at'])) }}</div>
                                                            <p class="card-text">{{ $studentNote['description'] }}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show " id="professor-notes" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row mt-5">
                                            @foreach($video['professor_notes'] as $professorNote)
                                                <div class="col-md-12 p-0 mb-4">
                                                    <div class="card">
                                                        <div class="card-header bg-secondary-100">
                                                            <div class="row">
                                                                <div class="col-md-8">{{ $professorNote['name'] }}</div>
                                                                <div class="col-md-4 text-md-right text-sm-left">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="text-muted text-md-right text-sm-left"> Created {{ date("d-m-Y", strtotime($professorNote['created_at'])) }}</div>
                                                            <p class="card-text">{{ $professorNote['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show " id="ask_question" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row" id="question-container">
                                            <div class="col p-0">
                                                <a data-toggle="modal" data-target="#add-question" href="#" class="btn btn-sm btn-primary my-4 rounded-0">Ask A Question</a>
                                            </div>
                                            <div class="col-md-12 p-0">
                                                <h5>Previously asked questions</h5>
                                            </div>
                                            @foreach($video['questions'] as $question)
                                                <div class="col-md-12 p-0 mb-4" id="question-{{ $question['id'] }}">
                                                    <div class="card rounded-0">
                                                        <div class="card-body bg-primary-50">
                                                            <div class="text-muted text-md-right text-sm-left"> Created {{ date("d-m-Y", strtotime($question['created_at'])) }}</div>
                                                            <p class="card-text"><b>{{ $question['question'] }}</b></p>
                                                            <p class="card-text">{{ $question['question'] }}</p>
                                                            <div class="text-md-right">
                                                                <button class="btn btn-sm btn-primary remove-question" data-id="{{ $question['id'] }}">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($video['demo_player_url'])
                        <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                            <script type='text/javascript' src='{{ $video['demo_player_url'] }}'></script>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ url('mobile/packages?course=' . $video['course_id'] . '&level=' . $video['level_id'] . '&subject=' . $video['subject_id'] . '') }}" class="btn btn-primary">Buy Now</a>
                        </div>
                    @else
                        <p>You have not purchased this video</p>
                        <a href="{{ url('mobile/packages?course=' . $video['course_id'] . '&level=' . $video['level_id'] . '&subject=' . $video['subject_id'] . '') }}" class="btn btn-primary">Buy Now</a>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="border shadow p-3">
                        <div class="subject-heading p-1 justify-content-center">
                            <a href="#" class="text-white"><i class="fa fa-chevron-left p-2"></i></a>
                            <span class="subject-name tex">{{ $video['subject']['name'] }}</span>
                            <a href="#" class="text-white"><i class="fa fa-chevron-right p-2"></i></a>
                        </div>
                        <div>
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="accordion student-chapters-accordion" id="student-chapters-accordion">
                                            @foreach($video['subject']['chapters'] as $chapter)
                                                <div class="card mt-2 border-0 rounded">
                                                    <div class="bg-secondary-100 shadow-sm d-flex flex-wrap align-items-center" id="heading0">
                                                        <span class="flex-fill py-1 px-2 text-white"><b>@if(strlen($chapter['name']) > 30) {{ substr($chapter['name'], 0, 30) . '...' }} @else {{ $chapter['name'] }} @endif</b></span>
                                                        <button class="btn btn-primary py-1" type="button" data-toggle="collapse"
                                                                data-target="#collapse{{ $chapter['id'] }}" aria-expanded="true" aria-controls="collapse{{ $chapter['id'] }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>

                                                    <div id="collapse{{ $chapter['id'] }}" class="collapse" aria-labelledby="heading{{ $chapter['id'] }}" data-parent="#student-chapters-accordion">
                                                        @foreach($chapter['videos'] as $chapterVideo)
                                                            <div class="border p-2 my-2">
                                                                <div class="row">
                                                                    <div class="col-md-12 py-2">
                                                                        <a class="text-info" href="{{ url('mobile/videos') . '/' . $chapterVideo['id'] }}">{{ $chapterVideo['title'] }}</a>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <span class="text-muted fs-14">
                                                                            <i class="far fa-trash-alt pr-1"></i> {{ gmdate("H", array_sum(array_column($chapterVideo, 'duration'))) }} Hour
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="border p-2 my-2">
                                                            <div class="row">
                                                                <div class="col-md-12 py-2">
                                                                    Quiz Name
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="text-muted">
                                                                        Score - 74
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-8 text-right">
                                                                    <span class="text-muted fs-14 mr-2">
                                                                        <span class="fa-stack ">
                                                                          <i class="fa fa-comment fa-stack-2x text-success"></i>
                                                                          <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="border p-2 my-2">
                                                            <div class="row">
                                                                <div class="col-md-12 py-2">
                                                                    Quiz Name
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="text-muted">
                                                                        Score - 74
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-8 text-right">
                                                                    <span class="text-muted fs-14 mr-2">
                                                                        <span class="fa-stack ">
                                                                          <i class="fa fa-comment fa-stack-2x text-danger"></i>
                                                                          <i class="fa fa-thumbs-down fa-stack-1x fa-inverse"></i>
                                                                        </span>
                                                                    </span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="add-notes" tabindex="-1" role="dialog" aria-labelledby="add-notes" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="">My Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="note-time">
                        <div class="form-group">
                            <label for="note-name" class="col-form-label">Note Name</label>
                            <input type="text" class="form-control" id="note-name">
                        </div>
                        <div class="form-group">
                            <label for="note-description" class="col-form-label">Detailed Note</label>
                            <textarea class="form-control" id="note-description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary" id="note-save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-question" tabindex="-1" role="dialog" aria-labelledby="add-question" aria-hidden="true">
        <form method="POST" action="{{ route('questions.store') }}" >
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Ask A Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="question" class="col-form-label">Question</label>
                                <input type="text" class="form-control" id="question" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" id="save-question">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal-purchase" tabindex="-1" role="dialog" aria-labelledby="modal-purchase-title" aria-hidden="true">
        <div class="modal-dialog modal-purchase" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-purchase-title">Purchase required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-2">
                        <p class="text-center">Please purchase the package to watch full version of the video</p>
                        <a href="{{ url('mobile/packages?course=' . $video['course_id'] . '&level=' . $video['level_id'] . '&subject=' . $video['subject_id'] . '') }}" class="btn btn-block btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {

            var pad = function(number, size) {
                var s = String(number);
                while (s.length < (size || 2)) {s = "0" + s;}
                return s;
            };

            var formatDuration = function (durationInSeconds) {
                var hours = Math.floor(durationInSeconds / 3600);
                durationInSeconds %= 3600;
                var minutes = Math.floor(durationInSeconds / 60);
                var seconds = durationInSeconds % 60;

                var durations = [pad(minutes), pad(seconds)];

                if (hours > 0) durations.unshift(pad(hours));

                return durations.join(':');
            };

            var showAddNoteModal = function () {
                jwplayer().pause();
                var position = jwplayer().getPosition();
                position = parseInt(position, 10);

                $('#note-time').val(position);
                $('#add-notes').modal('show');
            };

            jwplayer().on('ready', function(event){
                console.log('Player ready');
                jwplayer().addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg>',
                    'Ask a question',
                    function () {
                        $('#add-question').modal('show');
                    },
                    'jwp-btn-ask-a-question',
                    'jwp-btn-ask-a-question'
                );

                jwplayer().addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 11h-2v3H8v2h3v3h2v-3h3v-2h-3zm1-9H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>',
                    'Add note',
                    function () {
                        showAddNoteModal();
                    },
                    'jwp-btn-add-note',
                    'jwp-btn-add-note'
                );
            });

            @if (! $video['is_purchased'] && $video['demo_player_url'])
            jwplayer().on('complete', function(){
                $('#modal-purchase').modal('toggle');
            });
            @endif

            $('#btn-add-note').click(function (e) {
                e.preventDefault();
                showAddNoteModal();
            });

            $('#save-question').click(function () {
                let question = $('#question').val();
                let questionDescription = $('#question-description').val();

                $('#add-question').modal('toggle');

                $.ajax({
                    type:'POST',
                    url:'{{ route('questions.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'video_id': '{{ $video['id'] }}',
                        'question': question
                    },
                    success:function(response) {
                        let date = new Date(response.created_at);
                        let createdAt = date.getDate() + '-' +  ("0" + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();

                        $('#question-container').append(
                            `<div class="col-md-12 p-0 mb-4" id="question-${response.id}">
                                <div class="card rounded-0">
                                    <div class="card-body bg-primary-50">
                                        <div class="text-muted text-md-right text-sm-left"> Created ${createdAt}</div>
                                        <p class="card-text"><b>${response.question}</b></p>
                                        <div class="text-md-right">
                                            <button class="btn btn-sm btn-primary remove-question" data-id="${response.id}">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        );
                    }
                });
            });

            $('.remove-question').click(function () {
                $.ajax({
                    type:'DELETE',
                    url:'{{ url('questions') }}' + '/' + $(this).data('id'),
                    success:function(id) {
                        $('#question-' + id).remove();
                    }
                });
            });

            $('#note-save').click(function () {
                let noteName = $('#note-name').val();
                let noteDescription = $('#note-description').val();
                let noteTime = $('#note-time').val();

                $('#add-notes').modal('toggle');

                $.ajax({
                    type:'POST',
                    url:'{{ route('student-notes.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'video_id': '{{ $video['id'] }}',
                        'name': noteName,
                        'description': noteDescription,
                        'time': noteTime
                    },
                    success:function(response) {
                        let date = new Date(response.created_at);
                        let createdAt = date.getDate() + '-' +  ("0" + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();

                        var notePosition = formatDuration(parseInt(response.time || 0));

                        $('#student-notes-container').append(
                            `<div class="col-md-12 p-0 mb-4" id="student-note-${response.id}">
                                <div class="card">
                                    <div class="card-header bg-secondary-100">
                                        <div class="row">
                                            <div class="col-md-8">${response.name}</div>
                                            <div class="col-md-4 text-md-right text-sm-left">
                                                <span data-id="${response.id}" class="student-note-remove"><i class="far fa-trash-alt pr-1"></i></span>
                                                <i class="far fa-clock pr-1"></i>${notePosition}
                                                <i class="far fa-edit pr-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-primary-50">
                                        <div class="text-muted text-md-right text-sm-left">Created ${createdAt}</div>
                                        <p class="card-text">${response.description}</p>

                                    </div>
                                </div>
                            </div>`
                        );

                        $('#note-name').val('');
                        $('#note-description').val('');
                        $('#note-time').val('');
                    }
                });
            });

            $('.student-note-remove').click(function () {
                $.ajax({
                    type:'DELETE',
                    url:'{{ url('student-notes') }}' + '/' + $(this).data('id'),
                    success:function(id) {
                        $('#student-note-' + id).remove();
                    }
                });
            });

        });
    </script>
@endpush
