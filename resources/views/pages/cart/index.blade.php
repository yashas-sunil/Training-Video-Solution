@extends('layouts.master')
@section('content')
    <div class="main">
    <div id="facebookPixelNoScriptContainer" style="display: none;"></div>
    <input type="hidden" name="holiday_offer_count"  id="holiday_offer_count" value="<?php if($holiday_offers) echo count($holiday_offers);else echo '0';?>">
        <!--   DISCOUNT&CASHBACK-->
        <div class="modal fade" id="discount-cashback-modal" tabindex="-1" role="dialog" aria-modal="true" >
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="row p-0">
                    <div class="col-12">
                        <div class="signup-details">
                            <div class="s-content">
                               
                                    
                                    <div id="step-attempt-year">
                                       
                                            <label>Yeh!!</label><br>
                                            @if(@$holiday_offers['id'])
                                            <span>You are getting {{$holiday_offers['name']}} special cashback and discount on this purchase</span>
                                         @if($holiday_offers['discount_amount']>0)
                                            <p> Discount:  {{$holiday_offers['discount_amount']}} @if ($holiday_offers['discount_type']==2) % @endif </p>
                                        @endif
                                         @if($holiday_offers['cashback_amount']>0)
                                         <p> Cashback:  {{$holiday_offers['cashback_amount']}} @if ($holiday_offers['cashback_type']==2) % @if($holiday_offers['max_cashback']>0)Max cashback {{$holiday_offers['max_cashback']}} whichever is lower @endif @endif </p>
                                         @endif
                                         @endif
                                        <div class="row justify-content-center">
                                            <button type="button" class="s-attempt-year-next " id="holiday-offers" >Close</button>
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
<!-- discounts & cashback ends-->
        <div class="container-fluid">
            <div class="cart_section">
                <div class="cart_title">My cart</div>
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="cart-programs">
                            <div class="total_numers">You have {{ count($cart['items']) }} items in your cart</div>
                            <div class="programs_list">
                                @foreach($cart['items'] as $cartItem)

                                    <div class="pro_gram">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="pro_pram_image">
                                                    <img src="{{ $cartItem['image_url'] ? $cartItem['image_url'] : 'assets/images/course-img1.png' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-5 col-sm-12">
                                                <div class="pro_gram_details">
                                                <a style="text-decoration:none" href=" ">
                                                    <h2>{{ $cartItem['name'] }}</h2>
</a>
                                                    <h6>{{ \Illuminate\Support\Str::limit($cartItem['description'], 150, $end = '...') }}</h6>
                                                    <ul>
                                                        <li><img src="images/dashboard/time.svg" alt=""></li>
                                                        @if (!$cartItem['is_prebook'] || $cartItem['is_prebook_content_ready'])
                                                        <li>@if ($cartItem['total_duration_formatted']) <img src="{{ asset('assets/new_ui_assets/images/dashboard/time.svg') }}" alt=""> <p> {{ $cartItem['total_duration_formatted'] }}@if($cartItem['bonus_duration_formatted']) 
                                                                   + {{  $cartItem['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif | @endif {{$cartItem['language']['name']}}</p> </li>
                                                        @else
                                                            <li>@if ($cartItem['prebook_total_duration']) <img src="{{ asset('assets/new_ui_assets/images/dashboard/time.svg') }}" alt="">
                                                            <p>{{ $cartItem['prebook_total_duration'] }} | @endif {{$cartItem['language']['name']}} </p></li>
                                                        @endif
{{--                                                        <li>--}}
{{--                                                            <p>83:42:57</p>--}}
{{--                                                        </li>--}}
{{--                                                        <li><span></span></li>--}}
{{--                                                        <li>--}}
{{--                                                            <p>english</p>--}}
{{--                                                        </li>--}}
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
                                                          
                                                          
                                                        <p>Valid Upto: <b>                                                            
                                                        <?php
                                                            if($cartItem['expiry_type']=='1'){
                                                                echo $cartItem['expiry_month'].' Months';
                                                            }else if($cartItem['expiry_type']  == '2'){
                                                                echo date('d M Y',strtotime($cartItem['expire_at']));
                                                            }else{
                                                                echo ' 9 Months';
                                                            }
                                                            ?>


</b></p> | <p><b>@if(count($hours2)>0)
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
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                <div class="pro_gram_price">
                                                    @if ($cartItem['is_prebook'])
                                                        <h3><i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($cartItem['selling_price'],2) }}</h3>
                                                        <a class="mt-1 text-info mr-3 cart-remove" href="#" data-id="{{ $cartItem['cart_item_id'] }}">
                                                            <img src="{{ asset('assets/new_ui_assets/images/dashboard/delete.svg') }}" alt="">
                                                        </a>
                                                    @else
                                                        <h3><i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($cartItem['selling_price'],2) }}</h3>
                                                        <a class="mt-1 text-info mr-3 cart-remove" href="#" data-id="{{ $cartItem['cart_item_id'] }}">
                                                        <img src="{{ asset('assets/new_ui_assets/images/dashboard/delete.svg') }}" alt="">
                                                        </a>
                                                        @foreach ($cartItem['strike_prices'] as $price)
                                                            <small>₹<del>{{ number_format($price,2) }}</del></small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               @endforeach
                            </div>
{{--                            <div class="cart_address">--}}
{{--                                <div class="address_heading">--}}
{{--                                    <h4>Select Address</h4>--}}
{{--                                    <a href="" data-toggle="modal" data-target="#add_new_address">Add New Address</a>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    @foreach($addresses as $id => $address)--}}

