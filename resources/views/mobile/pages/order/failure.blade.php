@extends('old_layouts.mobile.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">

        <div class="mt-5 mb-5 text-center order-success">
            <i class="fas fa-exclamation-triangle fa-10x text-danger"></i>
            <h3>Oops some error occured.</h3>
            <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
        </div>

    </main>
@endsection
