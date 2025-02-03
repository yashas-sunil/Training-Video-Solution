@extends('layouts.master')

@section('title', 'Professor Profile')

@section('content')
    <main class="professor-profile" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>{{ $professor['name'] }}</b></h3>
            <a href="{{ route('professor.packages.index') }}"><i class="far fa-arrow-alt-circle-left fa-2x text-secondary"></i></a><br>
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
                    <div class="row mb-3">
                        <div class="col-md-12">
                            @if (request()->filled('published') && request()->input('published') == 'true')
                                <h3>Published Videos</h3>
                            @endif
                            @if (request()->filled('published') && request()->input('published') == 'false')
                                <h3>Drafted Videos</h3>
                            @endif
                            @if (request()->filled('package_id'))
                                <h3>{{ $package['name'] ?? '' }}</h3>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('professor.videos.index') }}">
                                {{--                                        <input type="hidden" name="package_type" value="{{ $tab }}">--}}
                                <div class="row mt-2">
                                    <input type="hidden" name="package_id" value="{{request()->input('package_id')}}">
                                    <input type="hidden" name="professor_id" value="{{request()->input('professor_id')}}">
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
                                        <div class="btn-group">
                                            <button id="btn-filter" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                    <div class="col-auto px-1">
                                        <div class="btn-group">
                                            
                                        </div>
                                    </div>

                                </div>
                            </form>
                            {{--                            <form method="GET" action="{{ route('professor.packages.index') }}">--}}
                            {{--                                <div class="row container mt-5">--}}
                            {{--                                    <div class="col-6">--}}
                            {{--                                        <input type="text" id="search" name="search" class="form-control" placeholder="Search Packages" @if (request()->filled('search')) value="{{ request()->input('search') }}" @endif>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-6">--}}
                            {{--                                        <button id="btn-search" class="btn btn-primary">Search</button>--}}
                            {{--                                        <a href="{{ route('professor.packages.index')}}" id="btn-reset" class="btn btn-primary border-left">Clear</a>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </form>--}}
                        </div>

                        <div class="col-md-6 mt-3">
                            <form id="form-search" method="GET" action="{{ route('professor.videos.index') }}">
                                <input type="hidden" name="professor_id" value="{{ request()->input('professor_id') }}">
                                <input type="hidden" name="package_id" value="{{ request()->input('package_id') }}">
                                <input type="hidden" name="published" value="{{ request()->input('published') }}">
                                <div class="input-group d-flex">
                                    <input class="form-control col-6 border-primary" id="query" name="query" type="text" placeholder="Search" value="{{ request()->input('query') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        <button id="button-clear" class="btn btn-primary" type="button"><i class="fas fa-redo"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-5">
                        @if(!empty($videos['data']))
                            @foreach($videos['data'] as $video)
                                <div class="col-sm-12 col-md-4">
                                    <a class="popup-iframe" href="{{ url('embed/videos/' . $video['media_id']) }}">
                                        <img src="https://cdn.jwplayer.com/v2/media/{{ $video['media_id'] }}/poster.jpg?width=320">
                                    </a>
                                    <div class="pt-2">{{ $video['title'] }}</div>
                                </div>
                            @endforeach
                        @else
                            <p><b>No Data Available!</b></p>
                        @endif
                    </div>
                    @if (request()->filled('package_id'))
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="?page=1&package_id={{ request()->input('package_id') }}&professor_id={{ request()->input('professor_id') }}">First</a>
                                </li>
                                <li class="page-item @if (! $videos['prev_page_url']) disabled @endif">
                                    <a class="page-link" href="?page={{ $videos['current_page'] - 1 }}&package_id={{ request()->input('package_id') }}&professor_id={{ request()->input('professor_id') }}">Previous</a>
                                </li>
                                <li class="page-item @if (! $videos['next_page_url']) disabled @endif">
                                    <a class="page-link" href="?page={{ $videos['current_page'] + 1 }}&package_id={{ request()->input('package_id') }}&professor_id={{ request()->input('professor_id') }}">Next</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $videos['last_page'] }}&package_id={{ request()->input('package_id') }}&professor_id={{ request()->input('professor_id') }}">Last</a>
                                </li>
                            </ul>
                        </nav>
                    @endif
                    @if (request()->filled('published') && request()->input('published') == 'true')
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="?page=1&professor_id={{ request()->input('professor_id') }}&published=true">First</a>
				</li>
				@if(!empty($videos['current_page']))
                                <li class="page-item @if (empty($videos['prev_page_url'])) disabled @endif">
                                    <a class="page-link" href="?page={{ $videos['current_page'] - 1 }}&professor_id={{ request()->input('professor_id') }}&published=true">Previous</a>
				</li>
				@endif
				@if(!empty($videos['current_page']))
                                <li class="page-item @if (! $videos['next_page_url']) disabled @endif">
                                    <a class="page-link" href="?page={{ $videos['current_page'] + 1 }}&professor_id={{ request()->input('professor_id') }}&published=true">Next</a>
				</li>
				@endif
				@if(!empty($videos['last_page']))
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $videos['last_page'] }}&professor_id={{ request()->input('professor_id') }}&published=true">Last</a>
				</li>
				@endif
                            </ul>
                        </nav>
                    @endif
                    @if (request()->filled('published') && request()->input('published') == 'false')
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="?page=1&professor_id={{ request()->input('professor_id') }}&published=false">First</a>
                                </li>
                                <li class="page-item @if (empty($videos['prev_page_url'])) disabled @endif">
                                    <a class="page-link" href="?page={{ $videos['current_page'] - 1 }}&professor_id={{ request()->input('professor_id') }}&published=false">Previous</a>
				</li>
				@if(!empty($videos['current_page']))
                                <li class="page-item @if (empty($videos['next_page_url'])) disabled @endif">
                                    <a class="page-link" href="?page={{ $videos['current_page'] + 1 }}&professor_id={{ request()->input('professor_id') }}&published=false">Next</a>
				</li>
				@endif
				@if(!empty($videos['last_page']))
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $videos['last_page'] }}&professor_id={{ request()->input('professor_id') }}&published=false">Last</a>
				</li>
				@endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(function() {
            $("#upload").click(function(){
                $("#image").click();
            });

            $('#button-clear').click(function (e) {
                $('#query').val('');
                $('#form-search').submit();
            });
        });
    </script>
@endpush
