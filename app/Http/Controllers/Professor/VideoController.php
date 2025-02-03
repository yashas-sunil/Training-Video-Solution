<?php

namespace App\Http\Controllers\Professor;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $package_id = $request->input('package_id');
        $professor_id = $request->input('professor_id');
        $response = $this->apiService->getProfessorProfile();
        $professor = $response['data']['professor'] ?? null;

        $response = $this->apiService->getPackage(request()->input('package_id'));
        $package = $response['data'] ?? null;

        $response = $this->apiService->getProfessorPackageVideos(request()->input());

//        return $response;

        $videos = $response['data'] ?? [];

        return view('professor.pages.videos.index', compact('professor', 'videos', 'package','package_id','professor_id'));
    }
}
