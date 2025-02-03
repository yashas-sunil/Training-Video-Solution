<!-- Feedback Collection -->
<div class="collections">
        <p>Could not find what you are looking for? <a data-toggle="modal" data-target="#feedback_collct">Click here</a></p>
    </div>

<div class="modal fade" id="feedback_collct" tabindex="-1" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-body">
              
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="enq_close">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
          <form action="{{route('can-not-find-enquire.store')}}" method="POST" id="enquire_form_id">
          @csrf  
          <input type="hidden" name="form" value="cannotfindenquire">
            <input id="cannotfind_otp_token" name="cannotfind_otp_token" type="hidden" value="">
            <input id="cannotfind_otp_code" name="cannotfind_otp_code" type="hidden" value="">
                <h5 class="text-center mx-auto mb-3">Enquire</h5>
                <div class="enquire_form">
                <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                <label for="fname">First Name *</label>
                @if (Session::has('cannotfind_fname'))
                <input type="text" class="form-control" value="{{Session::get('cannotfind_fname')}}" name="cannotfind_fname" id="cannotfind_fname" readonly autofocus required>
                @else
                <input type="text" class="form-control" value="" name="cannotfind_fname" id="cannotfind_fname" autofocus required>

                @endif
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="lname">Last Name *</label>
                @if (Session::has('cannotfind_lname'))
                <input type="text" class="form-control" value="{{Session::get('cannotfind_lname')}}" name="cannotfind_lname" id="cannotfind_lname" readonly required>
                @else
                <input type="text" class="form-control" value="" name="cannotfind_lname" id="cannotfind_lname" required>
                @endif
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="phnum">Mobile Number *</label>
                @if (Session::has('cannotfind_phone'))
                <input type="text" class="form-control" value="{{Session::get('cannotfind_phone')}}" name="mobile" id="phnum" readonly required>
                @else
                <input type="text" class="form-control" value="" name="mobile" id="phnum" required>
                @endif
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="email">Email address *</label>
                @if (Session::has('cannotfind_email'))
                <input type="email" class="form-control" value="{{Session::get('cannotfind_email')}}" name="email" id="enquireemail" readonly required>
                @else
                <input type="email" class="form-control" value="" name="email" id="enquireemail" required>
                @endif
                </div>
                <div class="form-group col-md-12">
                <label for="descrpt">Description *</label>
                <textarea name="descript" class="form-control" id="" cols="30" rows="3" placeholder="Please provide complete and proper details. Incomplete or Incorrect details will not be addressed." required></textarea>
                </div>
                <div class="form-group col-md-12">
                <div class="g-recaptcha-ce" data-sitekey="{{env('SITE_KEY')}}" id="RecaptchaField6"></div>
                <input id="et_hiddenRecaptcha" name="et_hiddenRecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/>
              </div>
                </div>
                <div class="d-flex justify-content-around">
                <button type="" id="cannotfind_feedback-submit" class="btn btn-primary d-block text-center mx-auto">Submit</button>
                @if(!request()->session()->has('access_token'))
                <button type="" id="feedback-login" class="btn btn-primary d-block text-center mx-auto ">Login</button>
                @endif
               
                </div>
            </div>
            </form>
            <form class="enquire_otp p-3" id="form-enquire-otp">
                    <input id="otp_enquire_mobile" name="otp_enquire_mobile" type="hidden">
                    <input id="otp_enquire_email" name="otp_enquire_email" type="hidden">
                    <input id="otp_enquire_token" name="otp_enquire_token" type="hidden">
                    @csrf
            <div >
                <div class="form-group text-center">
                    <label>Please enter OTP code just sent to your number</label>
                    <input type="text" required class="form-control w-50 text-center mx-auto" placeholder="Enter OTP" id="otp_enquire_code" name="otp_enquire_code">
                </div>
                <div class="form-group text-center">
                    <span id="enquire_resend_text">Didn't get? <a id="enquire_resend" class="ml-md-auto">Resend</a></span>
                    <span style="display: none" id="enquire_timer">30</span>
                </div>
                <button type="button" id="otp-enquire-submit" class="btn btn-primary d-block text-center mx-auto ">Verify</button>
            </div>
            </form>
      </div> 
    </div>
  </div>
</div>
    <!-- Feedback Collection -->
