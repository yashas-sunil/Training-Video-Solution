@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
        @include('includes.student-menu')
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="ask_questions">
                        <div class="ask">Ask a Question</div>
                    </div>
                    <form id="filter_study_materials" action="" method="GET" >
                        <div class="select_options">
                            <select name="subject" id="subject">
                                <option value="" disabled selected>By Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject['id'] }}" @if(request()->input('subject') == $subject['id']) selected @endif>{{ $subject['name'] }}</option>
                                @endforeach
                            </select>
                            <select name="recently_viewed" id="recently_viewed">
                                <option value="" disabled selected>View</option>
                                <option value="1" @if(request()->input('recently_viewed') == 1) selected @endif>Recently Viewed</option>
                                <option value="2" @if(request()->input('recently_viewed') == 2) selected @endif>Last Week</option>
                            </select>
                            <select name="professor" id="professor">
                                <option value="" disabled selected>Professor</option>
                                @foreach($professors as $professor)
                                    <option value="{{ $professor['id'] }}" @if(request()->input('professor') == $professor['id']) selected @endif>{{ $professor['name'] }}</option>
                                @endforeach
                            </select>
                            <a href="{{ url('ask-a-question') }}" class="btn btn-primary">Clear</a>
    {{--                    </div>--}}
                        </div>
                    </form>
                    <div class="inner_questions">
                        @if($questions['data'])
                            @foreach($questions['data'] as $question)
                                @if($question['video'])
                                    <div class="question_list">
                                        <div class="credated_date">
                                            <h6>{{$question['video']['subject']['name']}} - {{$question['video']['professor']['name']}} </h6>
                                            <h6>Created at: <span>{{ \Carbon\Carbon::parse($question['created_at'])->format('d-m-Y') }}</span> | <span>
                                                    {{ \Carbon\Carbon::parse($question['created_at'])->format('H:i') }}</span></h6>
                                        </div>
                                        <h4>{!! $question['question'] !!}</h4>


                                        <div class="proffesor_answer">
                                            @if($question['answer'])
                                                <div class="answer-section">
                                                    <h6 class="answer-create">Answer</h6>
                                                    <div class="answer-time">
                                                        <h6 class="answer-created-at">
                                                            <span>
                                                                {{ \Carbon\Carbon::parse($question['answer']['created_at'])->format('d-m-Y') }}
                                                            </span>
                                                            |
                                                            <span>
                                                                {{ \Carbon\Carbon::parse($question['answer']['created_at'])->timezone('asia/Kolkata')->format('H:i') }}
                                                            </span>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <p class="answer-content">{{ $question['answer']['answer'] }}</p>
                                            @endif
                                            <a href="{{ url('/videos/' . $question['video_id'] . '?tab=question&package=' . $question['package_id'] . '&order_item=' . $question['order_item_id'] . '&position=' . $question['time']) }}">
                                                <button><i class="fa fa-play" aria-hidden="true"></i>Play Video</button>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#subject').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#recently_viewed').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#professor').on('change', function (e) {
                $("#filter_study_materials").submit();
            });

        });
    </script>
@endpush
