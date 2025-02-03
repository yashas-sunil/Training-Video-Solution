<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;

class QuizController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * QuizController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }

    public function index() {
        $user =  $this->apiService->getProfile();

        return view('pages.quiz.index', compact('user'));
    }
}
