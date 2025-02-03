<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="author" content=" ">
    <meta name="generator" content=" ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    {{--Share Tags--}}
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="@yield('og_url')"/>
    <meta property="og:title" content="@yield('og_title')"/>
    <meta property="og:description" content="@yield('og_description')"/>
    <meta property="og:image" content="@yield('og_image')"/>

    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content="@yield('twitter_description')"/>
    <meta name="twitter:title" content="@yield('twitter_title')"/>
    <meta name="twitter:site" content="@yield('twitter_site')"/>
    <meta name="twitter:image" content="@yield('twitter_image')"/>
    {{--End Share Tags--}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dist/img/favicon.ico') }}"/>
{{--    <link rel="stylesheet" href="{{ asset('dist/css/app.min.css') }}"/>--}}
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('dist/css/screen.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/responsive.css') }}" rel="stylesheet">
    <style>
        .popup-form span.error{
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }

        #loginmodal .password {
            display:inline-flex;
        }

        #loginmodal #togglePassword {
            margin-left: -47px;
            cursor: pointer;
            margin-top: 4px;
            width: 30px;
        }

        .r_password {
            display:inline-flex;
        }

        #r_togglePassword {
            margin-left: -47px;
            cursor: pointer;
            margin-top: 4px;
            width: 30px;
        }

        .rc_password {
            display:inline-flex;
        }

        #rc_togglePassword {
            margin-left: -47px;
            cursor: pointer;
            margin-top: 4px;
            width: 30px;
        }

    </style>
    @stack('styles')
</head>

