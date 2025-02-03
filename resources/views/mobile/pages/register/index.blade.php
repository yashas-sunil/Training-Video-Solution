@extends('old_layouts.mobile.master')

@section('title', 'Register')

@section('content')
    <main role="main">
        <div class="container-fluid">
            @if(old('form') == 'signup' && session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif

            <form id="form-signup" method="POST" action="{{ url('/register') }}">
                @csrf
                <input type="hidden" name="form" value="signup">
                <input type="hidden" name="otp_token" id="otp_token">
                <input type="hidden" name="otp_code" id="otp_code">
                <input type="hidden" name="sso" value="true">
                @if (request()->has('referral'))
                    <input type="hidden" name="referral" value="{{ request()->input('referral') }}">
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_name" class="col-sm-5 col-form-label col-form-label-sm">Name*</label>
                            <div class="col-sm-7">
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
                            <label for="signup_email" class="col-sm-5 col-form-label col-form-label-sm">Email*</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('email') ? ' is-invalid' : '' }}" id="signup_email" name="email" value="@if(old('form') == 'signup') {{ old('email') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_mobile" class="col-sm-5 col-form-label col-form-label-sm">Mobile*</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('mobile') ? ' is-invalid' : '' }}" id="signup_mobile" name="mobile" value="@if(old('form') == 'signup') {{ old('mobile') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_password" class="col-sm-5 col-form-label col-form-label-sm">Password*</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('course_id') ? ' is-invalid' : '' }}" id="signup_password" name="password">
                                @if (old('form') == 'signup' && $errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_password_confirmation" class="col-sm-5 col-form-label col-form-label-sm">Confirm Password*</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="signup_password_confirmation" name="password_confirmation">
                                @if (old('form') == 'signup' && $errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_course_id" class="col-sm-5 col-form-label col-form-label-sm">Course</label>
                            <div class="col-sm-7">
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
                            <label for="signup_level_id" class="col-sm-5 col-form-label col-form-label-sm">Level</label>
                            <div class="col-sm-7">
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
                            <label for="signup_country_id" class="col-sm-5 col-form-label col-form-label-sm {{ old('form') == 'signup' && $errors->has('country_id') ? ' is-invalid' : '' }}">Country</label>
                            <div class="col-sm-7">
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
                            <label for="signup_state_id" class="col-sm-5 col-form-label col-form-label-sm">State</label>
                            <div class="col-sm-7">
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
                            <label for="signup_city" class="col-sm-5 col-form-label col-form-label-sm">City</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm {{ old('form') == 'signup' && $errors->has('city') ? ' is-invalid' : '' }}" id="signup_city" name="city" value="@if(old('form') == 'signup') {{ old('city') }} @endif">
                                @if (old('form') == 'signup' && $errors->has('city'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="signup_pin" class="col-sm-5 col-form-label col-form-label-sm">Pin</label>
                            <div class="col-sm-7">
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
                        <label class="form-check-label" for="signup_terms">
                            By clicking Sign Up, you agree to our <a href="{{ url('terms/')}}">terms & condition</a> and <a href="{{ url('privacy/')}}">privacy policy.</a>
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4 mb-5">
                    <button id="btn-signup" type="button" class="btn btn-primary px-4">Sign Up</button>
                </div>
            </form>
        </div>
    </main>

    <div class="modal fade" id="modal-otp" tabindex="-1" role="dialog" aria-labelledby="modal-otp-title"
         aria-hidden="true">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-otp-title">Verify</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <span>Please enter verification code just sent to your number</span><br />
                        <span id="otp_mobile"></span>
                    </p>
                    <form id="form-otp" method="POST" action="{{ url('/login') }}">
                        <input id="otp_mobile" name="otp_mobile" type="hidden">
                        <input id="signupemail" name="signupemail" type="hidden">
                        <input id="otp_token" name="otp_token" type="hidden">
                        @csrf
                        <div class="form-group">
                            <input placeholder="Verification Code" type="text" class="form-control" id="otp_code" name="otp_code">
                        </div>
                        <div class="form-group clearfix text-center pb-4">
                            <span id="resend_text">Didn't get? <a id="resend" class="ml-md-auto" href="#">Resend</a></span><span style="display: none" id="timer">30</span>
                        </div>

                        <div class="form-group mt-4">
                            <!--<button type="button" class="btn btn-block btn-primary">Login</button>-->
                            <button id="btn-otp-verify" type="submit" class="btn btn-block btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script id="script-modal-signup">
        $(function () {
            'use strict';

            @if (request()->has('referral'))
            $('#modal-signup').modal('show');
            @endif

            $('#form-signup').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    mobile: {
                        required: true,
                        maxlength: 255
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
                    }
                }
            });


            $('#btn-signup').click(function (e) {
                e.preventDefault();

                if (!$('#form-signup').valid()) {
                    return;
                }

                $('#modal-otp').find('#otp_mobile').val($('#signup_mobile').val());
                $('#modal-otp').find('#signupemail').val($('#signup_email').val());
                $('#modal-otp').modal('show');
            });

            $('#modal-otp').on('hide.bs.modal', function () {
                $('#form-signup').find('#otp_token').val($('#modal-otp').find('#otp_token').val());
                $('#form-signup').find('#otp_code').val($('#modal-otp').find('#otp_code').val());
                $('#form-signup').find('#signupemail').val($('#signup_email').val());
                $('#btn-signup').prop('disabled', true);
                $('#form-signup').submit();
            });

            @if(old('form') == 'signup')
                $('#modal-signup').modal('show');
            @endif
        });
    </script>
    <script id="script-modal-otp">
        $(function () {
            "use strict";
            var timer;

            let $modal = $('#modal-otp');

            let pad = function (value) {
                return (value < 10 ? '0' : '') + value;
            };

            let startTimer = function () {
                stopTimer();

                $('#resend_text').hide();

                var time  = 30;
                timer = setInterval(function() {
                    if (time < 0) {
                        stopTimer();
                        return;
                    }

                    $('#timer').show();
                    $('#timer').text(Math.floor(time / 60) + ':' + pad(time % 60));
                    time--;
                }, 1000);
            };

            let stopTimer = function () {
                if (timer) clearInterval(timer);
                $('#resend_text').show();
                $('#timer').hide();
            };

            let sendOTP = function () {
                startTimer();

                var url = '{{ env('API_URL').'/otp/send' }}';
                var phone = $modal.find('#otp_mobile').val();
                var email = $modal.find('#signupemail').val();
                var otp_token = $modal.find('#otp_token').val();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { mobile: phone,email:email, action: 'signup', token: otp_token}
                    /*,
                     global: false */ // set false to disable global event handler
                }).done(function (response, textStatus, jqXHR) {
                    // alert(JSON.stringify(data[0]));
                    $modal.find('#otp_token').val(response['data']);
                }).fail(function (jqXHR, textStatus, errorThrown) {

                }).always(function () {
                    //  ladda.stop();
                });
            };

            $modal.on('shown.bs.modal', function () {
                sendOTP();
            });

            $("#resend").click(function (e) {
                sendOTP();
            });

            $('#form-otp').validate({
                rules: {
                    otp_code: {
                        required: true
                    }
                }
            });

            $('#btn-otp-verify').click(function (e) {
                e.preventDefault();

                if (!$('#form-otp').valid()) {
                    return;
                }

                $modal.modal('hide');
            });

        })
    </script>
@endpush
