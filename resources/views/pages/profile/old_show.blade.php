@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>My Profile</b></h3>
            <a href="{{ url('contents') }}"><i class="far fa-arrow-alt-circle-left fa-2x text-secondary"></i></a>
            <div class="row mt-3">
                @include('includes.student-menu')
                {{--                <div class="col-md-auto student-profile-menu">--}}
                {{--                    <div class="student-profile-menu-content border shadow">--}}
                {{--                        <div class="student-profile-menu-image-container">--}}
                {{--                            <img src="{{ $user['student']['image'] ? $user['student']['image'] : url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">--}}
                {{--                        </div>--}}
                {{--                        <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>--}}
                {{--                        <form id="image-upload-form" method="POST" action="{{ url('upload-profile-image') }}" enctype="multipart/form-data">--}}
                {{--                            @csrf--}}
                {{--                            <input type="file" id="image" name="image" style="display: none;" onchange="this.form.submit();"/>--}}
                {{--                            <input type="hidden" name="hello">--}}
                {{--                        </form>--}}
                {{--                        <ul class="list-group">--}}
                {{--                            <li class="list-group-item"><a href="{{ url('profile') }}">Profile</a></li>--}}
                {{--                            <li class="list-group-item"><a href="{{ url('j-money') }}">J-Money</a></li>--}}
                {{--                            <li class="list-group-item">Notification</li>--}}
                {{--                            <li class="list-group-item">Privacy</li>--}}
                {{--                            <form id="logout" method="POST" action="/logout">--}}
                {{--                                @csrf--}}
                {{--                                <li class="list-group-item"><a href="#" onclick="document.getElementById('logout').submit();">Log Out</a></li>--}}
                {{--                            </form>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <form id="profile-update" class="p-5" method="POST" action="{{ url('profile/update') }}">
                            @csrf
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="name" class="form-control" name="name" value="{{ $user['student']['name'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mobile</label>
                                <div class="input-group-prepend">
                                    <div class="col-md-4">
                                        <select id="mobile-code" class="custom-select"  name="mobile_code">
                                            <option @if( $user['student']['country_code']=="+91") selected @endif value="+91">+91</option>
                                            <option  @if( $user['student']['country_code']=="+971") selected @endif   value="+971">+971</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" disabled class="form-control" name="phone" value="{{ $user['student']['phone'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">E-Mail ID*</label>
                                <div class="col-sm-5">
                                    <input type="email" id="email" disabled class="form-control" name="email" value="{{ $user['student']['email'] }}">
                                </div>
                                <div class="col-sm-2 mt-1">
                                    <i class="fas fa-edit" id="edit-email" data-toggle="modal" data-target="#editEmailModal" style="font-size: 20px;"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="age" value="{{ $user['student']['age'] }}">
                                </div>
                            </div>
                            <hr class="my-5">

                            <div class="form-group row">
                                <label for="profile_course_id" class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-6">
                                    <x-inputs.course id="profile_course_id" name="course_id" class="form-control {{ old('form') == 'profile' && $errors->has('course_id') ? ' is-invalid' : '' }}">

                                        @if(!empty(old('course_id', $user['student']['course_id'])))
                                            <option value="{{ old('course_id', $user['student']['course_id']) }}" selected>{{ old('course_id_text', $user['student']['course']['name']) }}</option>
                                        @endif

                                    </x-inputs.course>
                                    @if (old('form') == 'profile' && $errors->has('course_id'))
                                        <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('course_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_level_id" class="col-sm-2 col-form-label">Level</label>
                                <div class="col-sm-6">
                                    <x-inputs.level id="profile_level_id" name="level_id" class="form-control {{ old('form') == 'profile' && $errors->has('level_id') ? ' is-invalid' : '' }}" related="#profile_course_id">

                                        @if(!empty(old('level_id', $user['student']['level_id'])))
                                            <option value="{{ old('level_id', $user['student']['level_id']) }}" selected>{{ old('level_id_text', $user['student']['level']['name']) }}</option>
                                        @endif

                                    </x-inputs.level>
                                    @if (old('form') == 'profile' && $errors->has('level_id'))
                                        <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('level_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Attempt Year</label>
                                <div class="col-sm-6">
                                    <select id="attempt-year" name="attempt_year" class="form-control select2">
                                        @for ($i = date('Y'); $i >= 2000; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address" value="{{ $user['student']['address'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="city" value="{{ $user['student']['city'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_country_id" class="col-sm-2 col-form-label {{ old('form') == 'profile' && $errors->has('country_id') ? ' is-invalid' : '' }}">Country</label>
                                <div class="col-sm-6">
                                    <x-inputs.country id="profile_country_id" name="country_id" class="form-control form-control-sm">

                                        @if(!empty(old('country_id', $user['student']['country_id'])))
                                            <option value="{{ old('country_id', $user['student']['country_id']) }}" selected>{{ old('country_id_text', $user['student']['country']['name']) }}</option>
                                        @endif

                                    </x-inputs.country>
                                    @if (old('form') == 'profile' && $errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_state_id" class="col-sm-2 col-form-label {{ old('form') == 'profile' && $errors->has('country_id') ? ' is-invalid' : '' }}">State</label>
                                <div class="col-sm-6">
                                    <x-inputs.state id="profile_state_id" name="state_id" class="form-control form-control-sm {{ old('form') == 'profile' && $errors->has('state_id') ? ' is-invalid' : '' }}" related="#profile_country_id">

                                        @if(!empty(old('state_id', $user['student']['state_id'])))
                                            <option value="{{ old('state_id', $user['student']['state_id']) }}" selected>{{ old('state_id_text', $user['student']['state']['name']) }}</option>
                                        @endif

                                    </x-inputs.state>
                                    @if (old('form') == 'profile' && $errors->has('state_id'))
                                        <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('state_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Pin</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="pin" value="{{ $user['student']['pin'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-default btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade"  id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="editEmailModalLabel"  aria-hidden="true">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-otp-title">Update Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-email-update" name="form-email-update">
                        @csrf
                        <div class="form-group">
                            <input placeholder="Email"  type="email"  class="form-control" id="updated_email" name="updated_email">
                        </div>
                        <div class="form-group">
                            <p>An OTP will be sent your email.</p>
                            <small class="secondary" id="send-mail">Sending email...</small>
                        </div>

                        <div class="form-group mt-4">
                            <button id="update-email" type="submit" class="btn btn-block btn-primary" >OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-email-otp" tabindex="-1" role="dialog" aria-labelledby="modal-otp-title"
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
                        <span>Please enter verification code just sent to your email</span><br />
                    </p>
                    <form id="form-otp" >
                        <div class="form-group">
                            <input placeholder="Verification Code" maxlength="4" type="text" class="form-control" id="otp_code_value" name="otp_code_value">
                        </div>
                        {{--                        <div class="form-group clearfix text-center pb-4">--}}
                        {{--                            <span id="resend_text">Didn't get? <a id="resend" class="ml-md-auto" href="#">Resend</a></span><span style="display: none" id="timer">30</span>--}}
                        {{--                        </div>--}}

                        <div class="form-group mt-4">
                            <!--<button type="button" class="btn btn-block btn-primary">Login</button>-->
                            <button id="verify-otp-btn" type="button" class="btn btn-block btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{--    <div class="modal fade"  id="updateEmail" tabindex="-1" role="dialog" aria-labelledby="updateEmailModalLabel"  aria-hidden="true">--}}
    {{--        <div class="modal-dialog modal-login" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header border-0">--}}
    {{--                    <h5 class="modal-title text-secondary text-uppercase" id="modal-otp-title">Update Email</h5>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                        <span aria-hidden="true">&times;</span>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <form id="form-otp">--}}
    {{--                        @csrf--}}
    {{--                        <div class="form-group">--}}
    {{--                            <input placeholder="New email" type="email" class="form-control" id="new_email" name="new_email">--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group mt-4">--}}
    {{--                            <button id="update-new-mail" data-dismiss="modal" type="button" class="btn btn-block btn-primary" >OK</button>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection

@push('script')
    <script id="abc">
        $(document).ready(function(){
            $("#upload").click(function(){
                $("#image").click();
            });

            $('#image').change(function() {
                let file = $(this).val();
                let extension = file.split('.').pop().toLowerCase();

                if (extension === 'jpg' || extension === 'jpeg' || extension === 'png') {
                    $('#image-upload-form').submit();
                } else {
                    alert('Only JPEG and PNG files are allowed!');
                }
            });

            $('#attempt-year').select2({
                placeholder: 'Hello'
            });

            $('#form-email-update').validate({
                rules: {
                    updated_email: {
                        required: true,
                        email: true,
                        remote: {
                            url: '{{ url('validate-email') }}',
                            type: 'POST',
                            data: {
                                email: function () {
                                    return $('#updated_email').val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    updated_email: {
                        remote: 'Email already exist'
                    }
                },
            });

            // $('#form-email-update').submit(function (e) {
            //     e.preventDefault();
            //     console.log('submit');
            // });
            $('#send-mail').hide();
            $('#update-email').click(function(e){

                e.preventDefault();
                if (!$('#form-email-update').valid()) {
                    return;
                }
                $('#send-mail').show();

                // If email is valid send otp to email
                $.ajax({
                    type:'POST',
                    url:'{{ url('edit-student-email') }}',
                    data:{'email':$('#updated_email').val()},
                    success:function(data) {
                        $('#editEmailModal').modal('hide');
                        $('#modal-email-otp').modal('show');

                        //Verify OTP
                        $('#verify-otp-btn').click(function(){
                            var otp = $('#otp_code_value').val();
                            $.ajax({
                                type:'POST',
                                url:'{{ url('verify-student-email-otp') }}',
                                data:{'otp':otp},
                                success:function(data) {
                                    $('#otp').val("");

                                    // If OTP is verified update email
                                    if(data == 1){
                                        $('#modal-email-otp').modal('hide');
                                        var new_email = $('#updated_email').val();
                                        $.ajax({
                                            type:'POST',
                                            url:'{{ url('update-email') }}',
                                            data:{'email':new_email},
                                            success:function(data) {
                                                $('#email').val(new_email);
                                                $('#send-mail').hide();
                                                $('#updated_email').val('');
                                                $('#toast-email-updated').toast('show');
                                            }
                                        });
                                    }else{
                                        $('#toast-verification-failed').toast('show');
                                    }
                                }
                            });
                        });
                    }
                });
            });

            {{--$('#resend').click(function(){--}}
            {{--    $.ajax({--}}
            {{--        type:'POST',--}}
            {{--        url:'{{ url('edit-student-email') }}',--}}
            {{--        success:function(data) {--}}
            {{--            $('#modal-email-otp').modal('show');--}}
            {{--            $('#verify-otp-btn').click();--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}

            $('#profile-update').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
                    phone: {
                        required: true,
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
                        {{--remote: {--}}
                        {{--    url: '{{ url('validate-phone') }}',--}}
                        {{--    type: 'POST',--}}
                        {{--    data: {--}}
                        {{--        mobile: function() {--}}
                        {{--            if ($('#mobile-code').val() === '+91') {--}}
                        {{--                return '+91' + $('#phone').val();--}}
                        {{--            } else {--}}
                        {{--                return '+971' + $('#phone').val();--}}
                        {{--            }--}}
                        {{--        }--}}
                        {{--    }--}}
                        {{--}--}}
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 191
                    },
                    age: {
                        required: true,
                        digits: true,
                        maxlength: 11
                    },
                    course_id: {
                        required: true
                    },
                    level_id: {
                        required: true
                    },
                    attempt_year: {
                        required: true
                    },
                    address: {
                        required: true,
                        maxlength: 191
                    },
                    city: {
                        required: true,
                        maxlength: 191
                    },
                    country_id: {
                        required: true
                    },
                    state_id: {
                        required: true
                    },
                    pin: {
                        required: true,
                        maxlength: 191
                    }
                }
            });
        });
    </script>
@endpush
