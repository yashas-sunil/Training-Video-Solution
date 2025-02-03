@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="test_papers">
                        <div class="test_title">
                            <div class="test">Test Papers</div>
                        </div>
                        <form id="filter_study_materials" action="" method="GET" >
                            <div class="select_options">
                                <select name="course" id="course" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course['id'] }}" @if (request()->has('course')) @if ($course['id'] == request()->input('course')) selected @endif @endif>{{ $course['name'] }}</option>
                                    @endforeach
                                </select>

                                <select name="language" id="language" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language['id'] }}" @if (request()->has('language')) @if ($language['id'] == request()->input('language')) selected @endif @endif>{{ $language['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="subject" class="col-lg-2 col-md-4 col-sm-12" id="subject">
                                    <option value="" disabled selected>Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="chapter" id="chapter" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Chapter</option>
                                    @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter['id'] }}" @if (request()->has('chapter')) @if ($chapter['id'] == request()->input('chapter')) selected @endif @endif>{{ $chapter['name'] }}</option>
                                    @endforeach
                                </select>

                                <select name="professor" id="professor" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Professor</option>
                                    @foreach ($professors as $professor)
                                        <option value="{{ $professor['id'] }}" @if (request()->has('professor')) @if ($professor['id'] == request()->input('professor')) selected @endif @endif>{{ $professor['name'] }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ url('test-papers') }}" class="btn btn-primary">Clear</a>

{{--                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>--}}
{{--                                <a href="{{url('test-papers')}}"><button type="reset" class="btn btn-primary">Clear</button></a>--}}
                            </div>
                        </form>
                        <div class="test_list">

                            <div class="study_accordion" id="study_accordion">
                                        <div class="item">
                                            <div class="item-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="fa fa-caret-right"></i>

                                                        <h6>All</h6>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#study_accordion">
                                                <div class="test_inner">
                                                    <div class="row">
                                                        @foreach($studyMaterials as $key => $packageStudyMaterial)
                                                            @if($packageStudyMaterial['package']['package_study_materials'])
                                                                @foreach($packageStudyMaterial['package']['package_study_materials'] as $studyMaterial)
                                                                    @if($studyMaterial['study_material'])
                                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                                            <div class="test_inner_details">
                                                                                {{--<div class="banner_img">--}}
                                                                                     {{--<img class="banner" src="https://picsum.photos/300/170" alt="">--}}
                                                                                {{--</div>--}}
                                                                                <div class="details_inner">
                                                                                    <div class="inner_heading">
                                                                                        <h1>{{ $studyMaterial['study_material']['title'] }}</h1>
                                                                                        <a href="{{ url( $studyMaterial['study_material']['file_url']) }}" target="_blank">
                                                                                            <img class="download" src="{{ asset('assets/new_ui_assets/images/dashboard/download.svg') }}" alt="">
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="professor_heading">Professor</div>
                                                                                    <div class="professor">{{ $studyMaterial['study_material']['professor']['name'] }}</div>
                                                                                    <div class="subject_heading">Subject</div>
                                                                                    <div class="subject">{{ @$studyMaterial['study_material']['subject']['name'] }}</div>
                                                                                    <div class="chapter_heading">chapter</div>
                                                                                    <div class="chapter">{{ @$studyMaterial['study_material']['chapter']['name'] }}</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6">
                                                                                            <div class="course_plan_data">
                                                                                                <div class="course_heading">course</div>
                                                                                                <div class="course_name">{{ @$studyMaterial['study_material']['course']['name'] }}</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6">
                                                                                            <div class="course_plan_data">
                                                                                                <div class="language_heading">language</div>
                                                                                                <div class="language_name">
                                                                                                    {{$packageStudyMaterial['package']['language']['name']}}</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @foreach($studyMaterials as $key => $packageStudyMaterial)
                                    @if($packageStudyMaterial['package']['package_study_materials'])
                                        <div class="item">
                                            <div class="item-header" id="heading-{{$key}}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{$key}}"
                                                            aria-expanded="false" aria-controls="collapse-{{$key}}">

                                                        <i class="fa fa-caret-right"></i>

                                                        <h6>{{ $packageStudyMaterial['package']['name'] }}</h6>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#study_accordion">
                                                <div class="test_inner">
                                                    <div class="row">
                                                        @foreach($packageStudyMaterial['package']['package_study_materials'] as $studyMaterial)
                                                            @if($studyMaterial['study_material'])
                                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                                    <div class="test_inner_details">
                                                                        {{--<div class="banner_img">--}}
                                                                            {{--<img class="banner" src="https://picsum.photos/300/170" alt="">--}}
                                                                        {{--</div>--}}
                                                                        <div class="details_inner">
                                                                            <div class="inner_heading">
                                                                                <h1>{{ $studyMaterial['study_material']['title'] }}</h1>
                                                                                <a href="{{ url( $studyMaterial['study_material']['file_url']) }}" target="_blank">
                                                                                    <img class="download" src="{{ asset('assets/new_ui_assets/images/dashboard/download.svg') }}" alt="">
                                                                                </a>
                                                                            </div>
                                                                            <div class="professor_heading">Professor</div>
                                                                            <div class="professor">{{ $studyMaterial['study_material']['professor']['name'] }}</div>
                                                                            <div class="subject_heading">Subject</div>
                                                                            <div class="subject">{{ $studyMaterial['study_material']['subject']['name'] }} </div>
                                                                            <div class="chapter_heading">chapter</div>
                                                                            <div class="chapter">{{ @$studyMaterial['study_material']['chapter']['name'] }}</div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-sm-6">
                                                                                    <div class="course_plan_data">
                                                                                        <div class="course_heading">course</div>
                                                                                        <div class="course_name">{{ @$studyMaterial['study_material']['course']['name'] }}</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6">
                                                                                    <div class="course_plan_data">
                                                                                        <div class="language_heading">language</div>
                                                                                        <div class="language_name">{{ $packageStudyMaterial['package']['language']['name'] }}</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#course').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#language').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#subject').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#chapter').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#professor').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
        });
    </script>
@endpush
