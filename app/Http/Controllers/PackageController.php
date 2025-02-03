<?php

namespace App\Http\Controllers;

use App\PackageFeature;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

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
    public function loader(Request $request){
        $uuID = Session::get('cart_uuid');

        $uuID = str_replace('\"', '', $uuID);

        $response = $this->apiService->getCart(['uuid' => $uuID]);

        $cart = $response['data']['cart'];

        if (!empty($cart['items'])) {
                $items = $cart['items'];
                
                foreach ($items as $item) {
                    $cart_items[] = $item['id'];
                }
        } else {
            
            $cart_items[] = "";
        }
       
         $page = $request->filled('page') ? $request->input('page') : '1';
        $linked_packages_id = ($request->session()->get('linked_packagedata')) ?? [];
       
        $packages = $this->apiService->getPackageList([
            'search' => $request->input('search'),
            'course' => $request->input('course'),
            'price' => $request->input('price'),
            'professor' => $request->input('professor'),
           // 'level' => $request->input('level'),
            'levels' => $request->input('level_ids'),
            'languages' => $request->input('language_ids'),
            'subjects' => $request->input('subject_ids'),
            'chapters' => $request->input('chapter_ids'),
            'professors' => $request->input('professor_ids'),
            'linked_packages_id' => $linked_packages_id,
            'ratings' => $request->input('ratings'),
            'packagetypes' => $request->input('p_type_ids'),
            'offer' => $request->input('offer'),
            'limit' => 10,
            'page' => $page
        ]);
        $packages = $packages['data'] ?? [];
        $validPackages = $this->apiService->getValidPackages();
        $validPackages = $validPackages['data'];
        $wishlist = $this->apiService->getWishListUserPackageIds();
        $wishlist = $wishlist['data'] ?? [];
        $user_freemium = $this->apiService->getUserFreemiumPackageIds();
        $user_freemium = $user_freemium['data'] ?? [];
        // echo "<pre>" .PHP_EOL;print_r($user_freemium);die;
        $path = '/packages';
        $packages = new LengthAwarePaginator(
            $packages['data'],
            $packages['total'],
            $packages['per_page'],
            $packages['current_page'],
            $options = [
                'path' => $path
            ]
        );
       
        if ($request->ajax()) {
          

         
            
            if (count($packages) > 0) {

                foreach ($packages as $package) {
                    $href1 = url('packages/' . ($package['slug'] ?? $package['id']));
                    $title = $package['name'];
                    $img =  $package['image_url'] ?? asset('assets/images/placeholder.png');
                    $img_alt = $package['alt'];
                    $img_title = $package['title_tag'];
                    $href2 = url('packages/' . ($package['slug'] ?? $package['id']));
                   
                    $reviews = count($package['order_items']) > 0 ? count($package['order_items']) . ' Review(s)' : '&nbsp';
                    $cart = 'cart_' . $package['id'];
                    $data = '';
                    $data .= '<div class="container-list">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="course-image">
                                            <a href="' . $href1 . '" title="' . $title . '">
                                                <img src="' . $img . '" alt="' . $img_alt . '" title="' . $img_title . '">
                                            </a>';
                    if (!request()->session()->has('access_token')) {

                        $data .= '<div class="stage">
                                    <div class="heart buy-now-login" data-id="' . $package['id'] . '"></div>
                                </div>';                       
                    } else {
                        $pid = 'package_'.$package['id'];
                        if (in_array($package['id'], $wishlist)) {
                            $data .= '<div class="stage">
                                        <div class="heart cart-save-for-later is-active" data-id="' . $package['id'] . '" id="'.$pid .'"></div>
                                    </div>';
                        } else {
                            $data .= '<div class="stage">
                                        <div class="heart cart-save-for-later" data-id="' . $package['id'] . '" id="'.$pid .'"></div>
                                    </div>';
                        }
                    }
                    $data .= '</div></div>';
                    $data.= '<div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="course-details">
                                <h2>
                                    <a href="' . $href2 . '" title="' . $package['name'] . '">' . $package['name'] . '</a>
                                </h2>
                            <div class="enrolled">';

                    $max_count = 3;
                    $count = count($package['professors']);
                    $professors = $package['professors'];
                    $professors = collect($package['professors'])->take($max_count);

                    foreach ($professors as $professor) {
                        $img2 = $professor['image'] ?? asset('/assets/images/avatar.png');
                        $data .= '<img src="' . $img2 . '" title="' . $professor['name'] . '">';
                    }
                    if ($count > $max_count) {
                        $c = $count - $max_count;
                        $data .= '<span>+' . $c . '</span>';
                    }

                    $data .= '</div>
                                <h5>' . nl2br($package['description']) . '</h5>
                                <div class="ratings">';
                    if ($package['rating']) {

                        $data .= '<span>';

                        for ($i = 0; $i < round($package['average_rating']); $i++) {
                            $data .= '<i class="fa fa-star" aria-hidden="true"></i>';
                        }
                        $data .= '</span>';
                    }

                    $data .= '<p>' . $reviews . '</p></div>
                            <p class="language_display"><i class="fa fa-language" aria-hidden="true"></i>';

                    if ($package['language']['name'] == 'English') {
                        $data .= '<span class="english">' . $package['language']['name'] . '</span>';
                    } elseif ($package['language']['name'] == 'Hindi') {
                        $data .= '<span class="hindi">' . $package['language']['name'] . '</span>';
                    } else {
                        $data .= '<span class="both">' . $package['language']['name'] . '</span>';
                    }
                    $data .= ' | <span class="ml-0"><b>'.$package['packagetype']['name'].'</b></span></p> 
                            <p class="lecture">
                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                <span>' . $package['total_videos'] . '&nbspLectures</span>&nbsp|<span>' . $package['duration'] . '&nbspTimes Views</span>
                            </p>
                            <p class="time">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span>';
                    if (!$package['is_prebook'] || $package['is_prebook_package_launched'] || $package['is_prebook_content_ready']){
                        $data.='<small>';
                        if (@$package['total_duration_formatted']){
                            $data.= @$package['total_duration_formatted'];
                            if(@$package['bonus_duration_formatted']) {
                                $data.= '+'. @$package['bonus_duration_formatted'].' Bonus Hours';
                            }
                           
                        }else if(@$package['bonus_duration_formatted']){
                            $data.=  $package['bonus_duration_formatted'].' Bonus Hours';
                            }
                                    
                        $data.= '</small>';
                    }else{
                        $data.='<small>';
                        if ($package['prebook_total_duration']){
                            $data.=$package['prebook_total_duration'];
                        }
                        
                        $data.='</small>';
                    }
                    $valid_upto = $package['expiry_type'] =='1' ? $package['expiry_month'].' Months':($package['expiry_type']=='2' ? date('d M Y',strtotime($package['expire_at'])) :' 9 Months') ;
                    $data.=' </span>| <span class="ml-0">Valid Upto:&nbsp;&nbsp;<b>'.$valid_upto.' <b></b></span>';
                    $data.='</p>
                            <div class="price">
                                <h4>₹'.' '.number_format($package['selling_price'],2).'</h4>
                                <h6>';

                            if ($package['strike_prices']){
                                foreach ($package['strike_prices'] as $price){
                                    $data.='<del>₹'.' '.number_format($price,2).'</del>';
                                }
                            }
                    $data.='</h6>';
                    if($package['discount_percentage']!=0){
                        $data.='<span>'.$package['discount_percentage'].'%</span>';
                   
                    }
                    if($package['special_price']>0){
                        $data.= '<button  style="
                        background: #28a745;
                        border: 0;
                        border-radius: 10px;
                        color: #fff;
                        padding: 2px 10px;
                        font-size: 12px;
                        animation: blinker 3s linear infinite;
                        margin-left: 0.5rem;
                    ">J-Deals</button>';
                    }
                    if(!empty($package['total_duration'])){
                        if($package['total_duration'] == 0){
                            $rs_per_hr = $package['selling_price'];
                        }else{
                            $durationInSeconds = $package['total_duration'];
                            $durationInHour = $durationInSeconds / 3600;
                            $d = floor($durationInHour);
                            if($d != 0){
                                $rs_per_hr = $package['selling_price'] / $d;
                            }else{
                                $rs_per_hr = $package['selling_price'] / $durationInHour;
                            }  
                        }
                    }else{
                        $rs_per_hr = $package['selling_price'];
                    }
                    $data.='<span style="color: #7e7e7e;font-weight: 500;text-transform: none;font-size: 13px;">| &nbsp;₹'.' '.number_format($rs_per_hr,2).' '.'/ Hour</span>';
                    $data.='</div>';

                    $data.='<div class="course_enroll">';
                    if(!empty($cart_items)){
                        if(in_array($package['id'],$cart_items)){
                    
                            $data.='<button class="cart btn-add-to-cart" style="background-color: #999a9a;" id="'.$cart .'" data-id="'.$package['id'].'" disabled>Added to cart</button>';
                        }else{
                            if(in_array($package['id'],$validPackages)){
                                $data.='<button class="cart btn-add-to-cart" id="'.$cart.'" data-id="'.$package['id'].'" disabled style="background-color : #999a9a;">Add to cart</button>';
                            }else{
                                $data.='<button class="cart btn-add-to-cart" id="'.$cart.'" data-id="'.$package['id'].'">Add to cart</button>';
                            }
                        }
                    }
                    
                    if( $package['is_freemium'] === 1 ){
                        if(in_array($package['id'],$user_freemium )){
                            $data.='<button class="cart" style="background-color: #999a9a;" disabled>Start Trial</button>';
                        }else{
                            $data.='<button class="cart btn-start-free-trial"  data-id="'.$package['id'].'" data-percentage="'.$package['freemium_content'].'">Start Trial</button>';
                        }
                    }

                    if (! request()->session()->has('access_token')){
                        $data.='<button class="enroll buy-now-login" data-package="'. $package['id'].'">Enroll now</button>';
                    }
                  
                    $data.='</div><hr></div></div></div></div>';
                    $array[] = $data;
                }
               

            }else{
                $array = [];
            }
            return $array;

        }
    }

    public function index(Request $request)
    {

       // dd($request->input());
        $uuID = Session::get('cart_uuid');

        $uuID = str_replace('\"', '', $uuID);

        $response = $this->apiService->getCart(['uuid' => $uuID]);

        $cart = $response['data']['cart'];

        if (!empty($cart['items'])) {
                $items = $cart['items'];
                
                foreach ($items as $item) {
                    $cart_items[] = $item['id'];
                }
        } else {
            
            $cart_items[] = "";
        }

        $tab = $request->filled('tab') ? $request->input('tab') : 'all';
        $page = $request->filled('page') ? $request->input('page') : '1';

        if (empty($tab) && $request->filled('package_type')) {
            $tab = $request->input('package_type');
        }
        $chapter = null;
        $course = null;
        $course_id = null;
        $price_id = null;

        $levelofCousrses = [];
        if ($request->course) {
            $levelofCousrses = $this->apiService->getLevelByCourse($request->course);
            $levelofCousrses = $levelofCousrses['data'];
            $course = $this->apiService->getCourse($request->course);
            $course = $course['data'];
            $course_id = $request->input('course');
 }
        else if ($request->input('course_id')) {
            $levelofCousrses = $this->apiService->getLevelByCourse($request->input('course_id'));
            $levelofCousrses = $levelofCousrses['data'];
            $course = $this->apiService->getCourse($request->input('course_id'));
            $course = $course['data'];
            $course_id =$request->input('course_id');
        }else{
            $course_id =0;
        }
          $price_id = $request->input('price');
        if ($request->subject_ids) {

            $chapters = $this->apiService->getChaptersBySubjects([
                'subjects' => $request->subject_ids,
            ]);
    
            $chapter = $chapters['data'];
       }

        $level = null;
        if ($request->level) {
            $level = $this->apiService->getLevel($request->level);
            $level = $level['data'];
        }
        $type =  $tab == 'course' ? 'full' : $tab;
        if(@$request->input('course_text')){ 

        $levelIds = $request->input('level_ids') ? $request->input('level_ids') :  $levelofCousrses;
        }else{ 
       
       
        $levelIds= $request->input('level_ids') ? $request->input('level_ids') :  '';
        }

        $languageIds = $request->input('language_ids') ?? [];
        $subjectIds = $request->input('subject_ids') ?? [];
        $chapterIds = $request->input('chapter_ids') ?? [];
        $professorIds = $request->input('professor_ids') ?? [];
        $ratings = $request->input('ratings') ?? [];
        $packagetypes = $request->input('p_type_ids') ?? [];


//        return $request->all();
$linked_packages_id = ($request->session()->get('linked_packagedata')) ?? [];


        $packages = $this->apiService->getPackageList([
            'search' => $request->input('search'),
            'course' => $course_id,
            'price' => $request->input('price'),
            'professor' => $request->input('professor'),
           // 'level' => $request->input('level'),
            'levels' => $request->input('level_ids'),
            'languages' => $request->input('language_ids'),
            'subjects' => $request->input('subject_ids'),
            'chapters' => $request->input('chapter_ids'),
            'professors' => $request->input('professor_ids'),
            'linked_packages_id' => $linked_packages_id,
            'ratings' => $request->input('ratings'),
            'packagetypes' => $request->input('p_type_ids'),
            'offer' => $request->input('offer'),
            'limit' => 16,
            'page' => $page
        ]);
       //by jeswill
      
      
    //end by jeswill
        $package = $packages['data'] ?? [];
        if($request->input('offer')=='new'){
            $packages = array_slice($package,0,20);
        }else{
            $packages = $package;
        }
        
       // echo "<pre>";print_r($packages);exit;
        Session::put('package', $packages);

        $totalNumberOfPackages =   $packages['total'];

        $wishlist = $this->apiService->getWishListUserPackageIds();
        $wishlist = $wishlist['data'] ?? [];

        $user = $this->apiService->getProfile();
        $user = $user['data'] ?? [];
      

        $currentURL = url()->full();
        $webUrl = env('WEB_URL');
        $replacedPath = str_replace($webUrl, '', $currentURL);
        $path = $replacedPath;
        $packages = new LengthAwarePaginator(
            $packages['data'],
            $packages['total'],
            $packages['per_page'],
            $packages['current_page'],
            $options = [
                'path' => $path
            ]
        );
        
        foreach ($packages as $seo) {
           
             if (isset($seo['meta_title'])) {
                 SEOMeta::setTitle($seo['meta_title']);
             }
             if (isset($seo['meta_description'])) {
                 SEOMeta::setDescription($seo['meta_description']);
             }
             if (isset($seo['slug'])) {
                 SEOMeta::setCanonical(url('packages') . '/' . $seo['slug']);
             }
             break;
         }
        if ($request->course) {
            $levels =  $this->apiService->getLevelCourse($request->course);;
            $levels = $levels['data'];
        } else {
        $levels = $this->apiService->getLevels();
        $levels = $levels['data'];
        }

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];
        $courses = $this->apiService->getCourses();
        $courses = $courses['data'];
        $package_types = $this->apiService->getPackageTypes();
        $package_types = $package_types['data'];

        $subjects = $this->apiService->getSubjects();
        $subjects = $subjects['data']['data'];

        $professors = $this->apiService->getProfessors();
        $professors = $professors['data'];
        $validPackages = $this->apiService->getValidPackages();
        $validPackages = $validPackages['data'];
               
        $search = $request->input('search') ?? null;

        $freemiumDaysMax = $this->apiService->getSettings(['key' => 'freemium_days_max']);

        $freemiumDaysMax = $freemiumDaysMax['data']['freemium_days_max'] ?? null;

        $freemiumHoursMax = $this->apiService->getSettings(['key' => 'freemium_hours_max']);

        $freemiumHoursMax = $freemiumHoursMax['data']['freemium_hours_max'] ?? null;

     
    SEOMeta::setTitle('Packages | JK Shah Online');
    
        return view('pages.packages.index', compact(
            'packages',
            'tab',
            'page',
            'user',
            'levels',
            'languages',
            'totalNumberOfPackages',
            'wishlist',
            'levelIds',
            'languageIds',
            'subjectIds',
            'chapterIds',
            'professorIds',
            'ratings',
            'subjects',
            'professors',
             'course',
              'level',
              'levelofCousrses',
              'cart_items',
              'validPackages',
              'chapter',
              'course_id',
              'price_id',
              'search',
              'package_types',
              'packagetypes',
              'courses',
              'freemiumDaysMax',
              'freemiumHoursMax'
            ));
    }

    public function show($id)
    {
        $package = $this->apiService->getPackage($id);

        if ($package->clientError()) {
//            abort(404);
            return redirect(url('packages'));
        }

        $package = $package['data'];
        $user = $this->apiService->getProfile();
        $user = $user['data'] ?? null;
        if($user){

        $this->apiService->postStudentLogs([
            'user_id'=>$user['id'],
            'package_id'=>$package['id'],
            'ip_address'=>request()->ip(),
           // 'browser'=>request()->server(),
            'log_type'=>3,
            'session_token'=>session()->get('access_token')
        ]);
        }


        if ($package['slug'] && $package['id'] == $id) {
            return redirect(url('packages') . '/' . $package['slug']);
        }
        
        $uuID = Session::get('cart_uuid');

        $uuID = str_replace('\"', '', $uuID);

        $response = $this->apiService->getCart(['uuid' => $uuID]);

        $cart = $response['data']['cart'];

        if (!empty($cart['items'])) {
                $items = $cart['items'];
                
                foreach ($items as $item) {
                    $cart_items[] = $item['id'];
                }
        } else {
            
            $cart_items[] = "";
        }
//
//        $package_details = $this->apiService->getPackageDetails($id);
//        $package_details = $package_details['data'];
////        if ($package->clientError()) {
////            abort(404);
////        }
///
//        $packages = $this->apiService->getAllPackages(['limit' => 11, 'in_random' => true]);
//
//        $packages = $packages['data'] ?? [];

//        $miniPackages = $this->apiService->getMiniPackages(['limit' => 11]);
//        $miniPackages = $miniPackages['data'] ?? [];

//        $orderItem = $this->apiService->getOrderItem(['package_id' => $id]);
//        $orderItem = $orderItem['data'] ?? null;
//
        $orderItems = $this->apiService->getOrderItems(['package_id' => $package['id']]);
        $orderItems = $orderItems['data'] ?? null;
        $totalStudents = 0;
        if (count($orderItems) > 0) {
            $totalStudents = count($orderItems);
        }

        $user = $this->apiService->getProfile();
        $user = $user['data'] ?? null;

        if ($package['meta_title']) {
            SEOMeta::setTitle($package['meta_title']);
        }else{
            SEOMeta::setTitle($package['name'].' | JK Shah Online');
        }

        if ($package['meta_description']) {
            SEOMeta::setDescription($package['meta_description']);
        }

        if ($package['slug']) {
            SEOMeta::setCanonical(url('packages') . '/' . $package['slug']);
        }

        $packageFeatures = $this->apiService->getPackageFeatures($id);

        $validPackages = $this->apiService->getValidPackages();
        $validPackages = $validPackages['data'];

        $demo_video = $this->apiService->getDemoVideo(['id' => $id]);
        $demo_video = $demo_video['data'] ?? null;
        //  dd($package['updated_at']);
        $course_video = $this->apiService->getCourseVideo(['id' => $package['id'], 'updated_date' => $package['video_updated_at']]);
        $course_video = $course_video['data'] ?? null;
        

        if (!empty($course_video)) {
          
            $course_video['data'] = $course_video;
            $course_video['type'] = 1;
            
        } else {
            $const = env('ENC_CONST');
            $course_video['data'] = $package['video'];
            $course_video['type'] = 2;
            $cipher = env('ENC_CIPHER');
            $secret = env('ENC_SECRET_KEY');
            $option = 0;
            $str = '';
            $iv = str_repeat("0",openssl_cipher_iv_length($cipher));
            if(!empty($package['video'])){
                $course_video['encryptedString'] = $str =openssl_encrypt($package['video']['id'],$cipher,$secret,$option,$iv);
                $course_video['encryptedString']= str_replace("/",$const,$str);  
            }    
        }

        return view('pages.packages.show', compact('totalStudents', 'package', 'user', 'packageFeatures', 'cart_items', 'validPackages', 'demo_video', 'course_video'));
    }

    public function getSubjectsByLevels(Request $request)
    {
        $subjects = $this->apiService->getSubjectsByLevels([
            'levels' => $request->level_ids,
            'types'  => $request->type_id
        ]);

       return response()->json($subjects['data'], 200);
    }
    public function getTypesByLevels(Request $request)
    {
        $subjects = $this->apiService->getTypesByLevels([
            'levels' => $request->level_ids
          
        ]);

       return response()->json($subjects['data'], 200);
    }

    public function getSubjectsByLanguages(Request $request)
    {
        $subjects = $this->apiService->getSubjectsByLanguages([
            'levels' => $request->level_ids,
            'languages' => $request->language_ids
        ]);

        return response()->json($subjects['data'], 200);
    }

    public function getchaptersBySubject(Request $request)
    {
        $subjects = $this->apiService->getChaptersBySubjects([
            'subjects' => $request->subject_ids,
        ]);

        return response()->json($subjects['data'], 200);
    }

    public function getProfessorByChapter(Request $request)
    {
        $professors = $this->apiService->getProfessorsByChapter([
            'chapters' => $request->chapter_ids,
        ]);

        return response()->json($professors['data'], 200);
    }
    
    public function getProfessorBySubject(Request $request){
       
        $professors = $this->apiService->getProfessorBySubject([
            'subject_id' => $request->subject_ids,
        ]);
        return response()->json($professors['data'], 200);
    }

    public function getLevelsByCourse(Request $request){
       
        $courses = $this->apiService->getLevelsByCourse([
            'courses' => $request->course_ids
        ]);
     
        return response()->json($courses['data'], 200);
    }

    public function getPackageByLevel(Request $request)
    {
        $allPackages = $this->apiService->getPackageByLevelId(['in_random' => true, 'level' => $request->level_id]);
        $allPackages = $allPackages['data'] ?? [];

        return response()->json($allPackages, 200);
    }

    public function startFreeTrial(Request $request){
        
        $response = $this->apiService->startFreeTrial($request->input());
        if(!empty($response['data'])){
            return redirect('/contents');
        }
    }

}
