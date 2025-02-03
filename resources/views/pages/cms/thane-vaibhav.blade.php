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
            <h4 class="text-center mb-3">Student Registration Form</h4>
            <form action="" id="thane_vaibhav_reg" class="py-3">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="fname">Student Full Name*</label>
                            <input type="text" class="form-control" name="name" id="fname">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="student-number">Student Contact Number*</label>
                            <input type="text" class="form-control" name="student_contact" id="student-number">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="parent-number">Parent Contact Number*</label>
                            <input type="text" class="form-control" name="parent_contact" id="parent-number">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="email">Email Id*</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="resaddr">Residential Address*</label>
                            <textarea name="resaddr" id="resaddr" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="city">City*</label>
                            <input type="text" class="form-control" name="city" id="city">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="pincode">Pincode*</label>
                            <input type="text" class="form-control" name="pincode" id="pincode">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="agg_X">Aggregate Percentage in Class X*</label>
                            <input type="text" class="form-control" name="agg_X" id="agg_X">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="agg_XI">Aggregate Percentage in Class XI*</label>
                            <input type="text" class="form-control" name="agg_XI" id="agg_XI">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="college_name">Name of Junior College</label>
                            <input type="text" class="form-control" name="college_name" id="college_name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="college_addr">Address of Junior College</label>
                            <textarea name="college_addr" id="college_addr" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="income">Annual Family Income*</label>
                        <select name="income" id="income" class="form-control">
                            <option value="0 to 3 Lakhs">₹0 to ₹3 Lakhs</option>
                            <option value="3 Lakhs and Above">₹3 Lakhs and Above</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p><input type="checkbox" name="check" id="check">
                        <label for="check">I hereby agree to all terms & conditions (as applicable, from time to time) for the 'JKSC Online - Thane Vaibhav' CAFC Scholarship Program 2023, including the selection process followed independently by 'Thane Vaibhav' selection committee in association with Hon CMO & The Department of School Education, Govt of Maharashtra.</label>
                    </p>
                </div>
                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">Captcha</label>


                      <div class="col-md-6">
                          <div class="captcha">
                          <span>{!! captcha_img() !!}</span>
                          <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                          </div>
                          <input id="captcha" type="text" class="form-control mt-3" placeholder="Enter Captcha" name="captcha">

                              <span class="help-block" style="color: red;font-size: 10px;" id="captcha_error">
                                  
                              </span>
                      </div>
                  </div>
                <button type="submit" id="sub-btn" disabled class="btn btn-success px-5 text-center m-auto d-block font-weight-bold">Submit</button>
            </form>
        </div>
       
            <div class="timelines">
                        <div class="notes">
                            <h5>Note</h5>
                            <p>Registered Students Shall Be Informed Regarding Selection Process & Other Formalities By SMS / Email, From Time-To-Time. Student Will Have To Pay Nominal Fees Before Commencement Of The Batch.Registration is open till 31st October 2022.</p>
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

