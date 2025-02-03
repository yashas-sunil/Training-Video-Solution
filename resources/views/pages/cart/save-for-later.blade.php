@extends('layouts.master')

@section('title', 'Cart')

@section('content')
    <main class="cart px-md-5 px-sm-5 content-min-height" role="main">
        @if($items)
            <div class="container-fluid py-4  px-5" >
                <h3 class="text-secondary"><b>Save for later</b></h3>
                <div class="row mt-3 ">
                    <div class="col-md pl-4 pr-4 pt-2 mb-4 bg-secondary-10">
                        @foreach($items as $item)
                            <section>
                                <div class="container py-3">
                                    <div class="card">
                                        <div class="row">

                                            <div class="col-md-3 pull-5">
                                                <img src="{{ $item['package']['image_url'] ?? 'assets/images/course-img1.png' }}" class="w-100">
                                            </div>
                                            <div class="col-md-9 py-2 py-sm-2 pl-sm-2">
                                                <div class="row">
                                                    <div class="col-md-4 pl-5">
                                                        <div>
                                                          <a  href="{{ url('packages/' . ($item['package']['slug'] ?? $item['package']['id']) ) }}" > <span class="d-inline-block">{{ $item['package']['name'] }}</span></a>
                                                        </div>
                                                        {{--<i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--<i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--<i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--<i class="fa fa-star text-warning rating"></i>--}}
                                                        {{--<i class="fa fa-star text-warning rating"></i>--}}
                                                        @if($item['package']['total_duration_formatted'])
                                                        <div>
                                                            <span class="d-inline-block text-muted">{{ $item['package']['total_duration_formatted'] }} Hours</span>
                                                        </div>
                                                       @endif
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="d-flex justify-content-end">
                                                            <div class=" pt-2 pr-3">
                                                <span class="float-right ">
                                                     <h4>₹  {{ number_format($item['package']['selling_price'],2) }}</h4>
                                                </span>
                                                                <span class=" mr-1 float-right text-muted">
                                                                    @if(isset($cartItem['strike_prices']))
                                                    @foreach ($item['package']['strike_prices'] as $price)
                                                                        <small><del>{{ $price }}</del></small>
                                                                    @endforeach
                                                                        @endif
                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="pr-3">
                                                            <div class="d-flex justify-content-end">
                                                                <a class="mt-1 text-info pr-3 remove-item" href="#" data-id="{{ $item['id'] }}"><small>Remove</small></a>
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
                </div>
            </div>
        @else
            <div class="mt-5 mb-5 text-center">
                <i class="fas fa-heart fa-10x text-primary"  style="padding-top: 160px;"></i>
                <h3 >Save for later is empty</h3>
                <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
            </div>
        @endif
            {{--@if($items)--}}
            {{--@if($packages)--}}
            {{--<section class="">--}}
                {{--<div class="container-fluid py-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col">--}}
                            {{--<h3 class="mr-auto ml-5 text-secondary">Recommendation</h3>--}}
                        {{--</div>--}}
                        {{--<div class="col-auto">--}}
                            {{--<a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="mx-5">--}}
                        {{--@include('includes.packages-carousel', ['packages' => $packages])--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</section>--}}
            {{--@endif--}}

            {{--@if($miniPackages)--}}
            {{--<section class="bg-primary-half bg-right">--}}
                {{--<div class="container-fluid py-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col">--}}
                            {{--<h3 class="mr-auto ml-5 text-secondary">Also Bought</h3>--}}
                        {{--</div>--}}
                        {{--<div class="col-auto">--}}
                            {{--<a href="{{ url('packages/')}}" class="text-white">View more &gt;</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="mx-5">--}}
                        {{--@include('includes.mini-packages-carousel', ['packages' => $miniPackages])--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</section>--}}
            {{--@endif--}}
            {{--@endif--}}

    </main>

@endsection

@push('script')
    <script>
        $(function() {
            $('.remove-item').click(function () {
                let id = $(this).data('id');

                $.ajax({
                    type:'DELETE',
                    url:'{{ url('save-for-later') }}' + '/' + id,
                    data:{
                        _token: '{{ csrf_token() }}'
                    },
                    success:function() {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush
