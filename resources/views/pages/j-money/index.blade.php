@extends('layouts.master')

@section('title', 'J-Koins')
@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
  .dataTables_wrapper .dataTables_filter input [type="search"]{
    border-radius: 5px !important;
    border: 1px solid #ccc !important;
} 
</style>
@stop
@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4">
            <!-- <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}</b></h3>
            <a href="{{ url('contents') }}"><i class="far fa-arrow-alt-circle-left fa-2x text-secondary"></i></a> -->
            <div class="row mt-3 page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents  p-4">
                            @if (count($spinWheelRewards) > 0)
                                <h3>Spin Wheel Rewards</h3>
                                <div class="row mt-3">
                                    @foreach ($spinWheelRewards as $spinWheelReward)
                                        <div class="col-md-3">
                                            <div class="card text-white bg-secondary mb-3">
                                                <div class="card-body">
                                                   
                                                        <h1 class="card-title"><b>₹{{ $spinWheelReward['points']}}</b></h1>
                                                   
                                                    <span><i class="fas fa-calendar"></i> Expire on {{ \Carbon\Carbon::parse($spinWheelReward['expire_at'])->toFormattedDateString() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row">
                            <div class="col sm-d 6">
                             <h3>J-Koins</h3>
                            </div>
                            <div class="col sm-d 6" style="text-align:right;">
                             <span>Remaining:{{$jkoins['rewards']}} <p> Used : {{$usedJkoins}} </p> </span>
                             </div>
                            </div>
                            <div class="mt-4 mt-md-0 table-responsive" style="min-height:450px;">
                                <table class="table table-striped"  id="example">
                                    <thead class="bg-primary-50 p-2">
                                    <tr class="">
                                        <th class="border-0 font-weight-normal" scope="col">Activity</th>
                                        <th class="border-0 font-weight-normal" scope="col">Order ID</th>
                                        <th class="border-0 font-weight-normal" scope="col">Points</th>
                                        <th class="border-0 font-weight-normal" scope="col">Type</th>
                                        <th class="border-0 font-weight-normal" scope="col">Expire At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($jMoneys as $jMoney)
                                        <tr>
                                            <td>{{ $jMoney['activity'] }}</td>
                                            <td>{{ $jMoney['order_id'] }}</td>
                                            <td>{{ $jMoney['points'] }}</td>
                                            <td>
                                                @if($jMoney['transaction_type']==2)
                                                     Debit
                                                 @else
                                                     credit
                                                 @endif
                                            </td>
                                            <td> @if($jMoney['transaction_type']==1){{ \Carbon\Carbon::parse($jMoney['expire_at'])->toFormattedDateString() }} @if (\Carbon\Carbon::parse($jMoney['expire_at'])->lessThan(\Carbon\Carbon::now())) <span class="badge badge-pill badge-danger">Expired</span> @endif @endif</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                               
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
	$(document).ready(function () {
    $('#example').DataTable();
});
</script>
@endpush
