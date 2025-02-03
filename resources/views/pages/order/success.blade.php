@extends('layouts.master')

@section('title', 'Order Status')

@section('content')
<main class="orders px-md-5 px-sm-5 " role="main">
    <p id="amountValue" style="display: none;">{{$amount}}</p>
    <div id="facebookPixelNoScriptContainer" style="display: none;"></div>
    <div class="mt-5 mb-5 text-center associate-order" style="padding-top: 150px;">
        <i class="fas fa-check fa-10x text-success"></i>
        <h4>Your order was successfully placed !</h4>
        <div class="details">
            <div class="text-center">
                <input type="hidden" id="jcoin" value="{{$jcoin??0}}">
                <input type="hidden" id="offername" value="{{$holiday_offer_name??0}}">
                <a href="{{ url('/student-dashboard') }}" class="btn btn-sm btn-primary">Continue</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rakshabandhanjcoin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rakshabandhanjcoinlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div style="color:green!important" class="mt-3 text-center font-weight-bold">Congratulations. </div>
                    <div class="delete_titles mt-1 text-center font-weight-bold">Rs.<span id="jcoinmoney"></span>&nbsp;&nbsp;{{@$holiday_offer_name}} cashback has been added to your J-Koin wallet </div>
                    <div class="delete_conf_btns d-flex align-items-center justify-content-center mt-5">
                        <!-- <button id="btn-delete-confirm" class="btn btn-success confirm mx-2">Confirm</button> -->
                        <button class="btn btn-secondary mx-2 btn-cancel-confirm">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
            var amountElement = document.getElementById("amountValue");
            var amount=amountElement.textContent;
            $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "Purchase",
                                    amount: amount
                            },
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    console.log(script_execute);
                                    eval(script_execute);
                                }

                                var container = document.getElementById("facebookPixelNoScriptContainer");
                                var noscriptTag = document.createElement("noscript");
                                noscriptTag.setAttribute("id", "facebookPixelNoScript");

                                var imgElement = document.createElement("img");
                                imgElement.setAttribute("height", "1");
                                imgElement.setAttribute("width", "1");
                                imgElement.setAttribute("style", "display:none");
                                imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=Purchase&noscript=1");
                                noscriptTag.appendChild(imgElement);
                                container.appendChild(noscriptTag);
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });
            });
    $(document).ready(function() {
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
       
        if('{{@$jcoin}}' > 0){
            
            var jcoin = $('#jcoin').val();

            if (jcoin != '' && jcoin != null && jcoin != 0) {
                $('#rakshabandhanjcoin').modal();
                $('#rakshabandhanjcoin').modal('show').find('.modal-body .delete_titles #jcoinmoney').text(jcoin);

            }
        }
       
        $('.btn-cancel-confirm').click(function(e) {
            $('#rakshabandhanjcoin').modal('hide');

        });
    });
</script>
<script>
    dataLayer.push({
        'event': 'checkoutpage',
        'checkout_value': {{ $amount}},
        'currency': 'INR',
        'transaction_id': {{ $transactionId }}
    });
</script>
<script>
    dataLayer.push({
        'event': 'order_success',
        'value': {{$amount}},
        'currency': 'INR',
        'transaction_id': {{$transactionId}}
    });
</script>

@endpush