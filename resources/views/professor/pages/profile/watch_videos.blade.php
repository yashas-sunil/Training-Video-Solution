@extends('layouts.master')

@section('title', 'Video')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">
            <h3 class="text-secondary"><b>{{ $package }}</b></h3>
            <div class="row mt-3">
                <div class="col-md-8">
                        <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                            <script type='text/javascript' src='{{ $video['player_url'] }}'></script>
                        </div>
                        <h3 class="mt-3">{{ $video['title'] }}</h3>
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
                                                            <div class="text-muted text-md-right text-sm-left">  {{ date("d-m-Y", strtotime($question['created_at'])) }}</div>
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
                    @if($video['demo_player_url'])
                        <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                            <script type='text/javascript' src='{{ $video['demo_player_url'] }}'></script>
                        </div>
                        <div class="mt-3">
                            <div class="float-left">
                                <h3>{{ $video['title'] }}</h3>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="border shadow p-3">
                        <div class="subject-heading p-1 justify-content-center">
                            <a href="#" class="text-white"><i class="fa fa-chevron-left p-2"></i></a>
                            <span class="subject-name tex">{{ $video['subjects'][0]['name'] ?? null }}</span>
                            <a href="#" class="text-white"><i class="fa fa-chevron-right p-2"></i></a>
                        </div>
                        <div>
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="accordion student-chapters-accordion" id="student-chapters-accordion">
                                            @foreach($video['subjects'][0]['chapters'] as $chapter)
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
                                                                <div class="border p-2 my-2">
                                                                    <div class="row">
                                                                        <div class="col-md-12 py-2">
                                                                            <a class="text-info" href="{{ url('videos') . '/' . $video['id'] . '?package=' . request('package') }}">{{ $video['title'] }}</a>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                        <span class="text-muted fs-14">
                                                                            <i class="far fa-clock pr-1"></i> {{ $video['formatted_duration'] }}
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
                                                        @endforeach
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

@endsection

