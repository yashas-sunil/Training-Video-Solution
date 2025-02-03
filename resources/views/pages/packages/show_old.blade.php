@extends('layouts.master')

@section('title', 'Package')

@section('content')
    <main class="course-description px-md-5 px-sm-5" role="main">
        <div class="container-fluid py-4 px-md-5">
            <div class="bg-diamond " style="transform: translateX(-40%) translateY(-10%); left: 4; top: 3">
                <div class="bg-diamond-lg"></div>
            </div>
            <h1 class="text-secondary custom-package"><b>{{ $package['name'] }} </b></h1>
            <p><small class="text-muted">{{ strtoupper($package_details['course']['name']) }} | {{ strtoupper($package_details['level']['name']) }}</small></p>
            @if($package['expire_at'] !=null)
                <p><small class="text-muted">Expire On: {{ Carbon\Carbon::parse($package['expire_at'])->format('d M Y')}} </small></p>
            @endif
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="p-2 p-md-4 bg-secondary-10">
                        <div class="row no-gutters align-items-top mb-4">
                            <div class="col-md-5 mb-2 ">
                                <p class="text-justify">{{ $package['description'] }}</p>
                            </div>
                            <div class="col-md-4 mb-2 pl-3 text-center">
                                <div class="mb-1 text-secondary">
                                    @if (!$package['is_prebook'] || $package['is_prebook_package_launched'] || $package['is_prebook_content_ready'])
                                        @if ($package['total_duration_formatted'])
                                            <i class="far fa-clock pr-1"></i> {{ $package['total_duration_formatted'] }} |
                                        @endif
                                    @else
                                        @if ($package['total_duration_formatted'])
                                            <i class="far fa-clock pr-1"></i> {{ $package['prebook_total_duration'] }} |
                                        @endif
                                    @endif
                                    @if ($package['duration_formatted'])
                                        <i class="fa fa-eye pr-1"></i>{{ $package['duration_formatted'] }}
                                        |
                                    @endif
                                    {{$package_details['language']['name']}}
                                </div>
                                {{--                                <div>--}}
                                {{--                                    @if ($package['enrolled_count']) <i class="far fa-user pr-1"></i>{{ $package['enrolled_count'] }} Enrolled |@endif --}}
                                {{--                                       --}}
                                {{--                                </div>--}}
                                <div class="">
                                    @foreach($package['professors'] as $professor)
                                        @if ($professor['is_published'])
                                            <a href="{{route('ca-faculty.show', $professor['id'])}}"><img  data-toggle="tooltip" data-placement="top" title="{{ $professor['name']}}"src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                                                                                           alt="{{ $professor['alt'] }}"
                                                                                                           class="img-thumbnail rounded-circle p-0"
                                                                                                           style="width: 50px !important; height: 50px !important; display: inline;">
                                            </a>
                                        @else
                                            <img  data-toggle="tooltip" data-placement="top" title="{{ $professor['name']}}"src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                                  alt="{{ $professor['alt'] }}"
                                                  class="img-thumbnail rounded-circle p-0"
                                                  style="width: 50px !important; height: 50px !important; display: inline;">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="card shadow">
                                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" class="card-img-top" title="{{ $package['title_tag'] }}">
                                    <div class="card-body pb-3">
                                        @if($package['is_prebook'] && !$package['is_prebook_package_launched'])
                                            <div class="bg-primary-50 p-2 text-center  ">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        <div class="flex-fill">
                                                            <h5 class="text-secondary">
                                                                <strong >Book Now At Only ₹  {{ $package['booking_amount'] }}</strong>
                                                            </h5>
                                                            <strong>₹ {{ number_format($package['prebook_price'],2) }}</strong>
                                                            @if($package['price'])
                                                                <strong class="text-primary"> <del>₹ {{ number_format($package['prebook_selling_price'],2)}} </del></strong>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
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
                                        @endif
                                    </div>

                                    @if ((isset($user['role']) &&  $user['role'] != 6) || !isset($user['role']))
                                        @if (! request()->session()->has('access_token'))
                                            <a href="#" class="btn btn-block btn-primary rounded-0 mb-4 buy-now-login" data-toggle="modal" data-target="#modal-login" data-package="{{ $package['id'] }}">{{ $package['is_prebook'] && !$package['is_prebook_package_launched'] ? 'Book Now' : 'Enroll Now'}}</a>
                                        @else
                                            <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="btn btn-block btn-primary rounded-0 mb-4" href="">{{ $package['is_prebook'] && !$package['is_prebook_package_launched'] ? 'Book Now' : 'Enroll Now'}}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="text-secondary"><b>What you'll learn</b></h3>
            <div class="row">
                <div class="col-md-8">
                    @if (!$package['is_prebook'] || $package['is_prebook_package_launched'] || $package['is_prebook_content_ready'])
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
                                                                @if (((isset($user['role']) &&  $user['role'] != 6) || !isset($user['role']))&& (!$package['is_prebook'] && $package['is_prebook_package_launched']))
                                                                    @if ($package['is_purchased'] && $chapter['first_video_id'])
                                                                        <a href="{{ url('videos') . '/' . $chapter['first_video_id'] . '?package=' . $package['id'] }}">{{ $chapter['name'] }}</a>
                                                                    @else
                                                                        <a class="a-chapter-name" href="#" data-toggle="modal" data-target="#modal-purchase">{{ $chapter['name'] }}</a>
                                                                    @endif
                                                                @else
                                                                    <a class="a-chapter-name" href="#" >{{ $chapter['name'] }}</a>
                                                                @endif
                                                            </td>

                                                            <td class="col-auto px-4 text-nowrap">
                                                                @if ((isset($user['role']) &&  $user['role'] != 6) || !isset($user['role']))
                                                                    @if ($chapter['media_id'] && !$package['is_purchased'])
                                                                        <a class="popup-iframe" href="{{ url("embed/videos/".$chapter['media_id']) }}">Watch Demo</a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td class="col-auto px-4 text-nowrap">
                                                                <i class="fab fa-youtube mr-1  text-danger "></i>
                                                                <span>{{ $chapter['videos_count'] }}</span>
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
                    @else
                        {{ $package['prebook_content'] }}
                    @endif
                </div>
            </div>
        </div>

        @if($packages['data'])
            <section class="">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col">
                            <h3 class="mr-auto ml-5 text-secondary">Other Packages</h3>
                        </div>
                        <div class="col-auto">
                            <a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>
                        </div>
                    </div>
                    <div class="mx-5">
                        @if (isset($user['role']) &&  $user['role'] == 6)
                            @include('includes.associate-packages-carousel', ['packages' => $packages])
                        @else
                            @include('includes.packages-carousel', ['packages' => $packages])
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{--        @if($miniPackages['data'])--}}
        {{--        <section class="">--}}
        {{--            <div class="container-fluid py-3">--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col">--}}
        {{--                        <h3 class="mr-auto ml-5 text-secondary">Mini Courses</h3>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-auto">--}}
        {{--                        <a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="mx-5">--}}
        {{--                    @include('includes.mini-packages-carousel', ['packages' => $miniPackages])--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}
        {{--         @endif--}}

    </main>

    <!-- LOGIN MODAL-->
    <div class="modal fade" id="modal-purchase" tabindex="-1" role="dialog" aria-labelledby="modal-purchase-title"
         aria-hidden="true">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    @if(!$package['is_prebook'] && $package['is_prebook_package_launched'])
                        <h5 class="modal-title text-secondary text-uppercase" id="modal-purchase-title">Enrollment Required</h5>
                    @else
                        <h5 class="modal-title text-secondary text-uppercase" id="modal-purchase-title">Booking Required</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="mt-2">
                        @if(!$package['is_prebook'] && $package['is_prebook_package_launched'])
                            <p class="text-center"><b>Sorry!</b><br> You have not enrolled into this course.</p>
                            @if (! request()->session()->has('access_token'))
                                <a id="buy-now-unauthenticated" href="#" class="btn btn-block btn-primary rounded-0 mb-4 buy-now-login" data-toggle="modal" data-target="#modal-login" data-package="{{ $package['id'] }}">Enroll Now</a>
                            @else
                                <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="btn btn-block btn-primary rounded-0 mb-4">Enroll Now</a>
                            @endif
                        @else
                            <p class="text-center"><b>Sorry!</b><br> You have not prebooked this course.</p>
                            @if (! request()->session()->has('access_token'))
                                <a id="buy-now-unauthenticated" href="#" class="btn btn-block btn-primary rounded-0 mb-4 buy-now-login" data-toggle="modal" data-target="#modal-login" data-package="{{ $package['id'] }}">Book Now</a>
                            @else
                                <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="btn btn-block btn-primary rounded-0 mb-4">Book Now</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---- END LOGIN MODAL ------->
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
            $('.cart-save-for-later').click(function () {
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
                    }
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

            $('#buy-now-unauthenticated').click(function() {
                $('#modal-purchase').modal('toggle');
            });

            $('.collapse').on('hide.bs.collapse', function () {
                var id = $(this).attr('id');
                var $btn = $(this).closest('.card').find('[data-target="#'+id+'"] i');

                $btn.removeClass('fa-minus');
                $btn.addClass('fa-plus');
            });

            $('.collapse').on('show.bs.collapse', function () {
                var id = $(this).attr('id');
                var $btn = $(this).closest('.card').find('[data-target="#'+id+'"] i');

                $btn.removeClass('fa-plus');
                $btn.addClass('fa-minus');
            });
        });
    </script>
@endpush