<div class="footer" id="footer">       
    <div class="container-fluid">
        <div class="footer_row">
            <div class="footer_col">
                <div class="ft-info">
                    <h4>J. K. Shah Classes</h4>
                    <p>J. K. Shah Online is a platform which brings a new knowledge in ecosystem which helps students prepare for various professional and competitive exams like CA, CS, CMA, CFA, F.Y.J.C, S.Y.J.C Anytime, Anywhere, on Any Device.</p>
                    
                    <p>We have offices in Mumbai, Delhi, Rajkot, Surat, Vadodara, Veraval, Junagadh, Jamnagar, Vapi, Jaipur, Indore, Hyderabad, Coimbatore, Chennai, Bengaluru, Raipur, Hubli, Ernakulam, Ahmedabad etc.</p>
                </div>
               
            </div>
            
            <div class="footer_col">
                <div class="ft-courses">
                    <h4>Menu</h4>
                    <ul>
                        <li><a class="text-white" href="{{ url('/')}}">Home</a></li>
                        <li><a class="text-white" href="{{ url('/packages?offer=new')}}">New Releases</a></li>
                        <li><a class="text-white" href="{{ url('/packages?offer=special') }}">J-Deals</a></li>
                        <li><a class="text-white" href="{{ url('/#explore') }}">Most Popular</a></li>
                        <li><a class="text-white" href="{{ url('/ca-demo-lectures-online')}}">Demo</a></li>
                        <li><a class="text-white" href="{{ url('/ca-faculty')}}">Our Team</a></li>
                        <li><a class="text-white" href="{{ url('/about-us')}}">About Us</a></li>
                        <li><a class="text-white" href="{{ url('/contact-us')}}">Contact Us</a></li>
                        <li><a class="text-white" href="{{ url('/terms')}}">Terms of Use</a></li>
                        <li><a class="text-white" href="{{ url('/blogs')}}">Blogs</a></li>
                        @if( isset($user['role']))
                        <li><a href="#feedback_form" class="text-white" data-target="#feedback_form" data-toggle="modal">Feedback</a></li>
                         @endif
                        <li><a class="text-white" href="{{ url('/') . '/' . 'sitemap.html' }}">Sitemap</a></li>
                        <li><a class="text-white" href="{{ url('privacy/')}}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer_col">
                <div class="ft-courses">
                    <h4>Courses</h4>
                    <ul>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=3&level_ids%5B%5D=18&course_id=3&price=high')}}">CA Foundation</a></li>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=3&level_ids%5B%5D=22&course_id=3&price=high')}}">CA Intermediate</a></li>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=3&level_ids%5B%5D=21&course_id=3&price=high')}}">CA Final </a></li>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=7&level_ids%5B%5D=19&course_id=7&price=high')}}">CSEET</a></li>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=7&level_ids%5B%5D=9&course_id=7&price=high')}}">CS Executive</a></li>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=7&level_ids%5B%5D=20&course_id=7&price=high')}}">CS Professional</a></li>
                        {{--<li><a class="text-white" href="{{ url('/packages?offer=combo')}}">Combo Packs</a></li> /* as per removed from Raj J K Classes mail dated 07-10-2022 --}}
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=6&level_ids%5B%5D=8&course_id=6&price=high')}}">FYJC</a></li>
                        <li><a class="text-white" href="{{ url('/packages?courses_ids=6&level_ids%5B%5D=7&course_id=6&price=high')}}">SYJC</a></li>
                        {{--<li><a class="text-white" href="{{ url('/packages/258')}}">CA Inter Fast Track All Subjects</a></li>
                        <li><a class="text-white" href="{{ url('/packages?course=3&course_text=CA&level=2&level_text=CA%20Inter%20Fast%20Track')}}">CA Inter Fast Track</a></li>
                        <li><a class="text-white" href="{{ url('/packages?course=3&course_text=CA')}}">All CA Packages</a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="footer_col">
                <div class="ft-classes">
                    <h4>Classes</h4>
                    <ul>
                        <li><a class="text-white" href="https://jkshahclasses.com/chartered-accountancy.php" target="_blank">Chartered Accountancy - CA</a></li>
                        <li><a class="text-white" href="https://jkshahclasses.com/company-secretary.php" target="_blank">Company Secretary - CS</a></li>
                        <li><a class="text-white" href="https://jkshahclasses.com/cost-management-accounting.php" target="_blank">Cost & Management Accounting - CMA</a></li>
                        <li><a class="text-white" href="https://jkshahclasses.com/fyjc-syjc.php" target="_blank">MH State Board - F.Y.J.C, S.Y.J.C.<br>CBSE - Class XI & Class XII<br>ICSE - Class XI & Class XII</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer_col">
                <div class="ft-contact">
                    <h4>Locate Us</h4>
                    <ul class="address">
                        <li><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <p>J. K. Shah Classes,<br> Shraddha, 4th Floor,<br> Near Chinai College,<br> Old Nagardas Road,<br>Andheri East, <br>Mumbai - 400069
                            </p>
                        </li>
                        <li class="mt-3"><span><i class="fa fa-phone" aria-hidden="true"></i></span>
                            <p><a href="tel:+918070400900">8070 400 900</a></p>
                        </li>
                        <li><span><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                            <p><a href="https://wa.me/+919757001272" target="_blank">9757 00 1272</a></p>
                        </li>
                    </ul>
                    <div class="social-icons">
                        <h5 class="mb-0">Connect With us</h5>
                        <ul>
                            <li><a target="_blank" href="https://www.youtube.com/c/JKShahClassesOnline"><img src="{{asset('assets/new_ui_assets/images/Youtube.png')}}" alt="" /></a></li>
                            <li><a target="_blank" href="https://www.facebook.com/officialjksc"><img src="{{asset('assets/new_ui_assets/images/Facebook_ft.png')}}" alt="" /></a></li>
                            <li><a target="_blank" href="https://t.me/jkshahonline"><img src="{{asset('assets/new_ui_assets/images/Telegram.png')}}" alt="" /></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/officialjksc"><img src="{{asset('assets/new_ui_assets/images/Instagram.png')}}" alt="" /></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid text-center mx-auto copyright">Copyright &copy; J.K.ShahClasses. All rights reserved</div>
</div>

<div class="floating_box">
        <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <a href="" id="packageUrl">
            <div class="box_body">
                <div class="box_image" id="package_image">
                    
                </div>
                <div class="box_content">
                <h6 id="packageId"></h6>
                <div class="bottom_content">
                <div class="namespace">
                <p>has been bought by</p>
                    <p id="lastTrName" class="font-weight-bold"></p> <p>from</p>
                    <!-- <span class="v_line">&nbsp;</span> -->
                   <p id="country" class="font-weight-bold"></p>
                </div>
                <div class="pur_time">
                    <span id="transactiontime"></span>
                </div>
                </div>
                </div>
            </div>

        </a>
    </div>

@if (Session::has('access_token'))
    <!-- <p class="capture-screen-button">
        <button id="capture-screenshot" >Capture Screenshot</button>
    </p> -->
    <div class="tech_support">
        <button id="capture-screenshot" title="Tech Support"><img src="{{ asset('assets/new_ui_assets/images/techsupport.png') }}" style="height: auto;width:20px"></button>
    </div>
    <div class="modal fade" id="tech_support" tabindex="-1" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-body">
    <button type="button" id="tech_close" class="close" data-dismiss="modal" aria-label="Close">
    <i class="fa fa-times" aria-hidden="true"></i>
    </button>
    <form action="" method="post" id="tech-support-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h5 class="text-center">Tech Support</h5>
        <div class="form-group">
            <label for="">Problem on</label>
            <h6 class="form-control h-auto bg-light" id="q_course" style="min-height: 40px"></h6>
            <input type="hidden" name="pageorcourse" id="pageorcourse" >
        </div>
        <div class="form-group">
            <label for="">Tell us more about your problem *</label>
            <textarea onkeypress="return isAlfa(event)" name="description" id="descriptiont" class="form-control" placeholder="Enter here" rows="3"></textarea>
            <p id="charNum1"></p>
        </div>
        <div class="form-group">
            <label for="">Attach any supporting image/document/video</label>
            <input type="file" class="form-control" name="attachments[]" id="attachments" multiple>
        </div>
        <p style="font-size:small;"><b>Max size 30 MB</b></p>
    <button type="submit" id="support_submit" class="btn btn-primary d-block text-center mx-auto ">Submit</button>
    </form>
    </div> 
    </div>
    </div>
    </div>
@endif 

<?php  
if(!empty( @$user['student']['name'] )){
    $u_name = explode(' ',$user['student']['name']);
}else{
    $u_name[0] = '';
    $u_name[1] = '';
}
?>
<!-- testimonail form -->
<div class="modal" id="feedback_form">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
     
        <div class="modal_form">
            <form action="" id="testi-feedback-form">
                <h5 class="text-center mx-auto mb-3">Feedback Form</h5>
                <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                <label for="fname">First Name *</label>
                <input type="text" class="form-control" value="{{ @$u_name[0] }}" name="fname" id="fname" autofocus required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="lname">Last Name *</label>
                <input type="text" class="form-control" value="{{ @$u_name[1] }}" name="lname" id="lname" required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="lname">Mobile Number *</label>
                <input type="text" class="form-control" value="{{ @$user['student']['phone'] }}" name="mobile" id="feedback_mobile" required>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                <label for="email">Email address *</label>
                <input type="email" class="form-control" value="{{ @$user['student']['email'] }}" name="email" id="feedback_email" required>
                </div>
                <div class="form-group col-md-12">
                <label for="descrption">Description *</label>
                <textarea name="description" class="form-control" id="descrption" cols="30" rows="5" required></textarea>
                </div>
                </div>
                <button type="submit" id="feedback-submit" class="btn btn-primary web_button_color d-block text-center mx-auto ">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- testimonail form -->   
    @push('script')
   
    <script>

$('#testi-feedback-form').validate({
              
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
                      validate_phone:true,
                   
                  },
                  email:{
                      required:true,
                      validate_email: true
                  }
                 
              }, messages: {
                  
                  mobile: {
                      maxlength: 'Mobile number should not be greater than 10 digits'
                  }
              }
             
        });
        $('#feedback-login').click(function(e) {
            $('#feedback_collct').modal('hide');
            $.ajax({
                url: "{{route('can-not-find-enquire.index')}}",
                method:"GET",
                }).done(function(response) {
                    if(response==1){
                       
                    $(".login").click();
                       console.log(response);
                    }else{
                       alert ("session is not set");
                       console.log(response);
                    }
                   
                }); 
    });
    $('#cannotfind_feedback-submit').click(function(e) {
        e.preventDefault();
        let isValid = $('#enquire_form_id').valid();
        if (isValid) {
            $('#cannotfind_feedback-submit').prop('disabled', true);
            @if(request()->session()->has('access_token'))
            $("#cannotfind_feedback-submit").html("Saving <i class='fa fa-spinner fa-spin'>");

            $.ajax({
                    type: 'POST',
                    url: '{{ route('can-not-find-enquire.store') }}',
                    data: $("#enquire_form_id").serialize(),
                    success:function(data) {
                        if(data.status==1){
                       $('#toast_enquire_form_id').toast('show');
                       $('#feedback_collct').modal('hide');
                       $('#enquire_form_id')[0].reset();
                       $("#cannotfind_feedback-submit").html("Submit");
                       $('#cannotfind_feedback-submit').prop('disabled', false);
                       $('textarea').removeClass('is-valid');
                        }else{
                            $("#cannotfind_feedback-submit").html("Submit");
                            $('#cannotfind_feedback-submit').prop('disabled', false);

                        }
                       
          
          
                    }
                });
               // $('#feedback_collct').modal('hide');
                //$('#enquire_form_id').submit();
            @else
            $('#form-enquire-otp').find('#otp_enquire_mobile').val($('#phnum').val());
            $('#form-enquire-otp').find('#otp_enquire_email').val($('#enquireemail').val());
            sendEnquireOtp();
            $('#enquire_form_id').hide();
           
            $('.enquire_otp').css('display', 'block');
            @endif
          
            
           
        } else {
            alert("Form Input Is Invalid");
        }

    });
    $('#otp-enquire-submit').on('click', function(e) {
        e.preventDefault();
        let isValid = $('#form-enquire-otp').valid();
        if (isValid) {
            $("#otp-enquire-submit").html("Veriying <i class='fa fa-spinner fa-spin'>");
        $('#enquire_form_id').find('#cannotfind_otp_token').val( $('#feedback_collct .enquire_otp').find('#otp_enquire_token').val());
        $('#enquire_form_id').find('#cannotfind_otp_code').val( $('#feedback_collct .enquire_otp').find('#otp_enquire_code').val());

        $('#otp-enquire-submit').prop('disabled', true);
        // let isValids = $('#enquire_form_id').valid();
        // alert(isValids);
        //     alert('bfsubmt');
        // $('#enquire_form_id').submit();
        // alert('afsubmit');
        // $('#feedback_collct').modal('hide');



        $.ajax({
                    type: 'POST',
                    url: '{{ route('can-not-find-enquire.store') }}',
                    data: $("#enquire_form_id").serialize(),
                    success:function(data) {
                       if(data.status==1){
                        $('#toast_enquire_form_id').toast('show');
                       $('#feedback_collct').modal('hide');
                       $('#enquire_form_id')[0].reset();
                       $('#form-enquire-otp')[0].reset();
                       $("#otp-enquire-submit").html("Submit");
                       $('#otp-enquire-submit').prop('disabled', false);
                       $('textarea').removeClass('is-valid');
                       $('#enquire_form_id').css('display', 'block');
                       $('.enquire_otp').hide();
                       $('#cannotfind_feedback-submit').prop('disabled', false);
                       }else{
                        alert(data.message);
                        $('#otp-enquire-submit').prop('disabled', false);

                        $("#otp-enquire-submit").html("Submit");

                       }
                       
          
          
                    }
                });
        }else{
            alert ("Code Is Invalid");
        }


    });

    "use strict";
        var timer;

        // let $modal = $('#modal-otp');

        let pad = function(value) {
            return (value < 10 ? '0' : '') + value;
        };

    function startTimer() {
       
        stopTimer();

        $('#enquire_resend_text').hide();

        var time = 30;
        timer = setInterval(function() {
            if (time < 0) {
                stopTimer();
                return;
            }

            $('#enquire_timer').show();
            $('#enquire_timer').text(Math.floor(time / 60) + ':' + pad(time % 60));
            time--;
        }, 1000);
    };

    function stopTimer() {
        if (timer) clearInterval(timer);
        $('#enquire_resend_text').show();
        $('#enquire_timer').hide();
    };

    function sendEnquireOtp() {
        $('#otp-enquire-submit').prop('disabled', true);
        let $modal = $('#enquire_form_id');
        startTimer();

        var url = "{{ url('/send-otp') }}";
        var phone = $modal.find('#phnum').val();
        var email = $modal.find('#enquireemail').val();
        var name = $modal.find('#cannotfind_fname').val()+' '+$modal.find('#cannotfind_lname').val();
        var otp_token = $('#feedback_collct .enquire_otp').find('#otp_enquire_token').val();
        console.log(otp_token);
        $.ajax({
            url: url,
            beforeSend: function(request) {
                request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
            },
            type: 'POST',
            data: {
                mobile: phone,
                email: email,
                action: 'cannotfindenquire',
                token: otp_token,
                name:name
            }
            /*,
             global: false */ // set false to disable global event handler
        }).done(function(response, textStatus, jqXHR) {
            // alert (response['data']);
            // alert(JSON.stringify(response));
            // console.log(response.data);
            $('#otp-enquire-submit').prop('disabled', false);
            $('#feedback_collct .enquire_otp').find('#otp_enquire_token').val(response['data']);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }).always(function() {
            //  ladda.stop();
        });
    };
    $("#enquire_resend").click(function(e) {
        sendEnquireOtp();
    });

    $('#form-enquire-otp').validate({
        rules: {
            otp_enquire_code: {
                required: true,
                digits: true,
                maxlength:4
                
            }
        }, messages: {
                  
                otp_enquire_code: {
                      maxlength: 'OTP code should be maximum 4 digits',
                      required:'This field is required.',
                      digits:'Only digits are allowed.'
                  }
        }
    });
