@extends('layouts.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">
        <div class="mt-5 mb-5 text-center associate-order">
            <i class="fas fa-exclamation-triangle fa-8x text-danger"></i>
            <div class="col-md-6 offset-3">
                <div class="alert alert-light" role="alert">
                    @if($error){{$error}} !@endif <br><br>
                    @if($link_error){{$link_error}} !@endif
                </div>
                <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
            </div>
        </div>
    </main>
@endsection
