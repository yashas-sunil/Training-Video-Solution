<?php

namespace App\Http\Controllers\Professor;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
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
        $professor = $this->apiService->getProfessorProfile();
        $professor = $professor['data']['professor'] ?? null;

        $request = request()->input();
        $request['professor_id'] = $professor['id'];

        $orderItems = $this->apiService->getProfessorReports($request);
        $orderItems = $orderItems['data'] ?? [];

        return view('professor.pages.reports.index', compact('professor', 'orderItems'));
    }
}
