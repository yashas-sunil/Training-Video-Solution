@extends('frontend.master-old_layouts.master')

@section('title')
@endsection

{{--SEO Tags--}}

@section('og_title')
@endsection
@section('og_url')
@endsection
@section('og_description')
@endsection
@section('og_image')
@endsection

@section('twitter_title')
@endsection
@section('twitter_site')
@endsection
@section('twitter_description')
@endsection
@section('twitter_image')
@endsection

{{--End SEO Tags--}}

@push('styles')
@endpush

@section('content')
    <main role="main" class="main-section">
        <section class="testimonial">
            <div class="container">
                <div class="row">
                    <div class="testimonial-innersec">
                        <div class="section-title">
                            <h2>Test Completed</h2>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center">
                            <div class="col-sm-6">
                                <div class="owl-carousel owl-theme" id="testimonial-slider">
                                    <div class="item">
                                        <div class="testinner">
                                            <div class="testimg">
                                                <img src="{{ asset('dist/images/image08.png') }}">
                                            </div>
                                            <div class="test-text">
                                                <h3>Your Score</h3>
                                                <p>{{ $score }}</p>
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
        </section>
    </main>
@endsection

@push('scripts')
@endpush
