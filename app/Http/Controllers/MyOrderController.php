<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use PDF;
use Artesaos\SEOTools\Facades\SEOMeta;
use Session;

class MyOrderController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * AskAQuestionController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;

        $payments = $this->apiService->getPayments(['with' => ['orderItems.package'], 'limit' => 7, 'page' => $request->page, 'recently_viewed' => $request->recently_viewed]);
        $payments = $payments['data'] ?? [];

        $studymaterials_purchased=$this->apiService->getPurchasedStudyMat();
        $studymaterials_purchased=$studymaterials_purchased['data']??null;
//        return $payments;
        SEOMeta::setTitle("My Purchases | JK Shah Online");
        return view('pages.my-orders.index', Compact('user', 'payments','studymaterials_purchased'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function previewInvoice(Request  $request, $id, $pdf)
    {
        $orders =  $this->apiService->getInvoiceDetails(['id' => $id]);
        $orders_data = $orders['data'] ?? null;
        //dd($orders_data);
        if(empty($orders_data)){
            echo "<script>alert('No Invoice found')</script>";
            die("No Invoice found");
        }
        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;
        $user_id = $user['id'];
        $order_details =  $orders['data']['student_orders'];
        if($user_id != $order_details['user_id']){
            $user_data = array(
                'user_id' => $user_id,
                'name' =>$user['name'],
                'invoice_id' =>$id
            );
            $save_log = $this->apiService->saveInvoiceAccessLog($user_data);
            request()->session()->forget('access_token'); 
            return redirect('/'); 
   
        }
        $holiday_offer_det=$this->apiService->getHolidayOfferDet(['id'=>$order_details['order']['holiday_offer_id']]);
        $holiday_offer_name=$holiday_offer_det['data']['name'] ?? "PROMOTIONAL";
        $gstn =  $orders['data']['gstn'];
        $pendrive_price =  $orders['data']['pendrive_price'];

        view()->share(['order_details' => $order_details, 'gstn' => $gstn, 'pendrive_price' => $pendrive_price,'holiday_offer_name'=>$holiday_offer_name]);

        //$pdf = PDF::loadView('pdf.invoice')->setPaper('A4', 'portrait');
        $pdf = PDF::loadView('pdf.invoice_latest')->setPaper('A4', 'portrait');
        return $pdf->download('Invoice-' . $order_details['id'] . '.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    /**
     * show order history of particular order item id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderHistory()
    {
        $orderid= $_GET['id'];
        $orders =  $this->apiService->getOrderHistory(['id' => $_GET['id']]);
        $orders = $orders['data'] ?? null;
        return view('pages.my-orders.orderhistory', Compact('orders','orderid'));
    }
}
