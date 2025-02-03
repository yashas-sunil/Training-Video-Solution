<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-login-title"
     aria-hidden="true">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-secondary text-uppercase" id="modal-login-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


{{--                <ul class="nav nav-tabs mb-4 login-tab" id="tabContent">--}}
{{--                    <li class="active col p-0">--}}
{{--                        <a href="#student" data-toggle="tab" class="active">--}}
{{--                            <h5 class="m-0 text-center py-2 rounded-top text-primary">Student</h5>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="col p-0">--}}
{{--                        <a href="#associate" data-toggle="tab" id="associate-link">--}}
{{--                            <h5 class="m-0 text-center py-2 rounded-top text-primary">Associate</h5>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}

                <div class="tab-content">
                    <div class="tab-pane active" id="student">

                        <form id="form-sign-in" method="POST" action="{{ url('/login') }}">
                            @csrf
                            <input type="hidden" name="form" value="login">
                            <input type="hidden" id="package-id" name="package_id">
                            <input type="hidden" id="location" name="location">
                            <div class="form-group pb-4">
                                <input placeholder="Email / Phone" type="text" class="form-control {{ old('form') == 'login' && $errors->has('email') ? ' is-invalid' : '' }}"
                                       id="email" name="email" value="@if(old('form') == 'login'){{ old('email') }}@endif">
                                @if (old('form') == 'login' && $errors->has('email'))
                                    <span class="is-invalid invalid-feedback" role="alert" style="">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group pb-2">
                                <input placeholder="Password" type="password" class="form-control" id="password" name="password">
                            </div>
                            <div id="login-type-container">

                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                                <a class="fa-pull-right" href="forgot-password"> Forgot Password</a>
                            </div>
                            <div class="form-group mt-4">
                                <!--<button type="button" class="btn btn-block btn-primary">Login</button>-->
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div>
                        </form>

                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto"><span class="mx-2">OR</span></div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="text-center">Don’t have an account yet?</p>
                            <button id="sign-up" type="button" class="btn btn-block btn-secondary">Sign Up</button>
                        </div>

                    </div>

{{--                    <div class="tab-pane" id="associate">--}}
{{--                        <form id="form-sign-in" method="POST" action="{{ url('/login') }}">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="form" value="login">--}}
{{--                            <input type="hidden" name="role" value="associate">--}}
{{--                            <div class="form-group pb-4">--}}
{{--                                <input placeholder="Email / Phone" type="text" class="form-control {{ old('form') == 'login' && $errors->has('email') ? ' is-invalid' : '' }}"--}}
{{--                                       id="email" name="email" value="@if(old('form') == 'login'){{ old('email') }}@endif">--}}
{{--                                @if (old('form') == 'login' && $errors->has('email'))--}}
{{--                                    <span class="is-invalid invalid-feedback" role="alert" style="">{{ $errors->first('email') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="form-group pb-2">--}}
{{--                                <input placeholder="Password" type="password" class="form-control" id="password" name="password">--}}
{{--                            </div>--}}
{{--                            <div class="custom-control custom-checkbox">--}}
{{--                                <input type="checkbox" class="custom-control-input" id="customCheck1">--}}
{{--                                <label class="custom-control-label" for="customCheck1">Remember me</label>--}}
{{--                                <a class="fa-pull-right" href="forgot-password"> Forgot Password</a>--}}
{{--                            </div>--}}
{{--                            <div class="form-group mt-4">--}}
{{--                                <!--<button type="button" class="btn btn-block btn-primary">Login</button>-->--}}
{{--                                <button type="submit" class="btn btn-block btn-primary">Login</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}

                </div>


                @if(old('form') == 'login' && session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>

<div id="login-type-template" style="display: none">
    <p class="text-center text-secondary">Choose app:</p>
    <div class="form-group mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pb-3 border-bottom">
                <a class="btn-primary-login" href="#"><img src="{{ url('assets/images/logo.png') }}" alt="JK Shah Classes Online" title="JK Shah Classes Online" width="100"></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-3">
                <a class="btn-secondary-login" href="#"><img src="{{ url('assets/images/jk-logo.png') }}" alt="JK Shah Classes" title="JK Shah Classes" width="100"></a>
            </div>
        </div>
    </div>
</div>
<div id="login-type-secondary" style="display: none">
    <p class="text-center text-secondary">Choose app:</p>
    <div class="form-group mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-3">
                <a class="btn-secondary-login" href="#"><img src="{{ url('assets/images/jk-logo.png') }}" alt="JK Shah Classes" title="JK Shah Classes" width="100"></a>
            </div>
        </div>
    </div>
</div>
<form id="form-primary-login" method="POST" action="{{ url('login') }}">
    @csrf
    <input id="primary-username" type="hidden" name="email">
    <input id="primary-password" type="hidden" name="password">
</form>
<form id="form-secondary-login" method="POST" action="{{ url('secondary-login') }}">
    @csrf
    <input id="secondary-username" type="hidden" name="username">
    <input id="secondary-password" type="hidden" name="password">
</form>
@push('script')
<script id="script-modal-signup">
    $(function () {
        'use strict';

        @if (request()->has('login'))
            $('#modal-login').modal('show');
        @endif

        $('#sign-up').on("click",function(){
            $('#modal-signup').modal('show');
            $('#modal-login').modal('hide');
        });

        let signInForm = $('#form-sign-in');

        signInForm.validate({
            rules: {
                email: {
                    required: true,
                    // email: true,
                    maxlength: 255
                },
                password: {
                    required: true,
                    maxlength: 255,
                    minlength: 5
                }

            }
        });

        signInForm.submit(function(e) {
            e.preventDefault();

            if(signInForm.valid()) {
                $.ajax({
                    url: '{{ url('validate-login') }}',
                    type: 'POST',
                    data: {
                        username: $('#email').val(),
                        password: $('#password').val()
                    }
                }).done(function(response) {
                    let jsonResponse = JSON.parse(response);

                    console.log(jsonResponse);

                    if (jsonResponse.pri === true && jsonResponse.sec == true) {
                        let template = $('#login-type-template').clone();
                        template.css('display', 'block');
                        $('#login-type-container').html(template);
                        $('#primary-username').val($('#email').val());
                        $('#primary-password').val($('#password').val());
                        $('#secondary-username').val($('#email').val());
                        $('#secondary-password').val($('#password').val());
                    } else if (jsonResponse.sec === true) {
                        let template = $('#login-type-secondary').clone();
                        template.css('display', 'block');
                        $('#login-type-container').html(template);
                        $('#secondary-username').val($('#email').val());
                        $('#secondary-password').val($('#password').val());
                    } else {
                        signInForm.unbind(e);
                        signInForm.submit();
                    }
                });
            }
        });

        let loginTypeContainer = $('#login-type-container');

        loginTypeContainer.on('click', '.btn-primary-login', function() {
            $('#form-primary-login').submit();
        });

        loginTypeContainer.on('click', '.btn-secondary-login', function() {
            $('#form-secondary-login').submit();
        });

        @if(old('form') == 'login')
           $('#modal-login').modal('show');
        @endif

        @if (old('role'))
            $('#associate-link').trigger('click');
        @endif
    })
</script>
@endpush
