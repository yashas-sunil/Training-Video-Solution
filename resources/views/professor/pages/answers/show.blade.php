@extends('layouts.master')

@section('title', 'Notes')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">
            <h5 class="text-secondary"><b>{{ $question['video']['title'] }}</b></h5>
            <a href="{{ route('professor.questions.index') }}"><i class="far fa-arrow-alt-circle-left fa-2x text-secondary"></i></a>
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                        <script type='text/javascript' src='{{ $question['video']['player_url'] }}'></script>
                    </div>
                    <h3 class="mt-3">{{ $question['question'] }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <form id="form-answer" method="POST" action="{{ route('professor.answers.store') }}">
                        @csrf
                            @if ($question['answered'])
                                <input type="hidden" name="question_id" value="{{ $question['id'] }}">
                                <div class="form-group">
                                    <label for="answer">Answer:</label>
                                    <textarea class="form-control" id="answer" name="answer" rows="3">{!! $question['answered']['answer'] !!}</textarea>
                                    <p id="charNum"></p>
                                </div>
                            @else
                                <input type="hidden" name="question_id" value="{{ $question['id'] }}">
                                <div class="form-group">
                                    <label for="answer">Answer:</label>
                                    <textarea class="form-control" id="answer" name="answer" rows="3"></textarea>
                                    <p id="charNum"></p>
                                </div>
                            @endif
                            
                        <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-answer">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


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

                @if ($question['time'] > 0)
                    let seekPosition = '{{ $question['time'] }}';
                    jwplayer().seek(parseInt(seekPosition));
                @endif
            });

            $('#answer').keyup(function(){
                var word = $(this).val();
                var counts = word.split(' ');
                var maxLength = counts.length;
                var remaining = 500 - maxLength;
                if(word == '' && maxLength == 1){
                    document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">500 words remaining</span>';
                }
                else if(remaining > 0 ){
                    document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+remaining+' words remaining</span>';
                }else{
                    document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+maxLength+' words</span>';
                }
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
            var words = value.split(' ');
            if (words.length > 500) {
                return false;
            } else {
                return true;
            }
            }, "Maximum 500 words are allowed");

            $('#form-answer').validate({
                rules: {
                    answer: {
                        required: true,
                        validate_question:true,
                        validate_answer:true,
                    }
                }
            });

            $("#btn-answer").click(function (e) {
            e.preventDefault();
            let isValid = $('#form-answer').valid();
            if (isValid)
            { 
                $("#btn-answer").html("Saving <i class='fa fa-spinner fa-spin'>");
                $('#form-answer').submit();
            }
            });

        });
    </script>
@endpush
