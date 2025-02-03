<div class="modal fade" id="modal-refer-and-earn" tabindex="-1" role="dialog" aria-labelledby="modal-refer-and-earn-title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-refer-and-earn" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-secondary" id="modal-refer-and-earn">Refer & Earn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="refer-and-earn-container">
                    <div id="refer-and-earn-form-container">
                        <form id="form-refer-and-earn">
                            @csrf
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="referral-name" class="col-sm-5 col-form-label col-form-label-sm">Name of the referral</label>

                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm input-sm" id="referral-name" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="referral-phone" class="col-sm-5 col-form-label col-form-label-sm">Contact details of referral</label>
                                        <div class="col-sm-2">
                                            <select id="mobile" class="form-control-sm bg-white" name="mobile_code">
                                                <option selected value="+91">+91</option>
                                                <option value="+971">+971</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control form-control-sm input-sm" id="referral-phone" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="referral-email" class="col-sm-5 col-form-label col-form-label-sm">Email address of referral</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm input-sm" id="referral-email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="refer_and_earn_course_id-city" class="col-sm-5 col-form-label col-form-label-sm">Course</label>
                                        <div class="col-sm-7">
                                            <x-inputs.course id="refer_and_earn_course_id" name="course_id" class="form-control form-control-sm {{ old('form') == 'refer_and_earn' && $errors->has('course_id') ? ' is-invalid' : '' }}">
                                                @if(old('form') == 'refer_and_earn' && !empty(old('course_id')))
                                                    <option value="{{ old('course_id') }}" selected>{{ old('course_id_text') }}</option>
                                                @endif
                                            </x-inputs.course>
                                            @if (old('form') == 'refer_and_earn' && $errors->has('course_id'))
                                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('course_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="referral-city" class="col-sm-5 col-form-label col-form-label-sm">City</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm input-sm" id="referral-city" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="referral-state" class="col-sm-5 col-form-label col-form-label-sm">State</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm input-sm" id="referral-state" name="state">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <div class="form-group mt-2">
                                        <div class="form-check">
                                            <input checked class="form-check-input" type="checkbox" id="referral-terms" name="terms">
                                            <label class="form-check-label" for="referral-terms">
                                                By clicking Submit, you agree to our <a href="{{ url('terms/')}}">Terms & Conditions and Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <button type="submit" class="btn btn-primary px-4 refer-and-earn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(function () {
            $('#refer-and-earn').on('click', function() {
                $('#modal-refer-and-earn').modal('show');
            });

            $('#form-refer-and-earn').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
//                    phone: {
//                        required: true,
//                        digits: true,
//                        maxlength: 191
//                    },
                    phone: {
                        required: true,
                        maxlength: function() {
                            if ($('#mobile').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#mobile').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    course_id: {
                        required: true
                    },
                    city: {
                        maxlength: 191
                    },
                    state: {
                        maxlength: 191
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    terms: {
                        required: "You must agree our terms & condition to refer and earn"
                    }
                }
            });

            $('#form-refer-and-earn').on('submit', function(e) {
               // $('.refer-and-earn-submit').prop('disabled', true);
                let isValid = $('#form-refer-and-earn').valid();
                if (isValid) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('referrals.store') }}',
                        data: $(this).serialize(),
                        success:function(data) {
                            if (data.exist) {
                                alert('You can only refer once a friend')
                            } else {
                                $('.refer-and-earn-submit').prop('disabled', false);
                                $('#refer-and-earn-form-container').remove();
                                $('#refer-and-earn-container').append(
                                    `<div class="text-center">
                                        <i class="fas fa-envelope fa-7x text-success"></i>
                                        <h3>Invitation link successfully sent.</h3>
                                    </div>`
                                );
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
