@extends('old_layouts.mobile.master')

@section('title', 'Register')

@section('content')
    <div class="text-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('assets/images/logo.png') }}" width="137" height="62" alt="JK Shah Classes Online" title="JK Shah Classes Online">
        </a>
    </div>

    <main role="main">
        <div class="container-fluid">
            <div class="mt-5 mb-5 text-center order-success">
                <i class="fas fa-check fa-10x text-success"></i>
                <h3>You have signed up successfully.</h3>
            </div>
        </div>
    </main>
@endsection
