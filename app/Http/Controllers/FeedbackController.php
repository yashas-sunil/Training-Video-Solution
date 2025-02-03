<?php

namespace App\Http\Controllers;

use App\ApiService;
use http\Env\Response;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * AskAQuestionController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }

    public function store(Request $request)
    {

        $request->validate([
            'rating_comment' => 'required',
        ]);

        $response = $this->apiService->postFeedback($request->input());

        if ($response->clientError()) {
            abort(500);
        }

        $orderItem =  $response['data']['id'];
        $package = $response['data']['package_id'];

        return redirect('/contents');
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
