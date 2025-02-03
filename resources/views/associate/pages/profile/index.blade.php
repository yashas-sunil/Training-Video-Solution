@extends('layouts.master')

@section('title', 'Associate Profile')

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
                    <h3 class="mx-3">Profile</h3>
                    <div class="row bg-secondary mx-3 p-3 text-white">
                        <div class="col-md-12">
                            <div><h3>{{ $profile['name'] }}</h3></div>
                        </div>

                        <div class="col-md-5">
                            <ul class="list-group align-items-left">
                                <li class="list-group-item bg-transparent border-0 pl-0">
                                    <i class="fas fa-envelope mx-2 pr-3"></i>{{ $profile['associate']['email'] }}
                                </li>
                                <li class="list-group-item bg-transparent border-0 pl-0">
                                    <i class="fas fa-phone mx-2 pr-3 "></i>{{ $profile['associate']['phone'] }}
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-5">
                                <div class="mt-3"><a href="#" data-toggle="modal" data-target="#modal-change-password">Change Password</a></div>
                                <div class="mt-3">Commission: {{ $profile['associate']['commission'] ?? 0 }}%</div>
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

    <div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="modal-change-password-title" aria-hidden="true">
        <div class="modal-dialog modal-change-password" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-change-password">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-change-password" method="POST" action="{{ route('associate.profile.update', $profile['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="New password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="New password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
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

            $("#upload").click(function(){
                $("#image").click();
            });
        });

        @if (session()->has('success'))
            alert('Password successfully changed');
        @endif
    </script>
@endpush
