<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;

class ProfessorNoteController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * ProfessorNoteController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $params = array_merge($request->all());

        $response =  $this->apiService->getProfessorNotes($params);

        $user =  $this->apiService->getProfile();

        $user =  $user['data'] ?? null;

        if ($response->clientError()) {
            return redirect('/');
        }

        $professorNotes = $response['data'];

        $chapters = $this->apiService->getPurchasedChapters();
        $chapters = $chapters['data'];

        $subjects = $this->apiService->getPurchasedSubjects();
        $subjects = $subjects['data'];

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];

        SEOMeta::setTitle("Professor Notes | JK Shah Online");

        return view('pages.notes.index', compact(
            'professorNotes',
            'user',
            'chapters',
            'subjects',
            'languages'));
    }
}
