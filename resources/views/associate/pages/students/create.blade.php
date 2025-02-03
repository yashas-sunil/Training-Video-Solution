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
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Create Student</h3>
                        </div>
                    </div>
                    <div class="mt-md-0">
                        <form id="form-create-student" method="POST" action="{{ route('associate.students.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-5 col-form-label col-form-label-sm">Name*</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm input-sm" id="name" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-5 col-form-label col-form-label-sm">Email*</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control form-control-sm" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="student_phone" class="col-sm-12 col-form-label col-form-label-sm">Mobile*</label>
                                        <div class="col-sm-2">
                                            <select id="student_mobile_code" class="form-control-sm bg-white mobile_code" name="mobile_code">
                                                <option value="+91">+91</option>
                                                <option value="+971">+971</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm phone {{$errors->has('phone') ? ' is-invalid' : '' }}" id="student_phone" name="phone" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="course-id" class="col-sm-5 col-form-label col-form-label-sm">Course</label>
                                        <div class="col-sm-12">
                                            <x-inputs.course id="course-id" name="course_id" class="form-control form-control-sm">
                                            </x-inputs.course>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="level-id" class="col-sm-5 col-form-label col-form-label-sm">Level</label>
                                        <div class="col-sm-12">
                                            <x-inputs.level id="level-id" name="level_id" class="form-control form-control-sm" related="#course-id">
                                            </x-inputs.level>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="country-id" class="col-sm-5 col-form-label col-form-label-sm">Country</label>
                                        <div class="col-sm-12">
                                            <x-inputs.country id="country-id" name="country_id" class="form-control form-control-sm">
                                            </x-inputs.country>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="state-id" class="col-sm-5 col-form-label col-form-label-sm">State</label>
                                        <div class="col-sm-12">
                                            <x-inputs.state id="state-id" name="state_id" class="form-control form-control-sm" related="#country-id">
                                            </x-inputs.state>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-5 col-form-label col-form-label-sm">City</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="city" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="pin" class="col-sm-5 col-form-label col-form-label-sm">Pin</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="pin" name="pin">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-5 col-form-label col-form-label-sm">Address</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="address" name="address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="area" class="col-sm-5 col-form-label col-form-label-sm">Area</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="area" name="area">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="landmark" class="col-sm-5 col-form-label col-form-label-sm">Landmark</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="landmark" name="landmark">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary float-right">CREATE</button>
                        </form>
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

            $('#form-create-student').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 191,
                        remote: {
                            url: '{{ url('validate-email') }}',
                            type: 'POST',
                            data: {
                                email: function () {
                                    return $('#email').val()
                                }
                            }
                        }
                    },
                    phone: {
                        required: true,
                        maxlength: function() {
                            if ($('#student_mobile_code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#student_mobile_code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        remote: {
                            url: '{{ url('validate-phone') }}',
                            type: 'POST',
                            data: {
                                mobile: function() {
                                    return $('#student_phone').val()
                                }
                            }
                        }

                    },
                    course_id: {
                        required: true
                    },
                    level_id: {
                        required: true
                    },
                    country_id: {
                        required: true
                    },
                    state_id: {
                        required: true
                    },
                    city: {
                        required: true,
                        maxlength: 191
                    },
                    pin: {
                        required: true,
                        maxlength: 191
                    },
                    address: {
                        required: true
                    }
                },
                messages: {
                    phone: {
                        remote: 'Mobile number already exist'
                    },
                    email: {
                        remote: 'Email already exist'
                    }
                }
            });
        });
    </script>
@endpush
