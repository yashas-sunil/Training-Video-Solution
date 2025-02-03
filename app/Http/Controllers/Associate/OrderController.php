<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiService;

class OrderController extends Controller
{
    /** @var ApiService */
    var $apiService;

    /**
     * OrderController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = $this->apiService->getAssociateProfile();

        if ($profile->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $profile = $profile['data'] ?? null;
        $request=request()->input();
        $orders = $this->apiService->getAssociateOrders($request);

        $orders = $orders['data'] ?? [];

//        return $orders;

        return view('associate.pages.orders.index', compact('orders', 'profile'));
    }

    public function paymentLinkSent(){
        return view('associate.pages.orders.success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function sendPaymentLink()
    {
        $this->apiService->sendPaymentLink(request()->input());

        return redirect(url('associate/payment-link'));
    }
}
