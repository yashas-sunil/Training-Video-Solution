@extends('layouts.master')

@section('title', 'Study Materials')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}</b></h3>
            <div class="row mt-3">
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents p-4">
                            <h5 class="mb-3">Study Materials</h5>
                            <form id="filter_study_materials" action="" method="GET" >
                                <div class="row mb-4">
                                    <div class="col-sm col-md-2">
                                        <select name="subject" id="subject" class="form-control select2">
                                            <option value="" selected>Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm col-md-2">
                                        <select name="chapter" id="chapter" class="form-control select2">
                                            <option value="" selected>Chapter</option>
                                            @foreach ($chapters as $chapter)
                                                <option value="{{ $chapter['id'] }}" @if (request()->has('chapter')) @if ($chapter['id'] == request()->input('chapter')) selected @endif @endif>{{ $chapter['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm col-md-2">
                                        <x-inputs.professor id="professor" name="professor" class="form-control">
                                            @if (request()->filled('professor') && request()->filled('professor_text'))
                                                <option value="{{ old('professor', request()->input('professor')) }}" selected>{{ old('professor', request()->input('professor_text')) }}</option>
                                            @endif
                                        </x-inputs.professor>
                                    </div>
                                    <div class="col-sm col-md-2">
                                        <x-inputs.languages id="language" name="language" class="form-control" >
                                            @if (request()->filled('language') && request()->filled('language_text'))
                                                <option value="{{ old('language', request()->input('language')) }}" selected>{{ old('language', request()->input('language_text')) }}</option>
                                            @endif
                                        </x-inputs.languages>
                                    </div>
                                    <div class="col-sm col-md-2">
                                        <input type="text" id="search" placeholder="Search..." name="search" class="form-control" >
                                        <input type="hidden" name="type" value="1" >
                                    </div>
                                    <div class="col-sm col-md-2">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        <a href="{{url('study-materials')}}"><button type="reset" class="btn btn-primary">Clear</button></a>
                                    </div>
                                </div>
                            </form>

                            @if(count($study_materials['data'])>0)
                                <div class="table-responsive">
                                    <table class="table mt-3">
                                        <thead class="bg-primary">
                                        <tr>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Title</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Study Material</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Course</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Subject</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Chapter</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Language</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Professor</th>
                                        </tr>
                                        </thead>
                                        <tbody class="study-materials">
                                        @foreach($study_materials['data'] as $study_material)
                                            <tr>
                                                <td>{{ucwords($study_material['title'])}}</td>
                                                <td><a target="_blank" href="{{$study_material['file_url']}}">{{ substr($study_material['file_name'],10) }}</a></td>
                                                <td>{{$study_material['course']['name']}}</td>
                                                <td>{{$study_material['subject']['name']}}</td>
                                                <td>{{$study_material['chapter']['name'] ?? '-'}}</td>
                                                <td>{{$study_material['language']['name']}}</td>
                                                <td>{{$study_material['professor']['name']}}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <div class="mt-4">
                                                <p>Currently there are no study material !</p>
                                            </div>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                @if(count($study_materials['data']) > 0 )
                                    <div class="col-md-4 offset-4">
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=1">First</a>
                                                </li>
                                                <li class="page-item @if (!$study_materials['prev_page_url']) disabled @endif">
                                                    <a class="page-link" href="?page={{$study_materials['current_page']-1}}">Previous</a>
                                                </li>
                                                <li class="page-item @if (!$study_materials['next_page_url']) disabled @endif">
                                                    <a class="page-link" href="?page={{$study_materials['current_page']+1}}">Next</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page={{$study_materials['last_page']}}">Last</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                @endif
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
            $("#subject").select2({
                placeholder: 'Subject'
            });
            $("#chapter").select2({
                placeholder: 'Chapter'
            });
        });
    </script>
@endpush

