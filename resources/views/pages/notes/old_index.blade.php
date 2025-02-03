@extends('layouts.master')

@section('title', 'Professor Notes')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}<!--Notes--></b></h3>
            <div class="row mt-3">
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents  p-4">
                            <h5>Professor Notes</h5>
                            @if($professorNotes)
                                <div class="table-responsive">
                                    <table class="table mt-3">
                                        <thead class="bg-primary">
                                        <tr>
                                            <th class="text-light border-0 font-weight-normal" scope="col">Note</th>
                                            <th class="text-light border-0 font-weight-normal" scope="col">Chapter</th>
                                            <th class="text-light border-0 font-weight-normal" scope="col">Subject</th>
                                            {{--<th class="text-light border-0 text-center font-weight-normal" scope="col">Status of Download</th>--}}
                                            {{--<th class="text-light border-0 text-center font-weight-normal" scope="col">Last viewed</th>--}}
                                            {{--<th class="text-light border-0 text-center font-weight-normal" scope="col">Download</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($professorNotes as $professorNote)
                                            <tr>
                                                <td>{{ $professorNote['name'] }}</td>
                                                <td>{{ $professorNote['video']['chapter']['name'] }}</td>
                                                <td>{{ $professorNote['video']['subject']['name'] }}</td>
                                                {{--<td></td>--}}
                                                {{--<td></td>--}}
                                                {{--<td><a href="#">Download</a></td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="mt-4">
                                    <p>Currently no data available !</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
