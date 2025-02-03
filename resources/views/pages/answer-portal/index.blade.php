@extends('layouts.master')

@section('title', 'Answer Portal')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-4">
        <div class="card my-5">
            <div class="card-body">
                @if (isset($question))
                    <form method="POST" action="{{ route('answer-portal.store') }}" id="form-answer">
                        @csrf
                        <input name="question_id" type="hidden" value="{{ $question['id'] }}">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                Asked by: <strong>{{ $question['user']['name'] }}</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Asked at: <strong>{{ \Carbon\Carbon::parse($question['created_at']) }}</strong>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                Question: <strong>{!! $question['question'] !!}</strong>
                            </div>
                        </div>
                        @if(!empty($question['is_answered']))
                        <div class="row mt-3">
                            <div class="col-md-12">
                                Answer: <strong>{!! $question['answer']['answer'] !!}</strong>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                Answered By: <strong>@if(isset($question['answer']['user']['professor'])){{ $question['answer']['user']['professor']['name'] }} @else {{ $question['answer']['user']['name'] }} @endif</strong>
                            </div>
                        </div>
                        @else
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <textarea class="form-control" id="answer" name="answer" placeholder="Answer" rows="5"></textarea>
                                <p id="charNum"></p>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <button class="btn btn-primary mt-3" type="submit" id="btn-save">SAVE</button>
                            </div>
                        </div>
                        @endif
                    </form>
                @else
                    <div class="row mt-3 text-center">
                        <div class="col-md-12">
                            Sorry, the question no longer available.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(function () {
            $('#toast-added-to-cart').toast('show');

            @if(session()->has('success'))
                alert('{{ session()->get('success') }}');
            @endif

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
            onsubmit:false,
            rules: {
                answer: {
                    required: true,
                    validate_question:true,
                    validate_answer:true,
                },
            }
            });

            $('#answer').keyup(function(){
            var word = $(this).val();
            var counts = word.split(' ');
            var maxLength = counts.length;
            var remaining = 500 - maxLength;
            remaining = Math.max(0, remaining);
            if(word == '' && maxLength == 1){
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">500 words remaining</span>';
            }
            else if(remaining >= 0 ){
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+remaining+' words remaining</span>';
            }else{
                document.getElementById("charNum").innerHTML = '';
            }
            });

            $("#btn-save").click(function (e) {
            e.preventDefault();
            let isValid = $('#form-answer').valid();
            if (isValid)
            { 
                $("#btn-save").html("Saving <i class='fa fa-spinner fa-spin'>");
                $('#form-answer').submit();
            }
            });
        });
    </script>
@endpush
