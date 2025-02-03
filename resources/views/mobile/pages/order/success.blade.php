@extends('old_layouts.mobile.master')

@section('title', 'Order Status')

@section('content')
    <main class="orders px-md-5 px-sm-5 " role="main">

        <div class="mt-5 mb-5 text-center order-success">
            <i class="fas fa-check fa-10x text-success"></i>
            <h3>Your order was successfully placed.</h3>
            <div class="details">
                <p><strong>Name : {{$user_data['name']}}</strong></p>
                <p><strong>Email : {{$user_data['email']}}</strong></p>
                <p><strong>Phone : {{$user_data['phone']}}</strong></p>
                <p><strong>Plan :  {{$plan}} </strong></p>
                <p><strong>Amount : {{$user_data['amount']}} </strong></p>
                <div class="text-center">
                    <a href="{{url('/user/view-plans')}}" value="OK" class="btn btn-danger ">&nbsp; OK &nbsp;</a>
                </div>
            </div>
            <a href="{{ url('/home') }}" class="btn btn-sm btn-primary">Home</a>
        </div>

    </main>
@endsection
