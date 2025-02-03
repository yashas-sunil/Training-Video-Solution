<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;

class AddressController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * AddressController constructor.
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
        //
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
        $this->apiService->postAddresses($request->input());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        if (request()->ajax()) {
            $response = $this->apiService->getAddress($id);
            $response = $response['data'] ?? null;

            return response()->json($response, 200);
        }
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
        $this->apiService->putAddress($id, $request->input());

        if (request()->ajax()) {
            $response = $this->apiService->putAddress($id, $request->input());
            $response = $response['data'];

            return response()->json($response, 200);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->apiService->deleteAddress($id);

        if ($response->clientError()) {
            abort(500);
        }

        return $id;
    }
}
