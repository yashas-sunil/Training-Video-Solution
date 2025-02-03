@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="container-fluid">
            {{-- <div id="facebookPixelNoScriptInitiateCheckoutContainer" style="display: none;"></div> --}}
            <div id="facebookPixelNoScriptAddPaymentInfoontainer" style="display: none;"></div>
            <div class="cart_section">
                <div class="cart_title">Checkout</div>
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
                    <input type="hidden" name="max_jkoin" id="max_jkoin" value="{{$max_jkoin_percentage}}">
                    <input type="hidden" name="holiday_offer_id" id="holiday_offer_id" value="{{@$holiday_offers['id']}}">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="cart-programs" id="checkout_col">
                                <div class="checkout_lists">
                                    @php $cseet = 0;
                                    $cseet_pkg_id='';
                                    
                                    @endphp
                                    @foreach($cart['items'] as $cartItem)
                                        @php
                                        if($cartItem['is_cseet'] == 1)
                                            $cseet = $cseet + 1;
                                            $cseet_pkg_id=$cartItem['id']
                                        @endphp
                                        <div class="pro_gram">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <div class="pro_pram_image">
                                                        <img src="{{ $cartItem['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="">
                                                        @if($isPackage==0)
                                                            <button class="btn btn-secondary cart-remove mt-2" data-id="{{ $cartItem['cart_item_id'] }}">
                                                                <i class="fa fa-trash-o mr-3 " aria-hidden="true"></i>Delete
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12">
                                                    <div class="pro_gram_details">
                                                        <a style="text-decoration:none" href=" ">
                                                            <h2>{{ $cartItem['name'] }}</h2>
                                                        </a>
                                                        <h6>{{ \Illuminate\Support\Str::limit($cartItem['description'], 100, $end = '...') }}</h6>
                                                        <ul>
                                                            <li><img src="{{ asset('assets/new_ui_assets/images/dashboard/time.svg') }}" alt=""></li>
                                                            @if (!$cartItem['is_prebook'] || $cartItem['is_prebook_content_ready'])
                                                                <li>
                                                                    <p> @if ($cartItem['total_duration_formatted'])
                                                                    {{ $cartItem['total_duration_formatted'] }} @if($cartItem['bonus_duration_formatted']) 
                                                                   + {{  $cartItem['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif |@endif {{$cartItem['language']['name']}}
                                                                    </p>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <p> @if ($cartItem['prebook_total_duration'])
                                                                        {{ $cartItem['prebook_total_duration'] }} |@endif {{$cartItem['language']['name']}}
                                                                    </p>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                        <ul>
                                                        <li><img src="{{ asset('assets/new_ui_assets/images/course-icons/play_circle.png') }}"></li>
                                                        <li>
                                                            @php                                                            
                                                            if($cartItem['total_duration_formatted']==null){ 
                                                           
                                                           $hours2=array();  
                                                       }else{
                                                           $hours2=explode(':',$cartItem['total_duration_formatted']);
                                                       }
                                                          
                                                            @endphp
                                                          
                                                          
                                                            <p>Valid Upto: <b><?= $cartItem['expiry_type']=='1' ? $cartItem['expiry_month'].' Months':($cartItem['expiry_type']=='2' ? date('d M Y',strtotime($cartItem['expire_at'])) :' 9 Months') ;?></b></p> | <p><b>
        @if(count($hours2)>0)
        {{$hours2[0]*$cartItem['duration']}} 
        @else
        {{0}}
        @endif
     @if(count($hours2)==3)
      Hours 
      @endif
      @if(count($hours2)==2) 
      Minutes 
      @endif</b></p>
                                                        </li>
                                                    </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="content_delivery">
                                                        <h6 class="delivery_title">Content Delivery</h6>
                                                            <ul>
                                                                <li>
                                                                    <input checked type="radio" class="delivery-mode"
                                                                           id="online{{ $cartItem['id'] }}" value="online"
                                                                           name="content_delivery[{{ $cartItem['id'] }}]"
                                                                           data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                                           data-package-id="{{ $cartItem['id'] }}"
                                                                           data-package-name="{{ $cartItem['name'] }}">
                                                                    <label for="online{{ $cartItem['id'] }}">Online</label>
                                                                </li>
                                                                @if($cartItem['pendrive']!=0)
                                                                <li>

                                                                    <input type="radio"
                                                                           id="pendrive{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                                           class="delivery-mode" value="pendrive"
                                                                           data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                                           data-package-id="{{ $cartItem['id'] }}"
                                                                           data-package-name="{{ $cartItem['name'] }}">
                                                                    <label for="pendrive{{ $cartItem['id'] }}">Pendrive</label>

                                                                    </li>
                                                                @endif
                                                               
                                                            </ul><br>
                                                            <ul>
                                                            @if($cartItem['g_drive']==1)
                                                                <li>
                                                                    <input type="radio"
                                                                           id="g-drive{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                                           class="delivery-mode" value="g-drive"
                                                                           data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                                           data-package-id="{{ $cartItem['id'] }}"
                                                                           data-package-name="{{ $cartItem['name'] }}">
                                                                    <label for="g-drive{{ $cartItem['id'] }}">G-drive</label>
                                                                </li>
                                                                @endif
                                                            </ul>

                                                            <hr>
                                                            <h6 class="delivery_title">Study Material</h6>
                                                            <ul>
                                                                <li>
                                                                    <input  checked type="radio" id="study-material-ebook-{{ $cartItem['id'] }}"
                                                                            name="study_material[{{ $cartItem['id'] }}]"
                                                                            class="bg-blue custom-control-input study-material study-material-ebook"
                                                                            value="ebook"
                                                                            data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                                            data-package-id="{{ $cartItem['id'] }}"
                                                                            data-package-name="{{ $cartItem['name'] }}">
                                                                    <label for="study-material-ebook-{{ $cartItem['id'] }}">E-book</label>
                                                                </li>
                                                                @if ($cartItem['study_material_price'])
                                                                <li>
                                                                    <input type="radio" id="study-material-printed-{{ $cartItem['id'] }}" name="study_material[{{ $cartItem['id'] }}]"
                                                                           class="custom-control-input study-material" value="printed"
                                                                           data-study-material-price="{{ $cartItem['study_material_price'] }}"
                                                                           data-package-id="{{ $cartItem['id'] }}"
                                                                           data-package-name="{{ $cartItem['name'] }}">
                                                                    <label for="study-material-printed-{{ $cartItem['id'] }}">Printed</label>

                                                                </li>
                                                                @endif
                                                            </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                                @foreach($cart['items'] as $cartItem)
                                                    <div id="order-summery-item-{{ $cartItem['id'] }}" class="order-summery-item">
                                                        <li>
                                                            <h5>{{ $cartItem['name'] }}</h5>                                                            
                                                            <h6>
                                                                @foreach ($cartItem['strike_prices'] as $price)
                                                                    <del>₹ {{ number_format($price,2) }}</del>
                                                                @endforeach
                                                    </h6>
                                                            <h6 class="selling-price"><i class="fa fa-inr strike-prices" aria-hidden="true"></i>
                                                                {{ number_format($cartItem['selling_price'],2) }}</h6>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </ul>
                                        <div class="net_coupons">
                                            @if($cart['totalrakshabandanprice']!=0||$cart['rakshajcoin']!=0)
                                            @if($cart['totalrakshabandanprice']!=0)
                                            <h5>{{$holiday_offers['name']}} Discount</h5>
                                            @endif
                                            <input type="hidden" id="rakshadiscounthidden" value="{{$cart['totalrakshabandanprice']}}">
                                            <input type="hidden" id="rakshajcoin" value="{{$cart['rakshajcoin']}}">
                                            @if($cart['totalrakshabandanprice']!=0)
                                            <h6 id="raksha-discount"><i class="fa fa-inr" aria-hidden="true"></i>{{number_format($cart['totalrakshabandanprice'],2)}}</h6>
                                            @endif
                                            @else
                                            <input type="hidden" id="rakshadiscounthidden" value="0">
                                            <input type="hidden" id="rakshajcoin" value="0">
                                            @endif

                                        </div>
                                        <div class="gross_total">
                                            <h5>Gross Total</h5>
                                            <h6 id="gross-total"><i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($cart['total'],2) }}</h6>
                                        </div>
                                        <div class="reward">
                                            <h5>Rewards</h5>
                                            <h6 id="reward"><i class="fa fa-inr" aria-hidden="true"></i>0</h6>
                                        </div>
                                        <div class="net_coupons">
                                            <h5>Coupons</h5>
                                            <h6 id="coupon-price">0</h6>
                                        </div>
                                        
                                        <hr>
                                        @if($reward_points>0)
                                            <div class="form-group row no-gutters">
                                                <label for="rewards" class="col-sm-6 col-form-label">J-Koins</label>
                                                <div class="col-sm-6 text-right">
                                                                                                    <input type="email" readonly class="form-control form-control-sm " id="rewards">
                                                    <select class="form-control form-control-sm" name="reward_points"  id="reward_points" >
                                                        <option>Select J-Koins</option>
                                                        <option data-value="{{$reward_points}}" value="{{$reward_points}}">Jkoins Total Rs.{{ $reward_points}}</option>
                                                    </select>
                                                </div>
                                                <div class="" id="maxjkoin_msg" style="color: red;margin-bottom: 3px;font-size: small;"></div>
                                            </div>
                                        @endif
                                        @if ($user['role'] == 5)
                                            <div class="coupon_code">
                                                <label for="coupon">Coupon Code</label>
                                                <div class="code_input">
                                                <input type="hidden" id="package_id" name="package_id" value="{{$package_id}}" placeholder="Enter">
                                                    <input type="text" id="coupon" name="coupon" placeholder="Enter">
                                                    <button class="btn" id="apply" type="button">Apply</button>
                                                </div>
                                                <p id="coupon-message"style="font-size: x-small"></p>
                                                <div class="errorTxt" style="color: red;margin-bottom: 3px;"></div>
                                            </div>
                                        @endif
                                        <hr>
                                        <div class="total-prize">
                                            <h5>Net Total</h5>
                                            <h6 id="net-total"><i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($cart['total'],2) }}</h6>
                                        </div>
                                        <div class="total-tax">
                                            <h5></h5>
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
                                                <!-- <span>CGST 9% (<i class="fa fa-inr"></i>953.00)</span>
                                                <span>SGST 9% (<i class="fa fa-inr"></i>953.00)</span> -->
                                            </h6>
                                        </div>
                                        <div id="hidden-inputs-container">

                                        </div>
                                        @if($cseet)
                                       
                                        <input type="hidden" value="{{ $cseet_pkg_id}}" name="cseet_pkg_id">
                                        @endif
                                        <button class="btn btn-block btn-primary my-3 checkout" style="margin-top: 0px !important;"
                                                id="order-checkout-button"  type="submit">Checkout</button>
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
                            <label>City*</label>
                            <input type="text" name="city" class="form-control" @if(!$addresses)  required @endif>
                        </div>
                        <div class="form-group">
                            <label>Pincode*</label>
                            <input type="text" name="pin" class="form-control" id="add-pin"
                                   placeholder="6 digits [0-9] PIN code" @if(!$addresses)  required @endif>
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
                            <label>City*</label>
                            <input type="text" id="update-address-city" name="city" class="form-control" @if(!$addresses)  required @endif>
                        </div>

                        <div class="form-group">
                            <label>Pincode*</label>
                            <input type="text" id="update-address-pin" name="pin" class="form-control"
                                   placeholder="6 digits [0-9] PIN code" @if(!$addresses)  required @endif>
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
    <div class="modal fade" id="confirmdelete" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="confirmdeletelabel" aria-hidden="true">
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
    <div class="modal fade" id="rakshabandhan" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="rakshabandhanlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <div class="delete_title mt-3 text-center font-weight-bold">{{@$holiday_offers['name']}} Discount: </div>
                    <div class="delete_title mt-3 text-center font-weight-bold">
                        @if(@$holiday_offers[discount_amount]>0&&@$holiday_offers[cashback_amount]>0)
                        Flat {{@$holiday_offers['discount_amount']}}@if(@$holiday_offers['discount_type']==2)% @endif discount <br>&<br>
                        {{@$holiday_offers['cashback_amount']}}@if(@$holiday_offers['cashback_type']==2)% @endif cashback
                         applied on your purchase
                         @elseif(@$holiday_offers[discount_amount]>0)
                        Flat {{@$holiday_offers['discount_amount']}}@if(@$holiday_offers['discount_type']==2)% @endif discount applied on your purchase 
                        @else
                         {{@$holiday_offers['cashback_amount']}}@if(@$holiday_offers['cashback_type']==2)% @endif cashback applied on your purchase
                         @endif
                        </div>
                    <div class="delete_conf_btns d-flex align-items-center justify-content-center mt-5">
                        <!-- <button id="btn-delete-confirm" class="btn btn-success confirm mx-2">Confirm</button> -->
                        <button class="btn btn-secondary mx-2 btn-cancel-confirm">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cseet-modal"  role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title">Add New Address:</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cseet_close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-cseet"  method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Attach Proof</label>
                            <input type="file" class="form-control" name="proof" id="proof">
                        </div>
                        
                        <button style="border: none;background: #F59359;border-radius: 15px;min-width: 100px;font-weight: bold;font-size: 13px;color: #FFFFFF;margin: 0 auto;display: block;" type="submit" class="btn" id="btn-cseet">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
            $(document).ready(function(){
                var cseet_flag=1;
                'use strict';
                var $orderSummery = $('#order-summery');
                var  $rakshadiscounthiddencheckvalue=$orderSummery.find('#rakshadiscounthidden').val();
                var holidayjkoin=$orderSummery.find('#rakshajcoin').val();
                var today = new Date();
                var date = today.getFullYear() + '-' + (today.getMonth()+1) + '-' + today.getDate();
               
                if('{{@$holiday_offers['id']}}' && ($rakshadiscounthiddencheckvalue>0 || holidayjkoin>0)){
                $('#rakshabandhan').modal();
                // alert ("Raksha Bandhan Discount Flat 2.5% discount applied on your purchase");
                // console.log("Raksha Bandhan Discount Flat 2.5% discount applied on your purchase");
                }
                let cartItems = @json($cart['items']);
                let cartItemsCount = cartItems.length;
                if(cartItemsCount<=0) {
                    $("#order-checkout-button").addClass('d-none');
                }

                $('.cart-remove').click(function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');

                    $('#btn-delete-confirm').attr('data-id', id);

                    $('#confirmdelete').modal();
                });

                $('.btn-cancel-confirm').click(function (e) {
                    $('#rakshabandhan').modal('hide');
                    $('#confirmdelete').modal('hide');
                });

                $('#btn-delete-confirm').click(function (e) {
                    e.preventDefault();

                    let id = $(this).data('id');

                    $.ajax({
                        type:'POST',
                        url:'{{ url('/cart/remove') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': id
                        },
                        success:function() {
                            location.reload();
                        }
                    });
                });


                $('#address_type').select2();
                $('#update-address-address-type').select2();

                $('#form-add-address').find('#state_id').change(function() {
                    $('#add-address-state').val($(this).text());
                });

                $('#form-add-address').find('#country_id').change(function() {
                    $('#add-address-country').val($(this).text());
                    var country = $(this).val();
                    if(country == 2){
                        $('#add-pin').val('00000');
                        $('#add-pin').attr('readonly', true);
                    }else{
                        $('#add-pin').val('');
                        $('#add-pin').attr('readonly', false);
                    }
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
                var couponType = 0;
                var couponPackageId=0;
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
                    var product_price_except_cgst_sgst = ((grossTotal *100)/(100+cgst+sgst)).toFixed(2);
                    var product_price_except_igst = ((grossTotal *100)/(100+igst)).toFixed(2);
                    var cgst_amount = ((product_price_except_cgst_sgst * cgst)/100).toFixed(2);
                    var sgst_amount = ((product_price_except_cgst_sgst * cgst)/100).toFixed(2);
                    var igst_amount = ((product_price_except_igst * igst)/100).toFixed(2);


                    $('#c_gst').text('CGST : ₹ ' + cgst_amount +  ' ( '+ cgst +'%)');
                    $('#s_gst').text('SGST : ₹ ' + sgst_amount +  ' ( '+ cgst +'%)');
                    $('#i_gst').text('IGST :  ' + igst_amount +  ' ( '+ igst +'%)');
                    
                    $orderSummery.find('#net-total').text('₹ '+formatter.format(product_price_except_igst));
                    $orderSummery.find('#gross-total').text('₹ '+formatter.format(grossTotal));
                    var today = new Date();
                    var date = today.getFullYear() + '-' + (today.getMonth()+1) + '-' + today.getDate();
                    if('{{  @$holiday_offers['id'] }}'){
                     var   rakshajcoin =  $orderSummery.find('#rakshajcoin').val();
                     var   rakshadiscounthidden =  $orderSummery.find('#rakshadiscounthidden').val();
                    }
                 

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
                    $('#hidden-inputs-container').append(`<input type="hidden" name="coupon_type" value="${couponType}">`);
                    $('#hidden-inputs-container').append(`<input type="hidden" name="coupon_package_id" value="${couponPackageId}">`); 
                    if('{{  @$holiday_offers['id'] }}'){
                    $('#hidden-inputs-container').append(`<input type="hidden" name="rakshajcoin" value="${rakshajcoin}">`);  
                    $('#hidden-inputs-container').append(`<input type="hidden" name="rakshadiscounthidden" value="${rakshadiscounthidden}">`);   
                    }  
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


        //         var isPendrive = null;

        //         $('.order-items').find('.order-item').each(function () {
        //             var id = $(this).data('id');
        //             var $deliveryMod = $(this).find(".delivery-mode[name='content_delivery["+id+"]']:checked").val();

        //             if ($deliveryMod === 'pendrive') {
        //                 isPendrive = true;
        //             }
        //         });

        //         if (isPendrive) {
        //             $('#pendrive-price').html(
        //                 `<div class="row row-cols-2 no-gutters">
        //     <div class="col mb-2">Pendrive Price</div>
        //     <div class="col mb-2 text-right">
        //         <h5 class="m-0">₹ <span id="gross-total">{{ number_format($pendrivePrice,2) }}</span></h5>
        //     </div>
        // </div>`
        //             );

                //     pendrive_price = {{ number_format($pendrivePrice,2)}};
                //     update_tax();

                // } else {
                //     pendrive_price = 0;
                //     $('#pendrive-price').html('');
                //     update_tax();
                // }


                $('.delivery-mode').change(function() {

                    let mode = $(this).val();
                   
                   

                    //let studyMaterialPriceData = $(this).data('study-material-price');
                    let packageId = $(this).data('package-id');
                    let packageName = $(this).data('package-name');
                    let price = {{ number_format($pendrivePrice,2)}};
                   
                    var  state_sel = $('.select_address:checked').data('state');
                    if(mode == 'pendrive'){
                        
                        pendrive_price += price;
                        if(state_sel.toUpperCase() == 'MAHARASHTRA'){
                            update_tax();
                        }
                        else{
                            update_tax(1);
                        }
                            $(`.order-summery-items`).append(
                                `<div id="order-delivery-mode-${packageId}" class="row row-cols-2 no-gutters order-summery-item del_${packageId}">
                                <div class="col mb-2">${packageName} (<small>Pendrive</small>)</div>
                                    <div class="col-auto ml-auto mb-2 text-right">
                                        <h6 class="d-inline m-0">₹ <span class="selling-price">${price}</span></h6>
                                    </div>
                                </div>`)
                       
                    }
                    
                   else {

                        if (pendrive_price) {
                            pendrive_price -= price;
                            if(state_sel.toUpperCase() == 'MAHARASHTRA'){
                            update_tax();
                        }
                        else{
                            update_tax(1);
                        }
                           // alert(packageId);
                           
                           // $(`.del_${packageId}`).remove();
                            $(".del_"+packageId).remove();
                          //  $(`#order-study-material-${packageId}`).remove();

                        }
                       
                    }
                });

                $('#reward_points').change(function(){

                    var  state_sele = $('.select_address:checked').data('state');
                    reward_point_id = $('option:selected',this).data("value");
                    if($(this).val()!='Select J-Koins'){
                        redeemDiscount = 0;
                        $('#spin_wheel').prop("selectedIndex", 0).change();

                        let rewardID = $(this).find('option:selected').attr('data-value');
                        let rewardAmount = $(this).val();

                        $('#reward_id').val(rewardID);
                        var max_jkoin = $('#max_jkoin').val();
                        
                        var max_reward_amount= parseInt(grossTotal * max_jkoin/100);

                        if (rewardAmount <= max_reward_amount) {
                            $orderSummery.find('#reward').text('- ₹ ' + rewardAmount);
                            redeemDiscount = rewardAmount;
                            $('#reward_amount').val(rewardAmount);
                            $('#maxjkoin_msg').hide();
                        } else {
                            $orderSummery.find('#reward').text('- ₹ ' + max_reward_amount);
                            $('#maxjkoin_msg').html('You can use max of '+max_reward_amount+' JKOIN on this order');
                            redeemDiscount = max_reward_amount;
                            $('#maxjkoin_msg').show();
                            $('#reward_amount').val(max_reward_amount);
                        }

                        if(state_sele.toUpperCase() == 'MAHARASHTRA'){
                            update_tax();
                        }
                        else{
                            update_tax(1);
                        }
                    }
                    else {
                        $('#reward_id').val(null);
                        $('#reward_amount').val(null);
                        $orderSummery.find('#reward').text('- ₹ ' + 0);
                        redeemDiscount = 0;
                        reward_point_id = 0;
                        if(state_sele.toUpperCase() == 'MAHARASHTRA'){
                            update_tax();
                        }
                        else{
                            update_tax(1);
                        }
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
                    var package_id=$('#package_id').val();
                    if(coupon){
                        $.ajax({
                            type: 'POST',
                            url: '{{ url('/cart/apply-coupon') }}',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'amount': grossTotal,
                                'coupon': coupon,
                                'package_id': package_id
                            },
                            success:function(response) {
                                let selectedAddresState = $('.select_address:checked').data('state');
                                  selectedAddresState = selectedAddresState ? selectedAddresState.toUpperCase() : '';
                                if (response.data.total_coupon_amount > 0 ) {
                                  
                                  couponDiscount = response.data.total_coupon_amount;
                                  couponType= response.data.coupon_type;
                                  if(response.data.packageid){ 
                                  var pk_id=response.data.packageid;
                                  couponPackageId=pk_id.join(", ");
                                  }
                                  
                                  if (selectedAddresState == 'MAHARASHTRA') {
                                        update_tax();
                                  } else {
                                        update_tax(1);
                                  }
                                    $orderSummery.find('#coupon-price').text('- ₹ ' + couponDiscount);
                                    $orderSummery.find('#coupon-message')
                                        .text('Coupon Applied')
                                        .css('color', 'green');
                                        $("#apply").prop( "disabled", false );
                                } else {
                                    couponDiscount = 0;
                                    if (selectedAddresState == 'MAHARASHTRA') {
                                        update_tax();
                                    } else {
                                        update_tax(1);
                                    }
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

                jQuery.validator.addMethod("validate_city", function(value, element) {
                    var reg = /^[0-9a-zA-Z_.\s-]*$/;
                    if (reg.test(value)) {
                        return true;
                    } else {
                        return false;
                    }
                }, "Only letters, numbers,space, dot(period), hyphen and underscore are allowed");

                jQuery.validator.addMethod("validate_zipcode2", function(value, element) {
                    var c = $('#form-add-address').find('#country_id').val();
                    if( c==2){
                        var reg = /^[0-9]{0,6}$/;
                    }else{
                        var reg = /^[0-9]{6}$/;
                    }
                    
                    if (reg.test(value)) {
                        return true;
                    } else {
                        return false;
                    }
                }, "Only 6 digits are allowed");

                jQuery.validator.addMethod("validate_zipcode_update", function(value, element) {
                    var c = $('#form-update-address').find('#update-address-country').val();
                    if( c==2){
                        var reg = /^[0-9]{0,6}$/;
                    }else{
                        var reg = /^[0-9]{6}$/;
                    }
                    
                    if (reg.test(value)) {
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

                jQuery.validator.addMethod("validate_name", function(value, element) {
                    var reg = /^[a-zA-Z\s]*$/;
                    if (reg.test(value)) {
                        return true;
                    } else {
                        return false;
                    }
                }, "Only letters and space are allowed");

                $('#form-add-address').validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 191,
                            validate_name:true,
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
                            //maxlength: 191
                            //validate_city:true
                            lettersonly: true 
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
                            //maxlength: 191
                            validate_address:true
                        },
                        pin: {
                            required: true,
                            // digits: true,
                            // maxlength: 191
                            validate_zipcode2:true
                        },
                        landmark:{
                            required: true,
                            validate_address:true
                        },
                        area:{
                            required: true,
                            validate_address:true
                        }
                    }
                });



                $('#form-edit-address').validate({
                rules: {
                name: {
                required: true,
                maxlength: 191,
                validate_name:true,
                },
                phone: {
                required: true,
                digits:true,
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
                }
                ,
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
                alternate_phone: {
                digits: true,
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
                //maxlength: 191
                //validate_city:true
                lettersonly: true 
                },
                state: {
                required: true,
                maxlength: 191
                },
                address: {
                required: true,
                //maxlength: 191
                validate_address:true
                },
                pin: {
                required: true,
                // digits: true,
                // maxlength: 191
                validate_zipcode2:true
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
                            maxlength: 191,
                            validate_name:true,
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
                            maxlength: 191,
                            lettersonly:true,
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
                            maxlength: 191,
                            validate_address:true
                        },
                        pin: {
                            required: true,
                            digits: true,
                            //maxlength: 191
                            validate_zipcode_update:true,
                        },
                        landmark:{
                            required: true,
                            validate_address:true
                        },
                        area:{
                            required: true,
                            validate_address:true
                        }
                    }
                });

                let selectedAddressID = null;

                $('.select_address').click(function() {
                    selectedAddressID = $(this).val();
                });

                let isValidAddress = true;

                $('#form-create-order').on('submit', function(e) {
                    let cartItems = @json($cart['items']);
                    let cartItemsCount = cartItems.length;
                    if(cartItemsCount>0) {
                        if (couponDiscount <= 0) {
                            $("#coupon").val("");
                        }
                        var userAddress = @json($addresses);
                        if (userAddress.length == 0) {
                            e.preventDefault();
                            $("#add_new_address").modal('show');
                        } else {
                            if ($(this).valid()) {
                                let address = null;
                                $("#order-checkout-button").prop('disabled', true);
                                $.ajax({
                                    url: '{{ url('addresses') }}' + '/' + selectedAddressID,
                                    async: false
                                }).done(function (response) {
                                    address = response;
                                    console.log(address);
                                    
                                    // $.ajax({
                                    //     url: '{{ route('returnScript') }}',
                                    //     type: 'GET',
                                    //     data: { parameter: "InitiateCheckout"},
                                    //     success: function(response) {
                                    //         var script_execute = $(response).filter('script').html();
                                    //         if (script_execute) {
                                    //             eval(script_execute);
                                    //         }
                                    //     },
                                    //     error: function(xhr, status, error) {
                                    //         console.log("Script not executed");
                                    //     }
                                    // });

                                    // var container_InititaeCheckout = document.getElementById("facebookPixelNoScriptInitiateCheckoutContainer");
                                    // var noscriptTag_InitiateCheckout = document.createElement("noscript");
                                    // noscriptTag_InitiateCheckout.setAttribute("id", "facebookPixelNoScriptInitiateCheckout");

                                    // var imgElement_InitiateCheckout = document.createElement("img");
                                    // imgElement_InitiateCheckout.setAttribute("height", "1");
                                    // imgElement_InitiateCheckout.setAttribute("width", "1");
                                    // imgElement_InitiateCheckout.setAttribute("style", "display:none");
                                    // imgElement_InitiateCheckout.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=InitiateCheckout&noscript=1");
                                    // noscriptTag_InitiateCheckout.appendChild(imgElement_InitiateCheckout);
                                    // container_InititaeCheckout.appendChild(noscriptTag_InitiateCheckout);

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

                                    var container = document.getElementById("facebookPixelNoScriptAddPaymentInfoontainer");
                                    var noscriptTag = document.createElement("noscript");
                                    noscriptTag.setAttribute("id", "facebookPixelNoScriptAddPayment");

                                    var imgElement = document.createElement("img");
                                    imgElement.setAttribute("height", "1");
                                    imgElement.setAttribute("width", "1");
                                    imgElement.setAttribute("style", "display:none");
                                    imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=AddPaymentInfo&noscript=1");
                                    noscriptTag.appendChild(imgElement);
                                    container.appendChild(noscriptTag);
                                    
                                });

                                if (address && (!address.address || address.address === '-' || !address.address_type)) {
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
                                    $("#order-checkout-button").prop('disabled', true);
                                }
                                
                            }
                        }
                    }
                    else{
                        e.preventDefault();

                    }

                });
                $('#form-update-address').find('#update-address-country').change(function() {
                    //$('#add-address-country').val($(this).text());
                    var country = $(this).val();
                    if(country == 2){
                        $('#update-address-pin').val('00000');
                        $('#update-address-pin').attr('readonly', true);
                    }else{
                        $('#update-address-pin').val('');
                        $('#update-address-pin').attr('readonly', false);
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

                $('#order-checkout-button').on('click',function(e){
                    var cseet = {{$cseet}};
                    if(cseet > 0 &&  cseet_flag == 1){
                        e.preventDefault();
                        $('#cseet-modal').modal('toggle');
                    }
                });

                $('#cseet_close').click(function(){
                $('#form-cseet')[0].reset();
                $("#btn-cseet").html("Save");
                $("#btn-cseet").prop("disabled",false);
                
                });

                $('#form-cseet').validate({
                onsubmit:false,
                    rules: {
                        proof: {
                            required: true,
                             extension: "pdf"
                        },
                    },
        messages:{
            proof:{
            required : "Upload your enrollment proof",
            extension:"pdf file is allowed!"
            }

    }
                });
                
                $("#btn-cseet").click(function (e) {
                    e.preventDefault();
                    let isValid = $('#form-cseet').valid();
                    if (isValid)
                    { 
                        $("#btn-cseet").prop("disabled",true);
                        $("#btn-cseet").html("Saving <i class='fa fa-spinner fa-spin'>");
                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('save_proof') }}",
                                method:"POST",
                                data:new FormData(document.getElementById("form-cseet")),
                                dataType:'JSON',
                                contentType: false,
                                cache: false,
                                processData: false,
                                success:function(data)
                                {
                                    cseet_flag = 2;
                                    var file_name =data.file;
                                   
                                    $('#toast-cseet').toast('show');
                                    $("#btn-cseet").html("Save");
                                    $("#btn-cseet").prop("disabled",false);
                                    $('#form-cseet')[0].reset();
                                    $('#cseet-modal').modal('toggle');
                                    $('#hidden-inputs-container').append(`<input type="hidden" name="proof_name" value="${file_name}">`);
                                }
                            });
                        }, 15000);
                    }
                });

            });
        </script>
@endpush
