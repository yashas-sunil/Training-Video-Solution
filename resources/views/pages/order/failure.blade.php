@extends('layouts.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">
        <div class="mt-5 mb-5 text-center associate-order" style="padding-top: 150px;">
            <i class="fas fa-exclamation-triangle fa-8x text-danger"></i>
            <h4>Oops some error occured !</h4>
            <div class="details">
                <div class="text-center">
                    <div class="container">
                        <div class="alert alert-primary" role="alert">
                            Your payment status has failed, but if the amount has been deducted from your account, please wait for 30 minutes and check whether the course is available on the dashboard.
                        </div>
                    </div>
                </div>
                <a href="{{ url('/student-dashboard') }}" class="btn btn-sm btn-primary">Continue</a>
            </div>
        </div>
    </main>
@endsection
