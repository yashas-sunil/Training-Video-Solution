@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="container-fluid">
            <div class="cart_section">
                <div class="cart_title">Checkout</div>
                <form id="form-create-order" method="POST" action="{{ route('order.store') }}">
                    @csrf
                    <input type="hidden" name="is_study_material_order" value="true">
                    <input type="hidden" name="package_id" value="{{ $package['id'] }}">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="cart-programs" id="checkout_col">
                                <div class="checkout_lists">
                                    <div class="pro_gram">
                                        <div class="row order-item" data-id="{{ $package['id'] }}">
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="pro_pram_image">
                                                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-12">
                                                <div class="pro_gram_details">
                                                    <a style="text-decoration:none" href=" ">
                                                        <h2>{{ $package['name'] }}</h2>
                                                    </a>
                                                    <h6>{{ \Illuminate\Support\Str::limit($package['description'], 100, $end = '...') }}</h6>
                                                    <ul>
                                                        <li><img src="{{ asset('assets/new_ui_assets/images/dashboard/time.svg') }}" alt=""></li>
                                                        @if (!$package['is_prebook'] || $package['is_prebook_content_ready'])
                                                            <li>
                                                                <p> @if ($package['total_duration_formatted'])
                                                                        {{ $package['total_duration_formatted'] }} |@endif {{$package['language']['name']}}
                                                                </p>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <p> @if ($package['prebook_total_duration'])
                                                                        {{ $package['prebook_total_duration'] }} |@endif {{$package['language']['name']}}
                                                                </p>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart_address">
                                    <div class="address_heading">
                                        <h4>Select Address</h4>
                                        <a href="" data-toggle="modal" data-target="#add_new_address">Add New Address</a>
                                    </div>
                                    @if($addresses)
                                        <div class="row">
                                            @foreach($addresses as $id => $address)

                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                    <input type="radio" data-id="{{$id}}"  id="address-{{ $id }}" required  name="address_id"
                                                           data-state="{{$address['state']}}" class="select_address"
                                                           value="{{$address['id'] }}" >
                                                    <div class="student_cart_address @if($id == 0) default @endif">
                                                        <a href="#" class="delete-address" data-id="{{ $address['id'] }}">
                                                            <img src="{{ asset('assets/new_ui_assets/images/dashboard/delete.svg') }}" alt="">
                                                        </a>
                                                        <div class="student_name">{{ $address['name'] }}</div>
                                                        <div class="student_number">
                                                            {{ $address['phone'] }}
                                                        </div>
                                                        <div class="student_addr">
                                                            <p>{{ $address['address'] }}</p>
                                                            <p>{{ $address['city'] }}<span id="state-{{$id}}" data-value="{{ $address['state'] }}">{{ $address['state'] }}</span>, <span>{{ $address['country'] }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="summary">
                                <div class="order_summary" id="order-summery">
                                    <div class="summary_title">Order Summary</div>
                                    <hr>
                                    <div class="summary_details">
                                        <ul>
                                            <div class="order-summery-items">
                                                <div id="order-summery-item-{{ $package['id'] }}" class="order-summery-item">
                                                    <li>
                                                        <h5>{{ $package['name'] }}</h5>
                                                        <h6><i class="fa fa-inr strike-prices" aria-hidden="true"></i>
                                                            <span class="selling-price">
                                                                {{ number_format($package['study_material_price'], 2) }}
                                                            </span>
                                                        </h6>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                        <div class="gross_total">
                                            <h5>Gross Total</h5>
                                            <h6><i class="fa fa-inr" aria-hidden="true"></i>
                                                <span id="gross-total"> {{ number_format($package['study_material_price'], 2) }}
                                                </span>
                                            </h6>
                                        </div>
                                        <hr>
                                        @if ($user['role'] == 5)
                                            <!-- <div class="coupon_code">
                                                <label for="coupon">Coupon Code</label>
                                                <div class="code_input">
                                                    <input type="text" id="coupon" name="coupon" placeholder="Enter">
                                                    <button class="btn" id="apply" type="button">Apply</button>
                                                </div>
                                                <p id="coupon-message"style="font-size: x-small"></p>
                                                <div class="errorTxt" style="color: red;margin-bottom: 3px;"></div>
                                            </div> -->
                                        @endif
                                        <div class="total-prize">
                                            <h5>Net Total</h5>
                                            <h6><i class="fa fa-inr" aria-hidden="true"></i>
                                                <span id="net-total">
                                                    {{ number_format($package['study_material_price'], 2) }}
                                                </span>
                                            </h6>
                                        </div>
                                        <div class="total-tax">
                                            <h5>(Inclusive of All Taxes)</h5>
                                            <h6>
                                                <span id="c_gst_div">
                                                    <small id="c_gst"></small>
                                                </span>
                                                <span id="s_gst_div">
                                                    <small id="s_gst"></small>
                                                </span>
                                                <span id="i_gst_div">
                                                    <small id="i_gst"></small>
                                                </span>
                                                {{--                                            <span>CGST 9% (<i class="fa fa-inr"></i>953.00)</span>--}}
                                                {{--                                            <span>SGST 9% (<i class="fa fa-inr"></i>953.00)</span>--}}
                                            </h6>
                                        </div>
                                        <div id="hidden-inputs-container">

                                        </div>
                                        <button class="btn btn-block btn-primary my-3 checkout" style="margin-top: 0px !important;"  type="submit">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_new_address"  role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-address"  method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        <input id="add-address-state" type="hidden" name="state">
                        <input id="add-address-country" type="hidden" name="country">
                        <div class="form-group">
                            <label>Full Name*</label>
                            <input type="text" id="add-address"  name="name" placeholder="Full Name"
                                   class="form-control" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Pincode*</label>
                            <input type="text" name="pin" class="form-control"
                                   placeholder="6 digits [0-9] PIN code" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>City*</label>
                            <input type="text" name="city" class="form-control" @if(!$addresses)  required @endif>
                        </div>

                        <div class="form-group">
                            <label>Country*</label>
                            <x-inputs.country id="country_id" name="country_id" class="form-control">
                                @if(!empty(old('country_id')))
                                    <option value="{{ old('country_id') }}" selected>{{ old('country_id_text') }}</option>
                                @endif
                            </x-inputs.country>
                            @if ($errors->has('country_id'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>State*</label>
                            <x-inputs.state id="state_id" name="state_id" class="form-control form-control-sm {{$errors->has('state_id') ? ' is-invalid' : '' }}" related="#country_id">
                                @if(!empty(old('state_id_text')))
                                    <option value="{{ old('state_id_text') }}" selected>{{ old('state_id_text') }}</option>
                                @endif
                            </x-inputs.state>
                            @if ($errors->has('state_id_text'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('state_id_text') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Mobile No*</label>
                            <div class="m-num">
                                <select id="mobile_code" @if(!$addresses)  required @endif name="country_code">
                                    <option selected value="+91">+91</option>
                                    <option value="+971">+971</option>
                                </select>
                                <input type="text" placeholder="10-digit mobile number without prefixes" @if(!$addresses)  required @endif  class="phone  {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Flat, House No, Building, Company, Apartment*</label>
                            <input name="address" class="form-control" placeholder="" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Landmark*</label>
                            <input name="landmark" class="form-control" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc."
                                   @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Area , Colony , Street , Sector , Village*</label>
                            <input name="area" class="form-control" placeholder="" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Address Type</label>
                            <select id="address_type" name="address_type" class="js-states form-control">
                                <option value="1" selected>Home (7am - 9pm delivery)</option>
                                <option value="2">Office/Commercial (10am - 6pm delivery)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-address" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <small>Some fields are missing. Please fill the mandatory fields in the form.</small>
                    <form id="form-update-address">
                        @csrf
                        @method('PUT')
                        <input id="add-address-state" type="hidden" name="state">
                        <input id="add-address-country" type="hidden" name="country">
                        <div class="form-group">
                            <label>Full Name*</label>
                            <input type="text" id="update-address-name"  name="name" class="form-control form-control-sm"
                                   @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Pincode*</label>
                            <input type="text" id="update-address-pin" name="pin" class="form-control"
                                   placeholder="6 digits [0-9] PIN code" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>City*</label>
                            <input type="text" id="update-address-city" name="city" class="form-control" @if(!$addresses)  required @endif>
                        </div>

                        <div class="form-group">
                            <label>Country*</label>
                            <x-inputs.country id="update-address-country" name="country" class="form-control">
                                @if(!empty(old('country_id')))
                                    <option value="{{ old('country_id') }}" selected>{{ old('country_id_text') }}</option>
                                @endif
                            </x-inputs.country>
                            @if ($errors->has('country_id'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>State*</label>
                            <x-inputs.state id="update-address-state" name="state" class="form-control {{$errors->has('state_id') ? ' is-invalid' : '' }}" related="#country_id">
                                @if(!empty(old('state_id_text')))
                                    <option value="{{ old('state_id_text') }}" selected>{{ old('state_id_text') }}</option>
                                @endif
                            </x-inputs.state>
                            @if ($errors->has('state_id_text'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('state_id_text') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Mobile No*</label>
                            <div class="m-num">
                                <select id="update-address-country-code" @if(!$addresses)  required @endif name="country_code">
                                    <option selected value="+91">+91</option>
                                    <option value="+971">+971</option>
                                </select>
                                <input type="text" placeholder="10-digit mobile number without prefixes" @if(!$addresses)  required @endif  class="form-control phone form-control-sm mt-2 {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="update-address-phone" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Flat, House No, Building, Company, Apartment*</label>
                            <input id="update-address-address" name="address" class="form-control"
                                   placeholder="" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Landmark*</label>
                            <input id="update-address-landmark" name="landmark" class="form-control"
                                   placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc." required>

                        </div>
                        <div class="form-group">
                            <label>Area , Colony , Street , Sector , Village*</label>
                            <input id="update-address-area" name="area" class="form-control" placeholder=""  required >
                        </div>
                        <div class="form-group">
                            <label>Address Type</label>
                            <select id="update-address-address-type" name="address_type" style="width: 100%">
                                <option value="1" selected>Home (7am - 9pm delivery)</option>
                                <option value="2">Office/Commercial (10am - 6pm delivery)</option>
                            </select>
                        </div>
                        <button id="button-update-address"  class="btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input id="gross-total" type="hidden" value="{{ number_format($package['study_material_price'], 2) }}">
@endsection

@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            'use strict';

            $('#address_type').select2();
            $('#update-address-address-type').select2();

            $('#form-add-address').find('#state_id').change(function() {
                $('#add-address-state').val($(this).text());
            });

            $('#form-add-address').find('#country_id').change(function() {
                $('#add-address-country').val($(this).text());
            });

            $('#form-add-address').find('#mobile_code').change(function() {
                if ($(this).val() === '+91') {
                    $('#form-add-address').find('#phone').attr('placeholder', '10-digit mobile number without prefixes');
                } else {
                    $('#form-add-address').find('#phone').attr('placeholder', '9-digit mobile number without prefixes');
                }
            });

            @if (session('alert'))
            $('#address-required-modal').modal('show');
            @endif


            $('#i_gst_div').toggleClass('d-none')
            var couponDiscount = 0;
            var redeemDiscount = 0;
            var spinWheelRewardDiscount = 0;
            var pendrive_price = 0;
            var reward_point_id = 0;
            var studyMaterialPrice = 0;
            var grossTotal = parseInt('{{  $package['study_material_price'] }}') - parseInt(couponDiscount);

            if (grossTotal < 0) {
                grossTotal = 0;
            }

            var netTotal = parseInt('{{  number_format($package['study_material_price'],2) }}') ;

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
                var grossTotal = parseInt('{{  $package['study_material_price'] }}') - parseInt(couponDiscount)-parseInt(redeemDiscount);

                if (grossTotal < 0) {
                    grossTotal = 0;
                }

                var grossTotalExcludePenDrive = parseInt('{{  $package['study_material_price'] }}');
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
                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst_amount" value="${igst_amount}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst" value="${igst}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst_amount" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst_amount" value="0">`);

                }else{
                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="igst_amount" value="0">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst" value="${cgst}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst" value="${sgst}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="cgst_amount" value="${cgst_amount}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="sgst_amount" value="${sgst_amount}">`);
                }
                $('#hidden-inputs-container').append(`<input type="hidden" name="coupon_amount" value="${couponDiscount}">`);
                $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${grossTotal}">`);
                $('#hidden-inputs-container').append(`<input type="hidden" name="reward_point_id" value="${reward_point_id}">`);
            }

            var  selected_address = $('.select_address:checked').data('state');
            if(selected_address){
                if(selected_address.toUpperCase() == 'MAHARASHTRA'){
                    $('#i_gst_div').addClass('d-none');
                    $('#s_gst_div').removeClass('d-none');
                    $('#c_gst_div').removeClass('d-none');
                    update_tax();
                }
                else{
                    $('#i_gst_div').removeClass('d-none');
                    $('#s_gst_div').addClass('d-none');
                    $('#c_gst_div').addClass('d-none');

                    update_tax(1);
                }
            }

            $('input[type="radio"]').change(function(){
                if ($(this).is(':checked'))
                {
                    var id = $(this).data('id');
                    var state = $('#state-'+id).data('value');
                    if(state){
                        if(state.toUpperCase() == 'MAHARASHTRA'){
                            $('#i_gst_div').addClass('d-none');
                            $('#s_gst_div').removeClass('d-none');
                            $('#c_gst_div').removeClass('d-none');
                            update_tax();
                        }
                        else{
                            $('#i_gst_div').removeClass('d-none');
                            $('#s_gst_div').addClass('d-none');
                            $('#c_gst_div').addClass('d-none');

                            update_tax(1);
                        }
                    }
                }
            });


        {{--    var isPendrive = null;--}}

        {{--    $('.order-items').find('.order-item').each(function () {--}}
        {{--        var id = $(this).data('id');--}}
        {{--        var $deliveryMod = $(this).find(".delivery-mode[name='content_delivery["+id+"]']:checked").val();--}}

        {{--        if ($deliveryMod === 'pendrive') {--}}
        {{--            isPendrive = true;--}}
        {{--        }--}}
        {{--    });--}}

        {{--    if (isPendrive) {--}}
        {{--        $('#pendrive-price').html(--}}
        {{--            `<div class="row row-cols-2 no-gutters">--}}
        {{--    <div class="col mb-2">Pendrive Price</div>--}}
        {{--    <div class="col mb-2 text-right">--}}
        {{--        <h5 class="m-0">₹ <span id="gross-total">{{ number_format($pendrivePrice,2) }}</span></h5>--}}
        {{--    </div>--}}
        {{--</div>`--}}
        {{--        );--}}

        {{--        pendrive_price = {{ number_format($pendrivePrice,2)}};--}}
        {{--        update_tax();--}}

        {{--    } else {--}}
        {{--        pendrive_price = 0;--}}
        {{--        $('#pendrive-price').html('');--}}
        {{--        update_tax();--}}
        {{--    }--}}



            $("#apply").click(function(e){
                e.preventDefault();
                let coupon = $('#coupon').val();
                if(coupon){
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/cart/apply-coupon') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'amount': grossTotal,
                            'coupon': coupon
                        },
                        success:function(response) {
                            if (response.data > 0 ) {
                                couponDiscount = response.data;
                                update_tax();
                                $orderSummery.find('#coupon-price').text('- ₹ ' + couponDiscount);
                                $orderSummery.find('#coupon-message')
                                    .text('Coupon Applied')
                                    .css('color', 'green');
                                $("#apply").prop( "disabled", true );
                            } else {
                                couponDiscount = 0;
                                update_tax();
                                $orderSummery.find('#coupon-price').text('- ₹ 0' );
                                $orderSummery.find('#coupon-message')
                                    .text(response.message)
                                    .css('color', 'red');
                                $("#coupon").val("");
                            }

                        }
                    });
                }
            });


            $('#carousel-addresses').owlCarousel({
                margin: 10,
                loop: false,
                nav: true,
                navText: [
                    '<i class="fa fa-chevron-left">',
                    '<i class="fa fa-chevron-right">'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    577: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
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
                    }
                }
            });

            $('#form-create-order').validate({
                rules: {
                    address_id: {
                        required: true
                    }
                },
                messages: {
                    address_id: {
                        required: "• Please select a billing address for your order" }
                },
                errorElement : 'div',
                errorLabelContainer: '.errorTxt'
            });


            $('#form-add-address').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
                    phone: {
                        required: true,
                        digits: true,
                        maxlength: function() {
                            if ($('#mobile_code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#mobile_code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                    },
                    alternate_phone: {
                        digits: true,
                        maxlength: function() {
                            if ($('#altr-mobile-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#altr-mobile-code').val() === '+91') {
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
                                    if ($('#mobile-code').val() === '+91') {
                                        return '+91' + $('#phone').val();
                                    } else {
                                        return '+971' + $('#phone').val();
                                    }
                                }
                            }
                        }
                    },
                    city: {
                        required: true,
                        maxlength: 191
                    },
                    country_id: {
                        required: true
                    },
                    state: {
                        required: true,
                        maxlength: 191
                    },
                    address: {
                        required: true,
                        maxlength: 191
                    },
                    pin: {
                        required: true,
                        digits: true,
                        maxlength: 191
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
                            $('#btn-create-student').prop('disabled', false);
                            $('#form-create-student')[0].reset();
                            $('#modal-create-student').modal('toggle');
                            $('#hidden-inputs-container').html(`<input type="hidden" name="student_id" value="${response.user_id}">`);
                            $('#btn-checkout-container').css('display', 'none');
                            $('#btn-payment-container').css('display', 'block');
                        }
                    });
                }
            });

            $('#btn-existing-student-ok').click(function() {
                let studentId = $('input[name="radio_student_id"]:checked').val();

                if (! studentId) {
                    alert('Please choose a student');
                } else {
                    $('#modal-create-student').modal('toggle');
                    $('#hidden-inputs-container').html(`<input type="hidden" name="student_id" value="${studentId}">`);
                    $('#btn-checkout-container').css('display', 'none');
                    $('#btn-payment-container').css('display', 'block');
                }
            });

            $('#btn-send-payment-link').click(function() {
                $('#btn-send-payment-link').prop('disabled',true);
                swal("Please wait! Sending payment link to the student");
                $('#hidden-inputs-container').append(`<input type="hidden" name="associate_payment_type" value="link">`);
                $('#form-create-order').submit();
            });

            // $('#btn-pay-by-self').click(function() {
            //     $('#hidden-inputs-container').append(`<input type="hidden" name="associate_payment_type" value="self">`);
            //     $('#form-create-order').submit();
            // });

            $('.edit-address').click(function() {
                let id = $(this).data('id');
                $(".modal-body #name").val( $(this).data('name') );
                $(".modal-body #phone").val( $(this).data('phone') );
                $(".modal-body #alternate_phone").val( $(this).data('alternate_phone') );
                $(".modal-body #city").val( $(this).data('city') );
                $(".modal-body #state").val( $(this).data('state') );
                $(".modal-body #address").val( $(this).data('address') );
                $(".modal-body #pin").val( $(this).data('pin') );
                $('#form-edit-address').attr('action', '{{ url('addresses') }}' + '/' + id);
            });

            $('.delete-address').click(function() {
                $.ajax({
                    type:'DELETE',
                    url:'{{ url('addresses') }}' + '/' + $(this).data('id'),
                    success:function(data) {
                        location.reload();
                    }
                });
            });

            $('#form-update-address').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191
                    },
                    phone: {
                        required: true,
                        digits: true,
                        maxlength: function() {
                            if ($('#update-address-country-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                        minlength: function() {
                            if ($('#update-address-country-code').val() === '+91') {
                                return 10;
                            } else {
                                return 9;
                            }
                        },
                    },
                    city: {
                        required: true,
                        maxlength: 191
                    },
                    country_id: {
                        required: true
                    },
                    state: {
                        required: true,
                        maxlength: 191
                    },
                    address: {
                        required: true,
                        maxlength: 191
                    },
                    pin: {
                        required: true,
                        digits: true,
                        maxlength: 191
                    }
                }
            });

            let selectedAddressID = null;

            $('.select_address').click(function() {
                selectedAddressID = $(this).val();
            });

            let isValidAddress = true;

            $('#form-create-order').on('submit', function(e) {
                console.log(selectedAddressID);
                if(couponDiscount<=0){
                    $("#coupon").val("");
                }
                var userAddress = @json($addresses);
                if(userAddress.length == 0){
                    e.preventDefault();
                    $("#add_new_address").modal('show');
                }
                else{
                    if ($(this).valid()) {
                        let address = null;

                        $.ajax({
                            url: '{{ url('addresses') }}' + '/' + selectedAddressID,
                            async: false
                        }).done(function(response) {
                            address = response;
                            console.log(address);
                        });

                        if (address && (! address.address || address.address === '-' || ! address.address_type)) {
                            e.preventDefault();
                            isValidAddress = false;

                            $('#modal-update-address').modal('toggle');

                            $('#update-address-name').val(address.name);
                            $('#update-address-phone').val(address.phone);
                            $('#update-address-pin').val(address.pin);
                            $('#update-address-address').val(address.address);
                            $('#update-address-area').val(address.area);
                            $('#update-address-landmark').val(address.landmark);
                            $('#update-address-city').val(address.city);
                            $('#update-address-country').append(`<option value="${address.student.country_id}">${address.country}</option>`);
                            $('#update-address-state').append(`<option value="${address.student.state_id}">${address.state}</option>`);
                            $('#update-address-country-code').val(address.country_code);
                        }
                    }
                }
            });

            $('#form-update-address').on('submit', function(e) {
                if ($(this).valid()) {
                    e.preventDefault();
                    isValidAddress = true;

                    $.ajax({
                        url: '{{ url('addresses') }}' + '/' + selectedAddressID,
                        type: 'POST',
                        data: $(this).serialize()
                    }).done(function (response) {
                        if(response.state.toUpperCase() === 'MAHARASHTRA'){
                            $('#i_gst_div').addClass('d-none');
                            $('#s_gst_div').removeClass('d-none');
                            $('#c_gst_div').removeClass('d-none');
                            update_tax();
                        }
                        else{
                            $('#i_gst_div').removeClass('d-none');
                            $('#s_gst_div').addClass('d-none');
                            $('#c_gst_div').addClass('d-none');

                            update_tax(1);
                        }

                        $('#modal-update-address').modal('toggle');
                        $('#form-create-order').submit();
                    });
                }
            });
        });
    </script>
@endpush
