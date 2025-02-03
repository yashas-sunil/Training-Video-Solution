@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <main class="agent-order" role="main">
        <div class="container-fluid py-4 px-5">
            <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-10%) translateY(36%);">
                <div class="bg-diamond-lg"></div>
            </div>
            <h1 class="text-secondary"><b>Dashboard</b></h1>
            <div class="row mt-3">
                <div class="col-md-auto mb-5 student-profile-menu">
                    <div class="student-profile-menu-content border shadow bg-white">
                        <div class="student-profile-menu-image-container">
                            <img src="{{assets}}/images/avatar.png" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <ul class="list-group text-secondary pb-4">
                            <li class="list-group-item">Courses</li>
                            <li class="list-group-item">Commission</li>
                            <li class="list-group-item text-primary">Order</li>
                            <li class="list-group-item">Profile</li>
                            <li class="list-group-item">Log Out</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <h3 class="mx-3">Profile</h3>
                    <div class="row bg-secondary mx-3 p-3 text-white">
                        <div class="col-md-12">
                            <div><h3> Mr.Lorem Ipsum</h3></div>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group align-items-left">
                                <li class="list-group-item bg-transparent border-0 pl-0">
                                    <i class="fas fa-envelope mx-2 pr-5"></i>David Copperfield
                                </li>
                                <li class="list-group-item bg-transparent border-0 pl-0">
                                    <i class="fas fa-phone mx-2 pr-5 "></i>The Portrait of a Lady
                                </li>
                                <li class="list-group-item bg-transparent border-0 pl-0">
                                    <i class="fas fa-address-card  mx-1 pr-5"></i> The Trial
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-1 offset-1">
                            <ul class="list-group align-items-left">
                                <li class="list-group-item bg-transparent border-0 pl-0">
                                    <i class="fas fa-map-marker-alt mx-2 pr-5"></i>
                                </li>

                            </ul>
                        </div>

                        <div class="col pt-2">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, wh
                            <div class="mt-3"><a href="#">Change Password</a></div>
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
        $(document).ready(function(){
            $("#upload").click(function(){
                $("#image").click();
            });

            $('#attempt-year').select2({
                placeholder: 'Hello'
            });

            $('#profile-update').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
                    phone: {
                        required: true,
                        digits: true,
                        maxlength: 191
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 191
                    },
                    age: {
                        required: true,
                        digits: true,
                        maxlength: 11
                    },
                    course_id: {
                        required: true
                    },
                    level_id: {
                        required: true
                    },
                    attempt_year: {
                        required: true
                    },
                    address: {
                        required: true,
                        maxlength: 191
                    },
                    city: {
                        required: true,
                        maxlength: 191
                    },
                    country_id: {
                        required: true
                    },
                    state_id: {
                        required: true
                    },
                    pin: {
                        required: true,
                        maxlength: 191
                    }
                }
            });
        });
    </script>
@endpush
