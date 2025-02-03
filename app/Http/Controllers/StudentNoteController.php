<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;

class StudentNoteController extends Controller
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
        $params = array_merge($request->all());

        $studentNotes = $this->apiService->getStudentNotes($params);

        $user =  $this->apiService->getProfile();

        $user =  $user['data'] ?? null;

        if ($studentNotes->clientError()) {
            return redirect('/');
        }

        $studentNotes = $studentNotes['data'];
        
        $studentNotes = new Collection($studentNotes);

        $studentNotes = $studentNotes->groupBy('video_id');
        $chapters = $this->apiService->getPurchasedChapters();
        $chapters = $chapters['data'];

        $subjects = $this->apiService->getPurchasedSubjects();
        $subjects = $subjects['data'];

        $courses = $this->apiService->getCourses();
        $courses = $courses['data'] ?? [];

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];


//        return $studentNotes;

        SEOMeta::setTitle("My Notes | JK Shah Online");

        return view('pages.student-notes.index', compact(
            'studentNotes',
            'user',
            'chapters',
            'subjects',
            'courses',
            'languages'));
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
        $response = $this->apiService->postStudentNote($request->input());

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
        $response = $this->apiService->deleteStudentNote($id);

        if ($response->clientError()) {
            abort(500);
        }

        return $id;
    }
}
