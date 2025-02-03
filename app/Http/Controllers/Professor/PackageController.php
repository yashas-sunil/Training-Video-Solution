<?php

namespace App\Http\Controllers\Professor;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
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

        $professor = $this->apiService->getProfessorProfile();

        $professor = $professor['data']['professor'] ?? null;
        $request=request()->input();

        $request['professor_id'] = $professor['id'];

        $reponse = $this->apiService->getProfessorPackages($request);


        $packages = $reponse['data']['professor_packages'];

        return view('professor.pages.packages.index', compact('packages'),['professor' => $professor]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
