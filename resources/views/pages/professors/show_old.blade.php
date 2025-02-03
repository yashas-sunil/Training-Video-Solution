@extends('layouts.master')

@section('title', 'Professor')

@section('content')
    <main class="Professors px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">

            <div class="row mt-3 students-contents">
                <div class="col-md-10 offset-md-1">
                    <h1 class="text-secondary custom-package">Prof. {{ $professor['title'] }} @if($professor['description']) - {{ $professor['description'] }} @endif</h1>
                    <div class="border shadow p-5">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ $professor['image'] ?? url('/assets/images/avatar.png') }}" alt="{{ $professor['alt'] }}" title="{{ $professor['title_tag'] }}" class="img-thumbnail">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            {{--                                            <h5>{{ $professor['name'] }}--}}
                                            {{--<small class=" bg-secondary text-white py-1 px-2 position-relative" style="border-radius: 16px; z-index: 2; font-size: 11px">--}}
                                            {{--<i class="fa fa-star text-warning"></i>{{ $professor['rating'] }}--}}
                                            {{--</small>--}}
                                            {{--                                            </h5>--}}
                                        </div>
                                        <div class="py-2">
                                            <b>Experience: </b> {{ $professor['experience'] }} Years
                                        </div>
                                        <div class="py-2">
                                            <h4>Introduction</h4>
                                            <p class="text-justify"> {{ $professor['introduction'] }}</p>
                                        </div>
                                        {{--<div class="py-2">--}}
                                        {{--{{ $professor['email'] }}--}}
                                        {{--</div>--}}
                                        {{--<div class="py-2">--}}
                                        {{--{{ $professor['mobile'] }}--}}
                                        {{--</div>--}}
                                    </div>
                                    @if($professor['video_type'] == 1 )
                                        @if($professor['publish_status'] == 1 )
                                            <div class="col-md-6">
                                                <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                                                    <script type='text/javascript' src='{{ $professor['player_url'] }}'></script>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($professor['video_type'] == 2 )
                                        <div class="col-md-6">
                                            <iframe allowfullscreen="" frameborder="0" height="300" src="{{ $professor['video_url'] }}" width="100%"></iframe>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        @if($packages['data'])
                            <div class="row align-items-center mt-4">
                                <div class="col">
                                    <h3 class="mr-auto  mb-0 text-secondary">{{ $professor['heading_tag'] }}</h3>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('packages/')}}" class="text-white mr-5">view more <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="">
                                @include('includes.packages-carousel', ['packages' => $packages, 'nav' => 'false', 'dots' => 'true', 'professor_id' => $professor['id']])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function () {

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
        });

    </script>
@endpush

