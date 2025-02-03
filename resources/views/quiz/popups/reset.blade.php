<!---Reset Modal-->
<div class="modal fade" id="resetmodal" tabindex="-1" role="dialog" aria-labelledby="resetpasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="token" id="reset-token" value="{{ Session::get('token') }}">
            <input type="hidden" name="reset-email" id="reset-email" value="{{ Session::get('email') }}">
            <div class="modal-body login-popbody" style="background-image: url(dist/images/login-bg.png);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="loginform">
                    <h2>Reset Password</h2>
                    <div class="loginforminner">
                        <form id="reset_form" class="popup-form">
                            <div class="form-group head r_password">
                                <i class="fas fa-user"></i><input name="r_password" id="r_password" type="password" class="form-group required">
                                <img src="{{ asset('dist/images/show.png') }}" class="r_show" id="r_togglePassword" onclick="myFunctionR()">
                                <img src="{{ asset('dist/images/hide.png') }}" class="r_hide" id="r_togglePassword" onclick="myFunctionR()" style="display:none;">

                            </div>
                            <div class="form-group head rc_password">
                                <i class="fas fa-key"></i><input name="rc_password" id="rc_password" type="password" class="form-group required">
                                <img src="{{ asset('dist/images/show.png') }}" class="rc_show" id="rc_togglePassword" onclick="myFunctionRC()">
                                <img src="{{ asset('dist/images/hide.png') }}" class="rc_hide" id="rc_togglePassword" onclick="myFunctionRC()" style="display:none;">
                            </div>
                            <div class="form-group r_error" style="display: none;color: red;margin-top: -18px">
                                Incorrect Password.
                            </div>
                            <div class="form-footer">
                                <div class="formbtnsec">
                                    <button class="btn btn-primary resetbtn" type="button">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!---/Reset Modal-->
