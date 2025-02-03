@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="prof_notes">
                        <div class="notes_title">
                            <div class="notes">Professor Notes</div>
                        </div>
                        <form id="filter_study_materials" action="" method="GET" >
                            <div class="select_options">

                                <select name="language" id="language" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language['id'] }}" @if (request()->has('language')) @if ($language['id'] == request()->input('language')) selected @endif @endif>{{ $language['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="subject" class="col-lg-2 col-md-4 col-sm-12" id="subject">
                                    <option value="" disabled selected>Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="chapter" id="chapter" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" selected>Chapter</option>
                                    @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter['id'] }}" @if (request()->has('chapter')) @if ($chapter['id'] == request()->input('chapter')) selected @endif @endif>{{ $chapter['name'] }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                <a href="{{url('professor-notes')}}"><button type="reset" class="btn btn-primary">Clear</button></a>
                            </div>
                        </form>
                        <div class="notes_list">
                            <div class="row">
                                @if($professorNotes)
                                    @foreach($professorNotes as $professorNote)
                                        <div class="col-lg-6 col-md-12 co-sm-12">
                                            <div class="note_details">
                                                <h1>{{ $professorNote['name'] }}</h1>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="notes_details_inner">
                                                            <h6>subject</h6>
                                                            <p>{{ $professorNote['video']['subject']['name'] }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="notes_details_inner">
                                                            <h6>Chapter</h6>
                                                            <p>{{ $professorNote['video']['chapter']['name'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="popup-iframe" href="{{ url("embed/videos/".$professorNote['video']['media_id']) }}">
{{--                                                <a href="{{ url('videos') . '/' .  $professorNote['video']['id'] . '?package=' . $professorNote['video']['packages'][0]['id'] . '&order_item=' . $orderItem['id'] ?? '' }}">--}}
                                                    <button><i class="fa fa-play" aria-hidden="true"></i>Play Video</button>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
@endsection
