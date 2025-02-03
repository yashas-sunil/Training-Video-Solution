<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;

class CampaignRegistrationController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * CampaignRegistrationController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function store(Request $request)
    {
        $response = $this->apiService->postCampaignRegistration($request->input());

        $response = $response['data'] ?? null;

        session()->put('campaign_registration_id', $response['id']);

        return back();
    }

    public function validatePhone()
    {
        $response = $this->apiService->validateCampaignRegistrationPhone(request()->input());

        return $response ?? null;
    }

    public function validateOTP()
    {
        $response = $this->apiService->validateCampaignRegistrationOTP(request()->input());

        return $response;
    }
}
