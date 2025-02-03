<?php

namespace App\Http\Controllers\Professor;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * ProfileController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $portal = Session::get('answerportal');
        $url = Session::get('portalurl');
        if(isset($portal)){
            return redirect($url);
        }
        $professor = $this->apiService->getProfessorProfile();
        $professor = $professor['data']['professor'] ?? null;

        $dashboard = $this->apiService->getProfessorDashboard([
            'professor_id' => $professor['id']
        ]);
        $dashboard = $dashboard['data'] ?? null;

        return view('professor.pages.dashboard.index', compact('professor', 'dashboard'));
    }
}
