<?php

namespace App\Http\Controllers\Professor;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /**
     * ProfileController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }
    public function index(Request  $request)
    {
        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $professor = $professor['data']['professor'] ?? null;

        $videos = $this->apiService->getProfessorVideos($request->all());

        $videos = $videos['data'];

        return view('professor.pages.notes.index', compact('professor', 'videos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $professor = $this->apiService->getProfessorProfile();

        if ($professor->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $video = $this->apiService->showProfessorVideos(['id' => $id]);

        $video = $video['data'];

        $professor_notes = $this->apiService->getProfessorVideoNotes(['id' => $video['id']]);

        $professor_notes = $professor_notes['data'] ? $professor_notes['data'] : [];

        return view('professor.pages.notes.create',compact('video','professor_notes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->apiService->postProfessorNote($request->input());

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
    public function update(Request $request)
    {
        $response = $this->apiService->updateProfessorNote($request->input());

        if ($response->clientError()) {
            abort(500);
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $response = $this->apiService->deleteProfessorNote($request->input());

        if ($response->clientError()) {
            abort(500);
        }

        return $response;
    }
}
