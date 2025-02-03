@extends('layouts.master')

@section('title', 'Order History')

@section('content')
        <main class="student-dashboard" role="main">
            <div class="container-fluid py-4 px-5">
                <h3 class="text-secondary"><b>Order History</b></h3>
                <div class="row mt-3">

                    <div class="col-md">
                        <div class="border shadow mt-4 mt-md-0">
                            <div class="students-contents p-4">
                                <h5 class="mb-4">My Orders</h5>
                                @if($orders)
                                <div class="card mb-4">
                                    <div class="bg-primary-10 d-flex align-items-center" id="heading0">
                                        <table class='table table-bordered'>
                                            <th>Sr.No</th>
                                            <th>Order Status</th>
                                            <th>Created At</th>
                                            <?php $i = 1; ?>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>
                                                    <?php switch ($order['status']) {
                                                        case '1':
                                                            echo 'Order Received';
                                                            break;

                                                        case '2':
                                                            echo 'Order Accepted';
                                                            break;
                                                        case '3':
                                                            echo 'Order Shipped';
                                                            break;
                                                        case '4':
                                                            echo 'Order Delivered';
                                                            break;
                                                        default:
                                                            # code...
                                                            break;
                                                    }  ?>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($order['created_at'])->format('d M Y')}}</td>
                                            </tr>
                                            <?php ++$i; ?>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                @else
                                <div class="mt-4">
                                    <p>Currently no history !</p>
                                </div>
                                @endif
                            </div>
                        @if($orderid)
                        <!-- {{$orderid}} -->
                        @else
                        <!-- {{'-'}} -->
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

@push('script')
<script>
    $(function() {

    });
</script>
@endpush
