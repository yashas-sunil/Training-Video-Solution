@extends('old_layouts.campaign')

@section('title', 'Package')

@section('content')
    <main class="course-list" role="main">
        <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
            <div class="bg-diamond-lg"></div>
        </div>
        <div class="container  py-5  ">
            <form class="" id="form-signup" method="POST" action="{{ url('/register') }}">
                @csrf
                <input type="hidden" name="form" value="signup">
                <input type="hidden" name="otp_token" id="otp_token">
                <input type="hidden" name="otp_code" id="otp_code">
                @if (request()->has('referral'))
                    <input type="hidden" name="referral" value="{{ request()->input('referral') }}">
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_name" class="col-sm-3 col-form-label col-form-label-sm">Name*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm input-sm {{ old('form') == 'signup' && $errors->has('name') ? ' is-invalid' : '' }}" id="signup_name" name="name" value="@if(old('form') == 'signup') {{ old('name') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_email" class="col-sm-3 col-form-label col-form-label-sm">Email*</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('email') ? ' is-invalid' : '' }}" id="signup_email" name="email" value="@if(old('form') == 'signup') {{ old('email') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_mobile" class="col-sm-3 col-form-label col-form-label-sm">Mobile*</label>
                            <div class="col-sm-3">
                                <select id="mobile-code" class="form-control-sm bg-white" name="mobile_code">
                                    <option selected value="+91">+91</option>
                                    <option value="+971">+971</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('mobile') ? ' is-invalid' : '' }}" id="signup_mobile" name="mobile" value="@if(old('form') == 'signup') {{ old('mobile') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_password" class="col-sm-3 col-form-label col-form-label-sm">Password*</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('course_id') ? ' is-invalid' : '' }}" id="signup_password" name="password">
                                @if (old('form') == 'signup' && $errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_password_confirmation" class="col-sm-3 col-form-label col-form-label-sm">Confirm Password*</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="signup_password_confirmation" name="password_confirmation">
                                @if (old('form') == 'signup' && $errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_course_id" class="col-sm-3 col-form-label col-form-label-sm">Course</label>
                            <div class="col-sm-9">
                                <x-inputs.course id="signup_course_id" name="course_id" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('course_id') ? ' is-invalid' : '' }}">
                                    @if(old('form') == 'signup' && !empty(old('course_id')))
                                        <option value="{{ old('course_id') }}" selected>{{ old('course_id_text') }}</option>
                                    @endif
                                </x-inputs.course>
                                @if (old('form') == 'signup' && $errors->has('course_id'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('course_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_level_id" class="col-sm-3 col-form-label col-form-label-sm">Level</label>
                            <div class="col-sm-9">
                                <x-inputs.level id="signup_level_id" name="level_id" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('level_id') ? ' is-invalid' : '' }}" related="#signup_course_id">
                                    @if(old('form') == 'signup' && !empty(old('level_id')))
                                        <option value="{{ old('course_id') }}" selected>{{ old('level_id_text') }}</option>
                                    @endif
                                </x-inputs.level>
                                @if (old('form') == 'signup' && $errors->has('level_id'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('level_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_country_id" class="col-sm-3 col-form-label col-form-label-sm {{ old('form') == 'signup' && $errors->has('country_id') ? ' is-invalid' : '' }}">Country</label>
                            <div class="col-sm-9">
                                <x-inputs.country id="signup_country_id" name="country_id" class="form-control form-control-sm">
                                    @if(old('form') == 'signup' && !empty(old('country_id')))
                                        <option value="{{ old('country_id') }}" selected>{{ old('country_id_text') }}</option>
                                    @endif
                                </x-inputs.country>
                                @if (old('form') == 'signup' && $errors->has('country_id'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_state_id" class="col-sm-3 col-form-label col-form-label-sm">State / Province</label>
                            <div class="col-sm-9">
                                <x-inputs.state id="signup_state_id" name="state_id" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('state_id') ? ' is-invalid' : '' }}" related="#signup_country_id">
                                    @if(old('form') == 'signup' && !empty(old('state_id')))
                                        <option value="{{ old('state_id') }}" selected>{{ old('state_id_text') }}</option>
                                    @endif
                                </x-inputs.state>
                                @if (old('form') == 'signup' && $errors->has('state_id'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('state_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_city" class="col-sm-3 col-form-label col-form-label-sm">City</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('city') ? ' is-invalid' : '' }}" id="signup_city" name="city" value="@if(old('form') == 'signup') {{ old('city') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('city'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_pin" class="col-sm-3 col-form-label col-form-label-sm">Pin</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('pin') ? ' is-invalid' : '' }}" id="signup_pin" name="pin" value="@if(old('form') == 'signup') {{ old('pin') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('pin'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('pin') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <div class="form-check">
                        <input checked class="form-check-input" type="checkbox" id="signup_terms" name="terms">
                        <label for="signup_terms">
                            By clicking Sign Up, you agree to our <a href="{{ url('terms/')}}">terms & condition</a> and <a href="{{ url('privacy/')}}">privacy policy.</a>
                        </label>
                        <label class="form-check-label"></label>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button id="btn-signup" type="button" class="btn btn-primary px-4">Sign Up</button>
                </div>

            </form>
            <div class="bg-diamond bg-diamond-right bg-diamond-bottom" style="transform: translateX(20%) translateY(20%);">
                <div class="bg-diamond-md"></div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    <script>
        $(function () {
            'use strict';
            $('#form-signup').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: '{{ url('validate-email') }}',
                            type: 'POST',
                            data: {
                                email: function () {
                                    return $('#signup_email').val();
                                }
                            }
                        }
                    },
                    mobile: {
                        required: true,
                        maxlength: function () {
                            if ($('#mobile-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function () {
                            if ($('#mobile-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        remote: {
                            url: '{{ url('validate-phone') }}',
                            type: 'POST',
                            data: {
                                mobile: function () {
                                    return $('#signup_mobile').val();
                                }
                            }
                        }
                    },
                    password: {
                        required: true,
                        maxlength: 255,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#signup_password"
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
                        required: true
                    },
                    pin: {
                        required: true
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    terms: {
                        required: "You must agree our terms & condition and our privacy policy to continue signup"
                    },
                    email: {
                        remote: 'Email already exist'
                    },
                    mobile: {
                        remote: 'Mobile number already exist'
                    }
                }
            });

            $('#btn-signup').click(function (e) {
                e.preventDefault();

                if (!$('#form-signup').valid()) {
                    return;
                }

                $('#modal-otp').find('#otp_mobile').val($('#signup_mobile').val());
                $('#modal-otp').find('#signupemailverify').val($('#signup_email').val());
                $('#modal-otp').modal('show');
            });
        });
    </script>
@endpush
