@extends('old_layouts.mobile.master')

@section('title', 'Package')

@section('content')
    <main class="course-list" role="main">
        <div class="container sticky-md-top bg-white pt-3 px-0" style="top: 0px; z-index: 1;">
            <div class="">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 0 ? 'active' : '' }}   rounded-0" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Course</a>
                    </li>
                    <li style="width: 50%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 1 ? 'active' : '' }} rounded-0" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">Mini Course</a>
                    </li>
                    <li style="width: 30%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 2 ? 'active' : '' }} rounded-0" id="crash-course-tab" data-toggle="tab" href="#crash_course" role="tab"
                           aria-controls="crash_course" aria-selected="false">Crash Courses</a>
                    </li>
                </ul>
                <form method="GET" action="{{ url('mobile/packages') }}">
                    <div class="row container mt-5">
                        <div class="offset-md-1 col-md-2 mb-2">
                            <select name="course" class="custom-select custom-select-sm" onchange="this.form.submit()">
                                <option selected value="">Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course['id'] }}" @if (request()->has('course')) @if ($course['id'] == request()->input('course')) selected @endif @endif>{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="level" class="custom-select custom-select-sm mb-2" onchange="this.form.submit()">
                                <option selected value="">Level</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level['id'] }}" @if (request()->has('level')) @if ($level['id'] == request()->input('level')) selected @endif @endif>{{ $level['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="subject" class="custom-select custom-select-sm mb-2" onchange="this.form.submit()">
                                <option selected value="">Subject</option>
                                @foreach ($subjects['data'] ?? [] as $subject)
                                    <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="chapter" class="custom-select custom-select-sm mb-2" onchange="this.form.submit()">
                                <option selected value="">Chapters</option>
                                @foreach ($chapters as $chapter)
                                    <option value="{{ $chapter['id'] }}" @if (request()->has('chapter')) @if ($chapter['id'] == request()->input('chapter')) selected @endif @endif>{{ $chapter['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="professor" class="custom-select custom-select-sm mb-2" onchange="this.form.submit()">
                                <option selected value="">Professors</option>
                                @foreach ($professors as $professor)
                                    <option value="{{ $professor['id'] }}" @if (request()->has('professor')) @if ($professor['id'] == request()->input('professor')) selected @endif @endif>{{ $professor['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
                <div class="bg-diamond-lg"></div>
            </div>
            <div class="tab-content container mt-5" id="myTabContent">
                <div class="tab-pane fade show {{ $tab == 0 ? 'active' : '' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mb-5">
                        @if(!$packages)
                            <div class="col-md-6 offset-4">
                                <p><b>No Package Available!</b></p>
                            </div>
                        @else
                            @foreach ($packages as $package)
                                <div  class="col-md-6" >
                                    <div class="card mt-4 rounded-0" style="box-shadow: 0 10px 11px -6px rgba(0, 0, 0, 0.14);">
                                        <div class="row no-gutters mb-2">
                                            <div class="col-md-3">
                                                <img src="{{ $package['image_url'] }}" class="card-img rounded-0"
                                                     alt="...">
                                                <div class="text-center mt-3">
                                                <span class="mr-1 text-muted">
                                                    <small>
                                                        @foreach ($package['strike_prices'] as $price)
                                                            <del>₹{{ number_format($price,2) }}</del>
                                                        @endforeach
                                                    </small>
                                                </span><br>
                                                    <h4 class="d-inline m-0">₹{{ number_format($package['selling_price'],2) }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body py-2">
                                                    <div class="row no-gutters pb-2">
                                                        <div class="col-md-4 col-sm-12">
                                                            <div data-toggle="tooltip" title="{{$package['name']}}">
                                                                {{ \Illuminate\Support\Str::limit(($package['name']),18, $end=' ...') }}<br/>
                                                            </div>
                                                            <i class="far fa-clock pr-1"></i>{{$package['video_duration_formatted'] }}Hours
                                                        </div>
                                                        <div class="col-md-8 col-sm-12">
                                                            <div class="text-center py-1">
                                                                @foreach($package['professors'] as $professor)
                                                                    <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                                                         alt="..."
                                                                         class="img-thumbnail rounded-circle p-0"
                                                                         style="width: 50px !important; height: 50px !important; display: inline;">
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row no-gutters align-items-center mt-md-2">
                                                        <div class="col">
                                                            @if (! request()->session()->has('access_token'))
                                                                <a href="#" data-toggle="modal" data-target="#modal-login" class="btn btn-sm btn-primary buy-now-login" data-package="{{ $package['id'] }}">Buy Now</a>
                                                            @else
                                                                <a href="{{ url('mobile/order/checkout?package=' . $package['id']) }}" class="btn btn-sm btn-primary">Buy Now</a>
                                                            @endif
                                                        </div>
                                                        <div class="col">
                                                            <b>
                                                                <a href="{{ url('mobile/packages/' . $package['id']) }}" style="color: #f58457;" class="btn btn-sm">Learn More </a>
                                                            </b>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade {{ $tab == 1 ? 'show active' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row mb-5">
                        @foreach ($miniPackages as $package)
                            <div class="col-md-6">
                                <div class="card mt-4 rounded-0" style="box-shadow: 0 10px 11px -6px rgba(0, 0, 0, 0.14);" >
                                    <div class="row no-gutters">
                                        <div class="col-md-3">
                                            <img src="{{ $package['image_url'] }}" class="card-img rounded-0"
                                                 alt="...">
                                            <div class="text-center mt-3">

                                                        <span class="mr-1 text-muted">
                                                            <small>
                                                                @foreach ($package['strike_prices'] as $price)
                                                                    <del>₹{{ $price }}</del>
                                                                @endforeach
                                                            </small>
                                                         </span>
                                                <br>
                                                <h4 class="d-inline m-0">₹{{ $package['selling_price'] }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body py-2">
                                                <div class="row no-gutters ">
                                                    <div class="col-md-4 col-sm-12">
                                                        <div>
                                                            {{ $package['name'] }}<br/>
                                                        </div>
                                                        <i class="far fa-clock pr-1"></i>{{ $package['video_duration_formatted'] }} Hours
                                                    </div>
                                                    <div class="col-md-8 col-sm-12">
                                                        <div class="text-center py-1">
                                                            @foreach($package['professors'] as $professor)
                                                                <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                                                     alt="..."
                                                                     class="img-thumbnail rounded-circle p-0"
                                                                     style="width: 50px !important; height: 50px !important; display: inline;">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row no-gutters align-items-center mt-md-2">
                                                    <div class="col">
                                                        @if (! request()->session()->has('access_token'))
                                                            <a href="#" data-toggle="modal" data-target="#modal-login" class="btn btn-sm btn-primary buy-now-login" data-package="{{ $package['id'] }}">Buy Now</a>
                                                        @else
                                                            <a href="{{ url('mobile/order/checkout?package=' . $package['id']) }}" class="btn btn-sm btn-primary">Buy Now</a>
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <b>
                                                            <a href="{{ url('mobile/packages/' . $package['id']) }}" style="color: #f58457;" class="btn btn-sm ">Learn More </a>
                                                        </b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade {{ $tab == 2 ? 'show active' : '' }}" id="crash_course" role="tabpanel" aria-labelledby="crash-course-tab">
                    <div class="row mb-5">
                        @if(!$crashCourses)
                            <div class="col-md-6 offset-4">
                                <p><b>No Package Available!</b></p>
                            </div>
                        @else
                            @foreach ($crashCourses as $package)
                                <div class="col-md-6">
                                    <div class="card mt-4 rounded-0" style="box-shadow: 0 10px 11px -6px rgba(0, 0, 0, 0.14);" onclick="window.location='packages/{{$package['id']}}'">
                                        <div class="row no-gutters">
                                            <div class="col-md-3">
                                                <img src="{{ $package['image_url'] }}" class="card-img rounded-0"
                                                     alt="...">
                                                <div class="text-center mt-3">

                                                        <span class="mr-1 text-muted">
                                                            <small>
                                                                @foreach ($package['strike_prices'] as $price)
                                                                    <del>₹{{ $price }}</del>
                                                                @endforeach
                                                            </small>
                                                         </span>
                                                    <br>
                                                    <h4 class="d-inline m-0">₹{{ $package['selling_price'] }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body py-2">
                                                    <div class="row no-gutters ">
                                                        <div class="col-md-4 col-sm-12">
                                                            <div>

                                                                {{ $package['name'] }}<br/>
                                                                <i class="fa fa-star text-warning rating"></i>
                                                                <i class="fa fa-star text-warning rating"></i>
                                                                <i class="fa fa-star text-warning rating"></i>
                                                                <i class="fa fa-star text-warning rating"></i>
                                                                <i class="fa fa-star text-warning rating"></i>

                                                            </div>
                                                            <i class="far fa-clock pr-1"></i>{{ $package['video_duration_formatted'] }}
                                                        </div>
                                                        <div class="col-md-8 col-sm-12">
                                                            <div class="text-center py-1">
                                                                @foreach($package['professors'] as $professor)
                                                                    <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                                                         alt="..."
                                                                         class="img-thumbnail rounded-circle p-0"
                                                                         style="width: 50px !important; height: 50px !important; display: inline;">
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row no-gutters align-items-center mt-md-2">
                                                        <div class="col">
                                                            @if (! request()->session()->has('access_token'))
                                                                <a href="#" data-toggle="modal" data-target="#modal-login" class="btn btn-sm btn-primary buy-now-login" data-package="{{ $package['id'] }}">Buy Now</a>
                                                            @else
                                                                <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="btn btn-sm btn-primary">Buy Now</a>
                                                            @endif
                                                        </div>
                                                        <div class="col">
                                                            <a href="#" class="btn btn-sm btn-primary btn-add-to-cart"
                                                               data-id="{{ $package['id'] }}">Add to Cart</a>
                                                        </div>
                                                        <div class="col">
                                                            <b>
                                                                <a href="{{ url('packages/' . $package['id']) }}" class="btn btn-sm">Learn More </a>
                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="bg-diamond bg-diamond-right bg-diamond-bottom" style="transform: translateX(20%) translateY(20%);">
                    <div class="bg-diamond-md"></div>
                </div>
            </div>
        </div>

    </main>
@endsection
@push('script')
    <script>
        $(document).ready(function () {

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
        });
    </script>
@endpush
