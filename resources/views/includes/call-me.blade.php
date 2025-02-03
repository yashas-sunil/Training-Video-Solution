<div class="call-me bg-primary text-white" style="">
    <div class="row no-gutters">
        <div class="col call-me-content" style="/*display: none;*/" >
            <form id="form-call-request" class="pl-4 pr-2 py-2" method="POST" action="{{ route('call-requests.store') }}">
                @csrf
                <div class="form-group row align-items-center text-center pt-1">
{{--                    <label class="col-auto mb-0" for="call_me_mobile_number">+91</label>--}}
                    <select id="mobile-code" class="form-control-sm bg-white" name="mobile_code" style="border-radius: 19px; height: calc(1.5em + 0.75rem + 2px);outline: none;">
                        <option selected value="+91">+91</option>
                        <option value="+971">+971</option>
                    </select>
                    <input id="call_me_mobile_number" type="tel" class="form-control col border-white"
                           placeholder="Mobile Number" aria-label="Mobile Number"
                           aria-describedby="call_me_mobile_number_country_code"
                            name="phone"  style="border-radius: 19px; margin-left: 10px;" required>
                </div>
                <div class="form-group row align-items-center text-center pt-1">
                    <div class="g-recaptcha-cl" data-sitekey="{{env('SITE_KEY')}}" id="RecaptchaField4"></div>
                    <input id="rc_hiddenRecaptcha" name="rc_hiddenRecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/>
                </div>
                <!-- <div class="form-group row align-items-center text-center pt-1 {{ $errors->has('captcha_callme') ? ' has-error' : '' }}">
                            <label for="captcha_callme" class="col-md-4 control-label">Captcha*</label>
                            <div class="col-md-6">
                                <div class="captcha_callme">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-success btn-refresh-captchacallme"><i class="fa fa-refresh"></i></button>
                                </div>
                                
                                <input id="captcha_callme" type="text" class="form-control" placeholder="Enter Captcha" name="captcha_callme">

                                <span class="help-block" style="color: red;font-size: 10px;" id="captcha_callme_error">

                                </span>
                            </div>
                </div> -->
                <button type="submit" style="font-size:14px" class="btn btn-warning btn-block ml-4 mt-1">Request a call back</button>
                <small id="emailHelp" class="form-text text-inverse  ml-4 text-center" style="opacity:1;">Note - You will receive call between 10am to 7pm.</small>
            </form>
        </div>
        <div class="col-auto">
            <div class="call-me-btn">
                    <span class="fa-stack" style="font-size: 15px;">
                      <i class="fas fa-circle fa-stack-2x"></i>
                      <i class="fas fa-phone-alt fa-stack-1x text-primary icon-close"></i>
                      <i class="fas fa-times fa-stack-1x text-primary icon-open"></i>
                    </span>
            </div>

        </div>
    </div>
