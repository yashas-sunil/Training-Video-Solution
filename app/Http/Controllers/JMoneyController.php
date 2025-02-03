<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;

class JMoneyController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * JMoneyController constructor.
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
        $user = $this->apiService->getProfile();

        $user = $user['data'] ?? null;

        $response = $this->apiService->getJMoney();

        $jMoneys = $response['data']['jMoney'] ?? [];

        $spinWheelRewards = $response['data']['spinWheelRewards'];


        SEOMeta::setTitle("J-Koins | JK Shah Online");

        
        $usedJkoins=$this->apiService->getUsedJMoney();
        $usedJkoins= $usedJkoins['data'] ;
        $rewards= $this->apiService->rewardPoints();
        $jkoins=$rewards['data'];
        return view('pages.j-money.index', compact('user', 'jMoneys', 'spinWheelRewards','usedJkoins','jkoins'));

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