</script>
    <script>
       
        let lastdata=[];
              $.ajax({
                        url: '{{ url('getLastTransaction') }}',
                       
                        async: false
                    }).done(function(response) {
                       
                         lastdata = response;
                        
                    });
                  var c_url=$(location).attr("pathname");
                 
                  a_url=c_url.split('/');
              if(a_url['1']!='videos'){
                    if(lastdata.length>=1){ 
            setInterval(function(){
            if(jQuery.isEmptyObject(lastdata)!=true){    
                $("#lastTrName").html(lastdata[0].name);
                $("#packageId").html(lastdata[0].package_name);
                $("#country").html(lastdata[0].country);
                $("#package_image").html(lastdata[0].image_url);
                $("#transactiontime").html(lastdata[0].time);

                var newUrl = '{{ url('packages')}}'+'/'+lastdata[0].id ;
                $('#packageUrl').attr('href', newUrl);
            //  console.log(lastdata[0].name);
            if(lastdata){ 
                $('.floating_box').animate({
                 left: +($('.floating_box').outerWidth() - 310)
             });
            }
        }
  setTimeout(function(){
    lastdata.shift();
    var $floating_box = $('.floating_box');
                    if ($floating_box.is(':visible')) {
                        $floating_box.animate({
                            left: -($floating_box.outerWidth() + 10)
                        });
                    }
  },14000)
},20000);
                    }


                }
