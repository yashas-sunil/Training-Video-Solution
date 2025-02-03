<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;

class ForgotPasswordController extends Controller
{
    /** @var ApiService */
    var $apiService;

    /**
     * ForgotPasswordController constructor.
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
        return view('pages.auth.forgot-password');
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
        $response = $this->apiService->postForgotPassword($request->input());

        $response = $response['data'] ?? null;

        $email = null;
        $exist = false;

        if ($response['email_exist']) {
            
            $email = $request->input('email');
            $exist = true;
            return redirect()->back()->with(['exist' => $exist, 'email' => $email]);
        }else{
            $testpress_response = $this->apiService->hasTestpress($request->input());
            if ($testpress_response->status() == 422) {
                $exist = false; 
                return redirect()->back()->with(['exist' => $exist, 'email' => $email]);
            }elseif($testpress_response->status() == 200){
                return redirect('https://lmsdemo.testpress.in/password/reset/');
            }else{
                $exist = false; 
                return redirect()->back()->with(['exist' => $exist, 'email' => $email]);
            }
        }
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

    public function fp_copy()
    {
        return view('pages.auth.forgot-pwd_copy');
    }
}
