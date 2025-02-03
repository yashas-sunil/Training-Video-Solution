@extends('layouts.master')

@section('title', 'Orders')

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
                        <div class="col-md-12">
                            <h3>Orders</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ url('associate/orders') }}">
                                <input type="hidden" name="page" value="{{ request()->input('page') }}">
                                <input type="hidden" name="query" value="{{ request()->input('query') }}">
                                <div class="input-group">
                                    <input class="form-control col-6 border-primary" id="date" name="date" type="date" value="{{ request()->input('date') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-primary" href="{{ url('associate/orders') }}"><i class="fas fa-redo"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="GET" action="{{ url('associate/orders') }}">
                                <input type="hidden" name="page" value="{{ request()->input('page') }}">
                                <input type="hidden" name="date" value="{{ request()->input('date') }}">
                                <div class="input-group d-flex justify-content-end">
                                    <input class="form-control col-6 border-primary" id="query" name="query" type="text" placeholder="Search" value="{{ request()->input('query') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-primary" href="{{ url('associate/orders') }}"><i class="fas fa-redo"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="  mt-4 mt-md-0 table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-primary-50 p-2">
                            <tr class="">
                                <th class="border-0 font-weight-normal" scope="col"><strong>Order ID</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Student</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Email</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Phone</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Payment Mode</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Date</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Net Amount</strong></th>
                                <th class="border-0 font-weight-normal" scope="col"><strong>Commission</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders['data'] as $order)
                                <tr>
                                    <td scope="row">{{ $order['id'] }}</td>
                                    <td>{{ $order['student']['name'] }}</td>
                                    <td>{{ $order['student']['email'] }}</td>
                                    <td>{{ $order['student']['phone'] }}</td>
                                    <td>{{ $order['associate_payment_mode'] }}</td>
                                    <td>{{ date("d-m-Y", strtotime($order['created_at'])) }}</td>
                                    <td>₹{{ $order['net_amount'] }}</td>
                                    <td>₹{{ $order['commission'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="?page=1&date={{ request()->input('date') }}&query={{ request()->input('query') }}">First</a>
                                    </li>
                                    <li class="page-item @if (!$orders['prev_page_url']) disabled @endif">
                                        <a class="page-link" href="?page={{ $orders['current_page'] - 1 }}&date={{ request()->input('date') }}&query={{ request()->input('query') }}">Previous</a>
                                    </li>
                                    <li class="page-item @if (!$orders['next_page_url']) disabled @endif">
                                        <a class="page-link" href="?page={{ $orders['current_page'] + 1 }}&date={{ request()->input('date') }}&query={{ request()->input('query') }}">Next</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page={{ $orders['last_page'] }}&date={{ request()->input('date') }}&query={{ request()->input('query') }}">Last</a>
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
