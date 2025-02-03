@extends('layouts.master')

@section('title', 'Students')

@section('content')
    <main class="agent-order" role="main">
        <div class="container-fluid py-4 px-5">
            <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-10%) translateY(36%);">
                <div class="bg-diamond-lg"></div>
            </div>
            <h3 class="text-secondary"><b>Dashboard</b></h3>
            <div class="row mt-3">
                <div class="col-md-auto mb-5 student-profile-menu">
                    <div class="student-profile-menu-content border shadow bg-white">
                        <div class="student-profile-menu-image-container">
                            <img src="{{ $profile['associate']['image'] ?? url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <form id="image-upload-form" method="POST" action="{{ route('associate.update-avatar') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="image" name="image" style="display: none;" onchange="this.form.submit();"/>
                            <input type="hidden" name="hello">
                        </form>
                        <ul class="list-group text-secondary pb-4">
                            <li class="list-group-item {{ request()->is('associate/dashboard') ? 'active' : '' }}"><a href="{{ route('associate.dashboard.index') }}">Dashboard</a></li>
                            <li class="list-group-item {{ request()->is('associate/orders') ? 'active' : '' }}"><a href="{{ route('associate.orders.index') }}">Orders</a></li>
                            <li class="list-group-item {{ request()->is('associate/profile') ? 'active' : '' }}"><a href="{{ route('associate.profile.index') }}">Profile</a></li>
                            <li class="list-group-item {{ request()->is('associate/students') ? 'active' : '' }}"><a href="{{ route('associate.students.index') }}">Students</a></li>
                            <form id="logout" method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <li class="list-group-item"><a href="#" onclick="document.getElementById('logout').submit();">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Students</h3>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary float-right" href="{{ route('associate.students.create') }}"><i class="fas fa-plus"></i> NEW</a>
                        </div>
                    </div>
                    <div class="  mt-4 mt-md-0 table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary-50 p-2">
                            <tr class="">
                                <th class="border-0 font-weight-normal" scope="col"><strong>ID</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Name</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Email</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Phone</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Course</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Level</strong></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($students['data'] as $student)
                                <tr>
                                    <td>{{ $student['id'] }}</td>
                                    <td>{{ $student['name'] }}</td>
                                    <td>{{ $student['email'] }}</td>
                                    <td>{{ $student['country_code'] }} {{ $student['phone'] }}</td>
                                    <td>{{ $student['course']['name'] }}</td>
                                    <td>{{ $student['level']['name'] }}</td>
                                    <td align="right">
                                        @if (! $student['user']['is_verified'])
                                            <a href="#verification-mail-confirmation-modal" data-toggle="modal" data-student-id="{{ $student['id'] }}" class="verification-mail-confirmation-button" title="Send verification mail"><i class="fas fa-envelope mr-3"></i></a>
                                            <a href="{{ route('associate.students.edit', $student['id']) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        @else
                                            Verified
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="?page=1">First</a>
                                    </li>
                                    <li class="page-item @if (! $students['prev_page_url']) disabled @endif">
                                        <a class="page-link" href="?page={{ $students['current_page'] - 1 }}">Previous</a>
                                    </li>
                                    <li class="page-item @if (! $students['next_page_url']) disabled @endif">
                                        <a class="page-link" href="?page={{ $students['current_page'] + 1 }}">Next</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page={{ $students['last_page'] }}">Last</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="position-relative" style=" margin-top: 57px; ">
            <div class="bg-diamond bg-diamond-right bg-diamond-bottom" style="transform: translateX(20%) translateY(20%);">
                <div class="bg-diamond-md"></div>
            </div>
        </section>
    </main>
    <div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <div id="created" class="toast d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body">
                Student successfully created
            </div>
        </div>
    </div>
    <div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <div id="updated" class="toast d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body">
                Student successfully updated
            </div>
        </div>
    </div>
    <div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <div id="send" class="toast d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body">
                Verification mail successfully sent
            </div>
        </div>
    </div>

    <div class="modal fade" id="verification-mail-confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('associate.students.send-verification-mail') }}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="student_id" id="modal-student-id">
                        Send verification mail?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            @if (session()->has('created'))
                $('#created').toast('show');
                $('#created').removeClass('d-none');
            @endif

            @if (session()->has('updated'))
                $('#updated').toast('show');
                $('#updated').removeClass('d-none');
            @endif

            @if (session()->has('send'))
                $('#send').toast('show');
                $('#send').removeClass('d-none');
            @endif


            $("#upload").click(function(){
                $("#image").click();
            });

            $('.verification-mail-confirmation-button').click(function () {
                $('#modal-student-id').val($(this).data('student-id'));
            });
        });
    </script>
@endpush