<script>
     $(function(){

            jQuery.validator.addMethod("validate_email", function(value, element) {

                if (/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(value)) {
                    return true;
                } else {
                    return false;
                }
            }, "Please enter a valid Email.");

            jQuery.validator.addMethod("validate_phone", function(value, element) {

            if (/^[0-9]{10}$/.test(value)) {
                return true;
            } else {
                return false;
            }
            }, "Please enter a valid Phone number.");

            jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters"); 

     $('#thane_vaibhav_reg').validate({
        onsubmit:false,
            rules: {
                name: {
                    required: true,
                    lettersonly: true,
                    maxlength: 191
                },
                student_contact:{
                    required: true,
                    validate_phone:true,
                    remote: {
                            url: '{{ url('validate-scholar-phone') }}',
                            type: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                 mobile: function() {
                                    return $('#student-number').val();
                                }
                            }
                        }
                },
                parent_contact: {
                    required: true,
                    validate_phone:true,
                    notEqualTo: "#student-number"
                },
                email: {
                    required: true,
                    validate_email: true,
                    remote: {
                            url: '{{ url('validate-scholar-email') }}',
                            type: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                 email: function() {
                                    return $('#email').val();
                                }
                            }
                        }
                    
                },
                agg_X: {
                    required: true,
                    digits: true,
                    max:100
                },
                agg_XI: {
                    required: true,
                    digits: true,
                    max:100
                },
                 resaddr :{
                    required: true,
                 },
                 city :{
                    required: true,
                    lettersonly: true,
                 },
                 college_name:{
                    lettersonly: true,
                 },
                 pincode :{
                    required: true,
                    digits: true,
                    maxlength:6,
                    minlength:6,
                 },
                 captcha:{
                    required: true,
                 }
                },
                  messages: {                  
                    student_contact: {
                      maxlength: 'Mobile number should not be greater than 10 digits'
                  },
                  captcha:{
                     required : 'Captcha is required'
                  },
                  email: {
                        remote: 'Email already exist'
                    },
                  student_contact: {
                        remote: 'Mobile number already exist'
                    },
                 parent_contact:{
                      notEqualTo: 'Parent and student contact number should not be same'
                    }
              }
             
        });

        $('#otp_verify').validate({
            onsubmit:false,
            rules: {
                name: {
                    required: true,
                    
                },
            }
        });

        $('#check').on('click' ,function(){
            var a = $('#check').val();
            if($('#check:checkbox:checked').length > 0){
                $("#sub-btn").prop('disabled',false);
            }else{
                $("#sub-btn").prop('disabled',true);
            }
        });

        $(".btn-refresh").click(function(){
        $.ajax({
            type:'GET',
            url:'/refresh_captcha',
            success:function(data){
                $(".captcha span").html(data.captcha);
            }
            });
        });

        $('#thane_vaibhav_reg').on('submit', function(e) {

        
        e.preventDefault();
        let isValid = $('#thane_vaibhav_reg').valid();
        if (isValid)
        {   
            captcha();     
            $.ajax({
                type: 'POST',
                
                url: '{{ route('thane_vaibhav.store') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success:function(data) {
                    if(data.message == "Inserted"){
                        $('#captcha_error').css('display','none');
                        $('#student_id').val(data.data.id);
                        $("#otp-verify-modal").modal('show');
                    }else{
                        $('#captcha_error').css('display','block');
                        $("#captcha_error").html("Invalid Captcha");
                    }
                   
                   // $('#thane_vaibhav_reg').toast('show');
                    //$('#thane_vaibhav_reg')[0].reset();


                }
            });
        }
        });

        $("#verify-otp").click(function (e) {
            
            e.preventDefault();
            let isValid = $('#verify-mobile-otp').valid();
            if (isValid)
            { 
                let attemptYear = $('#otp_verify').val();
                let student_id=$('#student_id').val();
               if(attemptYear) {
                $('#invalid-otp').css('display','none');
                    
                   $("#verify-otp").prop('disabled',true);
                   $("#verify-otp").html("Verifying  <i class='fa fa-spinner fa-spin'>");
                   $.ajax({
                       method: 'POST',
                       url: '{{ url('/verify-otp-vaibhav') }}',
                       dataType: 'json',
                       data: {
                           '_token': '{{ csrf_token() }}',
                           'mobile_otp': attemptYear,
                           'student_id': student_id
                       },
                   }).done(function(response) {
                       if(response.status == '1'){
                          //  $("#verify-otp").prop('disabled',true);
                           $('#invalid-otp').css('display','none');
                           $("#valid-otp").html("Successfully Registered");
                            //$("#otp-verify-modal").modal('hide');
                            //alert("Successfully Registered");
                            //location.reload();
                            window.location.href = "{{ route('thank_you')}}";
                       }else{
                        $('#invalid-otp').css('display','block');
                            $("#invalid-otp").html("Invalid Otp");
                            $("#verify-otp").prop('disabled',false);
                            $("#verify-otp").html("Verify");
                            
                       }
                      
                   
                   });
               }else{
                     $("#verify-otp").prop('disabled',false);
               }
            }else{
                $("#verify-otp").prop('disabled',false);
            }
        });
        

    });

    function captcha(){
            $.ajax({
            type:'GET',
            url:'/refresh_captcha',
            success:function(data){
                $(".captcha span").html(data.captcha);
            }
            });
        
    }
    </script>
  
</html>