@extends('layouts.master')

@section('title', 'Verification')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">
        <div class="mt-5 mb-5 text-center" style="padding-top: 150px;">
            @if ($isVerified)
                <i class="fas fa-check fa-10x text-success"></i>
                <h4>Your account has been successfully verified. Please check your mail for login details.</h4>
                <div class="details">
                    <div class="text-center">
                        <a href="{{ url('/?login') }}" class="btn btn-sm btn-primary">Login</a>
                    </div>
                </div>
            @else
                <i class="fas fa-times fa-10x text-danger"></i>
                <h4>Verification link has been expired or invalid.</h4>
                <div class="details">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
