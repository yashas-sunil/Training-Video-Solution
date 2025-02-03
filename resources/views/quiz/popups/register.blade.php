<!---Signup Modal-->
<div class="modal fade bd-example-modal-lg" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body signup-popbody">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="singupform">
                    <h2>SIGNUP</h2>
                    <div class="signupforminner">
                        <div class="popuptab">
                            <ul class="nav nav-tabs d-flex justify-content-around align-items-center" id="signuptab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link check_tab active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true" data-type="student" value="1">Student / Parent</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link check_tab" id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="school" aria-selected="false" data-type="school">School</a>
                                </li>
                            </ul>
                        </div>
                        <div class="poptabcontant">

                            <div class="tab-content" id="signuptabContent" style="width: 100%">
                                <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab" style="background-color: transparent !important;">
                                <div class="error-bag alert alert-danger" style="display: none;"></div>
                                    <form id="student_form"  class="needs-validation popup-form" novalidate>
                                        <div class="row" style="margin-left: -10px;">
                                            <div class="col-sm-6">
                                                <div class="form-group form-row ">
                                                    <label for="board" class="col-sm-3 col-form-label"> Board</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control required" id="board" name="board">
                                                            @foreach(\App\Models\Board::all() as $board)
                                                                <option value="{{ $board->id }}">{{ $board->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row ">
                                                    <label for="grade" class="col-sm-3 col-form-label" \>Grade</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control required"id="grade" name="grade">
                                                            @foreach(\App\Models\Grade::all() as $grade)
                                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control required name" id="fname" name="fname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control required name" id="lname" name="lname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="email" class="col-sm-3 col-form-label">Your Email ID</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control required" id="email" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control required" id="mobile" name="mobile" min="0" minlength="10" maxlength="10">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control required" id="dob" name="dob" min="1900-01-01" max="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="perentdtls">
                                            <div class="row" style="margin-left:-10px;">
                                                <div class="col-sm-12">
                                                    <h4>Parent’s Details</h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="p_fname" class="col-sm-3 col-form-label">First Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required name" id="p_fname" name="p_fname">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="p_lname" class="col-sm-3 col-form-label">Last Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required name" id="p_lname" name="p_lname">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="p_email" class="col-sm-3 col-form-label">Parents Email ID</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control required" id="p_email" name="p_email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="p_mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control required" id="p_mobile" name="p_mobile" min="0" minlength="10" maxlength="10">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="perentdtls">
                                            <div class="row" style="margin-left:-10px;">
                                                <div class="col-sm-12 no-gutters" style="display: none">
                                                    <h4>School Details</h4>
                                                </div>
                                                <div class="col-sm-6" style="display: none">
                                                    <div class="form-group form-row">
                                                        <label for="city" class="col-sm-3 col-form-label">City</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="city" name="city">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6" style="display: none">
                                                    <div class="form-group form-row">
                                                        <label for="state" class="col-sm-3 col-form-label">State</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="state" name="state">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6" style="display: none">
                                                    <div class="form-group form-row">
                                                        <label for="school_name" class="col-sm-3 col-form-label">School Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" id="school_name" name="school_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 termssec">
                                                    <input type="checkbox" class="overflow-control-input required" name="terms" id="terms" value="1" required="required">Terms and conditions agreement.
{{--                                                    <label class="custom-control overflow-checkbox">--}}
{{--                                                        <span class="overflow-control-indicator"></span>--}}
{{--                                                        <span class="overflow-control-description">Terms and conditions agreement.</span>--}}
{{--                                                    </label>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="formbtnsec text-left ml-auto">
                                            <button class="btn btn-primary registerbtn" type="button">Signup</button>
                                        </div>
                                    </form>


                                </div>
                                <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
                                    <form id="school_form"  class="needs-validation" novalidate>
                                        <div class="row" style="margin-left:-10px;">
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="school_name" class="col-sm-3 col-form-label">School Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control required" id="school_name" name="school_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="board" class="col-sm-3 col-form-label">Board</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control required" id="board" name="board">
                                                            @foreach(\App\Models\Board::all() as $board)
                                                                <option value="{{ $board->id }}">{{ $board->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <label for="affiliation" class="col-sm-3 col-form-label">Affiliation number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control required" id="affiliation" name="affiliation">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="perentdtls">
                                            <div class="row" style="margin-left:-10px;">
                                                <div class="col-sm-12 no-gutters">
                                                    <h4>Address</h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="field1" class="col-sm-3 col-form-label">Address Field 1</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="field1" name="field1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="field2" class="col-sm-3 col-form-label">Address Field 2</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="field2" name="field2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="state" class="col-sm-3 col-form-label">State</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="state" name="state">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="city" class="col-sm-3 col-form-label">City</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="city" name="city">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="district" class="col-sm-3 col-form-label">District</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="district" name="district">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="pinCode" class="col-sm-3 col-form-label">Pin Code</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="pinCode" name="pinCode">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-left:-10px;">
                                                <div class="col-sm-12 no-gutters">
                                                    <h4>School Details</h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="school_email" class="col-sm-3 col-form-label">School Email ID</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control required" id="school_email" name="school_email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="school_mobile" class="col-sm-3 col-form-label">Phone Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control required" id="school_mobile" name="school_mobile" min="0" minlength="10" maxlength="10">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-left:-10px;">
                                                <div class="col-sm-12 no-gutters">
                                                    <h4>Principal Details</h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="principle_name" class="col-sm-3 col-form-label">Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required name" id="principle_name" name="principle_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="principle_email" class="col-sm-3 col-form-label">Email ID</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control required" id="principle_email" name="principle_email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-row">
                                                        <label for="principle_mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control required" id="principle_mobile" name="principle_mobile" min="0" minlength="10" maxlength="10">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 termssec">
                                                    <label class="custom-control overflow-checkbox">
                                                        <input type="checkbox" class="overflow-control-input required">
                                                        <span class="overflow-control-indicator"></span>
                                                        <span class="overflow-control-description">Terms and conditions agreement.</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="formbtnsec text-left ml-auto">
                                            <button class="btn btn-primary registerbtn" type="button">Signup</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!---/Signup Modal-->
