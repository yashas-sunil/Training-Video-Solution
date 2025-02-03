<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Support\Arr;
use Artesaos\SEOTools\Facades\SEOMeta;

class StudyMaterialController extends Controller
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
    public function index(Request  $request)
    {

        $params = array_merge(['type' => 1], $request->all());


//        $study_materials = $this->apiService->filterStudyMaterials($params);
//
//        $study_materials = $study_materials['data'];

        $studyMaterials = $this->apiService->getPackageStudyMaterials($params);

        $studyMaterials = $studyMaterials['data'];

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];

        $chapters = $this->apiService->getPurchasedChapters(['type' => 1]);
        $chapters = $chapters['data'];

        $subjects = $this->apiService->getPurchasedSubjects(['type' => 1]);
        $subjects = $subjects['data'];

        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;

        $professors = $this->apiService->getProfessors();
        $professors = $professors['data'];

        $courses = $this->apiService->getCourses();
        $courses = $courses['data'] ?? [];

        SEOMeta::setTitle("Study Materials | JK Shah Online");

        return view('pages.study-materials.index', Compact(
            'user',
            'studyMaterials',
            'chapters',
            'subjects',
            'languages',
            'professors',
            'courses'));
    }

    public function studyPlans(Request  $request){

        $params = array_merge(['type' => 2], $request->all());

        $studyMaterials = $this->apiService->getPackageStudyMaterials($params);

        $studyMaterials = $studyMaterials['data'];

//        return $studyMaterials;

//       foreach ($studyMaterials as $studyMaterial){
//         return  $studyMaterial['package']['package_study_materials'][0];
//       }

//        $study_materials = $this->apiService->filterStudyMaterials($params);

        $chapters = $this->apiService->getPurchasedChapters(['type' => 2]);
        $chapters = $chapters['data'];

        $subjects = $this->apiService->getPurchasedSubjects(['type' => 2]);
        $subjects = $subjects['data'];

        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;


        $professors = $this->apiService->getProfessors();
        $professors = $professors['data'];

        $courses = $this->apiService->getCourses();
        $courses = $courses['data'] ?? [];

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];

        SEOMeta::setTitle("Study Plans | JK Shah Online");

        return view('pages.study-plans.index', Compact('user',
            'studyMaterials',
            'chapters',
            'subjects',
            'professors',
            'courses',
            'languages'));
    }

    public function testPapers(Request  $request){

        $params = array_merge(['type' => 3], $request->all());

//        $study_materials = $this->apiService->filterStudyMaterials($params);

        $studyMaterials = $this->apiService->getPackageStudyMaterials($params);

        $studyMaterials = $studyMaterials['data'];

//        return $studyMaterials;

        $chapters = $this->apiService->getPurchasedChapters(['type' => 3]);
        $chapters = $chapters['data'];

        $subjects = $this->apiService->getPurchasedSubjects(['type' => 3]);
        $subjects = $subjects['data'];

        $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;

        $professors = $this->apiService->getProfessors();
        $professors = $professors['data'];

        $courses = $this->apiService->getCourses();
        $courses = $courses['data'] ?? [];

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];

        SEOMeta::setTitle("Test Papers | JK Shah Online");

        return view('pages.test-papers.index', Compact(
            'user',
            'studyMaterials',
            'chapters',
            'subjects',
            'professors',
            'courses',
            'languages'));
    }

}
