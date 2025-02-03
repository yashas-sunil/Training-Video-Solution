@extends('layouts.master')

@section('title', 'About Us')

@push('style')
<style>
    .the_wheel1 > canvas
    {
        background-image: url(./assets/images/wheel_back.png);
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
</style>
@endpush

@section('content')
    <main class="contact-us" role="main">

        <div class="container-fluid pt-4 px-lg-5 " style="position: relative" >
            <div style="background-image: url(https://i.ytimg.com/vi/v2iWow1QFtk/maxresdefault.jpg); background-size: cover; position:absolute;top: 0; left: 0; right: 0; bottom: 0; opacity: .2"></div>
            <h1 class="text-primary text-center blink_me"><b>Spin Your Wheel. Get Rewards</b></h1>
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
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <div class="card">
                            <img src="https://u01.appmifile.com/images/2019/09/10/2a26f644-df53-4b88-a083-14c7a7900ed2.jpg" class="card-img-top" alt="...">

                            <div class="card-body">

                                <form>
                                    <h3 class="text-secondary pb-3">Register & Try Your Luck</h3>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="phone" class="form-control" id="phone" aria-describedby="phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="name" class="form-control" id="name">
                                    </div>
                                    <div id="otp-div"  class="mb-3">
                                        <label for="name" class="form-label">OTP</label>
                                        <input type="name" class="form-control" id="name">
                                    </div>
                                    <button id="register" type="submit" class="btn btn-secondary">Register</button>
                                </form>

                                <h5 class="card-title pt-3">You have two chances</h5>
                                <p class="card-text">Click spin button to try your luck, all the best!</p>
                                <button type="submit" name="spin" id="spin" class="btn btn-block btn-secondary" >SPIN</button>
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
                       <h3 class="text-primary">You have won 10 points.</h3>
                       <h1 class="text-light blink_me">Congratulations</h1>
                   </div>
                    <p class="text-light"><a class="btn btn-primary" href="#">Signup</a></p>
                    <p class="text-light">Already have an account? <a href="#">Login</a> to redeem your points. </p>
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


    let audio = new Audio('assets/tick.mp3');  // Create audio object and load tick.mp3 file.

    function playSound()
    {
        // Stop and rewind the sound if it already happens to be playing.
        audio.pause();
        audio.currentTime = 0;

        // Play the sound.
        audio.play();
    }


    function alertPrize(indicatedSegment)
    {

        alert(indicatedSegment.text);
        // call ajax and insert prize. return next chance true or false

        // true   resetWheel();
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
        $(':input[name="spin"]').prop('disabled', false);
    }

    // Create new wheel object specifying the parameters at creation time.
    let theWheel = new Winwheel({
//        'responsive':true,
        'numSegments'  : 8,     // Specify number of segments.
        'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
        'textFontSize' : 28,    // Set font size as desired.
        'segments'     :        // Define segments including colour and text.
                [
                    {'fillStyle' : '#571845', 'text' : 'Prize 1'},
                    {'fillStyle' : '#90213F', 'text' : 'Prize 2'},
                    {'fillStyle' : '#C82F3A', 'text' : 'Prize 3'},
                    {'fillStyle' : '#EE5535', 'text' : 'Prize 4'},
                    {'fillStyle' : '#F8C346', 'text' : 'Prize 5'},
                    {'fillStyle' : '#571845', 'text' : 'Prize 6'},
                    {'fillStyle' : '#90213F', 'text' : 'Prize 7'},
                    {'fillStyle' : '#C82F3A', 'text' : 'Prize 8'}
                ],
        'animation' :           // Specify the animation to use.
        {
            'type'     : 'spinToStop',
            'duration' : 15,
            'spins'    : 8,
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
        $(':input[name="spin"]').prop('disabled', true);
        $.ajax({
            url: 'spinners/calculate-price',
            data: {
                campign_id: 1,
                Status: 2
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

//    $('#resultModal').on('hidden.bs.modal', function () {
//        resetWheel();
//    });
</script>


@endpush
