<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiService;

class ProfileController extends Controller
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
    public function index()
    {
        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;

        $packages = $this->apiService->getAllPackages(['professor' => $professor['id'], 'limit' => 3, 'in_random' => true]);

        $packages = $packages['data'] ?? null;

        return view('professor.pages.profile.index', compact('professor', 'packages'));
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
        $response = $this->apiService->postProfessorProfile($request->file('image'));

        if ($error = $this->handleApiError($response)) {
            return $error;
        }

        return back()->with('success', 'Profile successfully updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = $this->apiService->getPackage($id);
        $package = $package['data'];
        $packages = $this->apiService->getFullPackages();

        $packages = $packages['data'] ?? [];

        $miniPackages = $this->apiService->getMiniPackages();
        $miniPackages = $miniPackages['data'] ?? [];

        $orderItem = $this->apiService->getOrderItem(['package_id' => $id]);
        $orderItem = $orderItem['data'] ?? null;

        return view('professor.pages.profile.packages', compact('package', 'packages', 'miniPackages', 'orderItem'));
    }

    public function watchVideo($id)
    {
        $video = $this->apiService->getVideo($id, request()->input());
        $video = $video['data'] ?? null;

        $package = $this->apiService->getPackage(request('package'));
        $package = $package['data']['name'] ?? null;


        return view('professor.pages.profile.watch_videos',compact('video', 'package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
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
        $response = $this->apiService->putProfessorProfile($id, $request->input());

        if ($error = $this->handleApiError($response)) {
            return $error;
        }

        return back()->with('success', 'Profile successfully updated');
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
    public function changePassword(Request $request, $id)
    {
        $professor = $this->apiService->changeProfessorPassword($id, $request->input());

        return redirect()->back()->with('message', 'Password changed successfully');
    }
}
