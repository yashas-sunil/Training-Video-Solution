@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <main class="orders px-md-5 px-sm-5" role="main">
        <div id="facebookPixelNoScriptAddPaymentInfoontainer" style="display: none;"></div>
        <form id="form-create-order" method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="pendrive_price" id="input-pendrive-price" value="">
            <input type="hidden" name="checked_study_materials" id="checked-study-materials">
            <input type="hidden" name="address_id" id="address-id">
            <div class="container-fluid py-4 px-md-5">
                <div class="bg-diamond bg-diamond-left">
                    <div class="bg-diamond-lg checkout-diamond"></div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-12">
                            <h2 class="text-secondary mt-lg-5"><b>Order List</b></h2>
                        </div>
                        <div class="col-md-12">
                            <div class="p-2 p-md-4 bg-secondary-10">
                                <div class="row no-gutters ">
                                    <div class="col-md-8 d-none d-sm-block mb-3">
                                        <h5>Content Order List</h5>
                                    </div>
                                    <div class="col-md-2 d-none d-sm-block mb-3">
                                        <h5>
                                            Content Delivery
                                        </h5>
                                    </div>
                                    <div class="col-md-2 d-none d-sm-block mb-3">
                                        <h5>
                                            Study Material
                                        </h5>
                                    </div>
                                </div>
                                <div class="order-items mt-2">
                                    @foreach($cart['items'] as $cartItem)
                                        <div class="order-item row  align-items-center mb-4" data-id="{{ $cartItem['id'] }}">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <img src="{{ $cartItem['image_url'] ?? asset('assets/images/placeholder.png') }}" class="w-100">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="card-body py-2">
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <div>
                                                                            <a href="{{ url('packages') . '/' . ($cartItem['slug'] ?? $cartItem['id']) }}">{{ $cartItem['name'] }}</a><br/>
                                                                            <small>{{ \Illuminate\Support\Str::limit($cartItem['description'], 100, $end = '...') }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row  align-items-center mt-md-1">
                                                                    @if (!$cartItem['is_prebook'] || $cartItem['is_prebook_content_ready'])
                                                                        <div class="col-md-12">
                                                                            <small> @if ($cartItem['total_duration_formatted']) <i class="fa fa-clock mr-1"></i>{{ $cartItem['total_duration_formatted'] }} |@endif {{$cartItem['language']['name']}} </small>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-md-12">
                                                                            <small> @if ($cartItem['prebook_total_duration']) <i class="fa fa-clock mr-1"></i>{{ $cartItem['prebook_total_duration'] }} |@endif {{$cartItem['language']['name']}} </small>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="row">
                                                    <div class="custom-control custom-radio custom-control-inline" style="background-color: white!important;">
                                                        <input checked type="radio" id="online{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                               class="bg-blue custom-control-input delivery-mode" value="online">
                                                        <label class="custom-control-label bg-blue" for="online{{ $cartItem['id'] }}">Online</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input @if($cartItem['pendrive']==0) disabled @endif type="radio" id="pendrive{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                               class="custom-control-input delivery-mode" value="pendrive">
                                                        <label class="custom-control-label" for="pendrive{{ $cartItem['id'] }}">Pendrive</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="row">
                                                    <div class="custom-control custom-radio custom-control-inline" style="background-color: white!important;">
                                                        <input checked type="radio" id="study-material-ebook-{{ $cartItem['id'] }}" name="study_material[{{ $cartItem['id'] }}]"
                                                               class="bg-blue custom-control-input study-material study-material-ebook" value="ebook"
                                                               data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                               data-package-id="{{ $cartItem['id'] }}"
                                                               data-package-name="{{ $cartItem['name'] }}">
                                                        <label class="custom-control-label bg-blue" for="study-material-ebook-{{ $cartItem['id'] }}">E-Book</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="study-material-printed-{{ $cartItem['id'] }}" name="study_material[{{ $cartItem['id'] }}]"
                                                               class="custom-control-input study-material" value="printed"
                                                               data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                               data-package-id="{{ $cartItem['id'] }}"
                                                               data-package-name="{{ $cartItem['name'] }}"
                                                               @if (!$cartItem['study_material_price']) disabled @endif>
                                                        <label class="custom-control-label" for="study-material-printed-{{ $cartItem['id'] }}">Printed</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-auto orders-right-area ">
                                <div id="order-summery" class="border shadow ">
                                    <div class="px-3 py-4">
                                        <h5 class="pb-4">
                                            <strong>Order Summary</strong>
                                        </h5>
                                        <div class="order-summery-items border-bottom border-secondary mb-3">
                                            @foreach($cart['items'] as $cartItem)
                                                <div id="order-summery-item-{{ $cartItem['id'] }}" class="row row-cols-2 no-gutters order-summery-item">
                                                    <div class="col mb-2">{{ ucfirst($cartItem['name'])  }}</div>
                                                    <div class="col-auto ml-auto mb-2 text-right">
                                        <span class="mr-1 text-muted">
                                            <small class="strike-prices">
                                                @if ($cartItem['is_prebook'])
                                                @else
                                                    @foreach ($cartItem['strike_prices'] as $price)
                                                        <del>₹ {{ number_format($price,2) }}</del>
                                                    @endforeach
                                                @endif
                                            </small>
                                        </span>
                                                        <h6 class="d-inline m-0">₹ <span class="selling-price">{{ number_format($cartItem['selling_price'],2) }}</span></h6>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row row-cols-2 no-gutters">
                                            <div class="col mb-2">
                                                Gross Total
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 class="m-0">₹<span id="gross-total"> {{ number_format($cart['total'],2) }}</span></h5>
                                            </div>
                                        </div>
                                        <div id="pendrive-price">
                                        </div>
                                        <div id="study-material-price-container"></div>
                                        <div class="row row-cols-2 no-gutters">
                                            <div class="col">
                                                <h6><strong>Net Total</strong></h6>
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 class="m-0" style="font-weight: bold"><span>₹ </span><span id="net-total">{{ number_format($cart['total'],2) }}</span></h5>
                                                <div class="row">
                                                    <div id="c_gst_div" class="col-md-12">
                                                        <small id="c_gst"></small>
                                                    </div>
                                                    <div id="s_gst_div" class="col-md-12">
                                                        <small id="s_gst"></small>
                                                    </div>
                                                    <div id="i_gst_div"  class="col-md-12">
                                                        <small id="i_gst"></small>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <small>( Inclusive of all taxes )</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="hidden-inputs-container">
                                    </div>
                                    <div id="order-summary-buttons-container">
                                        <div id="btn-checkout-container">
                                            <button class="btn btn-block btn-primary rounded-0 my-3" style="margin-top: 0px !important;"  type="button" data-toggle="modal" data-target="#modal-create-student" id="analytics-meta">Checkout</button>
                                        </div>
                                        <div id="btn-payment-container" style="display: none">
                                            <button class="btn btn-block btn-primary rounded-0 my-3" type="button" id="btn-send-payment-link">Send Link For Payment</button>
                                            <button class="btn btn-block btn-primary rounded-0 my-3" type="button" id="btn-pay-by-self">Pay By Self</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <div class="modal fade" id="modal-create-student" tabindex="-1" role="dialog" aria-labelledby="modal-create-student-title"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-create-student" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 ">
                    <h5 class="modal-title text-secondary  text-uppercase" id="modal-create-student-title">STUDENTS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-pills" id="students-tab" role="tablist">
                        <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                            <a style="font-size: 25px;" class="nav-link rounded-0 active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">NEW</a>
                        </li>
                        <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                            <a style="font-size: 25px;" class="nav-link rounded-0" id="existing-tab" data-toggle="tab" href="#existing" role="tab" aria-controls="existing" aria-selected="false">EXISTING</a>
                        </li>
                    </ul>

                    <div class="container">
                        <div class="tab-content container mt-5" id="students-tab">
                            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                                <form id="form-create-student" method="POST" action="{{ route('branch-managers.students.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-5 col-form-label col-form-label-sm">Name*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control form-control-sm input-sm" id="name" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-5 col-form-label col-form-label-sm">Email*</label>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control form-control-sm" id="email" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="signup_mobile" class="col-sm-12 col-form-label col-form-label-sm">Mobile*</label>
                                                <div class="col-sm-3">
                                                    <select id="student_mobile_code" class="form-control-sm bg-white mobile_code" name="mobile_code">
                                                        <option value="+91">+91</option>
                                                        <option value="+971">+971</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm phone {{$errors->has('phone') ? ' is-invalid' : '' }}" id="student_phone" name="phone" value="{{ old('phone') }}">
                                                    @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-5 col-form-label col-form-label-sm">Password*</label>
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control form-control-sm" id="password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="password-confirmation" class="col-sm-5 col-form-label col-form-label-sm">Confirm Password*</label>
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control form-control-sm" id="password-confirmation" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="course-id" class="col-sm-5 col-form-label col-form-label-sm">Course</label>
                                                <div class="col-sm-12">
                                                    <x-inputs.course id="course-id" name="course_id" class="form-control form-control-sm">
                                                    </x-inputs.course>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="level-id" class="col-sm-5 col-form-label col-form-label-sm">Level</label>
                                                <div class="col-sm-12">
                                                    <x-inputs.level id="level-id" name="level_id" class="form-control form-control-sm" related="#course-id">
                                                    </x-inputs.level>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="country-id" class="col-sm-5 col-form-label col-form-label-sm">Country</label>
                                                <div class="col-sm-12">
                                                    <x-inputs.country id="country-id" name="country_id" class="form-control form-control-sm">
                                                    </x-inputs.country>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="state-id" class="col-sm-5 col-form-label col-form-label-sm">State</label>
                                                <div class="col-sm-12">
                                                    <x-inputs.state id="state-id" name="state_id" class="form-control form-control-sm" related="#country-id">
                                                    </x-inputs.state>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="city" class="col-sm-5 col-form-label col-form-label-sm">City</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control form-control-sm" id="city" name="city">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="pin" class="col-sm-5 col-form-label col-form-label-sm">Pin</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control form-control-sm" id="pin" name="pin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-5 col-form-label col-form-label-sm">Address</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control form-control-sm" id="address" name="address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-5 col-form-label col-form-label-sm">Area</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control form-control-sm" id="area" name="area">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="landmark" class="col-sm-5 col-form-label col-form-label-sm">Landmark</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control form-control-sm" id="landmark" name="landmark">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="submit" class="btn btn-primary px-4" id="btn-create-student">Create</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="existing" role="tabpanel" aria-labelledby="existing-tab">
                                <table id="table-students" class="display">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($branchManagerStudents as $id => $student)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-3 mt-2">
                                                    <input type="radio" id="radio-student-id-{{ $id }}" name="radio_student_id" class="bg-blue custom-control-input radio-studen-id" value="{{ $student['user_id'] }}" data-address-id="{{ $student['addresses'][0]['id'] ?? null }}" data-state-text="{{ $student['addresses'][0]['state'] ?? null }}">
                                                    <label class="custom-control-label bg-blue" for="radio-student-id-{{ $id }}"></label>
                                                </div>
                                            </td>
                                            <td>{{ $student['name'] }}</td>
                                            <td>{{ $student['email'] }}</td>
                                            <td>{{ $student['country_code'] }} {{ $student['phone'] }}</td>
                                            <td>{{ $student['city'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4" id="btn-existing-student-ok">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <input id="gross-total" type="hidden" value="{{  $cart['total'] }}">
@endsection

@push('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#analytics-meta').click(function(e) {
                    $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "AddPaymentInfo"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });
                    
                        var container = document.getElementById("facebookPixelNoScriptContainer");
                        var noscriptTag = document.createElement("noscript");
                        noscriptTag.setAttribute("id", "facebookPixelNoScript");

                        var imgElement = document.createElement("img");
                        imgElement.setAttribute("height", "1");
                        imgElement.setAttribute("width", "1");
                        imgElement.setAttribute("style", "display:none");
                        imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=AddPaymentInfo&noscript=1");
                        noscriptTag.appendChild(imgElement);
                        container.appendChild(noscriptTag);
                });
    </script>
    <script>
        $(document).ready(function(){
            'use strict';

            $('#i_gst_div').toggleClass('d-none')
            var pendrive_price = 0;
            var studyMaterialPrice = 0;
            var grossTotal = parseInt('{{  $cart['total'] }}') + parseInt(pendrive_price) + parseInt(studyMaterialPrice);

            var netTotal = parseInt('{{  number_format($cart['total'],2) }}') ;

            // Create currency formatter.
            var formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
            });

            var $orderSummery = $('#order-summery');

            var cgst = {{$cgst}};
            var sgst = {{$sgst}};
            var igst = {{$igst}};

            update_tax();

            function update_tax(state=0){
                var grossTotal = parseInt('{{  $cart['total'] }}') + parseInt(pendrive_price) + parseInt(studyMaterialPrice);
                var grossTotalExcludePenDrive = parseInt('{{  $cart['total'] }}') + parseInt(studyMaterialPrice);
                var product_price_except_cgst_sgst = (grossTotal *100)/(100+cgst+sgst).toFixed(2);
                var product_price_except_igst = (grossTotal *100)/(100+igst).toFixed(2);
                var cgst_amount = ((product_price_except_cgst_sgst * cgst)/100).toFixed(2);
                var sgst_amount = ((product_price_except_cgst_sgst * cgst)/100).toFixed(2);
                var igst_amount = ((product_price_except_igst * igst)/100).toFixed(2);

                $('#c_gst').text('CGST : ₹ ' + cgst_amount +  ' ( '+ cgst +'%)');
                $('#s_gst').text('SGST : ₹ ' + sgst_amount +  ' ( '+ cgst +'%)');
                $('#i_gst').text('IGST :  ' + igst_amount +  ' ( '+ igst +'%)');

                $orderSummery.find('#net-total').text(formatter.format(grossTotal));
                $orderSummery.find('#gross-total').text(formatter.format(grossTotalExcludePenDrive));

                if(state==1){
                    $('#i_gst_div').removeClass('d-none');
                    $('#s_gst_div').addClass('d-none');
                    $('#c_gst_div').addClass('d-none');


                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst_amount" value="${igst_amount}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst" value="${igst}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst_amount" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst_amount" value="0">`);
                }else{
                    $('#i_gst_div').addClass('d-none');
                    $('#s_gst_div').removeClass('d-none');
                    $('#c_gst_div').removeClass('d-none');

                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst_amount" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst" value="${cgst}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst" value="${sgst}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst_amount" value="${cgst_amount}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst_amount" value="${sgst_amount}">`);
                }
                $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${grossTotal}">`);
            }

            var isPendrive = null;

            $('.order-items').find('.order-item').each(function () {
                var id = $(this).data('id');
                var $deliveryMod = $(this).find(".delivery-mode[name='content_delivery["+id+"]']:checked").val();

                if ($deliveryMod === 'pendrive') {
                    isPendrive = true;
                }
            });

            if (isPendrive) {
                $('#pendrive-price').html(
                    `<div class="row row-cols-2 no-gutters">
                    <div class="col mb-2">Pendrive Price</div>
                    <div class="col mb-2 text-right">
                        <h5 class="m-0">₹ <span id="gross-total">{{ number_format($pendrivePrice,2) }}</span></h5>
                    </div>
                </div>`
                );

                pendrive_price = {{ number_format($pendrivePrice,2)}};
                update_tax();

            } else {
                pendrive_price = 0;
                $('#pendrive-price').html('');
                update_tax();
            }


            $('.delivery-mode').change(function() {

                var isPendrive = null;
                $('.order-items').find('.order-item').each(function () {
                    var id = $(this).data('id');
                    var $deliveryMod = $(this).find(".delivery-mode[name='content_delivery["+id+"]']:checked").val();

                    if ($deliveryMod === 'pendrive') {
                        isPendrive = true;
                    }
                });

                if (isPendrive) {
                    $('#pendrive-price').html(
                        `<div class="row row-cols-2 no-gutters">
                        <div class="col mb-2">Pendrive Price</div>
                        <div class="col mb-2 text-right">
                            <h5 class="m-0">₹ <span id="gross-total">{{ number_format($pendrivePrice,2) }}</span></h5>
                        </div>
                    </div>`
                    );

                    pendrive_price = {{ number_format($pendrivePrice,2)}};
                    update_tax();

                } else {
                    pendrive_price = 0;
                    $('#pendrive-price').html('');
                    update_tax();
                }
            });

            $('#form-create-student').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 191
                    },
                    phone: {
                        required: true,
                        maxlength: function() {
                            if ($('#student_mobile_code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#student_mobile_code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        remote: {
                            url: '{{ url('validate-phone') }}',
                            type: 'POST',
                            data: {
                                mobile: function() {
                                    if ($('#student_mobile_code').val() === '+91') {
                                        return '+91' + $('#student_phone').val();
                                    } else {
                                        return '+971' + $('#student_phone').val();
                                    }
                                }
                            }
                        }
                    },
                    password: {
                        required: true,
                        maxlength: 191,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                    course_id: {
                        required: true
                    },
                    level_id: {
                        required: true
                    },
                    country_id: {
                        required: true
                    },
                    state_id: {
                        required: true
                    },
                    city: {
                        required: true,
                        maxlength: 191
                    },
                    pin: {
                        required: true,
                        maxlength: 191
                    },
                    address: {
                        required: true
                    }
                }
            });

            $('#form-create-student').on('submit', function(e) {
                let isValid = $(this).valid();
                if (isValid) {
                    e.preventDefault();
                    $('#btn-create-student').prop('disabled', true);
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response){
                            let addressState = response.addresses[0].state;

                            $('#address-id').val(response.addresses[0].id);
                            $('#btn-create-student').prop('disabled', false);
                            $('#form-create-student')[0].reset();
                            $('#modal-create-student').modal('toggle');
                            $('#hidden-inputs-container').html(`<input type="hidden" name="student_id" value="${response.user_id}">`);
                            $('#btn-checkout-container').css('display', 'none');
                            $('#btn-payment-container').css('display', 'block');

                            if (addressState.toString().toUpperCase() === 'MAHARASHTRA') {
                                update_tax();
                            } else {
                                update_tax(1);
                            }
                        }
                    });
                }
            });

            $('#btn-existing-student-ok').click(function() {
                let studentId = $('input[name="radio_student_id"]:checked').val();
                let addressID = $('input[name="radio_student_id"]:checked').data('address-id');
                let addressState = $('input[name="radio_student_id"]:checked').data('state-text');

                if (! studentId) {
                    alert('Please choose a student');
                } else {
                    $('#modal-create-student').modal('toggle');
                    $('#hidden-inputs-container').html(`<input type="hidden" name="student_id" value="${studentId}">`);
                    $('#btn-checkout-container').css('display', 'none');
                    $('#btn-payment-container').css('display', 'block');
                    $('#address-id').val(addressID);

                    if (addressState.toString().toUpperCase() === 'MAHARASHTRA') {
                        update_tax();
                    } else {
                        update_tax(1);
                    }
                }
            });

            $('#btn-send-payment-link').click(function() {
                $('#btn-send-payment-link').prop('disabled',true);
                swal("Please wait! Sending payment link to the student");
                $('#hidden-inputs-container').append(`<input type="hidden" name="associate_payment_type" value="link">`);
                $('#form-create-order').submit();
            });

            $('#btn-pay-by-self').click(function() {
                $('#hidden-inputs-container').append(`<input type="hidden" name="associate_payment_type" value="self">`);
                $('#form-create-order').submit();
            });

            $('#table-students').DataTable();

            let checkedStudyMaterials = [];

            $('.study-material').change(function() {
                let value = $(this).val();

                let studyMaterialPriceData = $(this).data('study-material-price');
                let packageId = $(this).data('package-id');
                let packageName = $(this).data('package-name');

                if (value === 'printed') {
                    if (studyMaterialPriceData) {
                        studyMaterialPrice += studyMaterialPriceData;
                        update_tax();

                        $(`.order-summery-items`).append(
                            `<div id="order-study-material-${packageId}" class="row row-cols-2 no-gutters order-summery-item">
                            <div class="col mb-2">${packageName} (<small>Study Material</small>)</div>
                             <div class="col-auto ml-auto mb-2 text-right">
                                <h6 class="d-inline m-0">₹ <span class="selling-price">${studyMaterialPriceData.toFixed(2)}</span></h6>
                            </div>
                        </div>`
                        )

                        checkedStudyMaterials.push(packageId);
                    }
                } else {
                    if (studyMaterialPriceData) {
                        studyMaterialPrice -= studyMaterialPriceData;
                        update_tax();
                        $(`#order-study-material-${packageId}`).remove();

                        let index = checkedStudyMaterials.indexOf(packageId);

                        if (index >= 0) {
                            checkedStudyMaterials.splice(index, 1);
                        }
                    }
                }

                $('#checked-study-materials').val(JSON.stringify(checkedStudyMaterials));
            });

            $('.study-material-ebook').each(function() {
                $(this).prop( "checked", true );
            });
        });
    </script>
@endpush
