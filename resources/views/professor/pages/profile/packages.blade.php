@extends('layouts.master')

@section('title', 'Package')

@section('content')
    <main class="course-description px-md-5 px-sm-5" role="main">
        <div class="container-fluid py-4 px-md-5">
            <div class="bg-diamond " style="transform: translateX(-40%) translateY(-10%); left: 4; top: 3">
                <div class="bg-diamond-lg"></div>
            </div>
            <h3 class="text-secondary"><b>{{ $package['name'] }}</b></h3>
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="p-2 p-md-4 bg-secondary-10">
                        <div class="row no-gutters align-items-top mb-4">
                            <div class="col-md-6 mb-2 ">
                                {{ $package['description'] }}
                            </div>
                            <div class="col-md-3 mb-2 pl-3">
                                <div class="mb-1">
                                    <i class="far fa-clock pr-1"></i>{{ $package['video_duration_formatted'] }}
                                </div>
                                <div>
{{--                                    @if ($package['enrolled_count'] > 0) <i class="far fa-user pr-1"></i>{{ $package['enrolled_count'] }} Enrolled @endif--}}
                                </div>
                                <div class="">
                                    @foreach($package['professors'] as $professor)
                                        <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                             alt="..."
                                             class="img-thumbnail rounded-circle p-0"
                                             style="width: 50px !important; height: 50px !important; display: inline;">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="card shadow">
                                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['name'] }}" class="card-img-top" alt="...">
                                    <div class="card-body pb-0">
                                        <h5 class="card-title text-center">
                                        <span class="text-muted mr-1">
                                            <small>
                                                @foreach ($package['strike_prices'] as $price)
                                                    <del>₹{{ number_format($price,2) }}</del>
                                                @endforeach
                                            </small>
                                        </span>
                                            <span>
                                             <b>₹ {{ number_format($package['selling_price'],2) }}</b>
                                        </span>
                                        </h5>
                                    </div>
{{--                                    @if (! request()->session()->has('access_token'))--}}
{{--                                        <a href="#" class="btn btn-block btn-primary rounded-0 mb-4 buy-now-login" data-toggle="modal" data-target="#modal-login" data-package="{{ $package['id'] }}">Buy Now</a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="btn btn-block btn-primary rounded-0 mb-4" href="">Buy Now</a>--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="text-secondary"><b>What you'll learn</b></h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="accordion student-chapters-accordion mt-4" id="student-chapters-accordion">
                        @foreach($package['subjects'] as $subject)
                            <div class="card mt-4 border-0">
                                <div class="bg-primary-50 shadow-sm d-flex flex-wrap align-items-center"
                                     id="heading0">
                                    <span class="flex-fill py-2 px-2">{{ $subject['name'] }}</span>
                                    <button class="btn btn-primary py-2 rounded-0" type="button" data-toggle="collapse"
                                            data-target="#collapse{{ $subject['id'] }}" aria-expanded="true" aria-controls="collapse{{ $subject['id'] }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div id="collapse{{ $subject['id'] }}" class="collapse" aria-labelledby="heading0"
                                     data-parent="#student-chapters-accordion">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <tbody>
                                            @if($subject['chapters'])
                                                @foreach($subject['chapters'] as $chapter)
                                                    <tr>
                                                        <td class="col px-4">
                                                           <a href="{{ url('professor/watch-video') . '/' . $chapter['videos'][0]['id'] . '?package=' . $package['id'] }}">{{ $chapter['name'] }}</a>
                                                        </td>

                                                        <td class="col-auto px-4 text-nowrap">
                                                            <i class="fab fa-youtube mr-1  text-danger "></i>
                                                            <span>{{ count($chapter['videos']) }}</span>
                                                        </td>
                                                        <td class="col-auto px-4 text-nowrap">
                                                            <i class="fa fa-question-circle mr-1 text-primary  "></i>
                                                            <span>0</span>
                                                        </td>
                                                        <td class="col-auto px-4 text-nowrap">
                                                            <i class="fa fa-sticky-note mr-1 text-secondary-200  "></i>
                                                            <span>0</span>
                                                        </td>


                                                        <td class="col-auto px-0">
                                                            <div style="width: 40px;"></div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="col px-4">No Video Available ! </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if($packages)
            <section class="">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col">
                            <h3 class="mr-auto ml-5 text-secondary">Courses</h3>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>
                        </div>
                    </div>
                    <div class="mx-5">
                        @include('includes.associate-packages-carousel', ['packages' => $packages])
                    </div>
                </div>
            </section>
        @endif

        @if($miniPackages)
            <section class="">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col">
                            <h3 class="mr-auto ml-5 text-secondary">Mini Courses</h3>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>
                        </div>
                    </div>
                    <div class="mx-5">
                        @include('includes.associate-mini-packages-carousel', ['packages' => $miniPackages])
                    </div>
                </div>
            </section>
        @endif

    </main>

@endsection

@push('script')
    <script>
        $(function() {
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

            $('.a-chapter-name').click(function() {
                let url = '{{ url('videos') }}' + '/' + $(this).data('video-id')  + '?package=' + {{ $package['id'] }};

                $('#a-watch-demo').attr('href', url);
            });

            // $('#buy-now-unauthenticated').click(function() {
            //     $('#modal-purchase').modal('toggle');
            // });
        });
    </script>
@endpush
