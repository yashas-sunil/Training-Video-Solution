@extends('layouts.master')

@section('title', 'Professor Profile')

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
                        <div class="row p-5">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ $professor['name'] ?? '' }}
{{--                                            <small class=" bg-secondary text-white py-1 px-2 position-relative" style="border-radius: 16px; z-index: 2; font-size: 11px">--}}
{{--                                                <i class="fa fa-star text-warning"></i>{{ $professor['rating'] ?? '' }}--}}
{{--                                            </small>--}}
                                        </h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-profile">EDIT</button>
                                    </div>
                                </div>
                                <div class="py-2">
                                    Qualification: {{ $professor['qualification'] ?? '' }}
                                </div>
                                <div class="py-2">
                                    Experience: {{ $professor['experience'] ?? '' }}
                                </div>
                                <div class="py-2">
                                    Email: {{ $professor['email'] ?? '' }}
                                </div>
                                <div class="py-2">
                                    Phone: {{ $professor['mobile'] ?? '' }}
                                </div>
                                <div class="py-2">
                                    <h5>Introduction</h5>
                                    {{ $professor['introduction'] ?? '' }}
                                </div>
                            </div>
                            @if($professor['video_type'] == 1 )
                                {{--<div class="col-6">--}}
                                    {{--<div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">--}}
                                        {{--<script type='text/javascript' src='{{ $professor['player_url'] }}'></script>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            @else
                            <div class="col-md-6">
                                <iframe allowfullscreen="" frameborder="0" height="350" src="{{ $professor['video_url'] }}" width="100%"></iframe>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    @include('includes.associate-packages-carousel', ['packages' => $packages, 'nav' => 'false', 'dots' => 'true', 'professor_id' => $professor['id']])
                    {{--@include('includes.associate-packages-carousel', ['packages' => $packages, 'nav' => 'false', 'dots' => 'true'])--}}
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-labelledby="modal-edit-profile-title" aria-hidden="true">
        <div class="modal-dialog modal-edit-profile" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-edit-profile">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-profile" method="POST" action="{{ route('professor.profile.update', $professor['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $professor['name'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" value="{{ $professor['qualification'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience" placeholder="Experience" value="{{ $professor['experience'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="introduction">Introduction</label>
                            <textarea class="form-control" id="introduction" name="introduction" placeholder="Introduction" rows="3">{{ $professor['introduction'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('professor.pages.includes.change-password')
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


            $('#form-edit-profile').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    }
                }
            });

            jwplayer().on('ready', function(event){
                console.log('Player ready');
                jwplayer().addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg>',
                );

                jwplayer().addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 11h-2v3H8v2h3v3h2v-3h3v-2h-3zm1-9H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>',
                );
            });


            $("#upload").click(function(){
                $("#image").click();
            });

            @if (session()->has('success'))
                alert('{{ session()->get('success') }}');
            @endif

        });
    </script>
@endpush
