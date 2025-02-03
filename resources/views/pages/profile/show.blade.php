@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="profile_edit">
                        <div class="profile_title">
                            <div id="profile">My Profile</div>
                        </div>
                        <div class="profile_section">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="student_profile">
                                        <div class="profile">
                                            <div class="profile_circle">
                                                <img class="profile-pic"
                                                     src="{{ $user['student']['image'] ? $user['student']['image'] : url('assets/images/avatar.png') }}">
                                            </div>
                                            <div class="p-image">
                                                <i class="fa fa-camera upload-button"></i>
                                                <form id="image-upload-form" method="POST"
                                                      action="{{ url('upload-profile-image') }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input class="file-upload" type="file" id="image"
                                                           name="image" accept="image/*" style="display: none;"
                                                           onchange="this.form.submit();">
                                                </form>
                                            </div>
                                        </div>
                                        <div class="student_name">{{ $user['student']['name'] }}</div>
                                        <!-- <a href="" class="edit_profile" id="edit_profile">Edit Profile</a> -->
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12">
                                        <div class="profile_list">
                                            <div class="profile_accordion" id="profile_accordion">
                                                <form id="update-personal-details" method="POST"
                                                      action="{{ url('profile/update') }}">
                                                    @csrf
                                                    <div class="item">
                                                    <div class="item-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link" type="button"
                                                                    data-toggle="collapse" data-target="#collapseOne"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                <h6>Personal Details:</h6>
                                                                <i class="fa fa-chevron-up"></i>
                                                            </button>
                                                            <img class="edit_personal" src="{{ asset('assets/new_ui_assets/images/dashboard/Edit.svg') }}" alt="">
                                                            <button type="submit" id="save_personal_details" class="save_changes d-none">Save</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show"
                                                         aria-labelledby="headingOne" data-parent="#profile_accordion">
                                                        <div class="personal_details">
                                                            <div class="form-group">
                                                                <label>Full Name*</label>
                                                                <input disabled type="text" name="name" id="full_name" pattern="^[a-zA-Z\s]*$" title="Only letters and space are allowed"
                                                                       placeholder="Full Name"
                                                                       value="{{ $user['student']['name'] }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Mobile No*</label>
                                                                <div class="m-num">
                                                                    <select disabled id="student_number" name="mobile_code">
                                                                        <option @if( $user['country_code']=="+91") selected
                                                                                @endif value="+91">+91
                                                                        </option>
                                                                        <option @if( $user['country_code']=="+971") selected
                                                                                @endif   value="+971">+971
                                                                        </option>
                                                                    </select>
                                                                    <input disabled type="tel" placeholder="Mobile No"
                                                                           name="phone"
                                                                           value="{{ $user['phone'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email Id*</label>
                                                                <input disabled type="email" placeholder="Email Id"
                                                                       name="email"
                                                                       value="{{ $user['email'] }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Age</label>
                                                                <input disabled type="text" id="student_profile_age"
                                                                       placeholder="Age" name="age"
                                                                       value="{{ $user['student']['age'] }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <form id="update-academic-details" method="POST"
                                                      action="{{ url('profile/update-academic-details') }}">
                                                    @csrf
                                                    <div class="item">
                                                        <div class="item-header" id="headingTwo">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link" type="button"
                                                                        data-toggle="collapse" data-target="#collapseTwo"
                                                                        aria-expanded="false" aria-controls="collapseTwo">

                                                                    <h6>Academic Information:</h6>
                                                                    <i class="fa fa-chevron-up"></i>

                                                                </button>
                                                                <img class="edit_academic" src="{{ asset('assets/new_ui_assets/images/dashboard/Edit.svg') }}" alt="">
                                                                <button type="submit" id="save_academic_details" class="save_changes d-none">Save
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                                             data-parent="#profile_accordion">
                                                            <div class="academic_information">
                                                                <div class="form-group">
                                                                    <label>Course*</label>
                                                                    <x-inputs.course disabled id="profile_course_id"
                                                                                     name="course_id"
                                                                                     class="form-control {{ old('form') == 'profile' && $errors->has('course_id') ? ' is-invalid' : '' }}">
                                                            
                                                                        @if(!empty(old('course_id', $user['student']['course_id'])))
                                                                            <option value="{{ old('course_id', $user['student']['course_id']) }}"
                                                                                    selected>{{ old('course_id_text', $user['student']['course']['name']) }}</option>
                                                                        @endif   

                                                                    </x-inputs.course>
                                                                    @if (old('form') == 'profile' && $errors->has('course_id'))
                                                                        <span class="invalid-feedback" role="alert"
                                                                              style="display: inline;">{{ $errors->first('course_id') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Level*</label>
                                                                    <x-inputs.level disabled id="profile_level_id"
                                                                                    name="level_id"
                                                                                    class="form-control {{ old('form') == 'profile' && $errors->has('level_id') ? ' is-invalid' : '' }}"
                                                                                    related="#profile_course_id">

                                                                        @if(!empty(old('level_id', $user['student']['level_id'])))
                                                                            <option value="{{ old('level_id', $user['student']['level_id']) }}"
                                                                                    selected>{{ old('level_id_text', $user['student']['level']['name']) }}</option>
                                                                        @endif

                                                                    </x-inputs.level>
                                                                    @if (old('form') == 'profile' && $errors->has('level_id'))
                                                                        <span class="invalid-feedback" role="alert"
                                                                              style="display: inline;">{{ $errors->first('level_id') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Year*</label>
                                                                    <select disabled id="attempt_year" name="attempt_year"
                                                                            class="js-states form-control"
                                                                            data-placeholder="Course">
                                                                        @for ($i = date('Y'); $i >= 2000; $i--)
                                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form id="update-student-address" method="POST"
                                                      action="{{ url('profile/update-student-address') }}">
                                                    @csrf
                                                      <div class="item">
                                                            <div class="item-header" id="headingThree">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link" type="button"
                                                                            data-toggle="collapse" data-target="#collapseThree"
                                                                            aria-expanded="false" aria-controls="collapseThree">

                                                                        <h6>Address 1:</h6>
                                                                        <i class="fa fa-chevron-up"></i>

                                                                    </button>
                                                                    <img class="edit_address" src="{{ asset('assets/new_ui_assets/images/dashboard/Edit.svg') }}" alt="">
                                                                    <button type="submit" id="save_address_details" class="save_changes d-none">Save
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapseThree" class="collapse show"
                                                                 aria-labelledby="headingThree"
                                                                 data-parent="#profile_accordion">
                                                                <div class="address">
                                                                    <div class="form-group">
                                                                        <label>Country*</label>
                                                                        <x-inputs.country disabled id="profile_country_id"
                                                                                          name="country_id"
                                                                                          class="form-control form-control-sm">

                                                                            @if(!empty(old('country_id', $user['student']['country_id'])))
                                                                                <option value="{{ old('country_id', $user['student']['country_id']) }}"
                                                                                        selected>{{ old('country_id_text', $user['student']['country']['name']) }}</option>
                                                                            @endif

                                                                        </x-inputs.country>
                                                                        @if (old('form') == 'profile' && $errors->has('country_id'))
                                                                            <span class="invalid-feedback" role="alert"
                                                                                  style="display: inline;">{{ $errors->first('country_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>State*</label>
                                                                        <x-inputs.state disabled id="profile_state_id"
                                                                                        name="state_id"
                                                                                        class="form-control form-control-sm {{ old('form') == 'profile' && $errors->has('state_id') ? ' is-invalid' : '' }}"
                                                                                        related="#profile_country_id">

                                                                            @if(!empty(old('state_id', $user['student']['state_id'])))
                                                                                <option value="{{ old('state_id', $user['student']['state_id']) }}"
                                                                                        selected>{{ old('state_id_text', $user['student']['state']['name']) }}</option>
                                                                            @endif
                                                                        </x-inputs.state>
                                                                        @if (old('form') == 'profile' && $errors->has('state_id'))
                                                                            <span class="invalid-feedback" role="alert"
                                                                                  style="display: inline;">{{ $errors->first('state_id') }}</span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>City*</label>
                                                                        <input disabled type="text" class="form-control"
                                                                               id="profile_city" name="city"
                                                                               value="{{ $user['student']['city'] }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Pincode*</label>
                                                                        <input disabled type="text" placeholder="Pincode"
                                                                               id="profile_pin" name="pin"
                                                                               value="{{ $user['student']['pin'] }}">
                                                                    </div>
                                                                    
                                                                    <div class="form-group full_addr">
                                                                        <label>Address</label>
                                                                        <input disabled type="text" id="profile_address"
                                                                               placeholder="Address" name="address"
                                                                               value="{{ $user['student']['address'] }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                      </div>
                                                </form>
                                                <div class="item">
                                                    <div class="item-header" id="headingFour">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link" type="button"
                                                                    data-toggle="collapse" data-target="#collapseFour"
                                                                    aria-expanded="false" aria-controls="collapseFour">

                                                                <h6>Favourites</h6>
                                                                <i class="fa fa-chevron-up"></i>

                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseFour" class="collapse show"
                                                         aria-labelledby="headingFour" data-parent="#profile_accordion">
                                                        <div class="favourites">
                                                            <div class="row">
                                                                @if(count($wishlists)== 0) <h6>No items available</h6>@endif
                                                                    @foreach($wishlists as $wishlist)
                                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                                            <div class="course">
                                                                                <div class="course-img">
                                                                                    <a style="text-decoration:none"
                                                                                       href="{{ url('packages/' . ($wishlist['package']['slug'] ?? $wishlist['package']['id'])) }}">
                                                                                        <img src="{{ $wishlist['package']['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $wishlist['package']['alt'] }}" title="{{ $wishlist['package']['title_tag'] }}"
                                                                                             loading="lazy">
                                                                                    </a>
                                                                                    <a class="cart-remove" href="#" data-id="{{ $wishlist['id'] }}">
                                                                                    <div class="favourite_delete cart-remove">
                                                                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/delete.svg') }}">
                                                                                    </div>
                                                                                        </a>
                                                                                </div>
                                                                                <div class="course-content p-3">
                                                                                    <a style="text-decoration:none"
                                                                                       href="{{ url('packages/' . ($wishlist['package']['slug'] ?? $wishlist['package']['id'])) }}">
                                                                                        <h3 style="min-height: 50px; max-height: 50px;">{{  \Illuminate\Support\Str::limit($wishlist['package']['name'], env('TRIM_SIZE'), $end='...')}}
                                                                                            </h3>
                                                                                    </a>

                                                                                    <div class="ratings">
                                                                                        @for($i=0; $i<$wishlist['package']['rating']; $i++)
                                                                                    <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                                                                        @endfor
                                                                                        <p>({{ $wishlist['package']['number_of_reviews'] ?? 0 }} Reviews)</p>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <p class="language_display">
                                                                                        <i class="fa fa-language"
                                                                                           aria-hidden="true"></i>
                                                                                        @if($wishlist['package']['language_id'] == 1)
                                                                                        <span class="english">English</span>
                                                                                        @elseif($wishlist['package']['language_id'] == 2)
                                                                                            <span class="hindi">Hindi</span>
                                                                                        @else
                                                                                            <span class="both">English + Hindi</span>
                                                                                        @endif
                                                                                    </p>
                                                                                    <p class="lecture">
                                                                                        <i class="fa fa-play-circle"
                                                                                           aria-hidden="true"></i>
                                                                                        <span>{{$wishlist['package']['total_videos']}} Lectures</span>
                                                                                    </p>

                                                                                    @if (!$wishlist['package']['is_prebook'] || $wishlist['package']['is_prebook_package_launched'] || $wishlist['package']['is_prebook_content_ready'])
                                                                                    <p class="time">
                                                                                        <i class="fa fa-clock-o"
                                                                                           aria-hidden="true"></i>
                                                                                    <span class="dur-time">
                                                                                        <small>
                                                                                            @if ($wishlist['package']['total_duration_formatted'])
                                                                                                {{ $wishlist['package']['total_duration_formatted']}} Hrs
                                                                                                @elseif($wishlist['package']['prebook_total_duration'])
                                                                                                    {{ $wishlist['package']['prebook_total_duration']}} Hrs
                                                                                                @endif
                                                                                        </small>
                                                                                    </span>
                                                                                    </p>
                                                                                    @endif

                                                                                    <div class="course-amount">
                                                                                        <h5>
                                                                                            <i class="fa fa-inr"
                                                                                               aria-hidden="true"></i>&nbsp;{{ number_format($wishlist['package']['selling_price'],2) }}</h5>
                                                                                        <h6>@if ($wishlist['package']['strike_prices'])
                                                                                                @foreach ($wishlist['package']['strike_prices'] as $price)
                                                                                                    <del>₹&nbsp;{{ number_format($price,2) }}</del>
                                                                                                @endforeach
                                                                                            @endif</h6>

                                                                                        @if($wishlist['package']['discount_percentage']!=0)
                                                                                            <span>{{ $wishlist['package']['discount_percentage'] }}%</span>
                                                                                        @endif

                                                                                    </div>
                                                                                    <div class="bottom_btns d-flex align-items-center justify-content-between">
                                                                                        <a href="{{ url('packages/' . $wishlist['package']['slug'] ?? $wishlist['package']['id'])}}" class="btn more">Know More</a>
                                                                                        <a href="{{ url('/cart/checkout?package=' . $wishlist['package']['id']) }}" class="btn enroll">Enroll Now</a>
                                                                                    </div>
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="item-header" id="headingFive">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link" type="button"
                                                                    data-toggle="collapse" data-target="#collapseFive"
                                                                    aria-expanded="false" aria-controls="collapseFive">

                                                                <h6>Session Log</h6>
                                                                <i class="fa fa-chevron-up"></i>

                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseFive" class="collapse show"
                                                         aria-labelledby="headingFive" data-parent="#profile_accordion">
                                                        <div class="session_log">
                                                            <div class="logs">
                                                                <div class="row">
                                                                    <div class="col-lg-2 col-md-6 col-sm-6">
                                                                        <div class="logs_inner">
                                                                            <h3>Session Date</h3>
                                                                            <h6>12 Aug 2021</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-6 col-sm-6">
                                                                        <div class="logs_inner">
                                                                            <h3>Session Login</h3>
                                                                            <h6>12.00 PM</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                                        <div class="logs_inner">
                                                                            <h3>Session Duration</h3>
                                                                            <h6>35:45:01</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-5 col-md-6 col-sm-6">
                                                                        <div class="logs_inner">
                                                                            <h3>Browser</h3>
                                                                            <h6>Chrome 90.44.30.212</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="logs_inner">
                                                                            <h3>Video Streamed</h3>
                                                                            <h6>Appointment & Remuneration of Managerial
                                                                                Personnel (AD-H)</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <!-- <button type="submit" id="save_changes" class="save_changes">Save--}}
{{--                                                </button> -->--}}
                                            </div>
                                        </div>
{{--                                    </form>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div class="modal fade" id="confirmdelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmdeletelabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" id="remove-id" data-id="">
                    <div class="delete_title mt-3 text-center font-weight-bold">Are you sure you want to delete ? </div>
                    <div class="delete_conf_btns d-flex align-items-center justify-content-center mt-5">
                        <button id="btn-delete-confirm" class="btn btn-success confirm mx-2">Confirm</button>
                        <button class="btn btn-secondary mx-2 btn-cancel-confirm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
<script type="text/javascript">
        $(".edit_personal").click(function (e) {
            e.preventDefault();
            $("#full_name").attr('disabled', false);
            $("#student_profile_age").attr('disabled', false);
            $(".edit_personal").addClass('d-none');
            $("#save_personal_details").removeClass('d-none');
        });
        $(".edit_academic").click(function (e) {
            e.preventDefault();
            $("#profile_course_id").attr('disabled', false);
            $("#profile_level_id").attr('disabled', false);
            $("#attempt_year").attr('disabled', false);
            $(".edit_academic").addClass('d-none');
            $("#save_academic_details").removeClass('d-none');
        });
        $(".edit_address").click(function (e) {
            e.preventDefault();
            $("#profile_pin").attr('disabled', false);
            $("#profile_city").attr('disabled', false);
            $("#profile_state_id").attr('disabled', false);
            $("#profile_country_id").attr('disabled', false);
            $("#profile_address").attr('disabled', false);
            $(".edit_address").addClass('d-none');
            $("#save_address_details").removeClass('d-none');

            // $("#image").removeAttr('disabled');
        });
    </script>
<script type="text/javascript">
    $(document).ready(function () {
        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function () {
            readURL(this);
        });

        $(".upload-button").on('click', function () {
            $(".file-upload").click();
        });
    });
</script>
<script id="abc">
    $(document).ready(function () {
        $("#upload").click(function () {
            $("#image").click();
        });

        $('#image').change(function () {
            let file = $(this).val();
            let extension = file.split('.').pop().toLowerCase();

            if (extension === 'jpg' || extension === 'jpeg' || extension === 'png') {
                $('#image-upload-form').submit();
            } else {
                alert('Only JPEG and PNG files are allowed!');
            }
        });

        $('#attempt_year').select2({
            placeholder: 'Hello'
        });

        $('#profile_country_id').change(function(){
            var country = $(this).val();
            if(country == 2){
                $('#profile_pin').val('00000');
                $('#profile_pin').attr('readonly', true);
            }else{
                $('#profile_pin').val('');
                $('#profile_pin').attr('readonly', false);
                }
        });
        
        jQuery.validator.addMethod("validate_city", function(value, element) {
            var reg = /^[0-9a-zA-Z_.\s-]*$/;
                if (reg.test(value)) {
                    return true;
                } else {
                    return false;
                }
        }, "Only letters, numbers,space, dot(period), hyphen and underscore are allowed");

        jQuery.validator.addMethod("validate_zipcode2", function(value, element) {
            var country = $('#profile_country_id').val();
            if( country ==2){
                    var reg2 = /^[0-9]{0,6}$/;
            }else{
                    var reg2 = /^[0-9]{6}$/;
                }

            if (reg2.test(value)) {
                return true;
            } else {
                    return false;
            }
        }, "Only 6 digits are allowed");

        jQuery.validator.addMethod("validate_address", function(value, element) {
            var reg = /^[a-zA-Z0-9,\s]*$/;
            if (reg.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Only letters, numbers, comma and space are allowed");

        jQuery.validator.addMethod("validate_user_name", function(value, element) {
            var reg = /^[a-zA-Z\s]*$/;
            if (reg.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Only letters and space are allowed");

        $('#update-personal-details').validate({
            onsubmit:false,
            rules: {
                name: {
                    required:true,
                    validate_user_name: true 
                },
                
                age: {
                    digits: true
                    }
            }
        });
        $("#save_personal_details").click(function (e) {
            e.preventDefault();
            let isValid = $('#update-personal-details').valid();
            if (isValid)
            { 
                $('#update-personal-details').submit();
            }
        });
        $('#update-student-address').validate({
            onsubmit:false,
            rules: {
                city: {
                    //validate_city:true
                    required:true,
                    lettersonly: true 
                },
                
                address: {
                    required: true,
                    validate_address:true
                },
                pin: {
                    required: true,
                    validate_zipcode2:true
                    }
            }
        });
        $("#save_address_details").click(function (e) {
            e.preventDefault();
            let isValid = $('#update-student-address').valid();
            if (isValid)
            { 
                $('#update-student-address').submit();
            }
        });

        // $("#save_changes").click(function (e) {
        //     e.preventDefault();
        //     var fullName = $("#full_name").val();
        //     var age = $("#student_profile_age").val();
        //     var course = $("#profile_course_id").val();
        //     var level = $("#profile_level_id").val();
        //     var year = $("#attempt_year").val();
        //     var pin = $("#profile_pin").val();
        //     var city = $("#profile_city").val();
        //     var state = $("#profile_state_id").val();
        //     var country = $("#profile_country_id").val();
        //     var aaddress = $("#profile_address").val();
        //     if (fullName == "" || fullName == null) {
        //         toastr.error('Name required');
        //     }
        //     if (age == "" || age == null) {
        //         toastr.error('Age required');
        //     }
        //     if (course == "" || course == null) {
        //         toastr.error('Course required');
        //     }
        //     if (level == "" || level == null) {
        //         toastr.error('Level required');
        //     }
        //     if (year == "" || year == null) {
        //         toastr.error('Year required');
        //     }
        //     if (pin == "" || pin == null) {
        //         toastr.error('Pin required');
        //     }
        //     if (city == "" || city == null) {
        //         toastr.error('City required');
        //     }
        //     if (state == "" || state == null) {
        //         toastr.error('State required');
        //     }
        //     if (country == "" || country == null) {
        //         toastr.error('Country required');
        //     }
        //     if (aaddress == "" || aaddress == null) {
        //         toastr.error('Address required');
        //     }
        //     if (fullName != "" || fullName != null && age != "" || age != null && course != "" || course != null && level != "" || level != null
        //             && year != "" || year != null && pin != "" || pin != null && city != "" || city != null && state != "" || state != null
        //             && country != "" || country != null && aaddress != "" || aaddress != null) {
        //         $("#profile-update").submit();
        //     }
        // });

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
        $('#update-email').click(function (e) {

            e.preventDefault();
            if (!$('#form-email-update').valid()) {
                return;
            }
            $('#send-mail').show();

            // If email is valid send otp to email
            $.ajax({
                type: 'POST',
                url: '{{ url('edit-student-email') }}',
                data: {'email': $('#updated_email').val()},
                success: function (data) {
                    $('#editEmailModal').modal('hide');
                    $('#modal-email-otp').modal('show');

                    //Verify OTP
                    $('#verify-otp-btn').click(function () {
                        var otp = $('#otp_code_value').val();
                        $.ajax({
                            type: 'POST',
                            url: '{{ url('verify-student-email-otp') }}',
                            data: {'otp': otp},
                            success: function (data) {
                                $('#otp').val("");

                                // If OTP is verified update email
                                if (data == 1) {
                                    $('#modal-email-otp').modal('hide');
                                    var new_email = $('#updated_email').val();
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ url('update-email') }}',
                                        data: {'email': new_email},
                                        success: function (data) {
                                            $('#email').val(new_email);
                                            $('#send-mail').hide();
                                            $('#updated_email').val('');
                                            $('#toast-email-updated').toast('show');
                                        }
                                    });
                                } else {
                                    $('#toast-verification-failed').toast('show');
                                }
                            }
                        });
                    });
                }
            });
        });

        {{--$('#profile-update').validate({--}}
        {{--    rules: {--}}
        {{--        name: {--}}
        {{--            required: true,--}}
        {{--            maxlength: 191--}}
        {{--        },--}}
        {{--        phone: {--}}
        {{--            required: true,--}}
        {{--            maxlength: function () {--}}
        {{--                if ($('#mobile-code').val() === '+91') {--}}
        {{--                    return 10;--}}
        {{--                } else {--}}
        {{--                    return 9;--}}
        {{--                }--}}
        {{--            },--}}
        {{--            minlength: function () {--}}
        {{--                if ($('#mobile-code').val() === '+91') {--}}
        {{--                    return 10;--}}
        {{--                } else {--}}
        {{--                    return 9;--}}
        {{--                }--}}
        {{--            },--}}
        {{--            --}}{{--remote: {--}}
        {{--            --}}{{--    url: '{{ url('validate-phone') }}',--}}
        {{--            --}}{{--    type: 'POST',--}}
        {{--            --}}{{--    data: {--}}
        {{--            --}}{{--        mobile: function() {--}}
        {{--            --}}{{--            if ($('#mobile-code').val() === '+91') {--}}
        {{--            --}}{{--                return '+91' + $('#phone').val();--}}
        {{--            --}}{{--            } else {--}}
        {{--            --}}{{--                return '+971' + $('#phone').val();--}}
        {{--            --}}{{--            }--}}
        {{--            --}}{{--        }--}}
        {{--            --}}{{--    }--}}
        {{--            --}}{{--}--}}
        {{--        },--}}
        {{--        email: {--}}
        {{--            required: true,--}}
        {{--            email: true,--}}
        {{--            maxlength: 191--}}
        {{--        },--}}
        {{--        age: {--}}
        {{--            required: true,--}}
        {{--            digits: true,--}}
        {{--            maxlength: 11--}}
        {{--        },--}}
        {{--        course_id: {--}}
        {{--            required: true--}}
        {{--        },--}}
        {{--        level_id: {--}}
        {{--            required: true--}}
        {{--        },--}}
        {{--        attempt_year: {--}}
        {{--            required: true--}}
        {{--        },--}}
        {{--        address: {--}}
        {{--            required: true,--}}
        {{--            maxlength: 191--}}
        {{--        },--}}
        {{--        city: {--}}
        {{--            required: true,--}}
        {{--            maxlength: 191--}}
        {{--        },--}}
        {{--        country_id: {--}}
        {{--            required: true--}}
        {{--        },--}}
        {{--        state_id: {--}}
        {{--            required: true--}}
        {{--        },--}}
        {{--        pin: {--}}
        {{--            required: true,--}}
        {{--            maxlength: 191--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}

        // $("#edit_profile").click(function (e) {
        //     e.preventDefault();
        //     $("#full_name").attr('disabled', false);
        //     $("#student_profile_age").attr('disabled', false);
        //     $("#profile_course_id").attr('disabled', false);
        //     $("#profile_level_id").attr('disabled', false);
        //     $("#attempt_year").attr('disabled', false);
        //     $("#profile_pin").attr('disabled', false);
        //     $("#profile_city").attr('disabled', false);
        //     $("#profile_state_id").attr('disabled', false);
        //     $("#profile_country_id").attr('disabled', false);
        //     $("#profile_address").attr('disabled', false);
        //     $("#image").removeAttr('disabled');
        // })

        $('.cart-remove').click(function (e) {

            let id = $(this).data('id');

            $('#btn-delete-confirm').attr('data-id', id);

            $('#confirmdelete').modal();
        });
        $('.btn-cancel-confirm').click(function (e) {

            $('#confirmdelete').modal('hide');
        });
        $('#btn-delete-confirm').click(function (e) {
            e.preventDefault();
//                        $('#confirmdelete').modal();
//                        let text = "Do you want to remove the package from cart?";


//                        if (confirm(text) == true) {
            let id = $(this).data('id');


            $.ajax({
                type:'DELETE',
                url:'{{ url('save-for-later') }}' + '/' + id,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success:function() {
                    location.reload();
                }
            });
//                        }

        });
    });
</script>
@endpush
