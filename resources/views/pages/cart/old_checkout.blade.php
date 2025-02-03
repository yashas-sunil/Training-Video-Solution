@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <main class="orders px-md-5 px-sm-5" role="main">
        <form id="form-create-order" method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="pendrive_price" id="input-pendrive-price" value="">
            <input type="hidden" name="checked_study_materials" id="checked-study-materials">
            <input type="hidden" name="spin_wheel_reward_id" id="spin_wheel_reward_id">
            <input type="hidden" name="spin_wheel_reward_text" id="spin_wheel_reward_text">
            <input type="hidden" name="spin_wheel_reward_amount" id="spin_wheel_reward_amount">
            <input type="hidden" name="spin_wheel_reward_type" id="spin_wheel_reward_type">
            <input type="hidden" name="reward_id" id="reward_id">
            <input type="hidden" name="reward_amount" id="reward_amount">
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
                                                                            {{--                                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                                            {{--                                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                                            {{--                                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                                            {{--                                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                                            {{--                                                                        <i class="fa fa-star text-warning rating"></i>--}}
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
                                                                    {{--                                                                <div class="col-md-8">--}}
                                                                    {{--                                                                    <div class="d-flex justify-content-between justify-content-md-end align-items-md-center">--}}

                                                                    {{--                                                                    </div>--}}
                                                                    {{--                                                                </div>--}}
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
                        {{--                        @if ($errors->has('address_id'))--}}
                        {{--                            <div class="row">--}}
                        {{--                                <div class="col-md-10 offset-1">--}}
                        {{--                                    <div class="alert alert-danger alert-dismissible mt-4">--}}
                        {{--                                        <button type="button" class="close" data-dismiss="alert">&times;</button>--}}
                        {{--                                        <strong>  {{ $errors->first('address_id') }}</strong>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
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
                                                                    {{--<a href="#" data-toggle="modal" data-target="#modal-edit-address" class="edit-address"--}}
                                                                    {{--data-id="{{ $address['id'] }}"--}}
                                                                    {{--data-name="{{ $address['name'] }}"--}}
                                                                    {{--data-phone="{{ $address['phone'] }}"--}}
                                                                    {{--data-alternate_phone="{{ $address['alternate_phone'] }}"--}}
                                                                    {{--data-city="{{ $address['city'] }}"--}}
                                                                    {{--data-state="{{ $address['state'] }}"--}}
                                                                    {{--data-address="{{ $address['address'] }}"--}}
                                                                    {{--data-pin="{{ $address['pin'] }}"><i class="fas fa-edit"></i></a>--}}
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
                                            @foreach($cart['items'] as $cartItem)
                                                <div id="order-summery-item-{{ $cartItem['id'] }}" class="row row-cols-2 no-gutters order-summery-item">
                                                    <div class="col mb-2">{{ ucfirst($cartItem['name'])  }}</div>
                                                    <div class="col-auto ml-auto mb-2 text-right">
                                        <span class="mr-1 text-muted">
                                            <small class="strike-prices">
                                                @if ($cartItem['is_prebook'])
                                                    {{--                                                    <del>₹ {{ number_format($cartItem['prebook_selling_price'], 2) }}</del>--}}
                                                    {{--                                                    <del>₹ {{ number_format($cartItem['prebook_price'], 2) }}</del>--}}
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
                                        {{--                                        @if($reward_points)--}}
                                        <div class="row row-cols-2 no-gutters">
                                            <div class="col mb-2">
                                                Rewards
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 id="reward"  class="m-0">- ₹ 0</h5>
                                            </div>
                                        </div>
                                        {{--                                        @endif--}}
                                        <div class="row row-cols-2 no-gutters border-bottom border-secondary mb-3">
                                            <div class="col mb-2">
                                                Coupon
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 id="coupon-price"  class="m-0">- ₹ 0</h5>
                                            </div>
                                        </div>
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
                                                    {{--<small><small id="c_gst"></small></small><br>--}}
                                                    {{--<small><small id="s_gst"></small></small><br>--}}
                                                    {{--<small><small id="i_gst"> </small></small><br>--}}

                                                </div>

                                            </div>
                                        </div>

                                        <div class="bg-primary-50 px-3 py-3">
                                            @if($reward_points)
                                                <div class="form-group row no-gutters">
                                                    <label for="rewards" class="col-sm-6 col-form-label">J-Money</label>
                                                    <div class="col-sm-6 text-right">
                                                        {{--                                                <input type="email" readonly class="form-control form-control-sm " id="rewards">--}}
                                                        <select class="form-control form-control-sm" name="reward_points"  id="reward_points" >
                                                            <option>Select J-Money</option>
                                                            @foreach($reward_points as  $reward_point)
                                                                <option data-value="{{$reward_point['id']}}" value="{{$reward_point['points']}}">{{ $reward_point['activity'] }} (Rs. {{$reward_point['points']}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($spinWheelRewards)
                                                <div class="form-group row no-gutters">
                                                    <label for="rewards" class="col-sm-6 col-form-label">Spin Wheel Reward</label>
                                                    <div class="col-sm-6 text-right">
                                                        {{--                                                <input type="email" readonly class="form-control form-control-sm " id="rewards">--}}
                                                        <select class="form-control form-control-sm" name="spin_wheel"  id="spin_wheel" >
                                                            <option>Select Reward</option>
                                                            @foreach($spinWheelRewards as  $spinWheelReward)
                                                                @if ($spinWheelReward['value_type'] == 1)
                                                                    <option data-value="{{$spinWheelReward['value']}}" data-value-type="{{$spinWheelReward['value_type']}}" value="{{$spinWheelReward['id']}}">Rs. {{ $spinWheelReward['value'] }}</option>
                                                                @endif
                                                                @if ($spinWheelReward['value_type'] == 2)
                                                                    <option data-value="{{$spinWheelReward['value']}}" data-value-type="{{$spinWheelReward['value_type']}}" value="{{$spinWheelReward['id']}}">{{ $spinWheelReward['value'] }} % Off</option>
                                                                @endif
                                                                @if ($spinWheelReward['value_type'] == 3)
                                                                    <option data-value="{{$spinWheelReward['value']}}" data-value-type="{{$spinWheelReward['value_type']}}" value="{{$spinWheelReward['id']}}">Buy 1 Get 1 Free</option>
                                                                @endif
                                                                @if ($spinWheelReward['value_type'] == 5)
                                                                    <option data-value="{{$spinWheelReward['value']}}" data-value-type="{{$spinWheelReward['value_type']}}" value="{{$spinWheelReward['id']}}">Get 1 Chapter Free</option>
                                                                @endif
                                                                @if ($spinWheelReward['value_type'] == 6)
                                                                    <option data-value="{{$spinWheelReward['value']}}" data-value-type="{{$spinWheelReward['value_type']}}" value="{{$spinWheelReward['id']}}">Get 3 Chapter Free</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($user['role'] == 5)
                                                <div class="form-group row no-gutters">
                                                    <label for="discount_coupon" class="col-sm-8 col-form-label">Discount Coupon</label>
                                                    <div class="col-sm-4 text-right">
                                                        <input type="text"  class="form-control form-control-sm" id="coupon" name="coupon">
                                                        <p id="coupon-message"style="font-size: x-small"></p>
                                                    </div>
                                                </div>
                                                <div class="errorTxt" style="color: red;margin-bottom: 3px;"></div>
                                                <div class="form-group row no-gutters mb-0">
                                                    <div class="col-sm-12">
                                                        <button id="apply" type="button" class="btn btn-primary form-control-sm float-right">Apply</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="hidden-inputs-container">

                                    </div>
                                    @if ($user['role'] == 5)
                                        <button class="btn btn-block btn-primary rounded-0 my-3 checkout" style="margin-top: 0px !important;"  type="submit">Checkout</button>
                                    @endif
                                    @if ($user['role'] == 7)
                                        <div id="order-summary-buttons-container">
                                            <div id="btn-checkout-container">
                                                <button class="btn btn-block btn-primary rounded-0 my-3" style="margin-top: 0px !important;"  type="button" data-toggle="modal" data-target="#modal-create-student">Checkout</button>
                                            </div>
                                            <div id="btn-payment-container" style="display: none">
                                                <button class="btn btn-block btn-primary rounded-0 my-3" type="button" id="btn-send-payment-link">Send Link For Payment</button>
                                                <button class="btn btn-block btn-primary rounded-0 my-3" type="button" id="btn-pay-by-self">Pay By Self</button>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <section >
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
                        <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
                            <div class="bg-diamond-lg"></div>
                        </div>
                        <div class="tab-content container mt-5" id="students-tab">
                            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                                <form id="form-create-student" method="POST" action="{{ route('associate.students.store') }}">
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
                                                <label for="phone" class="col-sm-5 col-form-label col-form-label-sm">Mobile*</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="phone" name="phone">
                                                </div>
                                            </div>
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
                                    <div class="row mt-5">
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
                                    @foreach($associateStudents['data'] as $id => $student)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-3 mt-2">
                                                    <input type="radio" id="radio-student-id-{{ $id }}" name="radio_student_id" class="bg-blue custom-control-input radio-studen-id" value="{{ $student['user_id'] }}">
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
                                    <button type="submit" class="btn btn-primary px-4" id="btn-existing-student-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit-address" tabindex="-1" role="dialog" aria-labelledby="modal-edit-address-title" aria-hidden="true">
        <div class="modal-dialog modal-edit-address" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-secondary text-uppercase" id="modal-edit-address-title">Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-address" method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" class="form-control form-control-sm" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="alternate_phone" name="alternate_phone" class="form-control form-control-sm" placeholder="Alternate Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" id="city" name="city" class="form-control form-control-sm" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="state" name="state" class="form-control form-control-sm" placeholder="State" required>
                        </div>
                        <div class="form-group">
                            <textarea name="address" id="address" class="form-control form-control-sm" placeholder="Address" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="pin" name="pin" class="form-control form-control-sm" placeholder="Pin" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGIN MODAL-->
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
    <input id="gross-total" type="hidden" value="{{  $cart['total'] }}">

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
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0" style="position: relative;">
                <div class="modal-body text-center" >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('assets/images/gold-trophy.jpg') }}" width="125%">
                        </div>
                        <div class="col-md-7" style="margin-top: auto; margin-bottom: auto;">
                            You have saved <h1 class="result-modal-amount m-0 p-0 text-secondary"></h1>in this purchase
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="error-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/images/error.png') }}" width="25%">
                            <p class="text-danger error-modal-text"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="warning-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="warning-modal-text mt-2"></p>
                            <p>Are you sure to procceed?</p>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary button-proceed">Proceed</button>
                        <button class="btn btn-secondary button-cancel">Cancel</button>
                    </div>
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
            var couponDiscount = 0;
            var redeemDiscount = 0;
            var spinWheelRewardDiscount = 0;
            var pendrive_price = 0;
            var reward_point_id = 0;
            var studyMaterialPrice = 0;
            var grossTotal = parseInt('{{  $cart['total'] }}')+parseInt(pendrive_price) + parseInt(studyMaterialPrice) - parseInt(couponDiscount);

            if (grossTotal < 0) {
                grossTotal = 0;
            }

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
                var grossTotal = parseInt('{{  $cart['total'] }}') + parseInt(pendrive_price) + parseInt(studyMaterialPrice) - parseInt(couponDiscount)-parseInt(redeemDiscount) - parseInt(spinWheelRewardDiscount);

                if (grossTotal < 0) {
                    grossTotal = 0;
                }


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

            $('#reward_points').change(function(){

                reward_point_id = $('option:selected',this).data("value");
                if($(this).val()!='Select J-Money'){
                    redeemDiscount = 0;
                    $('#spin_wheel').prop("selectedIndex", 0).change();

                    let rewardID = $(this).find('option:selected').attr('data-value');
                    let rewardAmount = $(this).val();

                    $('#reward_id').val(rewardID);

                    if (rewardAmount >= grossTotal) {
                        $orderSummery.find('#reward').text('- ₹ ' + grossTotal);
                        redeemDiscount = grossTotal;
                        $('#reward_amount').val(grossTotal);
                    } else {
                        $orderSummery.find('#reward').text('- ₹ ' + rewardAmount);
                        redeemDiscount = rewardAmount;
                        $('#reward_amount').val(rewardAmount);
                    }

                    update_tax();
                }
                else {
                    $('#reward_id').val(null);
                    $('#reward_amount').val(null);
                    $orderSummery.find('#reward').text('- ₹ ' + 0);
                    redeemDiscount = 0;
                    reward_point_id = 0;
                    update_tax();
                }

            });

            $('#spin_wheel').change(function(){

                let selectedAddressState = $('.select_address:checked').data('state');
                selectedAddressState = selectedAddressState ? selectedAddressState.toUpperCase() : '';

                var reward_id = $('option:selected',this).data("value");
                var reward_value = $(this).find('option:selected').attr('data-value')
                var reward_value_type = $(this).find('option:selected').attr('data-value-type')
                if($(this).val()!='Select Reward'){
                    spinWheelRewardDiscount = 0;
                    $('#reward_points').prop("selectedIndex", 0).change();
                    $('#spin_wheel_reward_text').val($(this).find('option:selected').text());
                    $('#spin_wheel_reward_id').val($(this).val());
                    $('#spin_wheel_reward_type').val($(this).find('option:selected').attr('data-value-type'));

                    if(reward_value_type == 1){
                        if (reward_value > grossTotal) {
                            spinWheelRewardDiscount = grossTotal;

                            $('#warning-modal').modal('toggle');
                            $('.warning-modal-text').text('You can use upto Rs. ' + reward_value + ' in this offer. But you are using only Rs. ' + grossTotal);

                            $('#warning-modal').find('.button-proceed').click(function() {
                                $('#warning-modal').modal('toggle');
                                $('#resultModal').modal('toggle');
                                $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                            });

                            $('#warning-modal').find('.button-cancel').click(function() {
                                $('#warning-modal').modal('toggle');
                                $('#spin_wheel').prop("selectedIndex", 0).change();
                            });
                        } else {
                            spinWheelRewardDiscount = reward_value;

                            $('#resultModal').modal('toggle');
                            $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                        }
                    }

                    if(reward_value_type == 2){
                        let discountedAmount = Math.round(grossTotal * (reward_value/100));

                        if (discountedAmount > 10000) {
                            spinWheelRewardDiscount = 10000;
                        } else {
                            spinWheelRewardDiscount = discountedAmount;
                        }

                        $('#resultModal').modal('toggle');
                        $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                    }

                    if(reward_value_type == 3){
                        let cartItems = @json($cart['items']);

                        if (cartItems.length <= 1) {
                            $(this).prop("selectedIndex", 0).change();

                            $('#error-modal').modal('toggle');
                            $('.error-modal-text').text('The minimum courses count must be two. Please add at least 2 courses to your cart to apply this offer');
                        }

                        if (cartItems.length > 1) {
                            let prices = [];

                            cartItems.forEach(function(item) {
                                prices.push(item.price)
                            });

                            spinWheelRewardDiscount = Math.min(...prices);

                            $('#resultModal').modal('toggle');
                            $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                        }
                    }

                    if (reward_value_type == 5) {
                        let cartItems = @json($cart['items']);
                        let cartItemsCount = cartItems.length;
                        let cartItemType = parseInt(cartItems[0].type) || 0;

                        if (cartItemsCount === 1 && cartItemType === 1) {
                            spinWheelRewardDiscount = grossTotal;

                            $('#resultModal').modal('toggle');
                            $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                        } else {
                            $(this).prop("selectedIndex", 0).change();

                            $('#error-modal').modal('toggle');
                            $('.error-modal-text').text('Selected courses do not have any chapter-based course and/or the number of selected chapter-based courses are more than one. Please select only one chapter based course.');
                        }
                    }

                    if (reward_value_type == 6) {
                        let cartItems = @json($cart['items']);
                        let cartItemsCount = cartItems.length;
                        let cartItemType = false;
                        let cartItemTypes = [];

                        cartItems.forEach(function (item) {
                            cartItemTypes.push(parseInt(item.type));
                        });

                        cartItemType = cartItemTypes.every(function (e) {
                            return e === 1;
                        });

                        if (cartItemsCount < 3 && cartItemType) {
                            spinWheelRewardDiscount = grossTotal;

                            $('#warning-modal').modal('toggle');
                            $('.warning-modal-text').text('You can use upto 3 chapters in this offer. But you are using only ' + cartItemsCount + ' chapter');

                            $('#warning-modal').find('.button-proceed').click(function() {
                                $('#warning-modal').modal('toggle');
                                $('#resultModal').modal('toggle');
                                $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                            });

                            $('#warning-modal').find('.button-cancel').click(function() {
                                $('#warning-modal').modal('toggle');
                                $('#spin_wheel').prop("selectedIndex", 0).change();
                            });
                        }

                        if (cartItemsCount === 3 && cartItemType) {
                            spinWheelRewardDiscount = grossTotal;

                            $('#resultModal').modal('toggle');
                            $('.result-modal-amount').text('Rs. ' + spinWheelRewardDiscount);
                        }

                        if (cartItemsCount > 3) {
                            $(this).prop("selectedIndex", 0).change();

                            $('#error-modal').modal('toggle');
                            $('.error-modal-text').text('Selected courses do not have any chapter-based course and/or the number of selected chapter-based courses are more than three. Please select only three chapter-based courses.');
                        }
                    }

                    $orderSummery.find('#reward').text('- ₹ ' + spinWheelRewardDiscount);
//                spinWheelRewardDiscount = $(this).val();

                    if (selectedAddressState == 'MAHARASHTRA') {
                        update_tax();
                    } else {
                        update_tax(1);
                    }

                    $('#spin_wheel_reward_amount').val(spinWheelRewardDiscount);
                }
                else {
                    $orderSummery.find('#reward').text('- ₹ ' + 0);
                    spinWheelRewardDiscount = 0;
                    reward_point_id = 0;

                    if (selectedAddressState == 'MAHARASHTRA') {
                        update_tax();
                    } else {
                        update_tax(1);
                    }

                    $('#spin_wheel_reward_id').val(null);
                    $('#spin_wheel_reward_text').val(null);
                    $('#spin_wheel_reward_amount').val(null);
                    $('#spin_wheel_reward_type').val(null);
                }

            });


            $("#apply").click(function(){
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



            {{--$('#form-edit-address').validate({--}}
            {{--rules: {--}}
            {{--name: {--}}
            {{--required: true,--}}
            {{--maxlength: 191--}}
            {{--},--}}
            {{--phone: {--}}
            {{--required: true,--}}
            {{--digits:true,--}}
            {{--maxlength: function() {--}}
            {{--if ($('#mobile-code').val() === '+91') {--}}
            {{--return 10;--}}
            {{--} else {--}}
            {{--return 9;--}}
            {{--}--}}
            {{--},--}}
            {{--minlength: function() {--}}
            {{--if ($('#mobile-code').val() === '+91') {--}}
            {{--return 10;--}}
            {{--} else {--}}
            {{--return 9;--}}
            {{--}--}}
            {{--}--}}
            {{--,--}}
            {{--remote: {--}}
            {{--url: '{{ url('validate-phone') }}',--}}
            {{--type: 'POST',--}}
            {{--data: {--}}
            {{--mobile: function() {--}}
            {{--if ($('#mobile-code').val() === '+91') {--}}
            {{--return '+91' + $('#phone').val();--}}
            {{--} else {--}}
            {{--return '+971' + $('#phone').val();--}}
            {{--}--}}
            {{--}--}}
            {{--}--}}
            {{--}--}}
            {{--},--}}
            {{--alternate_phone: {--}}
            {{--digits: true,--}}
            {{--maxlength: function() {--}}
            {{--if ($('#mobile-code').val() === '+91') {--}}
            {{--return 10;--}}
            {{--} else {--}}
            {{--return 9;--}}
            {{--}--}}
            {{--},--}}
            {{--minlength: function() {--}}
            {{--if ($('#mobile-code').val() === '+91') {--}}
            {{--return 10;--}}
            {{--} else {--}}
            {{--return 9;--}}
            {{--}--}}
            {{--},--}}
            {{--remote: {--}}
            {{--url: '{{ url('validate-phone') }}',--}}
            {{--type: 'POST',--}}
            {{--data: {--}}
            {{--mobile: function() {--}}
            {{--if ($('#mobile-code').val() === '+91') {--}}
            {{--return '+91' + $('#phone').val();--}}
            {{--} else {--}}
            {{--return '+971' + $('#phone').val();--}}
            {{--}--}}
            {{--}--}}
            {{--}--}}
            {{--}--}}
            {{--},--}}
            {{--city: {--}}
            {{--required: true,--}}
            {{--maxlength: 191--}}
            {{--},--}}
            {{--state: {--}}
            {{--required: true,--}}
            {{--maxlength: 191--}}
            {{--},--}}
            {{--address: {--}}
            {{--required: true,--}}
            {{--maxlength: 191--}}
            {{--},--}}
            {{--pin: {--}}
            {{--required: true,--}}
            {{--digits: true,--}}
            {{--maxlength: 191--}}
            {{--}--}}
            {{--}--}}
            {{--});--}}


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

            $('#btn-pay-by-self').click(function() {
                $('#hidden-inputs-container').append(`<input type="hidden" name="associate_payment_type" value="self">`);
                $('#form-create-order').submit();
            });

            $('#table-students').DataTable();

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

            // $('.checkbox-study-material').each(function() {
            //     alert('Hello');
            //     $('.checkbox-study-material').prop("checked", true).trigger("change");
            // });

            $('.study-material-ebook').each(function() {
                $(this).prop( "checked", true );
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
