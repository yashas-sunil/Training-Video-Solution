@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="my_purchased">
                        <div class="purchased_title">
                            <div class="purchased">My Purchases</div>
                        </div>
                        <form id="filter_view" action="" method="GET" >
                            <div class="select_options">
                                <select name="recently_viewed" id="view">
                                    <option value="" disabled selected>View</option>
                                    <option value="1" @if(request()->input('recently_viewed') == 1) selected @endif>Last week</option>
                                    <option value="3" @if(request()->input('recently_viewed') == 3) selected @endif>Last 3 Months</option>
                                </select>
                            </div>
                        </form>
                        <div class="student_purchased">
                            @if($payments)
                                @foreach($payments as $payment)
                                        <div class="purchsed_list">
                                            <div class="row">
                                                {{--<div class="col-lg-2 col-md-2 col-sm-12">--}}
                                                    {{--<div class="purchased_banner">--}}
                                                        {{--<img src="https://picsum.photos/290/190" alt="">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="purchased_details">
                                                        <div class="purchased_upper">
                                                            <div class="purchased_info">
                                                                <h1>Invoice Number #{{ str_pad($payment['receipt_no'], 6, "0", STR_PAD_LEFT )}}</h1>
                                                                <ul>
                                                                    <li>
                                                                        <span>Order No:</span>
                                                                        <p># {{$payment['order_id']}}</p>
                                                                    </li>
                                                                    <li>
                                                                        <span>Purchase Date:</span>
                                                                        <p>{{ Carbon\Carbon::parse($payment['created_at'])->format('d M Y')}}</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="invoice">
                                                                
                                                                <button class="btn btn-primary buy_material" style="border-radius: 20px"  onclick="download_invoice(<?= $payment['id'] ?>)">Download Invoice</button>
                                                                <!-- <button class="btn btn-secondary buy_material" >Buy Study Material</button> -->
                                                            </div>
                                                        </div>
                                                        @foreach($payment['order_items'] as $order)
                                                            <div class="purchased_packages">
                                                                <h5>Package</h5>
                                                                <div class="purchased_pack_list">
                                                                    <h6>{{ $order['package']['name'] }} @if ($order['item_type'] == 2) (Study Material) @endif</h6>
                                                                    @if ($order['item_type'] == 1 && $order['package']['study_material_price'])
                                                                    @if(!(in_array($order['package']['id'],$studymaterials_purchased)))
                                                                         <a href="{{ url("study-materials/{$order['package']['id']}/checkout") }}"
                                                                            class="btn btn-secondary buy_material" >Buy Study Material</a>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
 <!-- Review Modal -->
                <div class="modal fade" tabindex="-1" id="review_modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h1 class="modal-title">Rate your overall experience of this Course </h1>

                                <div class="feedback">
                                    <div class="ratings">
                                        <input type="radio" name="rate" id="rate-5">
                                        <label for="rate-5"></label>
                                        <input type="radio" name="rate" id="rate-4">
                                        <label for="rate-4"></label>
                                        <input type="radio" name="rate" id="rate-3">
                                        <label for="rate-3"></label>
                                        <input type="radio" name="rate" id="rate-2">
                                        <label for="rate-2"></label>
                                        <input type="radio" name="rate" id="rate-1">
                                        <label for="rate-1"></label>
                                    </div>
                                </div>

                                <input type="text" name="tite" id="review_title" placeholder="Title of the review">
                                <textarea  rows="5" placeholder="Your detailed review"></textarea>
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- Review Modal -->
            </main>
        </div>
    </div>
@endsection
@push('script')
<script>
    $(function() {
        $('#view').on('change', function (e) {
            $("#filter_view").submit();
        });
    });
    
    function download_invoice(id){
        var url = '{{ url('download-invoice') }}'+'/'+id+'/pdf';
        window.location.href = url;
    }
    </script>
@endpush


