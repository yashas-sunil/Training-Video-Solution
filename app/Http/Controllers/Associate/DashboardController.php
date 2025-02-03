<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /** @var ApiService */
    var $apiService;

    /**
     * ProfileController constructor.
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

        $response = $this->apiService->getAssociateTotalOrders();

        $total_orders=$response['data']['total_orders'];
        $total_commission=$response['data']['total_commission'];
        $student=$response['data']['student'];

        $totalPendingCommission = $response['data']['total_pending_commission'];

        return view('associate.pages.dashboard.index',['total_orders' => $total_orders,'total_commission' => $total_commission,'student' => $student, 'totalPendingCommission' => $totalPendingCommission, 'profile' => $profile]);
    }
}
