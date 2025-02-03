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
        <section class="reeachplatform">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 section-title text-center">
                        <h2>Reach of the Platform</h2>
                    </div>
                </div>
                <div class="platform-sec">
                    <div class="row">
                        @foreach($tests as $test)
                        <div class="col-sm-4">
                            <div class="platform-inner">
                                <div class="platicon">
                                    <img src="{{ asset('dist/images/icon5.png') }}">
                                </div>
                                <div class="plattext">
                                    <h4>{{ $test->name }}</h4>
                                    <a href="{{ route('frontend.test', ['ID' => encrypt($test->id)]) }}" class="btn btn-primary">Select</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
@endpush
