@extends('layouts.master')
@section('content')
<div class="main">
    <div class="contact-info">
        <h1>Student Testimonials</h1>
    </div>
    <div class="container">
        <div class="full_testominials">
        @foreach($testimonials as $testimonial)
            <div class="test_row shadow">
                <div class="test_head">
                    <img src="{{ $testimonial['image'] ?? url('/assets/images/avatar.png') }}" alt="" loading="lazy">
                </div>
                <div class="test_info">
                    <h3 class="font-weight-bold">{{$testimonial['name']}}</h3>
                    <p>
                    <p>{{ $testimonial['testimonial']}}</p> 
                    
                    </p>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</div>
@endsection
