@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <main class="orders px-md-5 px-sm-5" role="main">
        <form id="form-create-order" method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="is_study_material_order" value="true">
            <input type="hidden" name="package_id" value="{{ $package['id'] }}">
            <div class="container-fluid py-4 px-md-5">
                <div class="bg-diamond bg-diamond-left">
                    <div class="bg-diamond-lg checkout-diamond"></div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-12">
                            <h2 class="text-secondary mt-lg-5"><b>Study Material</b></h2>
                        </div>
                        <div class="col-md-12">
                            <div class="p-2 p-md-4 bg-secondary-10">
                                <div class="order-items mt-2">
                                    <div class="order-item row  align-items-center mb-4" data-id="{{ $package['id'] }}">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" class="w-100">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="card-body py-2">
                                                            <div class="row ">
                                                                <div class="col">
                                                                    <div>
                                                                        <a href="">{{ $package['name'] }}</a><br/>
                                                                        <small>{{ \Illuminate\Support\Str::limit($package['description'], 100, $end = '...') }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($addresses)
                            <section class="bg-right mt-5">
                                <div class="container-fluid py-3">
                                    <div class="row">
                                        <div class="col-md-11 col-xs-10 ">
                                            <h4 class="text-secondary" >Select Address</h4>
                                            <div id="carousel-addresses" class="owl-carousel owl-theme clearfix">
                                                @foreach($addresses as $id => $address)
                                                    <div class="card-deck">
                                                        <div class="card rounded-0 bg-secondary-100 border-0">
                                                            <div class="custom-control custom-checkbox ml-3 mt-2">
                                                                <input type="radio" data-id="{{$id}}"  id="address-{{ $id }}" required  name="address_id" data-state="{{$address['state']}}" class="bg-blue custom-control-input select_address" value="{{$address['id'] }}" >
                                                                <label class="custom-control-label bg-blue" for="address-{{ $id }}"></label>
                                                                <div class="float-right mr-3">
                                                                    <a href="#" class="delete-address" data-id="{{ $address['id'] }}"><i class="fas fa-trash "></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-2">
                                                                <h5 class="card-title">
                                                                    <strong>{{ $address['name'] }}</strong>
                                                                </h5>
                                                                <p class="card-text">{{ $address['address'] }}</p>
                                                                <p class="card-text">{{ $address['area'] }}</p>
                                                                <p class="card-text">{{ $address['landmark'] }}</p>
                                                                <p class="card-text">{{ $address['city'] }}, <span id="state-{{$id}}" data-value="{{ $address['state'] }}">{{ $address['state'] }}</span>, <span>{{ $address['country'] }}</span></p>
                                                                <p class="card-text">{{ $address['pin'] }}</p>
                                                                <p class="card-text">{{ $address['phone'] }}, {{ $address['alternate_phone'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
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
                                            <div id="order-summery-item-{{ $package['id'] }}" class="row row-cols-2 no-gutters order-summery-item">
                                                <div class="col mb-2">{{ ucfirst($package['name'])  }}</div>
                                                <div class="col-auto ml-auto mb-2 text-right">
                                                    <h6 class="d-inline m-0">₹ <span class="selling-price">{{ number_format($package['study_material_price'], 2) }}</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-cols-2 no-gutters">
                                            <div class="col mb-2">
                                                Gross Total
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 class="m-0">₹<span id="gross-total"> {{ number_format($package['study_material_price'], 2) }}</span></h5>
                                            </div>
                                        </div>
                                        <div class="row row-cols-2 no-gutters">
                                            <div class="col">
                                                <h6><strong>Net Total</strong></h6>
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 class="m-0" style="font-weight: bold"><span>₹ </span><span id="net-total">{{ number_format($package['study_material_price'], 2) }}</span></h5>
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
                                        <div class="errorTxt" style="color: red;margin-bottom: 3px;"></div>
                                    </div>
                                    <div id="hidden-inputs-container"></div>
                                    <button class="btn btn-block btn-primary rounded-0 my-3 checkout" style="margin-top: 0px !important;"  type="submit">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <section>
            <div class="container-fluid px-md-5 pb-4">
                <div class="row ">
                    <div class="col-md-4 ">
                        <div class="bg-secondary-10 p-4">
                            <h3>Add address</h3>
                            <form id="form-add-address"  method="POST" action="{{ route('addresses.store') }}">
                                @csrf
                                <input id="add-address-state" type="hidden" name="state">
                                <input id="add-address-country" type="hidden" name="country">
                                <div class="form-group">
                                    <label>Country / Region</label>
                                    <x-inputs.country id="country_id" name="country_id" class="form-control form-control-sm">
                                        @if(!empty(old('country_id')))
                                            <option value="{{ old('country_id') }}" selected>{{ old('country_id_text') }}</option>
                                        @endif
                                    </x-inputs.country>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input type="text" id="add-address"  name="name" class="form-control form-control-sm" @if(!$addresses)  required @endif>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label>Phone</label>
                                        <select id="mobile_code" @if(!$addresses)  required @endif class="form-control-sm bg-white" name="country_code">
                                            <option selected value="+91">+91</option>
                                            <option value="+971">+971</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-9">
                                        <label></label>
                                        <input type="text" placeholder="10-digit mobile number without prefixes" @if(!$addresses)  required @endif  class="form-control phone form-control-sm mt-2 {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>PIN code</label>
                                    <input type="text" name="pin" class="form-control form-control-sm" placeholder="6 digits [0-9] PIN code" @if(!$addresses)  required @endif>
                                </div>
                                <div class="form-group">
                                    <label>Flat, House no., Building, Company, Apartment</label>
                                    <input name="address" class="form-control form-control-sm" placeholder="" @if(!$addresses)  required @endif>
                                </div>
                                <div class="form-group">
                                    <label>Area, Colony, Street, Sector, Village</label>
                                    <input name="area" class="form-control form-control-sm" placeholder="" @if(!$addresses)  required @endif>
                                </div>
                                <div class="form-group">
                                    <label>Landmark</label>
                                    <input name="landmark" class="form-control form-control-sm" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc." @if(!$addresses)  required @endif>
                                </div>
                                <div class="form-group">
                                    <label>Town/City</label>
                                    <input type="text" name="city" class="form-control form-control-sm" @if(!$addresses)  required @endif>
                                </div>
                                <div class="form-group ">
                                    <label>State / Province / Region</label>
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
                                    <label>Address Type</label>
                                    <select id="address_type" name="address_type" style="width: 100%">
                                        <option value="1" selected>Home (7am - 9pm delivery)</option>
                                        <option value="2">Office/Commercial (10am - 6pm delivery)</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="address-required-modal" tabindex="-1" role="dialog" aria-labelledby="modal-purchase-title"
         aria-hidden="true">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-purchase-title">Address Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-2">
                        <p class="text-center">Please add address to complete your order!</p>
                        <a class="btn btn-block btn-primary rounded-0 mb-4 " data-dismiss="modal">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="gross-total" type="hidden" value="{{ number_format($package['study_material_price'], 2) }}">
    <div id="modal-update-address" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bg-secondary-10 p-4">
                    <h3>Update Address</h3>
                    <small>Some fields are missing. Please fill the mandatory fields in the form.</small>
                    <form id="form-update-address">
                        @csrf
                        @method('PUT')
                        <input id="add-address-state" type="hidden" name="state">
                        <input id="add-address-country" type="hidden" name="country">
                        <div class="form-group">
                            <label>Country / Region</label>
                            <x-inputs.country id="update-address-country" name="country" class="form-control form-control-sm">
                                @if(!empty(old('country_id')))
                                    <option value="{{ old('country_id') }}" selected>{{ old('country_id_text') }}</option>
                                @endif
                            </x-inputs.country>
                            @if ($errors->has('country_id'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('country_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Full name</label>
                            <input type="text" id="update-address-name"  name="name" class="form-control form-control-sm" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label>Phone</label>
                                <select id="update-address-country-code" @if(!$addresses)  required @endif class="form-control-sm bg-white" name="country_code">
                                    <option selected value="+91">+91</option>
                                    <option value="+971">+971</option>
                                </select>
                            </div>
                            <div class="col-sm-9">
                                <label></label>
                                <input type="text" placeholder="10-digit mobile number without prefixes" @if(!$addresses)  required @endif  class="form-control phone form-control-sm mt-2 {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="update-address-phone" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PIN code</label>
                            <input type="text" id="update-address-pin" name="pin" class="form-control form-control-sm" placeholder="6 digits [0-9] PIN code" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Flat, House no., Building, Company, Apartment</label>
                            <input id="update-address-address" name="address" class="form-control form-control-sm" placeholder="" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Area, Colony, Street, Sector, Village</label>
                            <input id="update-address-area" name="area" class="form-control form-control-sm" placeholder="" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Landmark</label>
                            <input id="update-address-landmark" name="landmark" class="form-control form-control-sm" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc." @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Town/City</label>
                            <input type="text" id="update-address-city" name="city" class="form-control form-control-sm" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group ">
                            <label>State / Province / Region</label>
                            <x-inputs.state id="update-address-state" name="state" class="form-control form-control-sm {{$errors->has('state_id') ? ' is-invalid' : '' }}" related="#country_id">
                                @if(!empty(old('state_id_text')))
                                    <option value="{{ old('state_id_text') }}" selected>{{ old('state_id_text') }}</option>
                                @endif
                            </x-inputs.state>
                            @if ($errors->has('state_id_text'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('state_id_text') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Address Type</label>
                            <select id="update-address-address-type" name="address_type" style="width: 100%">
                                <option value="1" selected>Home (7am - 9pm delivery)</option>
                                <option value="2">Office/Commercial (10am - 6pm delivery)</option>
                            </select>
                        </div>
                        <button id="button-update-address" class="btn btn-primary">Update & Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
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
                var grossTotal = parseInt('{{  $package['study_material_price'] }}');
                var product_price_except_cgst_sgst = (grossTotal *100)/(100+cgst+sgst).toFixed(2);
                var product_price_except_igst = (grossTotal *100)/(100+igst).toFixed(2);
                var cgst_amount = ((product_price_except_cgst_sgst * cgst)/100).toFixed(2);
                var sgst_amount = ((product_price_except_cgst_sgst * cgst)/100).toFixed(2);
                var igst_amount = ((product_price_except_igst * igst)/100).toFixed(2);

                $('#c_gst').text('CGST : ₹ ' + cgst_amount +  ' ( '+ cgst +'%)');
                $('#s_gst').text('SGST : ₹ ' + sgst_amount +  ' ( '+ cgst +'%)');
                $('#i_gst').text('IGST :  ' + igst_amount +  ' ( '+ igst +'%)');

                // $orderSummery.find('#net-total').text(formatter.format(netTotal));
                // $orderSummery.find('#gross-total').text(formatter.format(grossTotal));

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
                $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${grossTotal}">`);
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


            $('#form-create-order').validate({
                rules: {
                    address_id: {
                        required: true
                    }
                },
                messages: {
                    address_id: {
                        required: "Please select a billing address for your order" }
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

            $('#form-create-order').on('submit', function(e) {
                if ($(this).valid()) {
                    let address = null;

                    $.ajax({
                        url: '{{ url('addresses') }}' + '/' + selectedAddressID,
                        async: false
                    }).done(function(response) {
                        address = response;
                    });

                    if (address && (! address.address || address.address === '-' || ! address.address_type)) {
                        e.preventDefault();

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
            });

            $('#form-update-address').on('submit', function(e) {
                if ($(this).valid()) {
                    e.preventDefault();

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
