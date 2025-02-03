<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;

class TempCampaignPointController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * TempCampaignPointController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function store(Request $request)
    {
        $response = $this->apiService->postTempCampaignPoints($request->input());
        $response = $response['data'];

        return response()->json($response);
    }
    public function campaignRegister(Request $request)
    {
        $response = $this->apiService->postTempCampaignRegister($request->input());
        $response = $response['data'];

        return response()->json($response);
    }

    public function getRemainingChances()
    {
        $response = $this->apiService->getSpinWheelCampaignRemainingChances(request()->input());
        $response = $response['data'];

        return response()->json($response);
    }
}
