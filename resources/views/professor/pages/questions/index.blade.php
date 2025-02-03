@extends('layouts.master')

@section('title', 'Professor - Ask A Question')

@section('content')
    <main class="professor-profile" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>{{ $professor['name'] }}</b></h3>
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
                            <li class="list-group-item"><a href="{{ route('professor.revenues.index') }}">Revenue</a></li>
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
                        <div class="p-5">
                            <h5 class="text-primary mb-4">Ask A Question</h5>
                            <ul class="nav nav-pills mb-3" id="questions" role="tablist">
                                <li style="width: 50%;text-align: center;" class="nav-item border-bottom border-primary">
                                    <a class="nav-link active rounded-0" id="pills-pending-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-pending" aria-selected="true">Pending</a>
                                </li>
                                <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-bottom border-primary">
                                    <a class="nav-link rounded-0" id="pills-answered-tab" data-toggle="pill" href="#pills-answered" role="tab" aria-controls="pills-answered" aria-selected="false">Answered</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">

                                    @foreach ($questions['data'] as $question)
                                        <div class="accordion student-questions-accordion" id="ask-questions-accordion" >
                                            <div class="card mb-4 border-0">
                                                <div class="bg-primary-10 d-flex align-items-center" id="heading0" >
                                                    <span class="flex-fill py-2">{!! $question['question'] !!}</span>
                                                    <a href="{{ route('professor.answers.show', $question['id']) }}">
                                                        <i class="fas fa-video" title="Play video"></i>
                                                    </a>
                                                    <button
                                                        class="btn  toggle-btn"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse{{ $question['id'] }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapse{{ $question['id'] }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>

                                                <div id="collapse{{ $question['id'] }}" class="collapse" aria-labelledby="heading0" data-parent="#ask-questions-accordion">
                                                    <div class=" flex-fill py-2">
                                                        <form id="form-answer" method="POST" action="{{ route('professor.answers.store') }}">
                                                            @csrf
                                                            <input type="hidden" name="question_id" value="{{ $question['id'] }}">
                                                            <div class="form-group">
                                                                <label for="answer">Answer:</label>
                                                                <textarea class="form-control" id="answer" name="answer" rows="3"></textarea>
                                                                <p id="charNum"></p>
                                                            </div>
                                                            <a href="{{ route('professor.questions.show', $question['id']) }}" class="btn btn-sm btn-primary">Existing Answer</a>
                                                            <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-answer">Save</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="?questions=1&answers=1">First</a>
                                                </li>
                                                <li class="page-item @if (!$questions['prev_page_url']) disabled @endif">
                                                    <a class="page-link" href="?questions={{ request('questions') - 1 }}&answers=1">Previous</a>
                                                </li>
                                                <li class="page-item @if (!$questions['next_page_url']) disabled @endif">
                                                    <a class="page-link" href="?questions={{ request('questions') + 1 }}&answers=1">Next</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?questions={{ $questions['last_page'] }}&answers=1">Last</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="float-right">
                                        {{ request('questions') . '/' . $questions['last_page'] }}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-answered" role="tabpanel" aria-labelledby="pills-answered-tab">

                                    @foreach ($answers['data'] as $answer)
                                        <div class="accordion student-questions-accordion" id="ask-questions-accordion" >
                                            <div class="card mb-4 border-0">
                                                <div class="bg-primary-10 d-flex align-items-center" id="heading0" >
                                                    <span class="flex-fill py-2">{!! $answer['question']['question'] !!}</span>
                                                    <a href="{{ route('professor.answers.show', $answer['question']['id']) }}">
                                                        <i class="fas fa-video" title="Play video"></i>
                                                    </a>
                                                    <button
                                                        class="btn  toggle-btn"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse{{ $answer['id'] }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapse{{ $answer['id'] }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>

                                                <div id="collapse{{ $answer['id'] }}" class="collapse" aria-labelledby="heading0" data-parent="#ask-questions-accordion">
                                                    <div class=" flex-fill py-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><small class="text-primary">Asked by {{ $answer['question']['user']['name'] }} at {{ date("d-m-Y", strtotime($answer['question']['created_at'])) }}</small></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="float-right"><small class="text-primary">Answered at {{ date("d-m-Y", strtotime($answer['created_at'])) }}</small></p>
                                                            </div>
                                                        </div>

                                                        <p><small>{!! $answer['answer'] !!}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="?questions=1&answers=1&answered=true">First</a>
                                                </li>
                                                <li class="page-item @if (!$answers['prev_page_url']) disabled @endif">
                                                    <a class="page-link" href="?questions=1&answers={{ request('answers') - 1 }}&answered=true">Previous</a>
                                                </li>
                                                <li class="page-item @if (!$answers['next_page_url']) disabled @endif">
                                                    <a class="page-link" href="?questions=1&answers={{ request('answers') + 1 }}&answered=true">Next</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?questions=1&answers={{ $answers['last_page'] }}&answered=true">Last</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="float-right">
                                        {{ request('answers') . '/' . $answers['last_page'] }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('professor.pages.includes.change-password')
    </main>
    <div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <div id="created" class="toast d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body">
                Answer successfully added
            </div>
        </div>
    </div>
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

            $('.toggle-btn').click(function() {
                $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
            });

            $("#upload").click(function(){
                $("#image").click();
            });

            $('.toggle-btn').click(function() {
                $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
            });

            @if (session()->has('success'))
                $('#created').toast('show');
                $('#created').removeClass('d-none');
            @endif

            @if (request()->has('answered'))
                $('#pills-answered-tab').trigger('click');
            @endif

            $('#form-change-password').validate({
                rules: {
                    password: {
                        required: true,
                        maxlength: 191,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                }
            });


            @if (session()->has('message'))
            alert('Password successfully changed');
            @endif
        });
    </script>
@endpush
