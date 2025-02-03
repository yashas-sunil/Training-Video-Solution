<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\ApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * CartController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $uuID = $this->getCartUUID();

        $uuID = str_replace('\"', '', $uuID);

        $response = $this->apiService->getCart(['uuid' => $uuID]);

        $cart = $response['data']['cart'];

        $holiday_offers=$this->apiService->getHolidayOffers();
        $holiday_offers=$holiday_offers['data']??null;
        if (request()->ajax()) {
            return response()->json(['data' => $response['data']]);
        }

        $value = request()->session()->get('access_token');
        if(!empty($value)){
            $packages = $this->apiService->getAllWishlistPackages();
        }else{
            $packages = $this->apiService->getAllPackages(['limit' => 11, 'in_random' => true]);
            $packages = $packages['data'] ?? [];
        }
        
        //        $miniPackages = $this->apiService->getMiniPackages(['limit' => 11]);
        //        $miniPackages = $miniPackages['data'] ?? [];

        SEOMeta::setTitle("Cart - JK Shah Online");
        SEOMeta::setDescription("Keep all the courses or packages here which you want to buy from JK Shah online classes for your upcoming exams.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/cart");

        return view('pages.cart.index', compact('cart', 'packages','holiday_offers'));
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'package_id' => 'required'
        ]);

        $uuID = $this->getCartUUID();
        $response = $this->apiService->addToCart($uuID, $request->get('package_id'));

        return response()->json([
            'data' => $response['data'] ?? null
        ]);
    }

    function removeFromCart(Request $request)
    {
        $response = $this->apiService->removeFromCart($request->input('id'));
        return $response;
    }

    function addToWishlist(Request $request)
    {
        $response = $this->apiService->addToWishlist($request->input());

        return $response;
    }

    public function checkout(Request $request)
    {

        $holiday_offers=$this->apiService->getHolidayOffers();
        $holiday_offers=$holiday_offers['data'] ?? null;

        $max_jkoin_percentage = $this->apiService->getJomenySetting();
        $max_jkoin_percentage=$max_jkoin_percentage['data']??null;

        if ($request->has('package')) {
            $response = $this->apiService->getPackage($request->input('package'));

            if ($response->clientError() || $response->serverError()) {
                return redirect(url('/'));
            }

            if ($error = $this->handleApiError($response)) {
                return $error;
            }

            $package = $response['data'];
            //15th August 2022 - Independence day
            // Flat 7.5% discount on All Listed Courses +
            // 7.5% Cashback as J-Koins
            $subtotal = $package['price'];
            $total = $package['selling_price'];
            $courseid = 0;
            $courseid =  $package['course_id'];
            $levelids=$package['level_id'];
            $type_p=$package['type'];
            // dd($packagecoursename);
            $totalrakshabandanprice = 0;
            $rakshajcoin = 0;
            //rakshabandhan starts
            
            if (!empty($holiday_offers['id'])&& $total >= $holiday_offers['min_cart_amount']) {
                if(!empty($holiday_offers['courses'])){   
                    if(!empty($holiday_offers['level_id'])){
                        $sel_levels=explode(',' ,$holiday_offers['level_id']);  
                    }  
                    else{
                        $sel_levels=[];
                    }  
                    if(!empty($holiday_offers['package_type'])){
                        $sel_types=explode(',' ,$holiday_offers['package_type']);  
                    }  
                    else{
                        $sel_types=[];
                    }                                 
                    $sel_course = explode(',' ,$holiday_offers['courses']);                    
                    }
                    else{
                    $sel_course = [];
                    }
                
                if((!empty($holiday_offers['courses']) && in_array($courseid,$sel_course))|| (empty($holiday_offers['courses']))){
                    if((!empty($holiday_offers['level_id']) && in_array($levelids,$sel_levels)) || (empty($holiday_offers['level_id']))){  
                        if((!empty($holiday_offers['package_type']) && in_array($type_p,$sel_types)) || (empty($holiday_offers['package_type']))){
                            if($holiday_offers['discount_type']==1)
                            {
                            $totalrakshabandanprice=$holiday_offers['discount_amount'];
                            }
                            else
                            {
                                $totalrakshabandanprice=round(($total * $holiday_offers['discount_amount'])/100);
                            }
                            // $totalrakshabandanprice=round(($total*2.5)/100);
                            if($holiday_offers['cashback_type']==1){
                                $rakshajcoin=$holiday_offers['cashback_amount'];
                            }
                            else{
                                $rakshajcoin=round(($total * $holiday_offers['cashback_amount'])/100);
                                if($holiday_offers['max_cashback']!=null){
                                    if($rakshajcoin>=$holiday_offers['max_cashback'])
                                    {
                                        $rakshajcoin=$holiday_offers['max_cashback'];
                                    }
                                }
                            }
                        }    
                    }
                }
            $total=$total-$totalrakshabandanprice;
                //ends
            }

            $discountPercentage = round((1 - $total / $subtotal) * 100 * 100) / 100;
            $discountPrice = $subtotal - $total;

            $cart =  [
                'subtotal' => $subtotal,
                'total' => $total,
                'discount' => $discountPrice,
                'discount_percentage' => $discountPercentage,
                'items' => [$package],
                'totalrakshabandanprice' => $totalrakshabandanprice,
                'rakshajcoin' => $rakshajcoin,
                'courseid' => $courseid

            ];

            $isPackage = 1;
            $package_id = $request->input('package');
        } else {
            $package_id = '';
            $uuid = $this->getCartUUID();

            $response = $this->apiService->getCart(['uuid' => $uuid]);

            if ($response->clientError() || $response->serverError()) {
                return redirect(url('/'));
            }
            $isPackage = 0;
            $cart = $response['data']['cart'];
        }

    //    session_start();
       
    $wasposted = session('wasPosted');
    if($wasposted==2){
        if ($cart['totalrakshabandanprice']>0) {
        $this->apiService->deleteJmoneyOffer();
        }
        // Session::put('wasPosted',1);
        // $_SESSION['wasPosted']=1;
        Session::put('wasPosted',1);
    }
    Session::put('wasPosted',1);
        $response = $this->apiService->getAddresses();

        if ($error = $this->handleApiError($response)) {
            return redirect('/?login');
        }

        $tax = $this->apiService->getTax();

        $cgst = $tax['data']['cgst']['value'];
        $igst = $tax['data']['igst']['value'];
        $sgst = $tax['data']['sgst']['value'];

        $points = $this->apiService->rewardPoints();
        $reward_points = $points['data']['rewards'] ?? null;

        $spinWheelRewards = $points['data']['spinWheelRewards'] ?? [];

        $addresses = $response['data'];

        $pendrivePrice = $this->apiService->getSettings(['key' => 'pendrive_price']);

        $pendrivePrice = $pendrivePrice['data']['pendrive_price'] ?? null;

        $user = $this->apiService->getProfile() ?? null;
        $user = $user['data'] ?? null;

        $associateStudents = $this->apiService->getAssociateStudents(['is_verified' => 'true']);

        $associateStudents = $associateStudents['data'] ?? [];

        SEOMeta::setTitle("Checkout - JK Shah Online");

        if ($user['role'] == 5) {
            return view('pages.cart.checkout', compact(
                'isPackage',
                'cart',
                'reward_points',
                'addresses',
                'pendrivePrice',
                'user',
                'associateStudents',
                'cgst',
                'igst',
                'sgst',
                'spinWheelRewards',
                'package_id',
                'max_jkoin_percentage',
                'holiday_offers'
            ));
        }

        if ($user['role'] == 7) {
            return view('associate.pages.cart.checkout', compact('cart', 'pendrivePrice', 'user', 'associateStudents', 'cgst', 'igst', 'sgst', 'package_id'));
        }

        if ($user['role'] == 11) {
            $branchManagerStudents = $this->apiService->getBranchManagerStudents();
            $branchManagerStudents = $branchManagerStudents['data'] ?? [];

            return view('branch-managers.pages.cart.checkout', compact('cart', 'pendrivePrice', 'user', 'branchManagerStudents', 'cgst', 'igst', 'sgst', 'package_id'));
        }

        return false;
    }


    public function applyCoupon(Request $request)
    {
        $response = $this->apiService->getCoupons(['amount' => $request->input('amount'), 'coupon' => $request->input('coupon'), 'package_id' => $request->input('package_id')]);

        return response()->json($response->json(), 200);
    }

    function getCartUUID()
    {
        $uuid = Session::get('cart_uuid');

        if (!$uuid) {
            $uuid = Str::uuid();
            Session::put('cart_uuid', $uuid);
        }

        return $uuid;
    }

    public function saveproof(Request $request){
        if($request->hasfile('proof'))
        {
            $file = $request->file('proof');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/enroll_proofs/', $name);  
            $response = array('file'=> $name);
            return response()->json($response);
        }
    }
}
