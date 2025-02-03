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


@push('script')
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
                beforeSend: function(request) {
                    request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                },
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