<body>
    @include('frontend.includes.header')
    @yield('content')
    @include('frontend.includes.footer')
    @guest('user')
    @include('frontend.popups.login')
    @include('frontend.popups.register')
    @include('frontend.popups.forgot')
    @if (Session::has('forgot'))
        @include('frontend.popups.reset')
    @endif
    @endguest
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/all.min.js') }}"></script>
    <script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(".name").keypress(function (event) {
                var inputValue = event.which;
                //Allow letters, white space, backspace and tab.
                //Backspace ASCII = 8
                //Tab ASCII = 9
                if (!(inputValue >= 65 && inputValue <= 123)
                    && (inputValue != 32 && inputValue != 0)
                    && (inputValue != 48 && inputValue != 8)
                    && (inputValue != 9)){
                    event.preventDefault();
                }
                console.log(inputValue);
            });

            $('#announcement-slider').owlCarousel({
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
                .css({
                    "text-align": "center",
                });
        })

        $(document).ready(function() {
            $('#archievement-slider').owlCarousel({
                margin: 50,
                nav: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 2
                    }
                }
            })
        })
        $(document).ready(function() {
            $('#testimonial-slider').owlCarousel({
                margin: 0,
                nav: true,
                center: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        });
    function myFunction() {
        var type =  $('#loginmodal #password').attr('type') === 'password' ? 'text' : 'password';
        var icon =  $('#loginmodal #password').attr('type') === 'password' ? '.hide' : '.show';
        $('#loginmodal #password').attr('type', type);
        $('#loginmodal #togglePassword').hide();
        $('#loginmodal '+icon).show();
        // this.classList.toggle('fa-eye-slash');
    }

    function myFunctionR() {
        var type =  $('#r_password').attr('type') === 'password' ? 'text' : 'password';
        var icon =  $('#r_password').attr('type') === 'password' ? '.r_hide' : '.r_show';
        $('#r_password').attr('type', type);
        $('#r_togglePassword').hide();
        $(+icon).show();
        // this.classList.toggle('fa-eye-slash');
    }

    function myFunctionRC() {
        var type =  $('#rc_password').attr('type') === 'password' ? 'text' : 'password';
        var icon =  $('#rc_password').attr('type') === 'password' ? '.rc_hide' : '.rc_show';
        $('#rc_password').attr('type', type);
        $('#rc_togglePassword').hide();
        $(+icon).show();
        // this.classList.toggle('fa-eye-slash');
    }

    $(document).ready(function() {

        @if(Session::has('isLogin') && Session::get('isLogin') == 1)

        $('#loginmodal').modal('show');
        @endif

    function checkloginValidation() {
        $("#login_form").validate({
            errorElement: "span",
        });
    }

    $('.loginbtn').click(function() {
    // $('.error').css('display','block')
    var email = $('#email').val();
    var password = $('#password').val();
    var token = $('[name="_token"]').val();
    checkloginValidation();
    if (!$('#login_form').valid()) {
        return false;
    }

    $.ajax({
        url: "{{ route('login') }}",
        type: "POST",
        data: {
            'email':email,'password':password,'_token':token
        },
        success: function(response) {
            // console.log(response);
            if (response == 1) {
              window.location.reload();
            } else {
                $('.error').show();
                setTimeout(function (){ $('.error').hide(); }, 3000);
            }
        }
    });

    });

    function checkRegisterValidation(form_type='') {
            $("#"+form_type).validate({
            errorElement: "span",
        });
    }
    $('.registerbtn').click(function() {
    $('.error-bag').hide();
    // $('.error').css('display','block')
    var token   = $('[name ="_token"]').val();
    var board   = $(".tab-content div.active #board").val();
    var grade   = $(".tab-content div.active #grade").val();
    var fname   = $('.tab-content div.active #fname').val();
    var lname   = $('.tab-content div.active #lname').val();
    var email   = $(".tab-content div.active #email").val();
    var mobile  = $(".tab-content div.active #mobile").val();
    var dob     = $(".tab-content div.active #dob").val();
    var p_fname = $(".tab-content div.active #p_fname").val();
    var p_lname = $(".tab-content div.active #p_lname").val();
    var p_email = $(".tab-content div.active #p_email").val();
    var p_mobile= $(".tab-content div.active #p_mobile").val();
    var city    = $(".tab-content div.active #city").val();
    var state   = $(".tab-content div.active #state").val();
    var school_name= $(".tab-content div.active #school_name").val();
    var affiliation = $('#affiliation').val();
    var field1          = $('#field1').val();
    var field2          = $('#field2').val();
    var district        = $('#district').val();
    var pinCode         = $('#pinCode').val();
    var school_email    = $('#school_email').val();
    var school_mobile   = $('#school_mobile').val();
    var principle_name  = $('#principle_name').val();
    var principle_email = $('#principle_email').val();
    var principle_mobile= $('#principle_mobile').val();
    var terms = $('#terms').val();

    var user_type = $(".justify-content-around a.active").attr('data-type')
    if(user_type == 'student'){ var form_type = 'student_form'; }
    if(user_type == 'parent') { var form_type = 'parent_form';  }
    if(user_type == 'school') { var form_type = 'school_form';  }

    checkRegisterValidation(form_type);
    if (!$('#'+form_type).valid()) {
        return false;
    }
    if(email == p_email){
        $('.error-bag').text('Student And Parent Email Id cannot be same.').show();
        return false;
    }
    if(mobile == p_mobile){
        $('.error-bag').text('Student And Parent Mobile No cannot be same.').show();
        return false;
    }
    // $('form').serialize()
    $.ajax({
        url: "{{ route('register') }}",
        type: "POST",
        data: {
            '_token':token,
            'user_type':user_type,
            'board':board,
            'grade':grade,
            'fname':fname,
            'lname':lname,
            'email':email,
            'mobile':mobile,
            'dob':dob,
            'p_fname':p_fname,
            'p_lname':p_lname,
            'p_email':p_email,
            'p_mobile':p_mobile,
            'city':city,
            'state':state,
            'school_name':school_name,
            'affiliation':affiliation,
            'field1':field1,
            'field2':field2,
            'district':district,
            'pinCode':pinCode,
            'school_email':school_email,
            'principle_name':principle_name,
            'school_mobile':school_mobile,
            'principle_name':principle_name,
            'principle_email':principle_email,
            'principle_mobile':principle_mobile,
        },
        success: function(response) {
            console.log(response);
            if (response == 1) {
                $('#signupmodal').modal('hide');
                $('#loginmodal').modal('show');
                $('#loginmodal #reg-msg').show();
                setTimeout(function (){ $('#loginmodal #reg-msg').hide(); }, 5000);
            }else {
                $('.error').css('display','block')
            }
        },
        error : function($xhr,textStatus,errorThrown){
            var data = $xhr.responseJSON.errors;
            // console.log(data.errors);
            var bag = "<ul>";
            $.each(data, function (key, value){

                bag += "<li><strong>"+key+":</strong> "+value+"</li>";

            });
            bag += "</ul>";
            $('.error-bag').html(bag);
            $('.error-bag').show();
            $('.error-bag ul').css('margin-bottom', '0px');
            setTimeout(function (){
                $('.error-bag').hide();
                $('.error-bag').html('');
            }, 5000)
        }
    });

    });

    $('#forgotclick').click(function() {
        $('#loginmodal').modal('hide');
        $('#forgotmodel').modal('show');
    });

    $('.singbtn').click(function() {
        $('#loginmodal').modal('hide');
        $('#signupmodal').modal('show');
    });

    $('.forgotbtn').click(function() {
        $('.f_error').hide();
        checkRegisterValidation("forgot_form");
        if (!$('#forgot_form').valid()) {
            return false;
        }
        var token   = $('[name ="_token"]').val();
        var email   = $("#f_email").val();
        $.ajax({
        url: "{{ route('ajax.forgot') }}",
        type: "POST",
        data: {
            '_token':token,
            'email':email,
        },
        success: function(response) {
            if (response.code === 1) {
                $('.f_error').text(response.status).show().css("color","green");
            } else {
                $('.f_error').text(response.status).show();
            }
            setTimeout(function (){ $('.f_error').hide(); }, 3000);
        }
    });
    });

    function checkResetValidation() {
        $("#reset_form").validate({
            rules : {
                r_password : {
                    minlength : 8
                },
                rc_password : {
                    minlength : 8,
                    equalTo : "#r_password"
                }
            },
            errorElement: "span",
            // errorPlacement: function(error, element) {
            //     error.appendTo(element.parents('.head'));
            // }
        });
    }
    $('.resetbtn').click(function() {
        $('.r_error').hide();
        checkResetValidation();
        if (!$('#reset_form').valid()) {
            return false;
        }
        var _token   = $('[name ="_token"]').val();
        var token   = $('#reset-token').val();
        var email   = $("#reset-email").val();
        var password   = $("#rc_password").val();
        $.ajax({
            url: "{{ route('ajax.reset') }}",
            type: "POST",
            data: {
                '_token':_token,
                'token':token,
                'email':email,
                'password':password
            },
            success: function(response) {
                if (response.code === 1) {
                    $('.r_error').text(response.status).show().css("color","green");
                    $('#resetmodal').modal('hide');
                    $('#loginmodal').modal('show');
                } else {
                    $('.r_error').text(response.status).show();
                }
                setTimeout(function (){ $('.r_error').hide(); }, 3000);
            }
        });
    });
    });

    @if (Session::has('forgot'))
    $(document).ready(function(){
        $('#resetmodal').modal('toggle');
    });
    @endif
    </script>
    @stack('scripts')
</body>
</html>
