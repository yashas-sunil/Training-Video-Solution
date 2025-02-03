<div class="modal fade" id="modal-otpcontactus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-otpcontactus-title"
     aria-hidden="true">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-secondary text-uppercase" id="modal-otpcontactus-title">Verify</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <span>Please enter verification code just sent to your number.</span><br />
                    <span id="otpcontactus_mobile"></span>
                </p>
                <form id="form-otpcontactus" method="POST" action="{{ url('/login') }}">
                    <input id="otpcontactus_mobile" name="otpcontactus_mobile" type="hidden">
                   
                    <input id="otpcontactus_token" name="otpcontactus_token" type="hidden">
                    @csrf
                    <div class="form-group">
                        <input placeholder="Verification Code" type="text" class="form-control" id="otpcontactus_code" name="otpcontactus_code">
                    </div>
                    <div class="form-group clearfix text-center pb-4">
                        <span id="resendcontactus_text">Didn't get? <a id="resendcontactus" class="ml-md-auto" href="#">Resend</a></span><span style="display: none" id="timer">30</span>
                    </div>
                    <span style="color: red;font-size: 10px;" id="contactus-invalid-otp"></span>
                    <span style="color: green;font-size: 20px;" id="contactus-valid-otp"></span>
                    <div class="form-group mt-4">
                        <!--<button type="button" class="btn btn-block btn-primary">Login</button>-->
                        <button id="btn-otpcontactus-verify" type="submit" class="btn btn-block btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('script')
<script id="script-modal-otpcontactus">
    $(function () {
        "use strict";
        var timer;

        let $modal = $('#modal-otpcontactus');

        let pad = function (value) {
            return (value < 10 ? '0' : '') + value;
        };

        let startTimer = function () {
            stopTimer();

            $('#resendcontactus_text').hide();

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
            $('#resendcontactus_text').show();
            $('#timer').hide();
        };

        let sendOTP = function () {
            startTimer();
 
            //var url = '{{ env('API_URL').'/otp/send' }}';
            var url="{{ url('send-otp') }}";
            var phone = $modal.find('#otpcontactus_mobile').val();
            var email = $('#contact_form').find('#contactusemail').val();
            var name = $('#contact_form').find('#name').val();
            // var email = $modal.find('#signupemail').val();
            var otpcontactus_token = $modal.find('#otpcontactus_token').val();
 
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'POST',
                data: { mobile: phone, action: 'contactform', token: otpcontactus_token ,name:name,email:email}
                /*,
                 global: false */ // set false to disable global event handler
            }).done(function (response, textStatus, jqXHR) {
              
                $modal.find('#otpcontactus_token').val(response.data);
            }).fail(function (jqXHR, textStatus, errorThrown) {
               
            }).always(function () {
                //  ladda.stop();
            });
        };

        $modal.on('shown.bs.modal', function () {
            sendOTP();
        });

        $("#resendcontactus").click(function (e) {
            sendOTP();
        });

        $('#form-otpcontactus').validate({
            rules: {
                otpcontactus_code: {
                    required: true,
                    number: true
                }
            }
        });

        $('#btn-otpcontactus-verify').click(function (e) {
            e.preventDefault();

            if (!$('#form-otpcontactus').valid()) {
                return;
            }
            contactusotpverify();
            // $modal.modal('hide');
        });

    })
</script>
@endpush
