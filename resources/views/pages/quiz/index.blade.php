@extends('layouts.master')

@section('title', 'Quiz')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome<!--Quiz List--></b></h3>
            <div class="row mt-3">
                <div class="col-md-auto student-dashboard-menu">
                    <div class="student-dashboard-menu-content border shadow">
                        <div class="student-dashboard-menu-image-container">
                            <img src="{{ $user['student']['image'] ? $user['student']['image'] : url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <div class="list-group mb-4">
                            <a href="{{ url('contents') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-copy p-2"></i> Content
                            </a>
                            <a href="{{ url('quiz') }}" class="list-group-item list-group-item-action active">
                                <i class="fas fa-question-circle p-2"></i> Quiz
                            </a>
                            <a href="{{ url('ask-a-question') }}" class="list-group-item list-group-item-action "><i class="fas fa-question p-2"></i> Ask A Question</a>
                            <a href="{{ url('professor-notes') }}" class="list-group-item list-group-item-action "><i class="fas fa-sticky-note p-2"></i> Notes</a>
                            <a href="{{ url('student-notes') }}" class="list-group-item list-group-item-action "><i class="fas fa-edit p-2"></i> My Motes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="p-4">
                            <h5>Quiz List</h5>
                            <div class="table-responsive">
                                <table class="table mt-3">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th class="text-light border-0 text-center font-weight-normal" scope="col">Quiz Name</th>
                                        <th class="text-light border-0 text-center font-weight-normal" scope="col">Chapter Name</th>
                                        <th class="text-light border-0 text-center font-weight-normal" scope="col">Subject Name</th>
                                        <th class="text-light border-0 text-center font-weight-normal" scope="col">Course Level</th>
                                        <th width="20%" class="text-light border-0 text-center font-weight-normal" scope="col">Status of Attempt & Last Attempt Details</th>
                                        <th width="20%" class="text-light border-0 text-center font-weight-normal" scope="col">Score of Last Attempt</th>
                                        <th class="text-light border-0 text-center font-weight-normal" scope="col">Reattempt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Mark</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td width="20%">@mdo</td>
                                        <td width="20%">@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>Mark</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td width="20%">@mdo</td>
                                        <td width="20%">@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>Mark</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td width="20%">@mdo</td>
                                        <td width="20%">@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
