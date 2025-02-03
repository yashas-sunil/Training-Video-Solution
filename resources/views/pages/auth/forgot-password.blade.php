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
                <div class="g-recaptcha-c" data-sitekey="{{env('SITE_KEY')}}" id="RecaptchaField3"></div>
                <input id="ft_hiddenRecaptcha" name="ft_hiddenRecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/>
              </div>
                <!-- <div class="row justify-content-center">
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
                </div> -->
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
            //captchaforgot();
            $('#form-forgot-password').validate({
                onsubmit:false,
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    "ft_hiddenRecaptcha": {
                        required: true,
                        minlength: "255",
                        remote: {
                            url: '{{ url('/validate-captcha') }}',
                            type: 'POST',
                            data: {
                              captchaa: function () {
                              // alert();
                               return $('#ft_hiddenRecaptcha').val();
                                },
                                _token: '{{ csrf_token() }}',
                            }
                        },
                    },
                },
            });
           
            $("#submit-btn").click(function (e) {
               
                e.preventDefault();
                let isValid = $('#form-forgot-password').valid();
                if (isValid)
                {   
                    $('#submit-btn').prop('disabled', true);
                    $('#form-forgot-password').submit();
                }
            });
            // function captchaforgot() {
            //     $.ajax({
            //         type: 'GET',
            //         url: '/refresh_captcha',
            //         success: function(data) {
            //             $(".captcha_forgot span").html(data.captcha);
            //             $('#captcha_forgot').val('');
            //             $('#captcha_forgot').removeClass('is-valid');
            //             $('#captcha_forgot').removeClass('is-invalid');
            //         }
            //     });
            //   }
            // $(".btn-refresh").click(function() {
            //     captchaforgot();
            // });
           
            $('#email_forgot').on('keyup',function(){                
                $('#submit-btn').prop('disabled', false);
            });
            // $('#captcha_forgot').on('keyup',function(){                
            //     $('#submit-btn').prop('disabled', false);
            // });

        });
    </script>
@endpush

