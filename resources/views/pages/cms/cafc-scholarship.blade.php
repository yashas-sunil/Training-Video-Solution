<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/new_ui_assets/css/stye.css')}}">
    <link rel="stylesheet" href="{{asset('assets/new_ui_assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/new_ui_assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <title>JKSC Online - Thane Vaibhav CAFC Scholarship Program</title>
    <style>
        .error{
            width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #dc3545;
        }
        .verify_otp{
    
   bottom: 20px;
    right: 20px;
    border: 0;
    background: #e78c60;
    border-radius: 30px;
    font-weight: bold;
    font-size: 15px;
    color: #ffffff;
    padding: 10px 25.5px;
}
    </style>
</head>

<body class="thane">
    <nav class="container-fluid bg-white">
        <img class="logo border-right pr-2" src="{{ asset('assets/new_ui_assets/images/thane/thane_vaibhav.jpg') }}" alt="">
        <a class="navbar-brand" href="/">
        <img class="logo" src="{{ asset('assets/new_ui_assets/images/logo.png') }}" alt="">
     </a>
    </nav>
    <div class="container-fluid py-3 overflow-hidden">
        <h1 class="text-center thane_title">J. K. Shah Online & Thane Vaibhav - CAFC Scholarship Program</h1>
        <h6 class="text-center thane_info"><span>On the occasion of the 47th Thane Vaibhav Divas</span>, J. K. Shah Sir (Founder of J. K. Shah Classes) met with the Chief Minister of the State of Maharashtra, Eknath Shinde Ji</h6>
        <div class="row py-4 bg-white">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="cms_image">
                    <img src="{{asset('assets/new_ui_assets/images/thane/thane_1.jpg')}}" loading="lazy" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="cms_image">
                    <img src="{{asset('assets/new_ui_assets/images/thane/thane_2.jpg')}}" loading="lazy" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="cms_image">
                    <img src="{{asset('assets/new_ui_assets/images/thane/thane_3.jpg')}}" loading="lazy" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="cms_image">
                    <img src="{{asset('assets/new_ui_assets/images/thane/thane_4.jpg')}}" loading="lazy" alt="">
                </div>
            </div>
        </div>

        <div class="container p-3 border-bottom registration">
            <h4 class="text-center mb-3">Registration Closed</h4>
           
        </div>
       
            <div class="timelines">
                        <div class="notes">
                            <h5>Note</h5>
                            <p>Registered Students Shall Be Informed Regarding Selection Process & Other Formalities By SMS / Email, From Time-To-Time. Student Will Have To Pay Nominal Fees Before Commencement Of The Batch. Registration is open till 30<sup>th</sup> November 2022.</p>
                            <p>Please note that the applicant must have an annual family income of Rs. 6 lakhs or lower to be eligible for the scholarship program</p>
                        </div>
            </div>
   
    </div>
    <div class="modal fade" id="otp-verify-modal" tabindex="-1" role="dialog" aria-modal="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="row p-0">
                    <div class="col-12">
                        <div class="signup-details">
                            <div class="s-content">
                                <form id="verify-mobile-otp"  method="POST" >
                                    @csrf
                                    <div id="step-attempt-year">
                                        <div class="form-group">
                                            <label>Please enter the Mobile Otp *</label>
                                            <input type="text" class="form-control"  placeholder="OTP" maxlength="4" required="required" id="otp_verify" name="otp_verify" value="{{ old('otp_verify') }}">
                                            <input id="student_id" name="student_id" type="hidden" />
                                            <span style="color: red;font-size: 10px;" id="invalid-otp"></span>
                                            <span style="color: green;font-size: 10px;" id="valid-otp"></span>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button type="button" class="verify_otp" id="verify-otp">Verify</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/new_ui_assets/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
</body>


  
</html>