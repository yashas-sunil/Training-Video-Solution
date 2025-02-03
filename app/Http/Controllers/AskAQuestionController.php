<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;

class AskAQuestionController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "hi";exit;
        $params = array_merge(['subject' => $request->subject, 'recent' => $request->recently_viewed, 'professor' =>
            $request->professor]);

        $response = $this->apiService->getAskAQuestions($params);

        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;

        if ($response->clientError()) {
            return redirect('/');
        }

        $subjects = $this->apiService->getPurchasedSubjects();
        $subjects = $subjects['data'];

       /** Modified by TE- On 24 MAy 2022 */
        if($request->subject){ 
            $data=array('subject_id'=>$request->subject);
            $professors = $this->apiService->getProfessorsBySubject($data);
        }
        else{
            $professors = $this->apiService->getProfessors();
        }
        /***End modification***/
        $professors = $professors['data'] ?? [];

        $questions = $response['data'];

//        return $questions;

        SEOMeta::setTitle("Ask a Question | JK Shah Online");

        return view('pages.ask-a-question.index', compact('questions',
            'user',
            'subjects',
            'professors'));
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
        $response = $this->apiService->postQuestion($request->input());

        if ($response->clientError()) {
            abort(500);
        }

        return $response['data'];
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
        $response = $this->apiService->deleteQuestion($id);

        if ($response->clientError()) {
            abort(500);
        }

        return $id;
    }
}
