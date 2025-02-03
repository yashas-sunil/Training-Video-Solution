@extends('layouts.master')

@section('title', 'Demos')

@section('content')
    <main class="course-list" role="main">
        <div class="container sticky-md-top bg-white pt-3 px-0" style="top: 0px; z-index: 1;">
            <h1 class="text-secondary">Demo Video Lectures Online For CA Inter & Final Subjects</h1>
            <div class="mt-3">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'videos' ? 'active' : '' }}   rounded-0" id="videos-tab" href="{{ route('ca-demo-lectures-online.index', array_merge(request()->all(), ['resource_type' => 'videos','page' => 1])) }}" role="tab"
                           aria-controls="all" aria-selected="true">Videos</a>
                    </li>
                    <li style="width: 25%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'audios' ? 'active' : '' }} rounded-0" id="audios-tab"   href="{{ route('ca-demo-lectures-online.index', ['tab' => 'audios']) }}" role="tab"
                           aria-controls="profile" aria-selected="false">Audio</a>
                    </li>
                    <li style="width: 25%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'images' ? 'active' : '' }}   rounded-0" id="images-tab"  href="{{ route('ca-demo-lectures-online.index', ['tab' => 'images']) }}" role="tab"
                           aria-controls="home" aria-selected="true">Images</a>
                    </li>
                    <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'documents' ? 'active' : '' }} rounded-0" id="documents-tab" href="{{ route('ca-demo-lectures-online.index',  array_merge(request()->all(), ['resource_type' => 'documents','page' => 1])) }}" role="tab"
                           aria-controls="crash_course" aria-selected="false">Documents</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
            <div class="bg-diamond-lg"></div>
        </div>

        <div class="container">
            <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
                <div class="bg-diamond-lg"></div>
            </div>

            <form method="GET" action="{{ url('ca-demo-lectures-online') }}">
                <input type="hidden" name="resource_type" value="{{ $tab }}">
                <div class="row container mt-5 ">
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
                        <x-inputs.professor id="professor" name="professor" class="form-control">
                            @if (request()->filled('professor') && request()->filled('professor_text'))
                                <option value="{{ old('professor', request()->input('professor')) }}" selected>{{ old('professor', request()->input('professor_text')) }}</option>
                            @endif
                        </x-inputs.professor>
                    </div>
                    <div class="col-md-3">
                        <input type="text"  id="search" name="search" class="form-control" placeholder="Search Demos" @if(isset($_GET['search']))  value="{{ $_GET['search'] }}" @endif >
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group">
                            <button id="btn-filter" class="btn btn-primary">Filter</button>
                            <a href="{{ route('ca-demo-lectures-online.index', ['tab' => $tab]) }}" id="btn-reset" class="btn btn-primary border-left">Clear</a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="tab-content container mt-5" id="myTabContent">
                <div class="tab-pane fade show {{ $tab == 0 ? 'active' : '' }}" id="videos" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mb-5">
                        @if($free_resources['data'])
                            @foreach($free_resources['data'] as $free_resource)
                                @if($free_resource['type'] == 5 )
                                    <div class="col-md-4 mb-5">
                                        <a class="popup-iframe" href="{{ url("embed/videos/".$free_resource['media_id']) }}">
                                            <img src="https://cdn.jwplayer.com/v2/media/{{$free_resource['media_id']}}/poster.jpg?width=320">
                                        </a>
                                        <div class="pt-2 text-center">{{$free_resource['title']}}</div>
                                    </div>
                                @elseif($free_resource['type'] == 1 )
                                    <div class="col-md-4 mb-5">
                                        <a class="popup-youtube" href="http://www.youtube.com/watch?v={{$free_resource['youtube_id']}}">
                                            <img  src="https://img.youtube.com/vi/{{$free_resource['youtube_id']}}/mqdefault.jpg">
                                        </a>
                                        <div class="pt-2 text-center">{{$free_resource['title']}}</div>
                                    </div>
                                @elseif($free_resource['type'] == 2 )
                                    <div class="col-md-4 mb-5">
                                        <a class="text-decoration-none text-dark"  target="_blank" download="{{$free_resource['file']}}" href="{{$free_resource['file_url']}}">
                                            <img  src="{{$free_resource['file_url']}}" width="320px;" height="200px;" >
                                            <div class="pt-2 text-center">{{$free_resource['title']}}</div>
                                        </a>
                                    </div>
                                @elseif($free_resource['type'] == 3 )
                                    <div class="col-md-4 mb-5">
                                        <embed width="320" height="240" name="plugin" src="{{$free_resource['file_url']}}" type="application/pdf">
                                        <a class="text-decoration-none" target="_blank" download="{{$free_resource['file']}}" href="{{$free_resource['file_url']}}">
                                            <div class="pt-2 text-center">{{$free_resource['title']}}</div>
                                        </a>
                                    </div>
                                @elseif($free_resource['type'] == 4)
                                    <div class="col-md-4 mb-5">
                                        <a class="text-decoration-none text-dark" href="#">
                                            <img src="{{ url('assets/images/audio.jpg') }}">
                                            <div class="pt-2 text-center"><a download href="{{$free_resource['file_url']}}">{{$free_resource['file']}}</a></div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p><b>No Data Available!</b></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="{{ route('ca-demo-lectures-online.index', ['tab' => $tab, 'page' => 1]) }}">First</a>
                        </li>
                        @if($page <=1)
                            <a disabled class="page-link" >Previous</a>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ route('ca-demo-lectures-online.index', ['tab' => $tab, 'page' => $page - 1]) }}">Previous</a>
                            </li>
                        @endif

                        @if($page >= $free_resources['last_page'])
                            <a disabled class="page-link" >Next</a>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{  route('ca-demo-lectures-online.index', ['tab' => $tab, 'page' => $page + 1]) }}">Next</a>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{  route('ca-demo-lectures-online.index', ['tab' => $tab, 'page' => $free_resources['last_page']]) }}">Last</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </main>
@endsection
@push('script')
    <script>
        $(document).ready(function () {

            $("#type").select2({
                placeholder: 'Type'
            });

            $('.btn-add-to-cart').click(function (e) {
                e.preventDefault();

                var url = '{{ url('cart') }}';
                var packageId = $(this).data('id');

                $.post(url, {
                    package_id: packageId
                }).done(function (data) {

                    if (!data.data) {
                        $('#toast-already-exist').toast('show');
                    } else {
                        $('#toast-added-to-cart').toast('show');
                    }

                    $('body').trigger('change.cart');
                }).fail(function () {
                    alert("Error while adding to cart");
                });
            });
        });
    </script>
@endpush
