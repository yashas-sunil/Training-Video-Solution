<?php

namespace App\Http\Controllers;

use App\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnswerPortalController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * AnswerPortalController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $question_id=$request->input('question_id');
        $url = '/professor/questions?questions=1&answers=1&question_id='.$question_id;
        Session::put('portalurl',$url);
        Session::put('answerportal',1);
        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        $response = $this->apiService->getAnswerPortal($request->input());
        $question = $response['data'];
        if(!isset($user_json->data)){
            return redirect('/?login=true');
        }else{
            if($user_json->data->role==6){
                if($user_json->data->id != $question['prof']['id']){
                    request()->session()->forget('access_token');
                    echo "<script>";
                    echo "alert('You are not authorized to access this.');";
                    echo "window.location.href='/'";
                    echo "</script>";
                    //return redirect('/');
                }
            }else{
                //abort(401);
                request()->session()->forget('access_token');
                //return redirect('/');
                echo "<script>";
                echo "alert('You are not authorized to access this.');";
                echo "window.location.href='/'";
                echo "</script>";
            }
        }
        
        return redirect('/professor/questions?questions=1&answers=1&question_id='.$question_id);
        //return view('pages.answer-portal.index', compact('question'));
    }

    public function store(Request $request)
    {  
        $this->apiService->postAnswerPortal($request->input());
        Session::forget('portalurl');
        Session::forget('answerportal');
        return back()->with(['success' => 'Answer successfully saved.']);
    }
}