$('.floating_box .close').click(function() {
    var $floating_box = $('.floating_box');
                    if ($floating_box.is(':visible')) {
                        $floating_box.animate({
                            left: -($floating_box.outerWidth() + 10)
                        });
                    }
                    $.ajax({
                        url: '{{ url('blockpopup') }}',
                       
                        async: false
                    }).done(function(response) {
                       
                        lastdata = '';
                        
                    });
               
            });

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
        jQuery.validator.addMethod("validate_html_tags", function(value, element) {

        if (/<(.|\n)*?>/g.test(value)) {
            return false;
        } else {
            return true;
        }
        }, "Html tags are not allowed.");
       
       

        $('#enquire_form_id').validate({
              
              rules: {
                cannotfind_fname: {
                      required: true,
                      lettersonly: true 
                  },
                  cannotfind_lname: {
                      required: true,
                      lettersonly: true 
                  },
                  descript:{
                      required: true,
                      maxlength: 255,
                      validate_html_tags:true
                  },
                  mobile:{
                      required:true,
                      validate_phone:true,
                   
                  },
                  email:{
                      required:true,
                      validate_email: true
                  },
                  "et_hiddenRecaptcha": {
                        required: true,
                        minlength: "255",
                        remote: {
                            url: '{{ url('/validate-captcha') }}',
                            type: 'POST',
                            data: {
                              captchaa: function(){
                               return $('#et_hiddenRecaptcha').val();
                                },
                                _token: '{{ csrf_token() }}',
                            }
                        },
                    },
                 
              }, messages: {
                  
                  mobile: {
                      maxlength: 'Mobile number should not be greater than 10 digits'
                  }
              }
             
        });


        $('#testi-feedback-form').on('submit', function(e) {

            e.preventDefault();
            let isValid = $('#testi-feedback-form').valid();
            

            if (isValid)
            {
               
                $.ajax({
                    type: 'POST',
                    url: '{{ route('testimonials.store') }}',
                    data: $(this).serialize(),
                    success:function(data) {
                        $('#toast-testi-feedback').toast('show');
                        $('#feedback_form').modal('hide');
                        $('#testi-feedback-form')[0].reset();
          
           
                    }
                });
            }
        });

        // $('#capture-screenshot').click(function() {
        //     $("#capture-screenshot").html("Capturing Screenshot <i class='fa fa-spinner fa-spin'>");
        //     $.ajax({
        //         type:'POST',
        //         url:'{{ route('savescreenshot') }}',
        //         success:function(response) {
        //                     $("#capture-screenshot").html("Capture Screenshot");
        //                     alert('success');
        //                }
        //         });
        // });


    })

