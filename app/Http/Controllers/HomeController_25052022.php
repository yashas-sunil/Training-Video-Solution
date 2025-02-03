<?php

namespace App\Http\Controllers;

use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use App\Models\Quiz\Event;

class HomeController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * Create a new controller instance.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $levels = $this->apiService->getLevels();
        $levels = $levels['data'] ?? [];

        $sections = $this->apiService->getSections();
        $sections = $sections['data'] ?? [];

        $fullPackages = [];
        foreach ($levels as $level){
            $allPackages = $this->apiService->getPackagesToHomePage(['limit' => 11, 'in_random' => true, 'level' => $level['id']]);
            $allPackages = $allPackages['data'] ?? [];
            array_push($fullPackages, $allPackages);
        }

//        return $fullPackages;

        $sectionPackages = [];
        foreach ($sections as $section){
            $allSectionPackages = $this->apiService->getSectionPackagesToHomePage(['section_id' => $section['id']]);
            $allSectionPackages = $allSectionPackages['data'] ?? [];
            array_push($sectionPackages, $allSectionPackages);
        }


//        return $sectionPackages;

        $response = $this->apiService->getWishListUserPackageIds();
        $wishlist = $response['data'] ?? [];

//        return $wishlist;


//        return $fullPackages;
//
//        $miniPackages = $this->apiService->getMiniPackages(['limit' => 11]);
//        $miniPackages = $miniPackages['data'] ?? [];
//
//        $crashCourses = $this->apiService->getCrashCourses(['limit' => 11]);
//        $crashCourses = $crashCourses['data'] ?? [];

//        $preBookCourses = $this->apiService->getPreBookCourses(['limit' => 11]);
//        $preBookCourses = $preBookCourses['data'] ?? [];

        $professors = $this->apiService->getProfessors(['is_published' => true]);
        $professors = $professors['data'];

        $banners = $this->apiService->getBanners();
        $banners = $banners['data'] ?? [];

        $courses = $this->apiService->getCourses();

//        $testimonials = $this->apiService->getTestimonials();
//        $testimonials = $testimonials['data'] ?? [];

//        $user = $this->apiService->getProfile();
//        $user = $user['data'] ?? null;

//        $event = Event::all();

        SEOMeta::setTitle("CA Intermediate - Professional CA Online Coaching Classes In Mumbai | JK Shah Online");
        SEOMeta::setDescription("JK Shah is India's No.1 Commerce & CA online classes. We provide coaching for CA Inter, CA Foundation, CS and Junior college with updated study material.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/");

        return view('pages.home', compact('levels','fullPackages','professors', 'banners', 'wishlist', 'courses', 'sections', 'sectionPackages'));
    }

    public function closeNotification()
    {
        $notificationID = request()->input('notification_id');
        Cookie::queue(Cookie::forever('notification_' . $notificationID, 'true'));
    }

    public function studentDashbaord(Request $request)
    {
        $params = array_merge($request->all());

        $response =  $this->apiService->getProfile();
        $user = $response['data'] ?? null;

        $response =  $this->apiService->getCourseDetails();
        $courseDetails = $response['data'] ?? null;

//        return $courseDetails;

        $response = $this->apiService->getDashboardPurchasedPackage($params);
        $orderItems = $response['data'] ?? [];

        $params = array_merge(['type' => 2]);

        $studyMaterials = $this->apiService->dashboardStudyPlans($params);

//        return $studyMaterials;

        $studyMaterials = $studyMaterials['data'];


//        return view('pages.student-dashboards.index', compact('user', 'courseDetails'));

        return view('pages.student-dashboards.index', compact('user', 'courseDetails', 'orderItems', 'studyMaterials'));
    }
}
