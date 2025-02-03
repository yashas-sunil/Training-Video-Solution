<?php

namespace App\Http\Controllers\Professor;

use App\ApiService;
use App\Http\Controllers\Controller;
use App\ProfessorRevenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessorRevenueController extends Controller
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
        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;

        $request=request()->input();
        $request['professor_id'] = $professor['id'];

        $response = $this->apiService->getProfessorRevenue($request);

        $professor_revenues=$response['data'];

        return view('professor.pages.revenues.index', compact('professor_revenues', 'professor'));
    }
}
