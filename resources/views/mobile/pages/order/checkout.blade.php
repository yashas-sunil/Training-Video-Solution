@extends('old_layouts.mobile.master')

@section('title', 'Order')

@section('content')
    <main class="orders px-md-5 px-sm-5" role="main">
        <form id="form-create-order" method="POST" action="{{ url('mobile/order') }}">
            @csrf
            <input type="hidden" name="pendrive_price" id="input-pendrive-price" value="">
            <input type="hidden" name="address" id="selected_address" value="" required>
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
                                    <div class="col-md-7 d-none d-sm-block mb-3">
                                        <h5 class="ml-4">
                                            <strong>Content Order List</strong>
                                        </h5>
                                    </div>
                                    <div class="col-md-5 d-none d-sm-block pl-5 mb-3">
                                        <h5>
                                            <strong>Content Delivery Mode</strong>
                                        </h5>
                                    </div>
                                </div>
                                <div class="order-items mt-2">
                                    @foreach($cart['items'] as $cartItem)
                                        <div class="order-item row  align-items-center mb-4" data-id="{{ $cartItem['id'] }}">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img src="{{ $cartItem['image_url'] ? $cartItem['image_url'] : '/assets/images/course-img1.png' }}" class="w-100">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card-body py-2">
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <div>
                                                                            {{ $cartItem['name'] }}<br/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row  align-items-center mt-md-1">
                                                                    <div class="col-md-4">
                                                                        <span class="d-inline-block text-muted"><small>2 Hours</small></span>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-2 mr-sm-4 pl-sm-5">
                                                <div class="row ml-4">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input checked type="radio" id="online{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                               class="bg-blue custom-control-input delivery-mode" value="online">
                                                        <label class="custom-control-label bg-blue" for="online{{ $cartItem['id'] }}">Online</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="pendrive{{ $cartItem['id'] }}" name="content_delivery[{{ $cartItem['id'] }}]"
                                                               class="custom-control-input delivery-mode" value="pendrive">
                                                        <label class="custom-control-label" for="pendrive{{ $cartItem['id'] }}">Pendrive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <section class="bg-right mt-5">
                            <div class="container-fluid py-3">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <h4 class="text-secondary" >Select Address</h4>
                                        <div id="carousel-addresses" class="owl-carousel owl-theme clearfix">
                                            @foreach($addresses as $id => $address)
                                                <div class="card-deck">
                                                    <div class="card rounded-0 bg-secondary-100 border-0">
                                                        <div class="custom-control custom-checkbox ml-3 mt-2">
                                                            <input type="radio" id="address-{{ $id }}" required name="address_id" class="bg-blue custom-control-input address" checked value="{{ $address['id'] }}" >
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
                            </div>
                        </section>
                        <div class="custom-control custom-checkbox pb-4">
                            <input type="checkbox" class="custom-control-input" id="another_address">
                            <label class="custom-control-label" for="another_address">Add Another Address</label>
                        </div>
                        <section id="address-section">
                            <div class="container-fluid px-md-5  pb-4">
                                <div class="row ">
                                    <div class="col-sm-12">
                                        <div class="bg-secondary-10 p-4">
                                            <form  id="address-form"  method="POST" action="{{ route('addresses.store') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" id="name" name="name" @if(!$addresses) required @endif  class="form-control form-control-sm" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="phone" name="phone" @if(!$addresses) required @endif   class="form-control form-control-sm" placeholder="Phone">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="alternate_phone"  name="alternate_phone" class="form-control form-control-sm" placeholder="Alternate Phone">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="city" name="city" @if(!$addresses) required @endif  class="form-control form-control-sm" placeholder="City">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="state" @if(!$addresses) required @endif  name="state" class="form-control form-control-sm" placeholder="State">
                                                </div>
                                                <div class="form-group">
                                                    <textarea id="address"  name="address" @if(!$addresses) required @endif  class="form-control form-control-sm" placeholder="Address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="pin" name="pin" @if(!$addresses) required @endif  class="form-control form-control-sm" placeholder="Pin">
                                                </div>
                                                <button type="submit" formaction="{{ route('addresses.store') }}" class="btn btn-primary">Submit</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-auto">
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
                                                @foreach ($cartItem['strike_prices'] as $price)
                                                    <del>₹ {{ number_format($price,2) }}</del>
                                                @endforeach
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
                                        <div class="row row-cols-2 no-gutters border-bottom border-secondary mb-3">
                                            <div class="col mb-2">
                                                Coupon
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 id="coupon-price"  class="m-0">- ₹ 0</h5>
                                            </div>
                                        </div>
                                        <div class="row row-cols-2 no-gutters">
                                            <div class="col mb-2">
                                                <h6><strong>Net Total</strong></h6>
                                            </div>
                                            <div class="col mb-2 text-right">
                                                <h5 class="m-0" style="font-weight: bold"><span>₹ </span><span id="net-total">{{ number_format($cart['total'],2) }}</span></h5>
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
                                                <input type="text"  class="form-control form-control-sm" id="coupon" name="coupon">
                                                <p id="coupon-message"style="font-size: x-small"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row no-gutters mb-0">
                                            <div class="col-sm-12">
                                                <button id="apply" type="button" class="btn btn-primary form-control-sm float-right">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="hidden-inputs-container">

                                    </div>

                                    @if ($user['role'] == 5)
                                        <button class="btn btn-block btn-primary rounded-0 my-3 checkout"   type="submit" >Checkout</button>
                                    @endif
                                    @if ($user['role'] == 7)
                                        <div id="order-summary-buttons-container">
                                            <div id="btn-checkout-container">
                                                <button class="btn btn-block btn-primary rounded-0 my-3" type="button" data-toggle="modal" data-target="#modal-create-student">Checkout</button>
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
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm input-sm" id="name" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-5 col-form-label col-form-label-sm">Email*</label>
                                                <div class="col-sm-7">
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-5 col-form-label col-form-label-sm">Password*</label>
                                                <div class="col-sm-7">
                                                    <input type="password" class="form-control form-control-sm" id="password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="password-confirmation" class="col-sm-5 col-form-label col-form-label-sm">Confirm Password*</label>
                                                <div class="col-sm-7">
                                                    <input type="password" class="form-control form-control-sm" id="password-confirmation" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="course-id" class="col-sm-5 col-form-label col-form-label-sm">Course</label>
                                                <div class="col-sm-7">
                                                    <x-inputs.course id="course-id" name="course_id" class="form-control form-control-sm">
                                                    </x-inputs.course>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="level-id" class="col-sm-5 col-form-label col-form-label-sm">Level</label>
                                                <div class="col-sm-7">
                                                    <x-inputs.level id="level-id" name="level_id" class="form-control form-control-sm" related="#course-id">
                                                    </x-inputs.level>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="country-id" class="col-sm-5 col-form-label col-form-label-sm">Country</label>
                                                <div class="col-sm-7">
                                                    <x-inputs.country id="country-id" name="country_id" class="form-control form-control-sm">
                                                    </x-inputs.country>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="state-id" class="col-sm-5 col-form-label col-form-label-sm">State</label>
                                                <div class="col-sm-7">
                                                    <x-inputs.state id="state-id" name="state_id" class="form-control form-control-sm" related="#country-id">
                                                    </x-inputs.state>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="city" class="col-sm-5 col-form-label col-form-label-sm">City</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="city" name="city">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="pin" class="col-sm-5 col-form-label col-form-label-sm">Pin</label>
                                                <div class="col-sm-7">
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
                                    @foreach($associateStudents as $id => $student)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-3 mt-2">
                                                    <input type="radio" id="radio-student-id-{{ $id }}" name="radio_student_id" class="bg-blue custom-control-input radio-studen-id" value="{{ $student['user_id'] }}">
                                                    <label class="custom-control-label bg-blue" for="radio-student-id-{{ $id }}"></label>
                                                </div>
                                            </td>
                                            <td>{{ $student['name'] }}</td>
                                            <td>{{ $student['email'] }}</td>
                                            <td>{{ $student['phone'] }}</td>
                                            <td>{{ $student['city'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="button" class="btn btn-primary px-4" id="btn-existing-student-ok">OK</button>
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
                            <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" class="form-control form-control-sm" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" id="alternate_phone" name="alternate_phone" class="form-control form-control-sm" placeholder="Alternate Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" id="city" name="city" 
                             class="form-control form-control-sm" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input type="text" id="state" name="state" class="form-control form-control-sm" placeholder="State">
                        </div>
                        <div class="form-group">
                            <textarea name="address" id="address"  class="form-control form-control-sm" placeholder="Address"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="pin" name="pin"  class="form-control form-control-sm" placeholder="Pin">
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

            var grossTotal = {{ $cart['total'] }};
            var couponDiscount = 0;
            var netTotal = 0;
            $("#hidden_coupon_price").val(couponDiscount);
            $("#hidden_net_total").val(grossTotal);

            // Create currency formatter.
            var formatter = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
            });


            var $orderSummery = $('#order-summery');

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
                        success:function(couponDiscount) {
                            if (couponDiscount>0) {
                                var netTotal = formatter.format(grossTotal - couponDiscount);
                                $orderSummery.find('#net-total').text(netTotal);
                                $orderSummery.find('#coupon-price').text('- ₹ ' + couponDiscount);
                                $orderSummery.find('#coupon-message')
                                    .text('Coupon Applied')
                                    .css('color', 'green');
                                $("#apply").prop( "disabled", true );
                                $('#hidden-inputs-container').append(`<input type="hidden" name="coupon_amount" value="${couponDiscount}">`);
                                $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${grossTotal - couponDiscount}">`);
                            } else {
                                var netTotal = formatter.format(grossTotal);
                                $orderSummery.find('#net-total').text(netTotal);
                                $orderSummery.find('#coupon-price').text('- ₹ 0' );
                                $orderSummery.find('#coupon-message')
                                    .text('Invalid Coupon')
                                    .css('color', 'red');
                                $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${grossTotal}">`);
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
                            <h5 class="m-0">₹ <span id="gross-total">{{ number_format($pendrivePrice[0]['value'],2) }}</span></h5>
                        </div>
                    </div>`
                    );

                    var coupon_price_text =  $orderSummery.find('#coupon-price').text();
                    var coupon_price =  coupon_price_text.replace('- ₹','');

                    grossTotal = {{ $cart['total'] + $pendrivePrice[0]['value']}} - coupon_price;

                    netTotal = formatter.format(grossTotal);
                    $orderSummery.find('#net-total').text(netTotal);

                    $('#input-pendrive-price').val({{ $pendrivePrice[0]['value'] }});
                    $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${grossTotal}">`);


                } else {
                    var total_amount = {{ $cart['total'] }} - couponDiscount;
                    grossTotal =
                        $('#pendrive-price').html('');
                    $orderSummery.find('#net-total').text(formatter.format({{ $cart['total'] }} - couponDiscount));
                    $('#input-pendrive-price').val('');

                    $('#hidden-inputs-container').append(`<input type="hidden" name="total_amount" value="${total_amount}">`);

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
                        maxlength: 191
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


        });
    </script>
@endpush
