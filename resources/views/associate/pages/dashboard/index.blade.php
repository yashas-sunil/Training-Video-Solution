@extends('layouts.master')

@section('title', 'Associate Dashboard')

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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-secondary mb-3">
                                    <div class="card-body">
                                        <h1 class="card-title"><b>{{ $total_orders }}</b></h1>
                                        <span><i class="fas fa-cart-plus"></i> <a class="text-white" href="{{ url('associate/orders') . '?last_month=true' }}">TOTAL ORDERS (Last 30 days)</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h1 class="card-title"><b>{{ $total_commission }}</b></h1>
                                        <span><i class="fas fa-rupee-sign"></i> TOTAL COMMISSION (Last 30 days)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-info mb-3">
                                    <div class="card-body">
                                        <h1 class="card-title"><b>{{ $student }}</b></h1>
                                        <span><i class="fas fa-user"></i> STUDENTS</span>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card text-white bg-primary mb-3">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h1 class="card-title"><b>{{ $totalPendingCommission }}</b></h1>--}}
{{--                                        <span><i class="fas fa-rupee-sign"></i> TOTAL PENDING COMMISSION</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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

