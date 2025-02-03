@extends('layouts.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">
        <div class="mt-5 mb-5 text-center associate-order" style="padding-top: 80px;">
            <img src="/assets/images/cancelled.jpg" class="align-self-center" alt="cancel image" width="257" height="259">
            <h4>Transaction Cancelled!</h4>
            <div class="details">
                <div class="text-center">
                    <div class="container">
                        <div class="alert alert-primary" role="alert">
                        <p>It seems you cancelled your last transaction. You can attempt to purchase the course again. If it was not cancelled by you and if the amount has been deducted, then wait for 30 minutes for payment confirmation.</p>
                    </div>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Home</a>
            </div>
        </div>
    </main>
@endsection
