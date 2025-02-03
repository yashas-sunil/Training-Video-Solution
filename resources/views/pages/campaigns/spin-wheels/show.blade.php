@extends('layouts.master')

@section('title', 'Get lucky with JK Shah’s Spin & Win')

@push('style')
    <style>
        .the_wheel1 > canvas
        {
            background-image: url('{{ asset('assets/images/wheel_back.png') }}');
            background-position: center;
            background-repeat: no-repeat;
            /*padding-top: 10rem !important;*/
        }

        .blink_me {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
        .gradient{
            background: rgb(57,168,239);
            background: linear-gradient(90deg, rgba(57,168,239,1) 0%, rgba(60,148,246,1) 41%, rgba(58,122,246,1) 57%, rgba(49,114,246,1) 96%);
        }
    </style>
@endpush

@section('content')
    <main class="contact-us" role="main">

        <div class="container-fluid pt-4 px-lg-5  " style="position: relative" >
            <div class="gradient" style="background-image: url({{ asset('assets/images/blue-bg.jpg')  }}); background-size: cover; position:absolute;top: 0; left: 0; right: 0; bottom: 0; "></div>
            <h1 class="text-primary text-center blink_me"><b>Get lucky with JK Shah’s Spin & Win</b></h1>
            <div class="mt-3">
                <div class="row ">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-center  align-items-center the_wheel1">
                            <canvas id="canvas" width="438" height="582"
                                    data-responsiveMinWidth="180"
                                    data-responsiveScaleHeight="true"
                                    data-responsiveMargin="50">
                                <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                            </canvas>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center mb-5">
                        <div class="card">
                            <img src="{{ asset('assets/images/new-year-win-wheel.jpeg')  }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                @if (! request()->session()->has('access_token') && ! request()->session()->has('campaign_registration_id'))
                                    <form id="form-campaign-register" method="POST" action="{{ url('campaign-registrations') }}">
                                        @csrf
                                        <input id="otp_token" name="otp_token" type="hidden">
                                        <input id="campaign_id" name="campaign_id" type="hidden" value="{{ $spinWheel['id'] }}">
                                        <h3 class="text-secondary mb-3">Register & Try Your Luck</h3>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label>Phone</label>
                                                <select id="phone-code" class="form-control bg-white" name="phone_code">
                                                    <option selected value="+91">+91</option>
                                                    <option value="+971">+971</option>
                                                </select>
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                <label for="phone" class="form-label"></label>
                                                <input class="form-control" id="phone" name="phone" type="text" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" autocomplete="off">
                                        </div>
                                        <div class="mb-3 div-otp d-none">
                                            <label for="otp" class="form-label">OTP</label>
                                            <input class="form-control" id="otp_code" name="otp_code" type="text" autocomplete="off">
                                            <small class="d-none small-invalid-otp" style="color: #dc3545;">Verification code is invalid or expired</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 mb-2">
                                                <button class="btn btn-secondary">Register</button>
                                            </div>
                                            <div class="col-md-5 ml-2 mb-2 resend-otp-container"></div>
                                        </div>
                                    </form>
                                    <div class="mt-2">Already have an account? <a href="#" id="already-account-login">Login</a></div>
                                @endif
                                @if (request()->session()->has('access_token') || request()->session()->has('campaign_registration_id'))
{{--                                    <h5 class="card-title pt-3">You have {{ $spinWheel['no_of_chances'] }} chances</h5>--}}
                                    <p class="card-text">Click spin button to try your luck, all the best!</p>
                                    <button type="submit" name="spin" id="spin" class="btn btn-block btn-secondary" >SPIN</button>
                                @endif
                            </div>
                        </div>
                        {{--<div class="bg-primary p-4 shadow text-light rounded">
                            <h3> You have 2 chances</h3>
                            <button class="btn btn-secondary btn-lg" onClick="startSpin();">SPIN</button>
                        </div>--}}
                        {{-- <img id="spin_button" src="spin_off.png" alt="Spin" onClick="startSpin();" />
                         <br /><br />
                         &nbsp;&nbsp;<a href="#" onClick="resetWheel(); return false;">Play Again</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(reset)--}}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-secondary" style="position: relative;">
                <div class="modal-body text-center" >
                    <div class="p-5">
                        <h3 class="text-light blink_me modal-head"></h3>
                    </div>
                    <p style="display: none" class="text-light modal-signup">
                        <a data-toggle="modal" data-target="#modal-signup"  class="btn btn-primary" href="#" id="result-modal-button-sign-up">Signup</a>
                    </p>
                    <p style="display: none" class="text-light modal-home">
                        <a class="btn btn-primary" href="{{ url('/') }}" id="result-modal-button-sign-up">Home</a>
                    </p>
                    <p style="display: none" class="text-light modal-redeem">
                        <a class="btn btn-primary" href="{{ url('/') }}">Redeem</a>
{{--                        <a data-toggle="modal" data-target="#modal-signup"  class="btn btn-primary" href="#" id="result-modal-button-sign-up">Redeem</a>--}}
                    </p>
                    <p style="display: none" class="text-light modal-message-1"></p>
                    <p style="display: none" class="text-light modal-message-2"></p>
                    {{--<p class="text-light">Already have an account? <a href="#" id="result-modal-button-login">Login</a> to redeem your points. </p>--}}
                </div>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endsection
@push('script')

    <script>
        let responseSegments = @json($spinWheel['spin_wheel_segments']);

        console.log(responseSegments);

        segments = [];

        responseSegments.forEach(function (segment) {
            segments.push({ 'fillStyle': '#' + segment.color_code, 'text': segment.title, 'point': segment.point, 'segment_value':segment.value, 'segment_value_type':segment.value_type,'segment_id':segment.id })
        });

        $.ajax({
            url: '{{ url('campaigns/remaining-chances') }}',
            data: {
                campaign_registration_id: '{{ session()->get('campaign_registration_id') }}',
                campaign_id: '{{ $spinWheel['id'] }}'
            }
        }).done(function(response) {
            let remainingChances = parseInt(response);

            if (remainingChances <= 0) {
                $('#spin').attr('disabled', 'disabled');
            }
        });

        let audio = new Audio('{{ asset('assets/tick.mp3') }}');  // Create audio object and load tick.mp3 file.

        function playSound()
        {
            // Stop and rewind the sound if it already happens to be playing.
            audio.pause();
            audio.currentTime = 0;

            // Play the sound.
            audio.play();
        }

        let isChancesLeft = true;


        function alertPrize(indicatedSegment)
        {
console.log(indicatedSegment);


            // alert(indicatedSegment.text);
            // call ajax and insert prize. return next chance true or false
            // resetWheel();

            $.ajax({
                url: '{{ url('temp-campaigns-points') }}',
                type: 'POST',
                data: {
                    campaign_registration_id: '{{ session()->get('campaign_registration_id') }}',
//                    campaign_registration_id: 10,
                    campaign_id: '{{ $spinWheel['id'] }}',
                    segment_value: indicatedSegment.segment_value,
                    segment_value_type: indicatedSegment.segment_value_type,
                    expire_at: '{{ $spinWheel['point_validity'] }}',
                },
                async: false
            }).done(function(response) {
                let noOfChances = '{{ $spinWheel['no_of_chances'] }}';
                noOfChances = parseInt(noOfChances);
                let totalChances = parseInt(response);
                if (totalChances >= noOfChances) {
                    isChancesLeft = false;
                    $('#spin').attr('disabled', 'disabled');
                }
            });

            $('.modal-signup').hide();
            $('.modal-home').hide();
            $('.modal-head').hide();
            $('.modal-message-1').hide();
            $('.modal-message-2').hide();
            $('.modal-redeem').hide();

            // Registered Only
            @if (!request()->session()->has('access_token') && request()->session()->has('campaign_registration_id'))

            if(indicatedSegment.segment_value_type == 4){

                $('.modal-signup').show();

                $('.modal-head').text('More contests in the near future. Stay tuned!').show();

                $('.modal-message-1').text('Join JK Shah Online to learn from anywhere, anytime!').show();

            }else{
                $('.modal-signup').show();

                if (indicatedSegment.segment_value_type == 1) {
                    $('.modal-head').text('Congratulations! You have won '+indicatedSegment.segment_value+' points.').show();
                }

                if(indicatedSegment.segment_value_type == 2) {
                    $('.modal-head').text('Congratulations! You have won '+indicatedSegment.segment_value+'% discount.').show();
                }

                if(indicatedSegment.segment_value_type == 3) {
                    $('.modal-head').text('Congratulations! You have won Buy 1 Get 1 Offer.').show();
                }

                if(indicatedSegment.segment_value_type == 5) {
                    $('.modal-head').text('Congratulations! You have won 1 chapter free offer.').show();
                }

                if(indicatedSegment.segment_value_type == 6) {
                    $('.modal-head').text('Congratulations! You have won 3 chapters free offer.').show();
                }

                $('.modal-message-1').text('Purchase a package and redeem your reward while checking out.').show();
                $('.modal-message-2').text('You will see the reward in the JMoney in your dashboard and will be able to use it while checking out.').show();
            }

            @endif


            // Signup Completed.
            @if (request()->session()->has('access_token') )

                if(indicatedSegment.segment_value_type == 4){
                    $('.modal-home').show();

                    $('.modal-head').text('More contests in the near future. Stay tuned!').show();

                    $('.modal-message-1').text('Join JK Shah Online to learn from anywhere, anytime!').show();

                }else{

                $('.modal-redeem').show();

                if (indicatedSegment.segment_value_type == 1) {
                    $('.modal-head').text('Congratulations! You have won '+indicatedSegment.segment_value+' points.').show();
                }

                if(indicatedSegment.segment_value_type == 2) {
                    $('.modal-head').text('Congratulations! You have won '+indicatedSegment.segment_value+'% discount.').show();
                }

                if(indicatedSegment.segment_value_type == 3) {
                    $('.modal-head').text('Congratulations! You have won Buy 1 Get 1 Offer.').show();
                }

                if(indicatedSegment.segment_value_type == 5) {
                    $('.modal-head').text('Congratulations! You have won 1 chapter free offer.').show();
                }

                if(indicatedSegment.segment_value_type == 6) {
                    $('.modal-head').text('Congratulations! You have won 3 chapters free offer.').show();
                }

                $('.modal-message-1').text('Purchase a package and redeem your reward while checking out.').show();
                $('.modal-message-2').text('You will see the reward in the JMoney in your dashboard and will be able to use it while checking out.').show();
            }


            @endif

            // if(indicatedSegment.point == 0){
            //
            //     $('.message-1').text('Join JK Shah Online to learn from anywhere, anytime!');
            //     $('.message-2').text('');
            //
            // }else{
            //     $('.model-text').text('Congratulations! You have won '+indicatedSegment.value+' points.').show();
            // }

            $('#resultModal').modal('show');
        }

        let wheelPower    = 0;
        let wheelSpinning = false;


        function powerSelected(powerLevel)
        {
            // Ensure that power can't be changed while wheel is spinning.
            if (wheelSpinning == false) {
                // Reset all to grey incase this is not the first time the user has selected the power.
                document.getElementById('pw1').className = "";
                document.getElementById('pw2').className = "";
                document.getElementById('pw3').className = "";

                // Now light up all cells below-and-including the one selected by changing the class.
                if (powerLevel >= 1) {
                    document.getElementById('pw1').className = "pw1";
                }

                if (powerLevel >= 2) {
                    document.getElementById('pw2').className = "pw2";
                }

                if (powerLevel >= 3) {
                    document.getElementById('pw3').className = "pw3";
                }

                // Set wheelPower var used when spin button is clicked.
                wheelPower = powerLevel;

                // Light up the spin button by changing it's source image and adding a clickable class to it.
                document.getElementById('spin_button').src = "spin_on.png";
                document.getElementById('spin_button').className = "clickable";
            }
        }


        function startSpin()
        {
//        $('#resultModal').modal('show');
//        return;
//        $('#exampleModal').modal('show');
            // Ensure that spinning can't be clicked again while already running.
            if (wheelSpinning == false) {
                // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                // to rotate with the duration of the animation the quicker the wheel spins.
                if (wheelPower == 1) {
                    theWheel.animation.spins = 3;
                } else if (wheelPower == 2) {
                    theWheel.animation.spins = 8;
                } else if (wheelPower == 3) {
                    theWheel.animation.spins = 15;
                }

                // Disable the spin button so can't click again while wheel is spinning.
//            document.getElementById('spin_button').src       = "spin_off.png";
//            document.getElementById('spin_button').className = "";

                // Begin the spin animation by calling startAnimation on the wheel object.
                theWheel.startAnimation();

                // Set to true so that power can't be changed and spin button re-enabled during
                // the current animation. The user will have to reset before spinning again.
                wheelSpinning = true;
            }
        }

        // -------------------------------------------------------
        // Function for reset button.
        // -------------------------------------------------------
        function resetWheel()
        {
            theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheel.draw();                // Call draw to render changes to the wheel.

            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.

            if (isChancesLeft) {
                $(':input[name="spin"]').prop('disabled', false);
            }
        }

        // Create new wheel object specifying the parameters at creation time.
        let theWheel = new Winwheel({
//        'responsive':true,
            'numSegments'  : segments.length,     // Specify number of segments.
            'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
            'textFontSize' : 15,    // Set font size as desired.
            'segments'     : segments,
            'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 5,
                    'spins'    : 5,
                    'callbackFinished' : alertPrize,
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin',        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
            'pins' :
                {
                    'outerRadius' : 5,
                    'fillStyle'   : '#ffffff',
                    'strokeStyle' : '#aaaaaa',
                    'number' : 16   // Number of pins. They space evenly around the wheel.
                }
        });


        $('#spin').on('click', function () {
            $('#spin').prop('disabled', true);
            // $(':input[name="spin"]').prop('disabled', true);
            $.ajax({
                url: '{{ url('campaigns/spin-wheels/calculate-price') }}',
                data: {
                    campaign_id: '{{ $spinWheel['id'] }}'
                },
                'success' : function(data) {
                    let segmentNumber =data;   // The segment number should be in response.

                    if (segmentNumber) {
                        // Get random angle inside specified segment of the wheel.
                        let stopAt = theWheel.getRandomForSegment(segmentNumber);

                        // Important thing is to set the stopAngle of the animation before stating the spin.
                        theWheel.animation.stopAngle = stopAt;

                        // Start the spin animation here.
                        theWheel.startAnimation();
                    }
                },
                dataType : 'json'
            });
            // startSpin();
        });

        $('#resultModal').on('hidden.bs.modal', function () {
            resetWheel();
        });

        $(function() {
            let campaignRegisterForm = $('#form-campaign-register');

            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Please enter a valid name");

            campaignRegisterForm.validate({
                rules: {
                    phone: {
                        required: true,
                        number: true,
                        maxlength: function() {
                            if ($('#phone-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#phone-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        remote: {
                            url: '{{ url('campaigns/validate-phone') }}',
                            type: 'POST',
                            data: {
                                phone: function() {
                                    return campaignRegisterForm.find('#phone').val()
                                },
                                campaign_id: function() {
                                    return '{{ $spinWheel['id'] }}'
                                }
                            }
                        }
                    },
                    name: {
                        required: true,
                        lettersonly: true
                    },
                    otp_code: {
                        required: true,
                        number: true,
                        maxlength: 4,
                        minlength: 4
                    },
                },
                messages: {
                    phone: {
                        remote: 'Phone number already exist, please login and try again'
                    }
                }
            });

            let isOTPSend = false;
            let isOTPVerified = false;

            campaignRegisterForm.on('submit', function(e) {
                e.preventDefault();

                if ($('#phone').valid() && $('#name').valid()) {
                    if (! isOTPSend) {
                        sendOTP();
                        isOTPSend = true;
                    }
                }

                if ($('#phone').valid() && $('#name').valid() && $('#otp_code').val() && $('#otp_code').valid()) {
                    if (! isOTPVerified) {
                        $.ajax({
                            url: '{{ url('campaigns/validate-otp') }}',
                            type: 'POST',
                            data: {
                                otp_code: $('#otp_code').val(),
                                otp_token: $('#otp_token').val()
                            },
                            async: false
                        }).done(function(response) {
                            if (response.toString() === 'true') {
                                isOTPVerified = true;
                            } else {
                                isOTPVerified = false;
                                $('.small-invalid-otp').removeClass('d-none');
                            }
                        });
                    }
                }

                if (isOTPVerified) {
                    $(this)[0].submit();
                }
            });

            let sendOTP = function () {
                let url = '{{ env('API_URL') . '/otp/send' }}';
                let phone = campaignRegisterForm.find('#phone').val();

                $.ajax({
                    url: url,
                    beforeSend: function(request) {
                        request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                    },
                    type: 'POST',
                    data: { mobile: phone, action: 'campaign'}
                }).done(function (response) {
                    campaignRegisterForm.find('.div-otp').removeClass('d-none');
                    campaignRegisterForm.find('#otp_token').val(response.data);
                    $('.resend-otp-container').html('<button type="button" class="btn btn-primary" id="button-resend-otp" disabled>Re-Send OTP</button>');
                    setTimeout(function() {
                        $('#button-resend-otp').removeAttr('disabled');
                    }, 15000);
                });
            };

            $(document).on('click', '#button-resend-otp', function() {
                sendOTP();
                // $('#button-resend-otp').attr('disabled', 'disabled');
            });

            @if (session()->has('otp_error'))
                alert('{{ session()->get('otp_error') }}');
            @endif

            $('#result-modal-button-sign-up').click(function() {
                $('#resultModal').modal('toggle');
                $('#modal-signup').modal('toggle');
            });

            $('#result-modal-button-login').click(function() {
                $('#resultModal').modal('toggle');
                $('#modal-login').modal('toggle');
            });

            $('#already-account-login').click(function() {
                $('#modal-login').modal('toggle');
            });
        });
    </script>
@endpush
