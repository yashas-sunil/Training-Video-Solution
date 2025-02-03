@extends('layouts.master')

@section('title', 'Answer')

@section('content')
    <main class="professor-profile" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Professor</b></h3>
            <div class="row mt-3">
                <div class="col-md-auto mb-5 professor-profile-menu">
                    <div class="professor-profile-menu-content border shadow bg-white">
                        <div class="professor-profile-menu-image-container">
                            <img src="{{ $professor['image'] ?? url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <form id="form-update-image" method="POST" action="{{ route('professor.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="image" name="image" style="display: none;" onchange="this.form.submit();"/>
                        </form>
                        <ul class="list-group text-secondary pb-4">
                            <li class="list-group-item"><a href="{{ route('professor.dashboard.index') }}">Dashboard</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.profile.index') }}">Profile</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Ask A Question</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.notes.index') }}">Notes</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.reports.index') }}">Reports</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.packages.index') }}">Packages</a></li>
                            <li class="list-group-item"><a href="#" data-toggle="modal" data-target="#modal-change-password">Change Password</a></li>
                            <form id="logout" method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <li class="list-group-item"><a href="#" onclick="document.getElementById('logout').submit();">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="p-4">
                            <a href="#" onclick="window.history.back();"><i class="fas fa-chevron-left"></i> Back</a>
                            <p class="mt-3">{!! $question['question'] !!}</p>
                            <form id="form-answer" method="POST" action="{{ route('professor.answers.store') }}">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question['id'] }}">
                                <div class="form-group">
                                    <textarea class="form-control" id="answer" name="answer" rows="3"></textarea>
                                    <p id="charNum"></p>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-answer">Save</button>
                            </form>
                            <div class="pt-5">
                                <table id="table-existing-answers" class="display">
                                    <thead>
                                    <tr>
                                        <td></td>
                                        <td width="80%">Existing Answers</td>
                                        <td>Created At</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($question['answers'] as $answer)
                                        <tr>
                                            <td align="center">
                                                <input type="radio" name="question" class="question" data-question-id="{{ $answer['id'] }}">
                                            </td>
                                            <td>
                                                <p>{!! $answer['question']['question'] !!} <small class="text-primary pull-right">Asked by {{ $answer['question']['user']['name'] }} at {{ date("d-m-Y", strtotime($answer['question']['created_at'])) }}</small></p>
                                                <small>
                                                    <p id="answer-p-{{ $answer['id'] }}">{!! $answer['answer'] !!}</p>
                                                </small>
                                            </td>
                                            <td><small>{{ date("d-m-Y", strtotime($answer['created_at'])) }}</small></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
            $('#answer').keyup(function(){
            var word = $(this).val();
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

            // $('#btn-answer').on('click',function(){
            // $("#btn-answer").html("Saving  <i class='fa fa-spinner fa-spin'>");
            // });
            $("#btn-answer").click(function (e) {
            e.preventDefault();
            let isValid = $('#form-answer').valid();
            if (isValid)
            { 
                $("#btn-answer").html("Saving <i class='fa fa-spinner fa-spin'>");
                $('#form-answer').submit();
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

            $("#upload").click(function(){
                $("#image").click();
            });

            @if (session()->has('success'))
            alert('Answer successfully saved');
            @endif

            $('#table-existing-answers').DataTable();

            $('.question').on('change', function() {
                let questionID = $(this).data('question-id');

                $('#answer').val($(`#answer-p-${questionID}`).text());
            });
        });
    </script>
@endpush
