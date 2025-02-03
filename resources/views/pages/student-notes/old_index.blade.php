@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}<!--My Notes--></b></h3>
            <div class="row mt-3">
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents p-4">
                            <h5>My Notes</h5>
                            @if(count($studentNotes)>0)
                                @foreach($studentNotes as $subject)
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb bg-white text-primary pl-0 mb-0">
                                            <li class="breadcrumb-item">{{ $subject['0']['video']['course']['name'] }}</li>
                                            <li class="breadcrumb-item">{{ $subject['0']['video']['level']['name'] }}</li>
                                            <li class="breadcrumb-item">{{ $subject['0']['video']['subject']['name'] }}</li>
                                        </ol>
                                    </nav>
                                    <div class="accordion student-notes-accordion" id="student-notes-accordion0" >
                                        @foreach($subject as $note)
                                            <div class="card mb-4">
                                                <div class="bg-primary-10 shadow d-flex align-items-center" id="heading{{ $note['id'] }}" >
                                                    <span class="flex-fill py-2 px-4">{{ $note['name'] }}</span>
                                                    <div class="px-4">
                                                        <a href="{{ url('videos/' . $note['video_id'] . '?package=' . $note['package_id']) . '&order_item=' . $note['order_item_id'] . '&position=' . $note['time']}}">
                                                            <i class="fas fa-video text-secondary"></i>
                                                        </a>
                                                    </div>
                                                    <button
                                                        class="btn btn-primary border-primary py-2 rounded-0 toggle-btn"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse{{ $note['id'] }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapse{{ $note['id'] }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>

                                                <div id="collapse{{ $note['id'] }}" class="collapse" aria-labelledby="heading{{ $note['id'] }}" data-parent="#student-notes-accordion0">
                                                    <div class="bg-primary-50 flex-fill py-2 px-4">
                                                        <small>
                                                            {{ $note['description'] }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @else
                                <div class="mt-4">
                                    <p>Currently no data available !</p>
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
