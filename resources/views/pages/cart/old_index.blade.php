@extends('layouts.master')

@section('title', 'Cart')

@section('content')
    <main class="cart px-md-5 px-sm-5" role="main">
        @if($cart['items'])
            <div class="container-fluid py-4  px-5 left-space">
                <div class="bg-diamond bg-diamond-right bg-diamond-top" style="transform: translateX(-10%) translateY(36%);">
                    <div class="bg-diamond-lg cart-diamond"></div>
                </div>
                <h2 class="text-secondary"><b>Your Cart</b></h2>
                <div class="row mt-3">
                    <div class="col-md-8 cart-list pl-4 pr-4 pt-2 mb-4 bg-secondary-10">
                        @foreach($cart['items'] as $cartItem)
                            <section>
                                <div class="container py-3 mb-2">
                                    <div class="card">
                                        <div class="row">

                                            <div class="col-md-3 pull-5">
                                                <img src="{{ $cartItem['image_url'] ? $cartItem['image_url'] : 'assets/images/course-img1.png' }}" class="w-100">
                                            </div>
                                            <div class="col-md-9 py-2 py-sm-2 pl-sm-2">
                                                <div class="row">
                                                    <div class="col-md-8 pl-5">
                                                        <div>
                                                            <span class="d-inline-block"><a href="{{ url('packages') . '/' . ($cartItem['slug'] ?? $cartItem['id']) }}">{{ $cartItem['name'] }}</a></span><br>
                                                            <span class="d-inline-block"><small>{{ \Illuminate\Support\Str::limit($cartItem['description'], 150, $end = '...') }}</small></span>
                                                        </div>
                                                        {{--                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--                                                        <i class="fa fa-star text-warning rating"></i>--}}
                                                        <div>
                                                            @if (!$cartItem['is_prebook'] || $cartItem['is_prebook_content_ready'])
                                                                <span class="d-inline-block text-muted">@if ($cartItem['total_duration_formatted']) <i class="fa fa-clock mr-1"></i>{{ $cartItem['total_duration_formatted'] }} | @endif {{$cartItem['language']['name']}} </span>
                                                            @else
                                                                <span class="d-inline-block text-muted">@if ($cartItem['prebook_total_duration']) <i class="fa fa-clock mr-1"></i>{{ $cartItem['prebook_total_duration'] }} | @endif {{$cartItem['language']['name']}} </span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4 ">
                                                        @if ($cartItem['is_prebook'])
                                                            <div class="d-flex justify-content-end">
                                                                <div class=" pt-2 pr-3">
                                                                    <span class="float-right ">
                                                                        <h4>₹{{ number_format($cartItem['selling_price'],2) }}</h4>
                                                                    </span>
                                                                    <span class=" mr-1 float-right text-muted">
{{--                                                                        <small>₹<del>{{ number_format($cartItem['prebook_selling_price'], 2)}}</del></small>--}}
                                                                        {{--                                                                        <small>₹<del>{{ number_format($cartItem['prebook_price'], 2) }}</del></small>--}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="d-flex justify-content-end">
                                                                <div class=" pt-2 pr-3">
                                                                    <span class="float-right ">
                                                                        <h4>₹{{ number_format($cartItem['selling_price'],2) }}</h4>
                                                                    </span>
                                                                    <span class=" mr-1 float-right text-muted">
                                                                        @foreach ($cartItem['strike_prices'] as $price)
                                                                            <small>₹<del>{{ number_format($price,2) }}</del></small>
                                                                        @endforeach
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="pr-3">
                                                            <div class="d-flex justify-content-end">
                                                                <a class="mt-1 text-info pr-3 cart-remove" href="#" data-id="{{ $cartItem['cart_item_id'] }}"><small>Remove</small></a>

                                                                {{--@if (! request()->session()->has('access_token'))--}}
                                                                {{--<a class="mt-1 text-info" href="#" data-toggle="modal" data-target="#modal-login"><small>Save for Later</small></a>--}}
                                                                {{--@else--}}
                                                                {{--<a class="mt-1 text-info cart-save-for-later" href="#" data-id="{{ $cartItem['id'] }}"><small>Save for Later</small></a>--}}
                                                                {{--@endif--}}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endforeach
                    </div>
                    <div class="col-md-auto cart-right-area">
                        <div class="student-profile-menu-content border shadow pb-4 pl-0">
                            <h4 class="p-2 px-3 py-3">
                                <strong>Total</strong>
                            </h4>
                            <h3 class="bg-primary-50 p-2 px-3">
                                ₹ <strong>{{ number_format($cart['total'],2) }}</strong>
                            </h3>
                            {{--                            @if($cart['discount'])--}}
                            {{--                                <div class="p-2 px-3">--}}
                            {{--                            <span class="mr-1 text-muted">--}}
                            {{--                                <strong>--}}
                            {{--                                   ₹  <del>{{ number_format($cart['discount'],2) }}</del>--}}
                            {{--                                </strong>--}}
                            {{--                            </span>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="p-2 px-3">--}}
                            {{--                            <span class=" mr-1 text-muted">--}}
                            {{--                                <strong>{{ $cart['discount_percentage'] }}% Off</strong>--}}
                            {{--                            </span>--}}
                            {{--                                </div>--}}
                            {{--                            @endif--}}

                            <div class="bg-primary p-2 text-center">
                        <span class="mr-1">
                            @if (! request()->session()->has('access_token'))
                                <a href="#" data-toggle="modal" data-target="#modal-login" class="text-white proceed-checkout" data-location="cart">Proceed Checkout</a>
                            @else
                                <a href="{{ url('cart/checkout') }}" class="text-white">Proceed Checkout</a>
                            @endif
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($packages['data'])
                <section class="cart">
                    <div class="container-fluid py-3 left-space">
                        <div class="bg-diamond bg-diamond-left">
                            <div class="bg-diamond-lg recommendation-diamond"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h2 class="mr-auto ml-5 text-secondary"><b>Recommendation</b></h2>
                            </div>
                            <div class="col-auto">
                                <a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>
                            </div>
                        </div>
                        <div class="mx-5">
                            @include('includes.packages-carousel', ['packages' => $packages])
                        </div>
                    </div>
                </section>
            @endif
            {{--            @if($miniPackages['data'])--}}
            {{--            <section class="cart">--}}
            {{--                <div class="container-fluid py-3 left-space">--}}
            {{--                    <div class="bg-diamond bg-diamond-right" style="transform: translateX(-10%) translateY(36%);">--}}
            {{--                        <div class="bg-diamond-lg"></div>--}}
            {{--                    </div>--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col">--}}
            {{--                            <h2 class="mr-auto ml-5 text-secondary"><b>Also Bought</b></h2>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-auto">--}}
            {{--                            <a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="mx-5">--}}
            {{--                        @include('includes.mini-packages-carousel', ['packages' => $miniPackages])--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </section>--}}
            {{--            @endif--}}
        @else
            <div class="cart empty mt-5 mb-5 text-center" style="padding-top: 150px;">
                <i  class="fas fa-shopping-cart  fa-10x text-secondary" ></i>
                <h3>Your cart is empty</h3>
                <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
            </div>
        @endif

    </main>

@endsection

@push('script')
    <script>
        $(function() {
            $('.cart-remove').click(function () {
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

            $('.proceed-checkout').click(function() {
                $(".modal-body #location").val( $(this).data(('location')) );
            });
        });
    </script>
@endpush
