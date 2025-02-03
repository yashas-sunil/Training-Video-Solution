<!DOCTYPE html>
<html lang="en">
<title>INVOICE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<head>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ url('vendor/@fortawesome/fontawesome-free/css/all.css') }}" />

    <style>
        .invoice{
            background-color: #f58457;
            color: white;
            font-weight: bold;
        }
        .invoice-border{
            border: 1px solid #f58457;
        }
        .table-bordered td {
            border: 1px solid #ffc9a3;
        }
        .table-bordered th {
            border: 1px solid #ffc9a3;
        }
        .payment-details-table{
            border: #f58457 1px solid !important;
            background: #f58457;
            color: whitesmoke;
        }
        .price-details{
            border: #f58457 1px solid !important;
            background: #f5a884;
        }
        #gst {
            width: 200px;
            height: 100px;
            background: coral;
        }

        .transparent-border{
            border: 1px solid white;
            background: white;
        }

        .receipt{
            color: #f58457;
        }
    </style>
</head>

<body>
<section id="content">
    <div class="container py-4 px-5" >

        <div class="row mt-3">
            <div class="col-sm-12 col-md-12">
                <table>
                    <tbody>
                    <tr>
                        <td><img src="{{url('assets/images/logo.png')}}" alt="JK Shah Classes Online" title="JK Shah Classes Online" width="100px" height="50"></td>
                        <td style="width: 300px"></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="text-center receipt"><p style="font-size: 30px;"><b>RECEIPT</b></p></td>
                                </tr>
                                <tr>
                                    <td  class="text-center receipt">{{str_pad($order_details['id'], 6, "0", STR_PAD_LEFT)}}</td>
                                </tr>
                                <tr>
                                    <td  class="text-center receipt">{{ Carbon\Carbon::parse($order_details['created_at'])->format('d M Y')}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-md-4">
            <div class="col-sm-12 col-md-12">
                <table>
                    <tbody>
                    <tr>
                        <td  style="width:250px">
                            <table  class="table table-bordered" >
                                <thead class="invoice invoice-border">
                                <tr>
                                    <th class="text-center" scope="col">FROM</th>
                                </tr>
                                </thead>
                                <tbody class="invoice-border">
                                <tr style="border: #f58457">
                                    <td class="text-center" style="border-bottom: 1px solid white">JKSHAH ONLINE</td>
                                </tr>
                                <tr style="border: #f58457">
                                    <td class="text-center" style="border-bottom: 1px solid white">ANDHERI EAST, SHRADDHA</td>
                                </tr>
                                <tr style="border: #f58457">
                                    <td class="text-center" style="border-bottom: 1px solid #ffc9a3">MAHARASHTRA, PIN :400069</td>
                                </tr>
                                <tr>
                                    <td class="price-details">GSTN : {{$gstn}}</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:30px"> </td>
                        <td style="width:250px">
                            <table class="table table-bordered" >
                                <thead class="invoice invoice-border">
                                <tr>
                                    <th class="text-center" scope="col">TO</th>
                                </tr>
                                </thead>
                                <tbody class="invoice-border">
                                <tr style="border: #f58457">
                                    <td class="text-center" style="border-bottom: 1px solid white">{{ strtoupper($order_details['address']) }}</td>
                                </tr>
                                <tr style="border: #f58457">
                                    <td class="text-center" style="border-bottom: 1px solid white">{{ strtoupper($order_details['city'])}}</td>
                                </tr>
                                <tr style="border: #f58457">
                                    <td class="text-center" style="border-bottom: 1px solid white">{{ strtoupper($order_details['state'])}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">{{ strtoupper($order_details['pin'])}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row mt-md-4">
            <div class="col-sm-12">
                <table style="margin-top: 10px;"  class="table table-bordered" >
                    <thead class="invoice invoice-border">
                    <tr>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">UNIT COST</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TAX</th>
                    </tr>
                    </thead>
                    <tbody class="invoice-border">
                    @foreach($order_details['order_items'] as $items)
                        <tr style="border: #f58457">
                            <td>{{ $items['package']['name']}}</td>
                            <td class="text-md-right">{{ number_format($items['package']['selling_price'],2)}}</td>
                            <td class="text-md-right">{{ number_format($items['package']['selling_price'],2) }}</td>
                            <td class="text-md-right">{{ number_format(($items['package']['selling_price'] * 0.18),2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-md-4">
            <div class="col-sm-12">
                <table  style="margin-top: 10px;" class="table table-bordered" >
                    <thead class="thead-border-bottom">
                    <tr>
                        <th scope="col"  style="border-bottom: #f58457 !important;">PAYMENT MADE BY : @if($order_details['payment_mode']==1) ONLINE @else CASH ON DELIVERY @endif</th>
                        <th  style="border: #f58457 1px solid  !important;" class="payment-details-table ">NET TOTAL</th>
                        <th scope="col"   class="price-details" style="border-bottom: #f58457 !important;">{{ number_format($order_details['net_amount'],2)}}</th>
                    </tr>
                    </thead>
                    <tbody class="invoice-border">
                    <tr style="border: #f58457">
                        <td></td>
                        <td style="border: #f58457 1px solid  !important;" class="payment-details-table" rowspan="2"><b>CGST (9%) + SGST (9%) / IGST (18%)</b> <br><br>
                            <p><b>TOTAL AMOUNT PAID</b></p>
                        </td>
                        <td class="price-details" >
                            <p>
                                @if($order_details['cgst_amount'] && $order_details['igst_amount']) {{   number_format($order_details['cgst_amount'] + $order_details['igst_amount'],2) }}
                                @elseif($order_details['cgst_amount'] ) {{  number_format($order_details['cgst_amount'],2)}}
                                @else 0
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ strtoupper(\Riskihajar\Terbilang\Facades\Terbilang::make($order_details['net_amount']) )}} RUPEES ONLY</td>
                        <td class="price-details" >{{ number_format($order_details['net_amount'],2)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div

        <div class="row mt-3" >
            <div class="col-sm-12 col-md-12">
                <table  style="margin-top: 10px;">
                    <tbody>
                    <tr>
                        <td style="width: 200px"></td>
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="text-center"><div  style="border-bottom: 1px solid #ffc9a3; "></div></td>
                                </tr>
                                <tr>
                                    <td  class="text-center"><b>Authorised Signatory</b></td>
                                </tr>
                                <tr>
                                    <td  class="text-center"><small>This is computer generated invoice no signature required.</small></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
