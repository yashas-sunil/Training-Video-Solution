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
                            <!-- <li class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Ask A Question</a></li> -->
                            <li class='sub-menu list-group-item'><a href='#settings'>Ask A Question <div class='pl-2 fa fa-caret-down right'></div></a>
                            
                            <ul class="list-group text-secondary">
                                <li  class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Pending Question</a></li>
                                <li  class="list-group-item"><a href="{{ url('professor/answerd_question')}}">Answerd Question</a></li>
                            </ul>
                            </li>
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
                        <div class="p-4">
                            <h5>Notes</h5>
                            <div class="table-responsive">
                                <table class="table mt-3">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Video</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Course</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Level</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Subject</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Chapter</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Duration</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($videos['data'] as $video)
                                        <tr>
                                            <td class=" p-2"> <a href="{{url('professor/notes/create/'.$video['id'])}}">
                                                <img src="https://cdn.jwplayer.com/v2/media/{{$video['media_id']}}/poster.jpg?width=320"
                                                width="120" class="p-2">{{ @$video['title'] }}</a></td>
                                            <td class="pt-4">{{ @$video['course']['name'] }}</td>
                                            <td class="pt-4">{{ @$video['level']['name'] }}</td>
                                            <td class="pt-4">{{ @$video['subject']['name'] }}</td>
                                            <td class="pt-4">{{ @$video['chapter']['name'] }}</td>
                                            <td class="pt-4">{{ @$video['formatted_duration']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div>
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="?page=1">First</a>
                                            </li>
                                            <li class="page-item @if (!$videos['prev_page_url']) disabled @endif">
                                                <a class="page-link" href="?page={{$videos['current_page']-1}}">Previous</a>
                                            </li>
                                            <li class="page-item @if (!$videos['next_page_url']) disabled @endif">
                                                <a class="page-link" href="?page={{$videos['current_page']+1}}">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="?page={{$videos['last_page']}}">Last</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="float-right">
{{--                                    {{. '/' . $answers['last_page'] }}--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('professor.pages.includes.change-password')
    </main>
@endsection

@push('script')
    <script>
        $(function() {
            $('.sub-menu ul').hide();
            $(".sub-menu a").click(function () {
                $(this).parent(".sub-menu").children("ul").slideToggle("100");
                $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
            });
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
