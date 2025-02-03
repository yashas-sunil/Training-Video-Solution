<!---Login Modal-->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body login-popbody" style="background-image: url({{ asset('dist/images/login-bg.png') }});">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="loginform">
                    <h2>LOGIN</h2>
                    <div class="loginforminner">
                        <form id="login_form" class="popup-form" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group form-row">
                                <div class="col-sm-1">
                                <i class="fas fa-user"></i>
                                </div>
                                <div class="col-sm-9">
                                <input name="email" id="email" type="email" class="form-group required">
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-sm-1">
                                <i class="fas fa-key"></i>
                                </div>
                                <div class="col-sm-9 password">
                                <input name="password" id="password" type="password" class="form-group required">
                                    <img src="{{ asset('dist/images/show.png') }}" class="show" id="togglePassword" onclick="myFunction()">
                                    <img src="{{ asset('dist/images/hide.png') }}" class="hide" id="togglePassword" onclick="myFunction()" style="display:none;">
                                </div>
                            </div>
                            <div class="form-group error" style="display: none;color: red;margin-top: -18px">
                                Incorrect Email or Password.
                            </div>
                            <div class="form-group" id="reg-msg" style="display: none;color: green;margin-top: -18px">
                                Please check your email for you credentials
                            </div>
                            <div class="form-footer">
                                <div class="forgtpassrd text-right text-dark"><a id="forgotclick" type="button">Forgot Password?</a></div>
                                <div class="formbtnsec">
                                    <a class="btn btn-primary loginbtn" type="button">Log in</a>
                                    <span>OR</span>
                                    <a class="btn btn-primary singbtn">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!---/Login Modal-->
