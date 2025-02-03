<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use App\ApiService;

class ProfessorController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

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
       
        $professors = $this->apiService->getProfessorsByExperience(['search' => request('search'), 'is_published' => true]);

        $professors = $professors['data'] ?? [] ;

//        $response = '';
//
//        if ($professors) {
//            foreach ($professors as  $professor) {
//                $response .=
//                    '<li>' .
//                        '<a class="dropdown-item px-3" href="' . route('professors.show', $professor['id']) . '">' .
//                            '<div class="media">' .
//                                '<img src="' . $professor['image'] . '" class="align-self-center mr-3" alt="' . $professor['name'] . '" width="30" height="30">' .
//                                '<div class="media-body align-self-center">' .
//                                    '<span class="mt-0 mb-1">' . $professor['name'] . '</span>' .
//                                '</div>' .
//                            '</div>' .
//                        '</a>' .
//                    '</li>';
//            }
//        } else {
//            $response = '<li><a class="dropdown-item px-3">No Results</a></li>';
//        }

       // return $response;

        SEOMeta::setTitle("CA Professor - Best CA Faculty in India | JK Shah Online");
        SEOMeta::setDescription("We have one of the best faculty for CA online classes with years of expertise of different subjects to coach our students with proven methods to be the best.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/ca-faculty");

        return view('pages.professors.index', compact('professors'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $professor = $this->apiService->getProfessor($id);

        $professor = $professor['data'] ?? null;

        $response = $this->apiService->getWishListUserPackageIds();
        $wishlist = $response['data'] ?? [];

//        if ($professor && ! $professor['is_published']) {
//            abort(404);
//        }
		$offset=($request->page-1)*3;
        $packages = $this->apiService->getFilteredPackages(['professor' => $id, 'in_random' => true,'page'=>$offset]);
        
        $packages = $packages['data'] ?? null;
        
        //SEOMeta::setTitle($professor['title_tag']);
        SEOMeta::setTitle('Professors - '.$professor['title'].' | JK Shah Online');
        SEOMeta::setDescription($professor['meta_description']);

        if ($request->ajax()) {
			 if(count($packages['data'])>0){
            foreach ($packages['data'] as $package) {
                $a1 =  url('packages/' . ($package['slug'] ?? $package['id']))  ;
                $img = $package['image_url'] ?? asset('assets/images/placeholder.png') ;
                $ill = \Illuminate\Support\Str::limit($package['name'], env('TRIM_SIZE'), $end='...') ;
                $a2 =  url('packages/' . ($package['slug'] ?? $package['id'])) ;
                if(count($package['order_items'])>0)
                $review_count = count($package['order_items']).' Review(s)';
                else
                $review_count ='&nbsp';
                $sell_price = number_format($package['selling_price'],2) ;
                $knw_more =  url('packages/' . ($package['slug'] ?? $package['id'])) ;
                $cart_url =  url('/cart/checkout?package=' . $package['id']) ;
                $data ='';
                $data .= '<div class="col-lg-4 col-md-6 col-sm-12 lazy" >
                            <div class="course_num" >
                                <div class="course">
                                    <div class="course-img">
                                        <a style="text-decoration:none" href="'.$a1.'">
                                            <img src="'.$img.'" loading="lazy" alt="">
                                        </a>';

                                 if (! request()->session()->has('access_token')){
                                    $data .='<div class="stage">
                                                <div class="heart buy-now-login" data-id="'. $package['id'].'"></div>
                                            </div>';
                                 }else{
                                    if(in_array($package['id'], $wishlist)){
                                        $data .= '<div class="stage">
                                                    <div class="heart cart-save-for-later   is-active " data-id="'. $package['id']. '"></div>
                                                    </div>';
                                    }else{
                                        $data .= '<div class="stage">
                                                    <div class="heart cart-save-for-later" data-id="'. $package['id']. '"></div>
                                                    </div>';
                                    }
                                   
                                 }
                          

                $data .=       ' </div>
                        <div class="course-content p-3">
                            <a style="text-decoration:none" href="'.$a2.'">
                                <h3 style="min-height: 50px; max-height: 50px;">'
                                   .$ill.
                                '</h3>
                            </a>
                            <div class="ratings">';
                                for($i=0.4;$i<$package['rating'];$i++){
                                    $img_star = asset('assets/new_ui_assets/images/star.png');
                                    $data .=   '<span>
                                            <img class="star" src="'.$img_star.'" alt="">
                                        </span>';
                                }
                                $data .= '<p>'.$review_count.'</p>
                                            </div>
                                            <hr>
                                            <p class="language_display">
                                            <i class="fa fa-language" aria-hidden="true"></i>';

                                 if($package['language']['name'] == 'English'){
                                    $data .= '<span class="english">'.$package['language']['name'].'</span>';
                                }elseif($package['language']['name'] == 'Hindi'){
                                    $data .= '<span class="hindi">'.$package['language']['name'].'</span>';
                                }else{
                                    $data .= '<span class="both">'.$package['language']['name'].'</span>';
                                }
                $data .= '</p>
                            <p class="lecture">
                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                <span>'. $package['total_videos']. 'Lectures</span>
                            </p>
                            <p class="time">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="dur-time">
                                <small>';
                                $data.=$package['total_duration_formatted'].' hrs';
                                if(@$package['bonus_duration_formatted']) {
                                    $data.= '+'. @$package['bonus_duration_formatted'].' Bonus Hours';
                                }
                                $data.='</small>
                                </span>
                            </p>
                            <div class="course-amount">
                                <h5>
                                <i class="fa fa-inr" aria-hidden="true"></i>'.$sell_price.'</h5>
                                <h6>';

                                foreach ($package['strike_prices'] as $price){
                                    $strike_price =  number_format($price,2) ;
                                    $data .=  '<i class="fa fa-inr" aria-hidden="true"></i>
                                        <p>
                                            <del>'.$strike_price.'</del>
                                        </p>';
                                }
                            $data.= ' </h6>';

                                if($package['discount_percentage']!=0){
                                    $data .= '<span>'.$package['discount_percentage'].'%</span>';
                                }
                        $data .= '</div>
                                    <div class="bottom_btns d-flex align-items-center justify-content-between">
                                    <a href="'.$knw_more.'" class="btn more">Know More</a>';
                                if (! request()->session()->has('access_token')){
                                    $data .= '<button class="enroll buy-now-login" data-package="'. $package['id']. '">Enroll now</button>';
                                }else{
                                    $data .= '<a href="'.$cart_url.'" class="btn enroll">Enroll now</a>';
                                }
                        $data .=    '</div>
                        </div>
                    </div>
                </div>
            </div>';
            $array[]=$data;
            } 
			}
            else{
                $array=[];
            }
            return $array;
        }

        return view('pages.professors.show', compact('professor', 'packages', 'wishlist'));
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
}
