<?php

namespace App\Http\Controllers\Mobile;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * PackageController constructor.
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
        $courses = $this->apiService->getCourses();
        $courses = $courses['data'] ?? [];

        if (!empty($request->input('course'))) {
            $levels = $this->apiService->getLevels(['course_id' => $request->input('course')]);
            $levels = $levels['data'] ?? [];
        }

        $levels = $levels ?? [];

        if (!empty($request->input('course')) && !empty($request->input('level'))) {
            $subjects = $this->apiService->getSubjects([
                'course' => $request->input('course'),
                'level' => $request->input('level')
            ]);

            $subjects = $subjects['data'] ?? [];
        }

        $subjects = $subjects ?? [];

        if (!empty($request->input('course')) && !empty($request->input('level')) && !empty($request->input('subject'))) {
            $chapters = $this->apiService->getChapters([
                'course' => $request->input('course'),
                'level' => $request->input('level'),
                'subject' => $request->input('subject')
            ]);

            $chapters = $chapters['data'] ?? [];
        }

        $chapters = $chapters ?? [];

        $packages = $this->apiService->getFilteredPackages([
            'type' => 'full',
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'subject' => $request->input('subject'),
            'chapter' => $request->input('chapter'),
            'professor' => $request->input('professor')
        ]);

        $packages = $packages['data'] ?? [];

        $miniPackages = $this->apiService->getFilteredPackages([
            'type' => 'mini',
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'subject' => $request->input('subject'),
            'chapter' => $request->input('chapter'),
            'professor' => $request->input('professor')
        ]);

        $miniPackages = $miniPackages['data'] ?? [];

        $crashCourses = $this->apiService->getFilteredPackages([
            'type' => 'crash',
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'subject' => $request->input('subject'),
            'chapter' => $request->input('chapter'),
            'professor' => $request->input('professor')
        ]);

        $crashCourses = $crashCourses['data'] ?? [];

        $response = $this->apiService->getProfessors();
        $professors = $response['data'];

        if($request->package_type=='mini'){
            $tab = 1;
        }
        else if($request->package_type=='crash'){
            $tab = 2;
        }
        else{
            $tab = 0;
        }

        return view('mobile.pages.packages.index', compact('courses', 'levels', 'subjects','chapters', 'packages', 'miniPackages', 'professors','tab'));
    }

    public function show($id)
    {
        $package = $this->apiService->getPackage($id);
        $package = $package['data'];

        $packages = $this->apiService->getFullPackages();

        $packages = $packages['data'] ?? [];

        $miniPackages = $this->apiService->getMiniPackages();
        $miniPackages = $miniPackages['data'] ?? [];

        $orderItem = $this->apiService->getOrderItem(['package_id' => $id]);
        $orderItem = $orderItem['data'] ?? null;

        return view('mobile.pages.packages.show', compact('package', 'packages', 'miniPackages', 'orderItem'));

    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('mobile.pages.register.success');
    }
}
