<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiService;

class SpinWheelController extends Controller
{
    var $apiService;

    /**
     * SpinWheelController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function show($slug)
    {
        $response = $this->apiService->getSpinWheelCampaign($slug);

        if ($response->status() == '404') {
            abort(404);
        }

        $spinWheel = $response['data'] ?? null;


        return view('pages.campaigns.spin-wheels.show', compact('spinWheel'));
    }

    public function calculatePrice()
    {
        $response = $this->apiService->getSpinWheelPrize(request()->input('campaign_id'));
        $response = $response['data'] ?? null;

        if((request()->input('respin')) == 1){
            $debit = $this->apiService->debitJkoin(['campaign_id'=>request()->input('campaign_id')]);
            $debit=$debit['data'] ?? null;
            if($debit==true){
                return response()->json($response); 
            }
            else{
                return response()->json(false);
            }
        }
        return response()->json($response);
    }
}
