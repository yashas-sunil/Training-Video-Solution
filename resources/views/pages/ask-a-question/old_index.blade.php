@extends('layouts.master')

@section('title', 'Ask A Question')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}</b></h3>
            <div class="row mt-3">
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents  p-4">
                            <h5>Ask A Question</h5>
                            @if($questions['data'])
                                @foreach($questions['data'] as $question)
                                    <div class="accordion student-questions-accordion" id="student-questions-accordion" >
                                        <div class="card mb-4">
                                            <div class="bg-primary-10 d-flex align-items-center" id="heading0" >
                                                <span class="flex-fill py-2 px-4">{{ $question['question'] }}</span>
                                                <div class="px-4">
                                                    <a href="{{ url('videos/' . $question['video_id'] . '?package=' . $question['package_id'] . '&order_item=' . $question['order_item_id'] . '&position=' . $question['time']) }}">
                                                        <i class="fas fa-video text-secondary"></i>
                                                    </a>
                                                </div>

                                                <button
                                                    class="btn btn-primary border-primary py-2 rounded-0 toggle-btn"
                                                    type="button"
                                                    @if($question['answer'] !='')
                                                    data-toggle="collapse"
                                                    data-target="#collapse{{ $question['id'] }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse{{ $question['id'] }}">
                                                    <i class="fas fa-plus"></i>
                                                    @else
                                                        data-toggle="collapse"
                                                        data-target="#"
                                                        aria-expanded="true"
                                                        aria-controls="#">
                                                        <i class="fas fa-question"></i>
                                                    @endif
                                                </button>
                                            </div>

                                            <div id="collapse{{ $question['id'] }}" class="collapse" aria-labelledby="heading0" data-parent="#student-questions-accordion">
                                                <div class="bg-primary-50 flex-fill py-2 px-4">
                                                    @if (($question['answer']))
                                                        <p><strong>Answer: </strong></p>

                                                        <small> <p >{{ $question['answer']['created_at'] }}</p> {{ $question['answer']['answer'] }}</small>
                                                    @else
                                                        <small class="text-center">
                                                            No Data Available.
                                                        </small>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mt-4">
                                    <p>Currently data is not available !</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    <script>
        $(function() {
            $('.toggle-btn').click(function() {
                $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
            });
        });
    </script>
@endpush
