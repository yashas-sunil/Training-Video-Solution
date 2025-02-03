@extends('layouts.master')

@section('title', 'Watch History')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>{{$package_name['package'] ? $package_name['package']['name'] : '-'}}</b></h3>
            <a href="{{ url('videos') . '/' . $video_id . '?package=' . $package_id . '&order_item=' . $order_id ?? '' }}"><i class="far fa-arrow-alt-circle-left fa-2x text-secondary"></i></a><br>
            <div class="row mt-3">
{{--                @include('includes.student-menu')--}}
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents p-4">
                            <h5 class="mb-3"></h5>
                            <div class="col-md-3">
                                <div class="card text-white bg-secondary mb-3">
                                    <div class="card-body">
                                        <span><i class="fas fa-clock"></i> Remaining Duration</span>
                                        <h4 class="card-title"><b>{{$remainingPackageDuration}} / {{$totalDuration}}</b></h4>
                                    </div>
                                </div>
                            </div>
{{--                            <form id="filter_study_materials" action="" method="GET" >--}}
{{--                                <div class="row mb-4">--}}
{{--                                    <div class="col-sm col-md-2">--}}
{{--                                        <select name="subject" id="subject" class="form-control select2">--}}
{{--                                            <option value="" selected>Subject</option>--}}
{{--                                            @foreach ($subjects as $subject)--}}
{{--                                                <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}

                                <div class="table-responsive">
                                    <table class="table mt-3">
                                        <thead class="bg-primary">
                                        <tr>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Video Title</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Duration</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Browser Used</th>
                                            <th class="text-light border-0 font-weight-normal"  scope="col">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody class="study-materials">
                                        @foreach($packages['data'] as $package)
                                            <tr>
                                                <td>{{$package['video']['title']}}</td>
                                                <td>{{gmdate("H:i:s",$package['duration'])}}</td>
                                                <td>{{$package['browser_agent']}}</td>
                                                <td>{{\Carbon\Carbon::parse($package['created_at'])->format('d-m-yy h:i:s')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if(count($packages) > 0 )
                                    <div class="col-md-4 offset-4">
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="?package={{$package_id}}&order_item={{$order_id}}&totalDuration={{$totalDuration}}&remainingPackageDuration={{$remainingPackageDuration}}&page=1">First</a>
                                                </li>
                                                <li class="page-item @if (!$packages['prev_page_url']) disabled @endif">
                                                    <a class="page-link" href="?package={{$package_id}}&order_item={{$order_id}}&totalDuration={{$totalDuration}}&remainingPackageDuration={{$remainingPackageDuration}}&page={{$packages['current_page']-1}}">Previous</a>
                                                </li>
                                                <li class="page-item @if (!$packages['next_page_url']) disabled @endif">
                                                    <a class="page-link" href="?package={{$package_id}}&order_item={{$order_id}}&totalDuration={{$totalDuration}}&remainingPackageDuration={{$remainingPackageDuration}}&page={{$packages['current_page']+1}}">Next</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?package={{$package_id}}&order_item={{$order_id}}&totalDuration={{$totalDuration}}&remainingPackageDuration={{$remainingPackageDuration}}&page={{$packages['last_page']}}">Last</a>
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


