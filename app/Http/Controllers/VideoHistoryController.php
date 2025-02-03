<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;

class VideoHistoryController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * VideoController constructor.
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
        $response = $this->apiService->getVideoHistories(request()->input());

        $response = $response['data'] ?? null;

        return response()->json($response);
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

       //info($request->all());
       $user = $this->apiService->getProfile();
       if($user){
         
       $logs=$this->apiService->postStudentLogs([
           'user_id'=>$user['data']['id'],
           'package_id'=>$request->package_id,
           'video_id'=>$request->video_id,

           'ip_address'=>request()->ip(),
           'browser'=>$request->browser_agent,
           'log_type'=>4,
           'session_token'=>session()->get('access_token')
       ]);
   }
    $response = $this->apiService->postVideoHistory(request()->input());

        return $response['data'] ?? null;
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

    public function getRemainingDuration()
    {
        $response = $this->apiService->getRemainingDuration(request()->input());
        $response = $response['data'] ?? null;

        return response()->json($response);
    }

    public function getFreemiumRemainingDuration()
    {
        $response = $this->apiService->getFreemiumRemainingDuration(request()->input());
        $response = $response['data'] ?? null;

        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function freemium_index()
    {
        $response = $this->apiService->getVideoHistories(request()->input());

        $response = $response['data'] ?? null;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function freemium_store(Request $request)
    {
        $user = $this->apiService->getProfile();
        if($user){
            /*$logs = $this->apiService->postStudentLogs([
                'user_id'=>$user['data']['id'],
                'package_id'=>$request->package_id,
                'video_id'=>$request->video_id,
                'ip_address'=>request()->ip(),
                'browser'=>$request->browser_agent,
                'log_type'=>4,
                'session_token'=>session()->get('access_token')
            ]);*/
        }
        $response = $this->apiService->postFreemiumVideoHistory(request()->input());
        return $response['data'] ?? null;
    }
}