</script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script type="text/javascript">
    function isAlfa(evt) {
        if (event.target.value.substr(-1) === ' ' && event.code === 'Space') {
            return false;
        }
    }
    $(function(){
        $('#descriptiont').keyup(function(){
            var word = $(this).val().trim();
            var counts = word.split(' ');
            var maxLength = counts.length;
            var remaining = 250 - maxLength;
            //remaining = Math.max(0, remaining);
            if(word == '' && maxLength == 1){
                document.getElementById("charNum1").innerHTML = '<span style="color: red;font-size: 80%;float: right;">250 words remaining</span>';
            }
            else if(remaining > 0 ){
                document.getElementById("charNum1").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+remaining+' words remaining</span>';
            }else{
                document.getElementById("charNum1").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+maxLength+' words </span>';
    
            }
        });


        var dataURL = {};
        var c_name = '';
        const screenshotTarget = document.body;
		$('#capture-screenshot').click(function(){
            var route =window.location.pathname;
            if (route.indexOf('/videos/') > -1)
            {
                jwplayer().pause();
                c_name = $('.subject_heading').text();
                $("#q_course").html(c_name);
                $("#pageorcourse").val(c_name);
            }else{
                if(route == '/'){
                    route = "/home";
                }
                $("#pageorcourse").val(route);
                $("#q_course").html(route);
            } 
            $("#capture-screenshot").html("Collecting data. Please wait <i class='fa fa-spinner fa-spin'>");
			html2canvas(screenshotTarget).then(canvas => {
	            dataURL = canvas.toDataURL();
	            post_data(dataURL);  	

	        });

		});

        function post_data(imageURL){
            var chi = "{{ asset('assets/new_ui_assets/images/techsupport.png') }}" ;
		    $.ajax({
			    url: "{{ route('savescreenshot') }}",
			    type: "POST",
			    data: {image: imageURL},
			    dataType: "json",
			    // success: function() {
                //     // $("#capture-screenshot").html("Tech Support");
                //     // $('#tech_support').modal('toggle');
				//     alert('Success!!');
				//     //location.reload();
			    // }
		    }).done(function() {
                $("#capture-screenshot").html("<img src='"+chi+"' style=\"height:auto;width:20px;\">");
                $('#tech_support').modal('toggle');
            });
        }

        jQuery.validator.addMethod("validate_query", function(value, element) {
            var reg =/<(.|\n)*?>/g;
            if (reg.test(value)) {
                return false;
            } else {
                return true;
            }
        }, "HTML tags are not allowed");

        jQuery.validator.addMethod("validate_desc", function(value, element) {
            var text=value.trim();
            var words = text.split(' ');
            if (words.length > 250) {
                return false;
            }else if(value.trim()<1){
                return false;
            } else {
                return true;
            }
        }, "Maximum 250 words are allowed");

        jQuery.validator.addMethod('fileSizeLimit', function(value, element, limit) {
	        return this.optional(element) || (element.files[0].size <= limit);
        }, 'File size exceeded');

        $('#tech-support-form').validate({
            onsubmit:false,
            rules: {
                description: {
                    required: true,
                    validate_query:true,
                    validate_desc:true,
                },
                "attachments[]":{
                    fileSizeLimit: 30000000,
                    extension: "jpeg|jpg|png|gif|bmp|JPEG|JPG|PNG|GIF|BMP|webp|webm|mp4|ogv|mpeg|AVI|avi|mov|MOV|mkv|MKV",
                },
            },messages: {                  
                "attachments[]": {
                   extension: 'You can upload only images and videos'
               }
            }
        });

        $("#support_submit").click(function (e) {
            e.preventDefault();
            let isValid = $('#tech-support-form').valid();
            if (isValid)
            { 
                $("#support_submit").html("Saving <i class='fa fa-spinner fa-spin'>");
                //$('#tech-support-form').submit();
                $.ajax({
                    url: "{{ route('save_tech_support') }}",
                    method:"POST",
                    data:new FormData(document.getElementById("tech-support-form")),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('#toast-techsupport').toast('show');
                        $("#support_submit").html("Submit");
                        $('#tech-support-form')[0].reset();
                        $("#charNum1").html('');
                        $('#tech_support').modal('toggle');
                    }
                });
            }
        });

        $('#tech_close').click(function(){
            $('#tech-support-form')[0].reset();
            $("#charNum1").html('');
        });

        $('#enq_close').click(function(){
          
                       $('#feedback_collct').modal('hide');
                       $('#enquire_form_id')[0].reset();
                       $('#form-enquire-otp')[0].reset();
                       $("#otp-enquire-submit").html("Submit");
                       $("#cannotfind_feedback-submit").html("Submit");
                       $('#otp-enquire-submit').prop('disabled', false);
                       $('textarea').removeClass('is-valid');
                       $('#enquire_form_id').css('display', 'block');
                       $('.enquire_otp').hide();
                       $('#cannotfind_feedback-submit').prop('disabled', false);
        });

        @if (session()->has('q_success'))
            alert('Query saved successfully');
        @endif

    });
</script>
@endpush