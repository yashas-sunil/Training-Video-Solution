<!---Forgot Modal-->
<div class="modal fade" id="forgotmodel" tabindex="-1" role="dialog" aria-labelledby="forgotmodellabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body login-popbody" style="background-image: url({{ asset('dist/images/login-bg.png') }});">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="loginform">
                    <h2>Reset Password</h2>
                    <div class="loginforminner">
                        <form id="forgot_form" class="popup-form">
                            <div class="form-group form-row">
                                <div class="col-sm-1">
                                <i class="fas fa-user"></i>
                                </div>
                                <div class="col-sm-9">
                                <input name="f_email" id="f_email" type="email" class="form-group required" placeholder="E-Mail Address">
                                </div>
                            </div>
                            <div class="form-group f_error" style="display: none;color: red;margin-top: -18px">
                                Email does not exists.
                            </div>
                            <div class="form-footer">
                                <!-- <div class="forgtpassrd text-right text-dark"><a href="#;">Forgot Password?</a></div> -->
                                <div class="formbtnsec">
                                    <button class="btn btn-primary forgotbtn" type="button">Send Password Reset Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!---/Forgot Modal-->
