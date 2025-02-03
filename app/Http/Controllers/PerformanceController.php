<?php

namespace App\Http\Controllers;

use App\ApiService;
use Illuminate\Http\Request;

class PerformanceController extends Controller
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

    public function index()
    {
        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;

        return view('pages.performances.index', compact('user'));
    }


}