{{--                                        <div class="col-lg-6 col-md-12 col-sm-12">--}}
{{--                                            <input type="radio" data-id="{{$id}}"  id="address-{{ $id }}" required  name="address_id"--}}
{{--                                                   data-state="{{$address['state']}}" class="select_address"--}}
{{--                                                   value="{{$address['id'] }}" >--}}
{{--                                            <div class="student_cart_address @if($id == 0) default @endif">--}}
{{--                                                <a href="#" class="delete-address" data-id="{{ $address['id'] }}">--}}
{{--                                                    <img src="images/dashboard/delete.svg" alt="">--}}
{{--                                                </a>--}}
{{--                                                <div class="student_name">{{ $address['name'] }}</div>--}}
{{--                                                <div class="student_number">--}}
{{--                                                    {{ $address['phone'] }}--}}
{{--                                                </div>--}}
{{--                                                <div class="student_addr">--}}
{{--                                                    <p>{{ $address['address'] }}</p>--}}
{{--                                                    <p>{{ $address['city'] }}<span id="state-{{$id}}" data-value="{{ $address['state'] }}">{{ $address['state'] }}</span>, <span>{{ $address['country'] }}</span></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <!-- Modal -->
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
                                            <form>
                                                <div class="form-group">
                                                    <label>Full Name*</label>
                                                    <input type="text" class="form-control" id="one_full_name" placeholder="Full Name" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pincode*</label>
                                                    <input type="tel" placeholder="Pincode">
                                                </div>
                                                <div class="form-group">
                                                    <label>City*</label>
                                                    <select id="city" class="js-states form-control" data-placeholder="City">
                                                        <option value="" selected></option>
                                                        <option>Mumbai</option>
                                                        <option>Delhi</option>
                                                        <option>Chennai</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>State*</label>
                                                    <select id="state" class="js-states form-control" data-placeholder="State">
                                                        <option value="" selected></option>
                                                        <option>Maharashtra</option>
                                                        <option>Kerala</option>
                                                        <option>Assam</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Country*</label>
                                                    <select id="country" class="js-states form-control" data-placeholder="Country">
                                                        <option value="" selected></option>
                                                        <option>India</option>
                                                        <option>UAE</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No*</label>
                                                    <div class="m-num">
                                                        <select>
                                                            <option>+91</option>
                                                            <option>+971</option>
                                                        </select>
                                                        <input type="tel" placeholder="Mobile No">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Flat, House No, Building, Company, Apartment*</label>
                                                    <input type="text" placeholder="Enter">
                                                </div>
                                                <div class="form-group">
                                                    <label>Landmark*</label>
                                                    <input type="text" placeholder="Enter">
                                                </div>
                                                <div class="form-group">
                                                    <label>Area , Colony , Street , Sector , Village*</label>
                                                    <input type="text" placeholder="Enter">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address Type</label>
                                                    <select id="address_type" class="js-states form-control" data-placeholder="Select">
                                                        <option>Home (7am-9pm Delivery)</option>
                                                        <option>Work (9am-6pm Delivery)</option>
                                                    </select>
                                                </div>
                                            </form>
                                            <button class="btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="proceed_buy">
                            <div class="total">
                                <div class="total_item">
                                    <h1>Total <span>{{ count($cart['items']) }} items:</span></h1>
                                    <h3><i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($cart['total'],2) }}</h3>
                                </div>
                                @if(count($cart['items']) > 0)
                                    @if (! request()->session()->has('access_token'))
                                        <a href="#" data-toggle="modal" data-target="#login-modal" class="proceed-checkout" id="proceed-checkout" data-location="cart"><button>Proceed To Buy</button></a>
                                    @else
                                        <a href="{{ url('cart/checkout') }}"><button id="proceed-checkout-analytics">Proceed Checkout</button></a>
                                    @endif
                                @endif
{{--                                <button>Proceed to buy</button>--}}
                            </div>
                            <div class="saved_later">
                                <div class="saved_title">Saved for Later Courses</div>
                                <div class="row">
                                    @include('includes.packages-carousel', ['packages' => $packages])

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
<div class="modal fade" id="confirmdelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmdeletelabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <input type="hidden" id="remove-id" data-id="">
        <div class="delete_title mt-3 text-center font-weight-bold">Are you sure you want to remove ? </div>
        <div class="delete_conf_btns d-flex align-items-center justify-content-center mt-5">
            <button id="btn-delete-confirm" class="btn btn-success confirm mx-2">Confirm</button>
            <button class="btn btn-secondary mx-2 btn-cancel-confirm">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        // Event delegation for dynamically added elements
        $(document).on('click', '.cart-remove', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            console.log('Item ID for deletion:', id);
            $('#btn-delete-confirm').attr('data-id', id);
            $('#confirmdelete').modal('show');
        });

        $(document).on('click', '.btn-cancel-confirm', function(e) {
            $('#confirmdelete').modal('hide');
        });

        $('#btn-delete-confirm').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            console.log('Confirmed deletion for item ID:', id);

            $.ajax({
                type: 'POST',
                url: '{{ url('/cart/remove') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function(response) {
                    console.log('Item removed successfully:', response);
                    location.reload(); // Refresh the page to reflect changes
                },
                error: function(xhr, status, error) {
                    console.error('Error removing item:', error);
                    alert('Failed to remove item. Please try again.');
                }
            });
        });
    });
