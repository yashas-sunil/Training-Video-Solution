@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <main class="orders px-md-5 px-sm-5" role="main">
        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <div class="container-fluid py-4 px-md-5">
                <h3 class="text-secondary"><b>Order List</b></h3>
                <div class="row mt-3">
                    <div class="col-md">
                        <div class="p-2 p-md-4 bg-secondary-10">
                            <div class="row no-gutters ">
                                <div class="col-md-6 d-none d-sm-block">
                                    <h5>
                                        <strong>Content Order List</strong>
                                    </h5>
                                </div>
                                <div class="col-md-6 d-none d-sm-block pl-5">
                                    <h5>
                                        <strong>Content Delivery Mode</strong>
                                    </h5>
                                </div>
                            </div>
                            <div class="order-items">
                                @foreach($cart['items'] as $cartItem)
                                    <div class="order-item row no-gutters align-items-center mb-4" data-id="{{ $cartItem['id'] }}">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="row no-gutters">
                                                    <div class="col-md-6">
                                                        <img src="{{ $cartItem['image_url'] ? $cartItem['image_url'] : 'assets/images/course-img1.png' }}" class="w-100">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card-body py-2">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col">
                                                                    <div>
                                                                        {{ $cartItem['name'] }}<br/>
                                                                        <i class="fa fa-star text-warning rating"></i>
                                                                        <i class="fa fa-star text-warning rating"></i>
                                                                        <i class="fa fa-star text-warning rating"></i>
                                                                        <i class="fa fa-star text-warning rating"></i>
                                                                        <i class="fa fa-star text-warning rating"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row no-gutters align-items-center mt-md-1">
                                                                <div class="col-md-4">
                                                                    <span class="d-inline-block text-muted"><small>2 Hours</small></span>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-between justify-content-md-end align-items-md-center">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2 pl-sm-5">
                                            <label class="d-sm-none mr-4">Content Delivery Mode</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input checked type="radio" id="online{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                       class="bg-blue custom-control-input delivery-mode" value="online"
                                                       data-id="{{ $cartItem['id'] }}" data-price="{{ $cartItem['price'] }}"
                                                       data-selling-price="{{ $cartItem['selling_price'] }}" data-strike-prices='@json($cartItem['strike_prices'])'>
                                                <label class="custom-control-label bg-blue" for="online{{ $cartItem['id'] }}">Online</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="pendrive{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                       class="custom-control-input delivery-mode" value="pendrive"
                                                       data-id="{{ $cartItem['id'] }}" data-price="{{ $cartItem['pendrive_price'] }}"
                                                       data-selling-price="{{ $cartItem['pendrive_selling_price'] }}" data-strike-prices='@json($cartItem['pendrive_strike_prices'])'>
                                                <label class="custom-control-label" for="pendrive{{ $cartItem['id'] }}">Pendrive</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-auto orders-right-area mt-4 mt-md-0">
                        <div id="order-summery" class="border shadow ">
                            <div class="px-3 py-4">
                                <h5 class="pb-4">
                                    <strong>Order Summary</strong>
                                </h5>
                                <div class="order-summery-items border-bottom border-secondary mb-3">
                                    @foreach($cart['items'] as $cartItem)
                                    <div id="order-summery-item-{{ $cartItem['id'] }}" class="row row-cols-2 no-gutters order-summery-item">
                                        <div class="col mb-2">{{ $cartItem['name'] }}</div>
                                        <div class="col-auto ml-auto mb-2 text-right">
                                        <span class="mr-1 text-muted">
                                            <small class="strike-prices">
                                                @foreach ($cartItem['strike_prices'] as $price)
                                                    <del>₹{{ $price }}</del>
                                                @endforeach
                                            </small>
                                        </span>
                                            <h6 class="d-inline m-0">₹<span class="selling-price">{{ $cartItem['selling_price'] }}</span></h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row row-cols-2 no-gutters">
                                    <div class="col mb-2">
                                        Gross Total
                                    </div>
                                    <div class="col mb-2 text-right">
                                        <h5 class="m-0">₹<span id="gross-total">{{ $cart['total'] }}</span></h5>
                                    </div>
                                </div>
                                <div class="row row-cols-2 no-gutters border-bottom border-secondary mb-3">
                                    <div class="col mb-2">
                                        Coupon
                                    </div>
                                    <div class="col mb-2 text-right">
                                        <h5 id="coupon-price" class="m-0">- ₹0</h5>
                                    </div>
                                </div>
                                <div class="row row-cols-2 no-gutters">
                                    <div class="col mb-2">
                                        <h5><strong>Net Total</strong></h5>
                                    </div>
                                    <div class="col mb-2 text-right">
                                        <h4 class="m-0" style="font-weight: bold"><span>₹ </span><span id="net-total">{{ $cart['total'] }}</span></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-primary-50 px-3 py-3">
                                <div class="form-group row no-gutters">
                                    <label for="rewards" class="col-sm-8 col-form-label">Rewards</label>
                                    <div class="col-sm-4 text-right">
                                        <input type="email" readonly class="form-control form-control-sm " id="rewards">
                                    </div>
                                </div>
                                <div class="form-group row no-gutters">
                                    <label for="discount_coupon" class="col-sm-8 col-form-label">Discount Coupon</label>
                                    <div class="col-sm-4 text-right">
                                        <input type="text" class="form-control form-control-sm" id="coupon" name="coupon">
                                        <p id="coupon-message"style="font-size: x-small"></p>
                                    </div>
                                </div>
                                <div class="form-group row no-gutters mb-0">
                                    <div class="col-sm-12">
                                        <button id="apply" type="button" class="btn btn-primary form-control-sm float-right">Apply</button>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-block btn-primary rounded-0 my-3" type="submit">Checkout</button>

                        </div>

                    </div>
                </div>
            </div>

            <section class="bg-right">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="mr-auto ml-5 text-secondary">Select Address</h4>
                        </div>
                    </div>
                    <div class="mx-5">
                        <div id="carousel-addresses" class="owl-carousel owl-theme clearfix">
                            @foreach($addresses as $id => $address)
                                <div class="card-deck">
                                    <div class="card rounded-0 bg-secondary-100 border-0">
                                        <div class="custom-control custom-checkbox ml-3 mt-2">
                                            <input type="radio" id="address-{{ $id }}" name="address_id" class="bg-blue custom-control-input" value="{{ $address['id'] }}" @if($id == 0) checked @endif>
                                            <label class="custom-control-label bg-blue" for="address-{{ $id }}"></label>
                                            <div class="float-right mr-3">
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-address" class="edit-address"
                                                data-id="{{ $address['id'] }}"
                                                data-name="{{ $address['name'] }}"
                                                data-phone="{{ $address['phone'] }}"
                                                data-alternatePhone="{{ $address['alternate_phone'] }}"
                                                data-city="{{ $address['city'] }}"
                                                data-state="{{ $address['state'] }}"
                                                data-address="{{ $address['address'] }}"
                                                data-pin="{{ $address['pin'] }}"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="delete-address" data-id="{{ $address['id'] }}"><i class="fas fa-trash "></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">

                                            <h5 class="card-title">
                                                <strong>{{ $address['name'] }}</strong>
                                            </h5>
                                            <p class="card-text">{{ $address['city'] }}, {{ $address['state'] }}</p>
                                            <p class="card-text">{{ $address['address'] }}</p>
                                            <p class="card-text">{{ $address['pin'] }}</p>
                                            <p class="card-text">{{ $address['phone'] }}, {{ $address['alternate_phone'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <section >
            <div class="container-fluid px-md-5 pb-4">
                <div class="custom-control custom-checkbox pb-4">
                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                    <label class="custom-control-label" for="customCheck2">Add Another Address</label>
                </div>
                <div class="row ">
                    <div class="col-md-4 bg-secondary-10 p-4">
                        <form method="POST" action="{{ route('addresses.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control form-control-sm" placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="alternate_phone" class="form-control form-control-sm" placeholder="Alternate Phone">
                            </div>
                            <div class="form-group">
                                <input type="text"name="city" class="form-control form-control-sm" placeholder="City" required>
                            </div>
                            <div class="form-group">
                                <input type="text"name="state" class="form-control form-control-sm" placeholder="State" required>
                            </div>
                            <div class="form-group">
                                <textarea name="address" class="form-control form-control-sm" placeholder="Address" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="pin" class="form-control form-control-sm" placeholder="Pin" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
@endsection

@push('script')
<script>
    $(document).ready(function(){
        'use strict';

        var grossTotal = 0;
        var couponDiscount = 0;

        var $orderSummery = $('#order-summery');

        $("#apply").click(function(){
            let coupon = $('#coupon').val();
            $.ajax({
                type: 'POST',
                url: '{{ url('/order/apply-coupon') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'coupon': coupon
                },
                success:function(data) {
                    if (data.length > 0) {
                        couponDiscount = data[0].price;

                        $orderSummery.find('#coupon-price').text('- ₹ ' + couponDiscount);
                        $orderSummery.find('#net-total').text(grossTotal - couponDiscount);

                        $orderSummery.find('#coupon-message')
                                .text('Coupon Applied')
                                .css('color', 'green');
                    } else {
                        $orderSummery.find('#coupon-message')
                                .text('Invalid Coupon')
                                .css('color', 'red');
                    }
                }
            });
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
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        $('.delivery-mode').change(function() {
            var total = 0;

            $('.order-items').find('.order-item').each(function () {
                var id = $(this).data('id');
                var $deliveryMod = $(this).find(".delivery-mode[name='content_delivery["+id+"]']:checked");
                var sellingPrice = $deliveryMod.data('selling-price');
                var strikePrices = $deliveryMod.data('strike-prices');

                console.log('id', id);
                console.log('$deliveryMod', $deliveryMod);
                console.log('sellingPrice', sellingPrice);
                console.log('strikePrices', strikePrices);

                var $orderSummeryItem = $orderSummery.find('#order-summery-item-'+id);

                var strikePricesHtml = $.map(strikePrices, function (strikePrice) {
                    return '<del>'+strikePrice+'</del>';
                });
                $orderSummeryItem.find('.strike-prices').html(strikePricesHtml);
                $orderSummeryItem.find('.selling-price').text(sellingPrice);

                total = total + sellingPrice;
            });

            grossTotal = total;
            $orderSummery.find('#gross-total').text(total);
            $orderSummery.find('#net-total').text(grossTotal - couponDiscount);
//
        });
    });

    $('.edit-address').click(function() {
        let id = $(this).data('id');
        $(".modal-body #name").val( $(this).data('name') );
        $(".modal-body #phone").val( $(this).data('phone') );
        $(".modal-body #alternate_phone").val( $(this).data('alternatePhone') );
        $(".modal-body #alternate_phone").val( $(this).data('alternatePhone') );
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
</script>
@endpush
