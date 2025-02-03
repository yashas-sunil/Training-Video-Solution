@extends('layouts.master')

@section('title', 'Courses')

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
                    <h3>Order</h3>
                    <div class="  mt-4 mt-md-0 table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary-50 p-2">
                            <tr class="">
                                <th class="border-0 text-center font-weight-normal" scope="col">Student</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Course Bought</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Purchase Date</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Paid Amount</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Mode of Payment</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Sales Agent (Name-Code)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($courses as $course)
                                <tr class="text-center">
                                    <td scope="row">{{ $course['order']['student']['name'] }}</td>
                                    <td>{{ $course['package']['name'] }}</td>
                                    <td>{{ date("d-m-Y", strtotime($course['order']['created_at'])) }}</td>
                                    <td>{{ $course['order']['net_amount'] }}</td>
                                    <td>{{ $course['order']['associate_payment_mode'] }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
            $("#upload").click(function(){
                $("#image").click();
            });
        });
    </script>
@endpush