</div>
<?php  
if(!empty( @$user['student']['name'] )){
    $u_name = explode(' ',$user['student']['name']);
}else{
    $u_name[0] = '';
    $u_name[1] = '';
}
?>
<div class="modal" id="email_support">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
     
                {{--   <div class="modal_form" >
            <form action="#" method="POST" id="form_email_support">
                @csrf
                <h5 class="text-center mx-auto mb-3">Email Support</h5>
                <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                <label for="fname">First Name *</label>
                <input type="text" class="form-control" name="fname" id="fname" value="{{ @$u_name[0] }}" @if(@$u_name[0]) readonly @endif autofocus required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="lname">Last Name *</label>
                <input type="text" class="form-control" name="lname" id="lname" value="{{ @$u_name[1] }}" @if(@$u_name[1]) readonly @endif required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="lname">Mobile Number *</label>
                <input type="text" class="form-control" name="mobile" id="mobile" value="{{ @$user['student']['phone'] }}" @if(@$user['student']['phone']) readonly @endif required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="email">Email address *</label>
                <input type="email" class="form-control" name="email" value="{{ @$user['student']['email'] }}" id="email" @if(@$user['student']['email']) readonly @endif  required>
                </div>
                <div class="form-group col-md-12">
                <label for="descrption">Query *</label>
                <textarea  class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                </div>
                </div>
                <button type="submit" class="btn btn-primary web_button_color d-block text-center mx-auto ">Submit</button>
            </form>
        </div>--}}
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
    $(function () {
        'use strict';

        $('.call-me-btn').click(function () {
            $('.call-me').toggleClass('open');
          
        });
        
        // $("#call_me_mobile_number").blur(function(){
        //     $.ajax({
        //     type:'GET',
        //     url:'/refresh_captcha',
        //     success:function(data){
        //         $(".captcha_callme span").html(data.captcha);
        //     }
        //     });
        // });
        $(document).click(function (e) {
            var $target = $(e.target);

            if ($target.is('.call-me') || $target.closest('.call-me').length) {
                return;
            }

            $('.call-me').removeClass('open');
        });
        // $(".btn-refresh-captchacallme").click(function(){
        // $.ajax({
        //     type:'GET',
        //     url:'/refresh_captcha',
        //     success:function(data){
        //         $(".captcha_callme span").html(data.captcha);
        //     }
        //     });
        // });
        $('#form-call-request').validate({
            rules: {
                phone: {
                    required: true,
                    digits: true,
                    maxlength: function() {
                        if ($('#mobile-code').val() === '+91') {
                            return 10;
                        } else {
                            return 9;
                        }
                    },
                    minlength: function() {
                        if ($('#mobile-code').val() === '+91') {
                            return 10;
                        } else {
                            return 9;
                        }
                    },
                },
                "rc_hiddenRecaptcha": { 
                        required: true,
                        minlength: "255",
                        remote: {
                            url: '{{ url('/validate-captcha') }}',
                            type: 'POST',
                            data: {
                              captchaa: function () {
                              //  alert();
                               return $('#rc_hiddenRecaptcha').val();
                                },
                                _token: '{{ csrf_token() }}',
                            }
                        }, 
                    },
                // captcha_callme:{
                //     required:true,
                //     remote:{
                //         type:'POST',
                //         async:false,
                //         dataType:'json',
                //         url:'{{route('captchacallmecheck')}}',
                //     }
                // },
            }
            // messages:{
            //     captcha_callme:{
            //         remote:'Captcha is invalid',
            //         required:'Captcha is required'
            //     }
            // }
        });

        $('#form-call-request').on('submit', function(e) {
            let isValid = $('#form-call-request').valid();

            if (isValid)
            {
                e.preventDefault();
               
                // $('#captcha_callme').val('');
                // $('#captcha_callme_error').val('');
                $.ajax({
                    type: 'POST',
                    async:false,
                    url: '{{ route('call-requests.store') }}',
                    data: $(this).serialize(),
                    success:function(data) {
                        // console.log(data);
                        $('#call_me_mobile_number').val('');
                        $('#toast-thanks-for-request').toast('show');
                        $('.call-me').removeClass('open');
                        // refreshcaptchacallme();
                        // location.reload();
                    }
                });
            }
        });
        
        // function refreshcaptchacallme(){
        //     $.ajax({
        //     type:'GET',
        //     url:'/refresh_captcha',
        //     success:function(data){
        //         $(".captcha_callme span").html(data.captcha);
        //     }
        //     });
        // }
       

       

    });
</script>

<script>
    $(function(){

        jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(value)) {
                    return true;
                } else {
                    return false;
                }
                }, "Please enter a valid Email.");

                jQuery.validator.addMethod("validate_mobileno", function(value, element) {

if (/^[0-9]{10}$/.test(value)) {
    return true;
} else {
    return false;
}
}, "Please enter a valid Mobile Number.");
                $('#form_email_support').validate({
              
              rules: {                 
                
                  fname: {
                      required: true,
                      lettersonly: true 
                  },
                  lname: {
                      required: true,
                      lettersonly: true 
                  },
                  description:{
                      required: true,
                  },
                  mobile:{
                      required:true,
                    //   digits: true,
                      validate_mobileno: true
                  },
                  email:{
                      required:true,
                      //email:true,
                      validate_email: true
                  }
                 
              }, messages: {
                  
                  mobile: {
                      maxlength: 'Mobile number should not be greater than 10 digits'
                  }
              }
             
      });

        $('#form_email_support').on('submit', function(e) {

            e.preventDefault();
             let isValid = $('#form_email_support').valid();
          
            if (isValid)
            {
                let fname = $('#fname').val();
                let lname = $('#lname').val();
                let email = $('#email').val();
                let mobile = $('#mobile').val();
                let description = $('#description').val();
               
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: $(this).serialize(),
                    success:function(data) {
                        $('#toast-thanks-for-request').toast('show');
                        $('#email_support').modal('hide');
                        $('.call-me').removeClass('open');
                      
                       
                    }
                });
            }
        });

          


    });
</script>
@endpush
