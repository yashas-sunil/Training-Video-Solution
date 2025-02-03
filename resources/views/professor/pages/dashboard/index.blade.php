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
                        <div class="p-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card text-white bg-secondary mb-3">
                                        <div class="card-body">
                                            <h1 class="card-title"><b>{{ $dashboard['drafted_videos_count'] }}</b></h1>
                                            <a class="text-white" href="{{ url('professor/videos?professor_id=' . $professor['id'] . '&published=false') }}"><span><i class="fas fa-video"></i> DRAFTED</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-success mb-3">
                                        <div class="card-body">
                                            <h1 class="card-title"><b>{{ $dashboard['published_videos_count'] }}</b></h1>
                                            <a class="text-white" href="{{ url('professor/videos?professor_id=' . $professor['id'] . '&published=true') }}"><span><i class="fas fa-video"></i> PUBLISHED</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-info mb-3">
                                        <div class="card-body">
                                            <h1 class="card-title"><b>{{ $dashboard['professor_packages_count'] }}</b></h1>
                                            <a class="text-white" href="{{ route('professor.packages.index') }}"><span><i class="fas fa-photo-video"></i> PACKAGES</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-warning mb-3">
                                        <div class="card-body">
                                            <h1 class="card-title"><b>{{ $dashboard['packages_purchase_count'] }}</b></h1>
                                            <a class="text-white" href="{{ route('professor.reports.index') }}"><span><i class="fas fa-shopping-cart"></i> PURCHASES</span></a>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="col-md-3">--}}
{{--                                    <div class="card text-white bg-warning mb-3">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <h1 class="card-title"><b>{{ $dashboard['revenue'] }}</b></h1>--}}
{{--                                            <span><i class="fas fa-shopping-cart"></i> REVENUE ({{ now()->format('F - yy') }})</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                @include('professor.pages.includes.change-password')
            </div>
        </div>
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
            $("#upload").click(function(){
                $("#image").click();
            });
        });
    </script>
@endpush
