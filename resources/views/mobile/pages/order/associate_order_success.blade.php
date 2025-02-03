@extends('old_layouts.mobile.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5" role="main">

        <div class="mt-5 mb-5 text-center">
            <i class="fas fa-envelope fa-10x text-success"></i>
            <h3>Payment link was successfully sent.</h3>
            <a href="{{ url('/home') }}" class="btn btn-sm btn-primary">Home</a>
        </div>

    </main>
@endsection
