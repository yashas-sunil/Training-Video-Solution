<?php

namespace App\Http\Controllers;

use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use App\Models\Quiz\Event;
use DateTime;
use Session;

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
    public function index($data=false)
     {
        if($data == 'onine_jk_shah')
        {
            $flag = true;

        }else{
            $flag = false;
        }
        $sections = $this->apiService->getSections();
        $sections = $sections['data'] ?? [];

        $levels = $this->apiService->getLevels();
        $levels = $levels['data'] ?? [];


        // $fullPackages = [];
        // foreach ($levels as $level){
        //     $allPackages = $this->apiService->getPackagesToHomePage(['limit' => 11, 'in_random' => true, 'level' => $level['id']]);
        //     $allPackages = $allPackages['data'] ?? [];
        //     array_push($fullPackages, $allPackages);
        // }



//        return $sectionPackages;

        

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
        $testimonials = $this->apiService->getTestimonials();
        $testimonials = $testimonials['data'] ?? [];

        $admin_url = env('BASE_ADMIN_URL').'/home_page_count.txt';
        $file_data = file_get_contents($admin_url) ?? null;
        // $file_data =null;

//        $testimonials = $this->apiService->getTestimonials();
//        $testimonials = $testimonials['data'] ?? [];

//        $user = $this->apiService->getProfile();
//        $user = $user['data'] ?? null;

//        $event = Event::all();

        SEOMeta::setTitle("CA Intermediate - Professional CA Online Coaching Classes In Mumbai | JK Shah Online");
        SEOMeta::setDescription("JK Shah is India's No.1 Commerce & CA online classes. We provide coaching for CA Inter, CA Foundation, CS and Junior college with updated study material.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/");

        return view('pages.home', compact('levels','professors', 'banners', 'courses', 'sections','testimonials','file_data','flag'));
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
        if(env('VERANDA_VERASITY_RULEBOOK_SHOW')){
            $agreeTnC = $this->apiService->getCheckaAgreeTnC();
            $agreeTnC = $agreeTnC['data'];
        }else{
            $agreeTnC['show_popup'] = 0;
        }
//        return view('pages.student-dashboards.index', compact('user', 'courseDetails'));

        return view('pages.student-dashboards.index', compact('user', 'courseDetails', 'orderItems', 'studyMaterials','agreeTnC'));
    }
    public function testimonials()
    {
        return view('testimonials');
    }
    public function getLastTransaction()
    {
        if( Session::get('noPopup')=='yes'){
            $ar = '';
            return response()->json($ar);

        }
        $lastTransaction = $this->apiService->getLatestTransaction();

        $data = $lastTransaction['data'];
        foreach ($data as $row) {
			$fname=explode(" ",$row['name']);
            $array['name'] = $fname[0];
            $array['id'] = $row['order_items'][0]['package']['id'];
            $array['package_name'] = $row['order_items'][0]['package']['name'];

            $image_url = $row['order_items'][0]['package']['image_url'];
            $array['image_url'] = ' <img src="' . $image_url . '" loading="lazy" alt="">';

            $array['country'] = $row['student']['state']['name'] . ',' . $row['student']['country']['name'];
            $array['time'] = $this->getTime($row['updated_at']);

            $ar[] = $array;
        }
        return response()->json($ar);
        // echo "<pre>";
        // print_r($ar);
    }

    function getTime($date)
    {

        $post_date = strtotime($date);
        $delta = time() - $post_date;
        if ($delta < 60) {
            return 'Just Now';
        } elseif ($delta > 60 && $delta < 120) {
            return '1 minute ago';
        } elseif ($delta > 120 && $delta < (60 * 60)) {
            return  strval(round(($delta / 60), 0)) . ' minutes ago';
        } elseif ($delta > (60 * 60) && $delta < (120 * 60)) {
            return 'About an hour ago';
        } elseif ($delta > (120 * 60) && $delta < (24 * 60 * 60)) {
            return strval(round(($delta / 3600), 0)) . ' hour(s) ago';
        } else {
            $date1 = new DateTime($date);
            $date2 = date("Y-m-d");
            $date3 = new DateTime($date2);
            $interval = $date1->diff($date3);

            return  $interval->days . " day(s) ago ";
        }
    }
    public function blockpopup(){
        Session::put('noPopup', 'yes');
    }

    public function getPopularCourses(){
        $response = $this->apiService->getWishListUserPackageIds();
        $wishlist = $response['data'] ?? [];

        $sections = $this->apiService->getSections();
        $sections = $sections['data'] ?? [];
        $sectionPackages = [];
        foreach ($sections as $section){
            $allSectionPackages = $this->apiService->getSectionPackagesToHomePage(['section_id' => $section['id']]);
            $allSectionPackages = $allSectionPackages['data'] ?? [];
            array_push($sectionPackages, $allSectionPackages);
        }

        return view('pages.packages.popular_courses', compact('sections', 'sectionPackages', 'wishlist'));
    }
    public function redirecthome($data){
           $data = base64_decode($data);
           return $this->index($data);
       }
       public function sendotp(Request $request){
        
       $response=$this->apiService->sentotp(['mobile'=> request()->input('mobile'),'email'=>request()->input('email'), 'action'=>request()->input('action'), 'token'=>request()->input('token') ,'name'=>request()->input('name')]);

       $array['data']=$response['data'];
       return response()->json($array);

       }

    public function savescreenshot(Request $request){
    
        $file = $request->image;
        $png_url = "user-".time().".png";
        $path = "screenshots/".$png_url;
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
        file_put_contents($path, $image);
        Session::put('image_captured',$png_url);
        $data = ['image' => $png_url];
        //$response = $this->apiService->saveScreenshot(['image'=> $png_url]);
        //info($response);
        $ar['image'] = $png_url;
        return response()->json($ar);

    }

    public function save_tech_support(Request $request){
        $screen = Session::get('image_captured');
        $attachments = array();
        $attachments[] = $screen;
        $req['description']= $request->description;
        if($request->hasfile('attachments'))
        {
            foreach($request->file('attachments') as $file)
            {
                $name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/screenshots/', $name);  
                array_push($attachments,$name);
            }
        }
        $req['attached_files']=$attachments;
        $req['pageorcourse']= $request->pageorcourse;
        $response = $this->apiService->saveScreenshot($req);
        return response()->json($response);
        //return redirect()->back()->with('q_success', 'Your query submitted successfully');
    }

    public function agreeTnCofVerandaVarsity(Request $request){

        $agreeTnC = $this->apiService->agreeTnCofVerandaVarsity([
            'agreeTnC' => $request->input('agreeTnC'),
        ]);

        $agreeTnC = $agreeTnC['data'] ?? [];
        if(isset($agreeTnC['id']) || $agreeTnC['exist']){
            return redirect()->back();
        }
    }
}
