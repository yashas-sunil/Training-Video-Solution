@extends('layouts.master')

@section('title', 'Forgot Password')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4" role="main">
        <div class="mt-5 mb-5 text-center forgot-password">
        <h3 class="text-secondary text-center  pb-3"><b>Forgot Password</b></h3>
        @if (session()->has('email'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center">
                        <i class="far fa-envelope text-primary fa-7x"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-center">
                        Password reset link has been sent to <strong>{{ request()->session()->get('email') }}</strong>. Please check your email.
                    </div>
                </div>
            </div>
        @else
            <form id="form-forgot-password" method="POST" action="{{ route('forgot-password.store') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="form-group row mx-3">
                            <label for="email" class="col-sm-4 col-form-label text-sm-left col-form-label-sm text-md-right">Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm input-sm" id="email_forgot" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="form-group row mx-3">
                            <label for="email" class="col-sm-4 col-form-label text-sm-left col-form-label-sm text-md-right">Captcha(Kindly enter the sum)</label>
                            <div class="col-sm-2 pr-0">
                            <div class="captcha_forgot" style="float: left;">
                                <span style="float:left;margin-right: 3px;"></span>
                                <button type="button" class="btn btn-success btn-refresh" style="float:left"><i class="fa fa-refresh"></i></button>
                               </div>
                                
                            </div>

                            <div class="">
                                                                
                            <input id="captcha_forgot" type="text" class="form-control" placeholder="Please insert the sum" name="captcha_forgot">
                                

                                <span class="help-block" style="color: red;font-size: 10px;" id="captcha_forgot_error">
                                </span></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" id="submit-btn" class="btn btn-primary mb-5">Submit</button>
                </div>
            </form>
        @endif
        @if (session()->has('exist'))
            @if (!session()->get('exist'))
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="text-center">
                                Email doesn't exist, please enter a valid email address.
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        </div>
    </main>
@endsection

@push('script')
    <script>
        
        $(function () {
            captchaforgot();
            $('#form-forgot-password').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    captcha_forgot: {
                        required: true,
                        remote: {
                            type: 'POST',
                            async: false,
                            dataType: 'json',
                            url: '{{ route('captcha_forgotcheck') }}',
                        }
                    },
                },
                messages: {
                captcha_forgot: {
                   required: 'Captcha is required',
                    remote: 'Captcha is invalid',

                },
            }
            });

            $('#form-forgot-password').on('submit', function() {
                $('#submit-btn').prop('disabled', true);
            });
            function captchaforgot() {
                $.ajax({
                    type: 'GET',
                    url: '/refresh_captcha',
                    success: function(data) {
                        $(".captcha_forgot span").html(data.captcha);
                        $('#captcha_forgot').val('');
                        $('#captcha_forgot').removeClass('is-valid');
                        $('#captcha_forgot').removeClass('is-invalid');
                    }
                });
              }
            $(".btn-refresh").click(function() {
                captchaforgot();
            });
           
            $('#email_forgot').on('keyup',function(){                
                $('#submit-btn').prop('disabled', false);
            });
            $('#captcha_forgot').on('keyup',function(){                
                $('#submit-btn').prop('disabled', false);
            });

        });
    </script>
@endpush

