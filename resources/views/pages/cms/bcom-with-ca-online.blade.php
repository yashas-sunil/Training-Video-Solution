@extends('layouts.master')
@section('content')
<style>
    .demo-info {
        background: #3c3881;
        padding: 1% 0 !important;
    }
    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        box-sizing: border-box;
    }
    .with_ca {
        width: 90%;
        margin: 50px auto;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        border-radius: 35px;
        padding: 50px;
        box-sizing: border-box;
    }
    .with_ca_row{
        display: flex;
    }
    .with_ca_row_left{
        width: 50%;
        padding-right: 15px;
        padding-left: 15px;
    }
    .with_ca_row_left h2 {
        font-size: 45px;
        font-weight: 700;
        line-height: 55px;
        color: #0D1735;
        text-align: left;
        text-transform: uppercase;
        margin-bottom: 15px;
        font-family: 'Rubik', sans-serif;
        margin-top: 0;
        box-sizing: border-box;
    }
    .ctas {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .with_ca_row_left .ctas a {
        background-color: #F58D2F;
        padding: 10px 25px;
        border-radius: 50px;
        text-align: left;
        color: #fff;
        font-size: 16px;
        display: block;
        width: max-content;
        text-decoration: none;
    }

    .with_ca_row_right{
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 30px 15px 10px 15px;
    }
    .with_ca_row_right p {
        font-style: italic;
        font-size: 20px;
        text-align: left;
        color: #000;
        font-weight: 500;
        margin-bottom: 25;
        margin-left: 20px;
        margin-top: 0px;
    }

    .with_ca_row_right img {
        width: 90%;
        height: auto;
        margin-left: 20px;
        border-style: none;
        height: auto;
        max-width: 100%;
        vertical-align: middle;
    }

    @media(min-width: 576px){
        .container {
            max-width: 540px;
        }
    }
    @media(min-width: 768px){
        .container {
            max-width: 720px;
        }
    }
    @media(min-width: 992px){
        .container {
            max-width: 960px;
        }
    }
    @media(min-width: 1200px){
        .container {
            max-width: 1140px;
        }
    }

    @media(max-width: 980px){
        .with_ca {
            width: 100%;
        }
        .with_ca_row{
            flex-direction: column;
        }
        .with_ca_row_left, .with_ca_row_right{
            width: 100%;
        }
    }
</style>

<div class="main">
    <div class="demo-info">
        <h1>A FOUNDATION OF OPPORTUNITIES</h1>
    </div>

    <div class="container">
        <div class="with_ca">
            <div class="with_ca_row">
                <div class="with_ca_row_left">
                    <h2>B Com Online With CA</h2>
                    <div class="ctas">
                    <a href="https://sastraonline.com/bcom-with-ca-online" target="_blank">Get Details</a>
                    <a href="https://sastra.edu/onlinedodeform/JKShah/" target="_blank">B.Com Application Form</a>
                    </div>
                </div>
                <div class="with_ca_row_right">
                    <p>In collaboration with</p>
                    <img src="{{asset('assets/images/Sastra.svg')}}">
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@push('script')


@endpush