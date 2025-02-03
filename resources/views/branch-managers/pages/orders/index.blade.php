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
                            <img src="{{ url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <ul class="list-group text-secondary pb-4">
                            <li class="list-group-item {{ request()->is('branch-managers/orders') ? 'active' : '' }}"><a href="{{ route('branch-managers.orders.index') }}">Orders</a></li>
                            <li class="list-group-item {{ request()->is('branch-managers/profile') ? 'active' : '' }}"><a href="{{ route('branch-managers.profile.index') }}">Profile</a></li>
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
                                <th class="border-0 text-center font-weight-normal" scope="col">Order ID</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Student</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Date</th>
                                <th class="border-0 text-center font-weight-normal" scope="col">Purchase Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders['data'] as $order)
                                <tr class="text-center">
                                    <td scope="row">{{ $order['id'] }}</td>
                                    <td>{{ $order['student']['name'] }}</td>
                                    <td>{{ date("d-m-Y", strtotime($order['created_at'])) }}</td>
                                    <td>{{ $order['order_status'] }}</td>
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
                                    <li class="page-item @if (!$orders['prev_page_url']) disabled @endif">
                                        <a class="page-link" href="?page={{$orders['current_page']-1}}">Previous</a>
                                    </li>
                                    <li class="page-item @if (!$orders['next_page_url']) disabled @endif">
                                        <a class="page-link" href="?page={{$orders['current_page']+1}}">Next</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page={{$orders['last_page']}}">Last</a>
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
