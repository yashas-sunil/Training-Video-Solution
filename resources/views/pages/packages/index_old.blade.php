@extends('layouts.master')

@section('title', 'Package')

@section('content')
    <main class="course-list" role="main">
        <div class="container sticky-md-top bg-white pt-3 px-0" style="top: 0px; z-index: 1;">
            <div class="">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li style="width: 25%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'all' ? 'active' : '' }}   rounded-0" id="home-tab" href="{{ route('packages.index',  array_merge(request()->all(), ['tab' => 'all','page' => 1])) }}" role="tab"
                           aria-controls="all" aria-selected="true">All</a>
                    </li>
                    <li style="width: 25%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'course' ? 'active' : '' }}   rounded-0" id="home-tab" href="{{ route('packages.index',  array_merge(request()->all(), ['tab' => 'course','page' => 1])) }}" role="tab"
                           aria-controls="home" aria-selected="true">Course</a>
                    </li>
                    <li style="width: 25%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'mini' ? 'active' : '' }} rounded-0" id="profile-tab" href="{{ route('packages.index', array_merge(request()->all(), ['tab' => 'mini','page' => 1])) }}" role="tab"
                           aria-controls="profile" aria-selected="false">Chapters</a>
                    </li>
                    <li style="width: 25%;text-align: center;border-bottom: solid 5px;" class="nav-item border-primary">
                        <a style="font-size: 25px;" class="nav-link {{ $tab == 'crash' ? 'active' : '' }} rounded-0" id="crash-course-tab" href="{{ route('packages.index',  array_merge(request()->all(), ['tab' => 'crash','page' => 1])) }}" role="tab"
                           aria-controls="crash_course" aria-selected="false">Crash Courses</a>
                    </li>
                </ul>
                <form method="GET" action="{{ url('packages') }}">
                    <input type="hidden" name="package_type" value="{{ $tab }}">
                    <div class="row container mt-5">
                        <div class=" col-md-2">
                            <x-inputs.course id="course" name="course" class="form-control">
                                @if (request()->filled('course') && request()->filled('course_text'))
                                    <option value="{{ old('course', request()->input('course')) }}" selected>{{ old('course', request()->input('course_text')) }}</option>
                                @endif
                            </x-inputs.course>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.level id="level" name="level" class="form-control" related="#course">
                                @if (request()->filled('level') && request()->filled('level_text'))
                                    <option value="{{ old('level', request()->input('level')) }}" selected>{{ old('level', request()->input('level_text')) }}</option>
                                @endif
                            </x-inputs.level>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.subject id="subject" name="subject" class="form-control" related="#level">
                                @if (request()->filled('subject') && request()->filled('subject_text'))
                                    <option value="{{ old('subject', request()->input('subject')) }}" selected>{{ old('subject', request()->input('subject_text')) }}</option>
                                @endif
                            </x-inputs.subject>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.chapter id="chapter" name="chapter" class="form-control" related="#subject">
                                @if (request()->filled('chapter') && request()->filled('chapter_text'))
                                    <option value="{{ old('chapter', request()->input('chapter')) }}" selected>{{ old('chapter', request()->input('chapter_text')) }}</option>
                                @endif
                            </x-inputs.chapter>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.professor id="professor" name="professor" class="form-control">
                                @if (request()->filled('professor') && request()->filled('professor_text'))
                                    <option value="{{ old('professor', request()->input('professor')) }}" selected>{{ old('professor', request()->input('professor_text')) }}</option>
                                @endif
                            </x-inputs.professor>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.languages id="language" name="language" class="form-control" >
                                @if (request()->filled('language') && request()->filled('language_text'))
                                    <option value="{{ old('language', request()->input('language')) }}" selected>{{ old('language', request()->input('language_text')) }}</option>
                                @endif
                            </x-inputs.languages>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4 offset-3">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search Packages" @if (request()->filled('search')) value="{{ request()->input('search') }}" @endif>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group">
                                <button id="btn-filter" class="btn btn-primary">Filter</button>
                                <a href="{{ route('packages.index', ['tab' => $tab]) }}" id="btn-reset" class="btn btn-primary border-left">Clear</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
            <div class="bg-diamond-lg"></div>
        </div>

        <div class="container">
            <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
                <div class="bg-diamond-lg"></div>
            </div>
            <div class="container mt-5" id="myTabContent">
                <div class="row mb-5">
                    @if(!$packages)
                        <div class="col-md-6 offset-4">
                            <p><b>No Package Available!</b></p>
                        </div>
                    @else
                        @foreach ($packages['data'] as $package)
                            <div class="col-md-6">
                                <div class="card mt-4 rounded-0" style="box-shadow: 0 10px 11px -6px rgba(0, 0, 0, 0.14);">
                                    <div class="row no-gutters">
                                        <div class="col-md-3">
                                            <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" class="card-img rounded-0"
                                                 alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                                            <div class="text-center mt-3">
                                                @if ($package['strike_prices'])
                                                    <span class="mr-1 text-muted">
                                                        <small>
                                                            @foreach ($package['strike_prices'] as $price)
                                                                <del>₹{{ $price }}</del>
                                                            @endforeach
                                                        </small>
                                                     </span>
                                                    <br>
                                                @endif
                                                <h4 class="d-inline m-0">₹{{ $package['selling_price'] }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body py-2">
                                                <div class="row no-gutters ">
                                                    <div class="col-md-9 col-sm-12">
                                                        <div>

                                                            <a href="{{ url('packages/' . ($package['slug'] ?? $package['id'])) }}" class="text-dark" title="{{ $package['name'] }}">{{ \Illuminate\Support\Str::limit($package['name'], env('TRIM_SIZE'), $end='...')}}</a><br/>
                                                            <i class="fa fa-star text-warning rating"></i>
                                                            <i class="fa fa-star text-warning rating"></i>
                                                            <i class="fa fa-star text-warning rating"></i>
                                                            <i class="fa fa-star text-warning rating"></i>
                                                            <i class="fa fa-star text-warning rating"></i>

                                                        </div>
                                                        <span class="pr-1"></span>
                                                        @if (!$package['is_prebook'] || $package['is_prebook_package_launched'] || $package['is_prebook_content_ready'])
                                                            <small>
                                                                @if ($package['total_duration_formatted'])
                                                                    <i class="fa fa-clock pr-1"></i>{{ $package['total_duration_formatted'] }}
                                                                    |
                                                                @endif
                                                                @if ($package['duration_formatted'])
                                                                    <i class="fa fa-eye pr-1"></i>{{ $package['duration_formatted'] }}
                                                                    |
                                                                @endif
                                                                {{$package['language']['name']}}
                                                            </small>
                                                        @else
                                                            <small>
                                                                @if ($package['prebook_total_duration'])
                                                                    <i class="fa fa-clock pr-1"></i>{{ $package['prebook_total_duration'] }}
                                                                    |
                                                                @endif
                                                                @if ($package['duration_formatted'])
                                                                    <i class="fa fa-eye pr-1"></i>{{ $package['duration_formatted'] }}
                                                                    |
                                                                @endif
                                                                {{$package['language']['name']}}
                                                            </small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="text-right py-1">
                                                            <div class="d-flex flex-row-reverse justify-content-center flex-nowrap py-1">
                                                                @php
                                                                    $max_count = 3;
                                                                    $count = count($package['professors']);
                                                                    $professors = $package['professors'];
                                                                    $professors = collect($package['professors'])->take($max_count);
                                                                @endphp
                                                                @foreach($professors as $professor)
                                                                    <div class="position-relative" style="margin-left: -8px;">
                                                                        <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                                                             alt="{{ $professor['alt'] }}"
                                                                             class="img-thumbnail rounded-circle border-0"
                                                                             style="width: 40px !important; height: 40px !important; display: inline; padding: 2px">
                                                                        @if ($loop->first && $count > $max_count)
                                                                            <div class="position-absolute d-flex text-center rounded-circle" style="margin: 2px; left: 0; right: 0; top: 0; bottom: 0; background: rgba(0, 0, 0, .5);">
                                                                                <small class="text-light flex-fill rounded-circle" style="line-height: 36px;">+{{ $count - $max_count }}</small>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row no-gutters align-items-center mt-md-2">
                                                    @if ((isset($user['role']) &&  $user['role'] != 6) || !isset($user['role']) )
                                                        <div class="col">
                                                            @if (! request()->session()->has('access_token'))
                                                                <a href="#" data-toggle="modal" data-target="#modal-login" class="btn btn-sm btn-primary buy-now-login" data-package="{{ $package['id'] }}">Enroll Now</a>
                                                            @else

                                                                <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="btn btn-sm btn-primary">Enroll Now</a>
                                                            @endif
                                                        </div>

                                                        <div class="col">
                                                            <a href="#" class="btn btn-sm btn-primary btn-add-to-cart"
                                                               data-id="{{ $package['id'] }}">Add to Cart</a>
                                                        </div>

                                                        <div class="col">
                                                            <b>
                                                                <a href="{{ url('packages/' . ($package['slug'] ?? $package['id'])) }}" class="btn btn-sm text-primary">Learn More </a>
                                                            </b>
                                                        </div>
                                                    @endif
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
        </div>
        <div class="container">
            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="{{ route('packages.index',  array_merge(request()->all(),['tab' => $tab, 'page' => 1])) }}">First</a>
                        </li>
                        @if($page <=1)
                            <a disabled class="page-link" >Previous</a>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ route('packages.index',  array_merge(request()->all(),['tab' => $tab, 'page' => $page - 1])) }}">Previous</a>
                            </li>
                        @endif
                        <li class="page-item">
                            @if($page >= $packages['last_page'])
                                <a disabled class="page-link" >Next</a>
                            @else
                                <a class="page-link" href="{{ route('packages.index',  array_merge(request()->all(),['tab' => $tab, 'page' => $page + 1])) }}">Next</a>
                            @endif
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ route('packages.index',  array_merge(request()->all(),['tab' => $tab, 'page' => $packages['last_page']])) }}">Last</a>
                        </li>
                    </ul>
                </nav>
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
