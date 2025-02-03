@extends('layouts.master')

@section('title', 'Ask A Question')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}</b></h3>
            <div class="row mt-3">
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents p-4">
                            <h5 class="mb-4">My Orders</h5>
                            @if($payments['data'])
                                @foreach($payments['data'] as $payment)
                                    <div class="accordion student-questions-accordion" id="student-questions-accordion" >
                                        <div class="card mb-4">
                                            <div class="bg-primary-10 d-flex align-items-center" id="heading0" >
                                                <span class="flex-fill py-2 px-4">#{{ str_pad($payment['receipt_no'], 6, "0", STR_PAD_LEFT )}}</span>
                                                <small class="text-muted pr-4">
                                                    <a class="text-decoration-none" href="{{ url('download-invoice/' . $payment['id'], ['download'=>'pdf']) }}">Download Invoice</a>
                                                </small>
                                                <small class="text-muted pr-4">{{ Carbon\Carbon::parse($payment['created_at'])->format('d M Y')}}</small>
                                                <button
                                                    class="btn btn-primary border-primary py-2 rounded-0 toggle-btn"
                                                    type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapse{{ $payment['id'] }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse{{ $payment['id'] }}">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                            <div id="collapse{{ $payment['id'] }}" class="collapse" aria-labelledby="heading0" data-parent="#student-questions-accordion">
                                                <div class="bg-primary-50 text-primary d-flex py-2 px-4 border-bottom ">
                                                    <span class="flex-fill py-2">Packages</span>
                                                </div>
                                                @foreach($payment['order_items'] as $order)
                                                    <div class="bg-primary-50 d-flex py-2 px-4">

                                                        <a target="_blank" href="{{ route('orderHistory') . '?id=' . $order['id'] }}">Order History: {{$order['id']}}</a>
                                                    </div>
                                                    <div class="bg-primary-50 d-flex py-2 px-4">
                                                        <span class="flex-fill py-2">{{ $order['package']['name'] }} @if ($order['item_type'] == 2) (Study Material) @endif</span>
                                                        @if ($order['item_type'] == 1 && $order['package']['study_material_price'])
                                                            <div class="text-right py-2"><a href="{{ url("study-materials/{$order['package']['id']}/checkout") }}" class="btn btn-primary"><i class="fas fa-book"></i> Buy Study Material</a></div>
                                                        @endif

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mt-4">
                                    <p>Currently you have no orders !</p>
                                </div>
                            @endif
                            <div>
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="?page=1">First</a>
                                        </li>
                                        <li class="page-item @if (!$payments['prev_page_url']) disabled @endif">
                                            <a class="page-link" href="?page={{$payments['current_page']-1}}">Previous</a>
                                        </li>
                                        <li class="page-item @if (!$payments['next_page_url']) disabled @endif">
                                            <a class="page-link" href="?page={{$payments['current_page']+1}}">Next</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="?page={{$payments['last_page']}}">Last</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(function() {
            $('.toggle-btn').click(function() {
                $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
            });
        });
    </script>
@endpush
