<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Support\Facades\Session;

class ThaneVaibhavRegController extends Controller
{

    /** @var ApiService $apiService */
    private $apiService;

    /**
     * CallRequestController constructor.
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
        //info(request()->all());
        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid captcha',
            ]);
        }
        $response = $this->apiService->thaneVaibhavReg($request->input());
        return $response;
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
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
    public function verifyMobReg(Request $request)
    {
        $response = $this->apiService->verifyMObileVaibhav($request->input());
        return $response;
    }

    public function validateEmail()
    {
        $response = $this->apiService->validateScholarEmail(request()->input());

        return $response ?? null;
    }

    public function validatePhone()
    {
        $response = $this->apiService->validateScholarPhone(request()->input());

        return $response ?? null;
    }

    public function thankyou()
    {

        return view('pages.cms.thankyou');
    }

   
}
