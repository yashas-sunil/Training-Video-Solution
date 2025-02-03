@extends('layouts.master')
@section('content')
<style>
    .demo-info {
        background: #3c3881;
        padding: 1% 0 !important;
    }
    .btn1{
        float: left;
    padding: 0.375rem 0.75rem !important;
    font-size: 1rem !important;
    min-width: auto !important;
    line-height: 1.5 !important;
    border-radius: 0.25rem !important;
    margin-left: 5px !important;
    background: #28a745 !important;
    }
</style>

<div class="main">
    <div class="demo-info">
        <h1>Contact Us</h1>
    </div>

    <div class="contact-details">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12"> 
            <div class="c-form">
                    <h1>Send Us Your Queries</h1>
                    <form name="contact-form" id="contact_form" method="POST" action="{{url('enquiries')}}">
                        @csrf
                        <input type="hidden" name="form" value="contactform">
                        <input type="hidden" name="otpcontactus_token" id="otpcontactus_token">
                        <input type="hidden" name="otpcontactus_code" id="otpcontactus_code">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                        @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error') !!}</li>
                            </ul>
                        </div>
                        @endif


                        @if (session()->has('successtest'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            We will contact you soon.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Name*</label>
                            <input placeholder="Full Name" name="name" type="text" value="{{old('name')}}" id="name" aria-describedby="name_help">
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('name') }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email Id*</label>
                            <input type="email" placeholder="Email Id" name="email" value="{{old('email')}}" id="contactusemail">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('email') }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mobile No*</label>
                            <input type="tel" placeholder="Mobile No" name="mobile" value="{{old('mobile')}}" id="mobile">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('mobile') }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Query*</label>
                            <textarea name="comment" id="comment" cols="8" class="form-control">{{old('comment')}}</textarea>
                            @error('comment')
                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('comment') }}</span>
                            @enderror
                        </div>
                        <!-- <div class="form-group {{ $errors->has('captcha_contact') ? ' has-error' : '' }}">
                            <label for="captcha_contact" class="control-label">Captcha(Kindly enter the sum)</label>
                            
                                <div class="captcha_contact">
                                <span style="float:left"></span>
                                <button type="button" class="btn1" style="float:left"><i class="fa fa-refresh"></i></button>
                                    
                                    
                                </div>

                                <input id="captcha_contact" type="text" class="form-control" placeholder="Please enter the sum" name="captcha_contact">

                                <span class="help-block" style="color: red;font-size: 10px;" id="captcha_contact_error">

                                </span>
                            </div>
                         -->
                         <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{env('SITE_KEY')}}" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired"></div>
                            <input id="hidden-grecaptcha" name="hidden-grecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/>
                        </div>
                        <button id="btn-contact-us" type="button" class="btn">Submit</button>
                    </form>
                </div>
                <div class="c-info">
                    <div class="info-box">
                        <h2>Contact Info</h2>
                    <h6>For any queries you can contact us on</h6>
                        <ul>
                            <li>
                                <img src="{{asset('assets/new_ui_assets/images/contact-us-icons/call-icon.png')}}" alt="img">
                                <a href="tel:+918070400900">8070 400 900</a>
                            </li>
                            <li>
                                <img src="{{asset('assets/new_ui_assets/images/contact-us-icons/whatsapp-icon.png')}}" alt="img">
                                <a href="https://wa.me/+919757001272" target="_blank">9757 00 1272</a>
                            </li>
                            <li>
                                <img src="{{asset('assets/new_ui_assets/images/contact-us-icons/email-icon.png')}}" alt="img">
                                <p>helpdesk@jkshahclasses.com</p>
                            </li>
                            <li>
                                <img src="{{asset('assets/new_ui_assets/images/contact-us-icons/location-icon.png')}}" alt="img">
                                <p>Shraddha, 4th Floor, Near Chinai College, Old Nagardas Road, Andheri East, Mumbai - 400 069</p>
                            </li>
                        </ul>
                        <a class="map" href="https://goo.gl/maps/dwhDCNpUsatuskJG6" target="_blank">See on Google Maps</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-12 col-sm-12">
                <div class="c-line"></div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                

                <div class="qrcode">
                    <h6 class="mt-4 qr_info">Use QR Code For Making Payments and Please Share Your Payment Details on below given Whatsapp Number.</h6>
                    <img class="qr_code" src="{{asset('assets/new_ui_assets/images/new-qr-code.png')}}" loading="lazy" alt="">
                </div>
                <div class="bank_d_main">
                    <div class="bank-detail">
                        <h2>Bank Details</h2>
                        <ul>
                            <li><span>Account Name </span> - J. K. Shah Classes</li>
                            <li><span>Bank Name </span> - Saraswat Bank</li>
                            <li><span>Account Number </span> - 019102100980299</li>
                            <li><span>IFSC Code</span> - SRCB0000019</li>
                            <li><span>Branch</span> - Andheri East</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function recaptchaCallback() {
	var response = grecaptcha.getResponse();
		$button = jQuery(".button-register");
	jQuery("#hidden-grecaptcha").val(response);
	//console.log(jQuery("#registerForm").valid());
	// if (jQuery("#contact_form").valid()) {
	// 	$button.attr("disabled", false);
	// }
	// else {
	// 	$button.attr("disabled", "disabled");
	// }
}
function recaptchaExpired() {
	var $button = jQuery(".button-register");
	jQuery("#hidden-grecaptcha").val("");
	var $button = jQuery(".button-register");
	// if (jQuery("#contact_form").valid()) {
	// 	$button.attr("disabled", false);
	// }
	// else {
	// 	$button.attr("disabled", "disabled");
	// }
}
    var map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8
        });
    }

    $(document).ready(function() {
       // captchacontact();

        //         $('#btn-contact-us').click(function () {
        //             let name = $('#name').val();
        //             let email = $('#email').val();
        //             let mobile = $('#mobile').val();
        //             let comment = $('#comment').val();

        //             $.ajax({
        //                 type:'POST',
        //                 url:'{{ route('save-for-later.store') }}',
        //                 data: {
        //                     '_token': '{{ csrf_token() }}',
        //                     'name': name,
        //                     'email': email,
        //                     'mobile': mobile,
        //                     'comment': comment,
        //                 },
        //                 success:function() {
        // //alert('success');
        //                    // $('#toast-contact-us').toast('show');
        //                 }
        //             });
        //         });
    });
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Letters only please");
    $('#contact_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 191,
                lettersonly: true
            },
            mobile: {
                required: true,
                number: true,
                maxlength: 10,
                minlength: 10
            },
            email: {
                required: true,
            },
            comment: {
                required: true,
                maxlength: 800,
            },
            "hidden-grecaptcha": {
              required: true,
              minlength: "255", 
              remote: {
                            url: '{{ url('/validate-captcha') }}',
                            type: 'POST',
                            data: {
                              captchaa: function () {
                              //  alert();
                               return $('#g-recaptcha-response').val()
                                },
                                _token: '{{ csrf_token() }}',
                            }
                    }
            }
            // captcha_contact: {
            //     required: true,
            //     remote: {
            //         type: 'POST',
            //         async: false,
            //         dataType: 'json',
            //         url: '{{ route('captchacontactcheck') }}',

            //     }
            // },
        },
        messages: {
            // captcha_contact: {
            //     required: 'Captcha is required',
            //     remote: 'Captcha is invalid',

            // },
        }
    });

    $(".btn1").click(function() {
        $.ajax({
            type: 'GET',
            url: '/refresh_captcha',
            success: function(data) {
                $(".captcha_contact span").html(data.captcha);
                $('#captcha_contact').val('');
                $('#captcha_contact').removeClass('is-valid');
                $('#captcha_contact').removeClass('is-invalid');
            }
        });
    });
    // $('#contact_form').on('submit', function(e) {
    //     let isValid = $(this).valid();
    //     if (isValid) {
    //         e.preventDefault();
    //         $('#btn-contact-us').prop('disabled', true);
    //         $.ajax({
    //             type: 'POST',
    //             url: $(this).attr('action'),
    //             data: $(this).serialize(),
    //             success: function(response){
    //                 $('#btn-contact-us').prop('disabled', false);
    //                 $('#contact_form')[0].reset();
    //                 swal("Thank You! ","We will contact you shortly!","success");
    //             }
    //         });
    //     }
    // });


    //
    $('#btn-contact-us').click(function(e) {

        e.preventDefault();

        if (!$('#contact_form').valid()) {
            return;
        }
       //captchacontact();
        saveforlater();

        $('#modal-otpcontactus').find('#otpcontactus_mobile').val($('#mobile').val());
        $('#modal-otpcontactus').modal('show');

    });


    // $('#modal-otpcontactus').on('hide.bs.modal', function() {

    //     $('#contact_form').find('#otpcontactus_token').val($('#modal-otpcontactus').find('#otpcontactus_token').val());
    //     $('#contact_form').find('#otpcontactus_code').val($('#modal-otpcontactus').find('#otpcontactus_code').val());

    //     $('#contact_form').submit();

    // });

    function saveforlater() {
        let name = $('#name').val();
        let email = $('#contactusemail').val();
        let mobile = $('#mobile').val();
        let comment = $('#comment').val();


        $.ajax({
            type: 'POST',
            url: '{{ route('save-for-later.store')}}',
            data: {
                '_token': '{{ csrf_token() }}',
                'name': name,
                'email': email,
                'mobile': mobile,
                'comment': comment,
            },
            success: function() {
                //alert('success');
                // $('#toast-contact-us').toast('show');
            }
        });
    }

    function submitcontactform() {

        $('#btn-contact-us').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                $('#btn-contact-us').prop('disabled', false);
                $('#contact_form')[0].reset();
                swal("Thank You! ", "We will contact you shortly!", "success");
            }
        });

    }

    // function captchacontact() {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/refresh_captcha',
    //         success: function(data) {
    //             $(".captcha_contact span").html(data.captcha);
    //             $('#captcha_contact').val('');
    //             $('#captcha_contact').removeClass('is-valid');
    //             $('#captcha_contact').removeClass('is-invalid');
    //         }
    //     });

    // }

    function contactusotpverify() {
        $('#contact_form').find('#otpcontactus_token').val($('#modal-otpcontactus').find('#otpcontactus_token').val());
        $('#contact_form').find('#otpcontactus_code').val($('#modal-otpcontactus').find('#otpcontactus_code').val());
        var name = $('#name').val();
        //console.log(name);
        var mobile = $('#mobile').val();
        //console.log(mobile);
        var email = $('#contactusemail').val();
        //console.log(email);
        var comment = $('#comment').val();
        //console.log(comment);
        var otpcontactus_token = $('#otpcontactus_token').val();
        //console.log(otpcontactus_token);
        var otpcontactus_code = $('#otpcontactus_code').val();
        //console.log(otpcontactus_code);
        $('#modal-otpcontactus').find('#contactus-invalid-otp').css('display', 'none');
        $('#modal-otpcontactus').find("#btn-otpcontactus-verify").prop('disabled', true);
        $('#modal-otpcontactus').find("#btn-otpcontactus-verify").html("Verifying  <i class='fa fa-spinner fa-spin'>");
        $.ajax({
            method: 'POST',
            url: '{{ url('enquiries') }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                'name': name,
                'mobile': mobile,
                'email': email,
                'comment': comment,
                'otpcontactus_token': otpcontactus_token,
                'otpcontactus_code': otpcontactus_code
            },
        }).done(function(response) {
            console.log(response);
            if (response.status == '1') {
                $('#contact_form')[0].reset();
                $('#modal-otpcontactus').find('#contactus-invalid-otp').css('display', 'none');
                $('#modal-otpcontactus').find('#contactus-valid-otp').html("OTP Verified Successfully.We will contact you soon.");
                $('#modal-otpcontactus').find("#btn-otpcontactus-verify").hide();
                setTimeout(function() {
                    $('#modal-otpcontactus').modal('hide');
                    location.reload();
                }, 8000);
            } else {
                $('#modal-otpcontactus').find('#contactus-invalid-otp').css('display', 'block');
                $('#modal-otpcontactus').find('#contactus-invalid-otp').html("Invalid Otp");
                $('#modal-otpcontactus').find("#btn-otpcontactus-verify").prop('disabled', false);
                $('#modal-otpcontactus').find("#btn-otpcontactus-verify").html("Verify");

            }
        });
    }

    //
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map.key') }}&callback=initMap" async defer></script>
@endpush