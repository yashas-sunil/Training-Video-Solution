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
                        <div class="p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Packages</h5>
                                </div>
                                <div class="col-md-12">
                                    <form method="GET" action="{{ route('professor.packages.index') }}">
{{--                                        <input type="hidden" name="package_type" value="{{ $tab }}">--}}
                                        <div class="row container mt-5">
                                            <div class=" col-md-2">
                                                <x-inputs.course id="course" name="course" class="form-control">
                                                    @if (request()->filled('course') && request()->filled('course_text'))
                                                        <option value="{{ old('course', request()->input('course')) }}" selected>{{ old('course', request()->input('course_text')) }}</option>
                                                    @endif
                                                </x-inputs.course>
                                            </div>
                                            <div class="col-md-2">
                                                <x-inputs.level id="level" name="level" class="form-control" related="#course">
                                                    @if (request()->filled('level') && request()->filled('level_text'))
                                                        <option value="{{ old('level', request()->input('level')) }}" selected>{{ old('level', request()->input('level_text')) }}</option>
                                                    @endif
                                                </x-inputs.level>
                                            </div>
                                            <div class="col-md-2">
                                                <x-inputs.subject id="subject" name="subject" class="form-control" related="#level">
                                                    @if (request()->filled('subject') && request()->filled('subject_text'))
                                                        <option value="{{ old('subject', request()->input('subject')) }}" selected>{{ old('subject', request()->input('subject_text')) }}</option>
                                                    @endif
                                                </x-inputs.subject>
                                            </div>
                                            <div class="col-md-2">
                                                <x-inputs.chapter id="chapter" name="chapter" class="form-control" related="#subject">
                                                    @if (request()->filled('chapter') && request()->filled('chapter_text'))
                                                        <option value="{{ old('chapter', request()->input('chapter')) }}" selected>{{ old('chapter', request()->input('chapter_text')) }}</option>
                                                    @endif
                                                </x-inputs.chapter>
                                            </div>
{{--                                            <div class="col-md-2">--}}
{{--                                                <x-inputs.professor id="professor" name="professor" class="form-control">--}}
{{--                                                    @if (request()->filled('professor') && request()->filled('professor_text'))--}}
{{--                                                        <option value="{{ old('professor', request()->input('professor')) }}" selected>{{ old('professor', request()->input('professor_text')) }}</option>--}}
{{--                                                    @endif--}}
{{--                                                </x-inputs.professor>--}}
{{--                                            </div>--}}
                                            <div class="col-md-2">
                                                <x-inputs.languages id="language" name="language" class="form-control" >
                                                    @if (request()->filled('language') && request()->filled('language_text'))
                                                        <option value="{{ old('language', request()->input('language')) }}" selected>{{ old('language', request()->input('language_text')) }}</option>
                                                    @endif
                                                </x-inputs.languages>
                                            </div>
{{--                                            <div class="col-md-2">--}}
{{--                                                <input type="text" id="search" name="search" class="form-control" placeholder="Search Packages" @if (request()->filled('search')) value="{{ request()->input('search') }}" @endif>--}}
{{--                                            </div>--}}
                                            <div class="col-auto p-0">

                                                    <button id="btn-filter" class="btn btn-primary">Filter</button>
                                            </div>
                                            <div class="col-auto px-1">
                                               <a href="{{ route('professor.packages.index')}}" id="btn-reset" class="btn btn-primary border-left">Clear</a>

                                            </div>
                                        </div>
                                    </form>
                                    <form method="GET" action="{{ route('professor.packages.index') }}">
                                        <div class="row container mt-5">
                                            <div class="col-6">
                                                <input type="text" id="search" name="search" class="form-control" placeholder="Search Packages" @if (request()->filled('search')) value="{{ request()->input('search') }}" @endif>
                                            </div>
                                            <div class="col-6">
                                                <button id="btn-search" class="btn btn-primary">Search</button>
                                                <a href="{{ route('professor.packages.index')}}" id="btn-reset" class="btn btn-primary border-left">Clear</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <table class="table mt-3">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Name</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($packages['data'] as $package)
                                        <tr>
                                            <td class="pt-4"><a href="{{ url('/professor/videos?package_id=' . $package['id'] . '&professor_id=' . $professor['id']) }}">{{ $package['name'] }}</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div>
                                    @if ($packages)
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=1">First</a>
                                                </li>
                                                <li class="page-item @if (!$packages['prev_page_url']) disabled @endif">
                                                    <a class="page-link" href="?page={{$packages['current_page'] - 1}}">Previous</a>
                                                </li>
                                                <li class="page-item @if (!$packages['next_page_url']) disabled @endif">
                                                    <a class="page-link" href="?page={{ $packages['current_page'] + 1 }}">Next</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page={{ $packages['last_page'] }}">Last</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    @endif
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
            $("#upload").click(function(){
                $("#image").click();
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

            $('#button-clear').click(function (e) {
                $('#query').val('');
                $('#form-search').submit();
            });
            $('#btn-search').click(function (e) {


            });
        });
    </script>
@endpush
