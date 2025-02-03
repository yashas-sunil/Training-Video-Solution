@extends('layouts.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">

       <div class="mt-5 mb-5 text-center">
           <i class="fas fa-check fa-10x text-success"></i>
           <h3>Your order was successfully placed.</h3>
           <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
       </div>

    </main>
@endsection
