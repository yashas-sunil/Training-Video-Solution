<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiService;

class QuestionController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * AnswerController constructor.
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
        $questions = $this->apiService->getProfessorQuestions(request('questions'));
        $question_id='';
     if(request('question_id')){
        $question_id=request('question_id');

     }

        if ($questions->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $questions = $questions['data'] ?? [];

        $answers = $this->apiService->getProfessorAnswers(request('answers'));

        if ($answers->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $answers = $answers['data'] ?? [];

        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;

       // return view('professor.pages.questions.index', compact('questions', 'answers', 'professor'));
        return view('professor.pages.questions.pending_question', compact('questions', 'answers', 'professor','question_id'));
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
        $question = $this->apiService->getProfessorQuestion($id);

        if ($question->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $question = $question['data'] ?? null;

        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;

        return view('professor.pages.questions.show', compact('question', 'professor'));
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
    public function pending_question(){
        $questions = $this->apiService->getProfessorQuestions(request('questions'));

        if ($questions->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $questions = $questions['data'] ?? [];

        $answers = $this->apiService->getProfessorAnswers(request('answers'));

        if ($answers->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $answers = $answers['data'] ?? [];

        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;
//dd($questions);
        return view('professor.pages.questions.pending_question', compact('questions', 'answers', 'professor'));
    }

    public function answerd_question(){
        $questions = $this->apiService->getProfessorQuestions(request('questions'));

        if ($questions->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $questions = $questions['data'] ?? [];

        $answers = $this->apiService->getProfessorAnswers(request('answers'));

        if ($answers->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $answers = $answers['data'] ?? [];

        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;
//dd($questions);
        return view('professor.pages.questions.answer_question', compact('questions', 'answers', 'professor'));
    }
    public function get_question_details()
    {
      
        $response = $this->apiService->get_question_details(['question'=>request()->input('question')]);
        $response = $response['data'] ?? [];
        $question = nl2br(strip_tags(@$response['question']));

        return response()->json($question);
    }
    public function get_question_answer()
    {
      
        $response = $this->apiService->get_question_answer(['answer'=>request()->input('answer')]);
        $response = $response['data'] ?? [];
        $question = nl2br(strip_tags(@$response['answer']));

        return response()->json($question);
    }
}