</script>
            <script>
                $(function() {

                    $('#proceed-checkout-analytics').click(function (e) {
                        $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "InitiateCheckout"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                                console.log("Script executed");
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
                        imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=InitiateCheckout&noscript=1");
                        noscriptTag.appendChild(imgElement);
                    });
                    });
//                     $('.cart-remove').click(function (e) {

//                         let id = $(this).data('id');

//                         $('#btn-delete-confirm').attr('data-id', id);

//                         $('#confirmdelete').modal();
//                     });
//                     $('.btn-cancel-confirm').click(function (e) {



//                         $('#confirmdelete').modal('hide');
//                     });
//                     $('#btn-delete-confirm').click(function (e) {
//                         e.preventDefault();
// //                        $('#confirmdelete').modal();
// //                        let text = "Do you want to remove the package from cart?";


// //                        if (confirm(text) == true) {
//                             let id = $(this).data('id');

//                             $.ajax({
//                                 type:'POST',
//                                 url:'{{ url('/cart/remove') }}',
//                                 data: {
//                                     '_token': '{{ csrf_token() }}',
//                                     'id': id
//                                 },
//                                 success:function() {
//                                     location.reload();
//                                 }
//                             });
// //                        }

//                     });

                    /*$('.cart-save-for-later').click(function () {
                        let packageID = $(this).data('id');

                        $.ajax({
                            type:'POST',
                            url:'{{ route('save-for-later.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'package_id': packageID
                    },
                    success:function() {

                        $('#toast-save-for-later').toast('show');
                        $('body').trigger('change.cart');
                    }
                });
            });*/

                    $('.btn-add-to-cart').click(function (e) {
                        e.preventDefault();

                        var url = '{{ url('cart') }}';
                        var packageId = $(this).data('id');

                        $.post(url, {
                            package_id: packageId
                        }).done(function (data) {

                            if (!data.data) {
                                $('#toast-already-exist').toast('show');
                            } else {
                                $('#toast-added-to-cart').toast('show');
                            }
                            $('body').trigger('change.cart');
                            location.reload();
                        }).fail(function () {
                            alert("Error while adding to cart");
                        });
                    });

                    $('.buy-now').click(function (e) {
                        e.preventDefault();

                        var url = '{{ url('cart') }}';
                        var packageId = $(this).data('id');
                        $.post(url, {
                            package_id: packageId
                        }).done(function (data) {
                            if (!data.data) {
                                $('#toast-already-exist').toast('show');
                            } else {
                                $('#toast-added-to-cart').toast('show');
                            }

                            $('body').trigger('change.cart');
                        }).fail(function () {
                            alert("Error while adding to cart");
                        });
                    });

                    $('.proceed-checkout').click(function(e) {
                        e.preventDefault();
                        $("#location").val("cart");
                        $("#login-modal").show();
                    });
                });
                $(document).ready(function() {

                    var holiday_offer_count = $('#holiday_offer_count').val();

        if('{{$cart["totalrakshabandanprice"]}}'>0||'{{$cart["rakshajcoin"]}}'>0) {
        $('#discount-cashback-modal').modal('show');
        }

        $('#holiday-offers').click(function() {
         $('#discount-cashback-modal').modal('hide');
        });

                });
            </script>
    @endpush
