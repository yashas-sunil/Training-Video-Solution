<?php

namespace App\Http\Controllers;

use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

//use GuzzleHttp\Psr7\Request;

class CMSController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * OrderController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
    public function terms()
    {
        SEOMeta::setTitle("Terms Of Use | JK Shah Online | Best CA Institute in India");
        SEOMeta::setDescription("JK Shah Classes Private Limited is a registered CA coaching institution. We are committed to provide doubt free offline & online classes for students all over India.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/terms");

        return view('pages.cms.terms');
    }

    public function privacy()
    {
        SEOMeta::setTitle("Privacy Policy | JK Shah Online | Best CA Institute in India");
        SEOMeta::setDescription("JKSC Private Limited is the best online & offline CA institution in India. Students can get access to demo lectures & packages for CA subjects through website.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/privacy");

        return view('pages.cms.privacy');
    }

    public function disclaimer()
    {
        return view('pages.cms.disclaimer');
    }

    public function contactUs()
    {
        SEOMeta::setTitle("Contact Us - Best CA Coaching in India | JK Shah Online Classes");
        SEOMeta::setDescription("JK Shah provides online & offline classes across 15 cities in India. Enroll with us for best CA final, inter, foundation & junior college packages.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/contact-us");

        return view('pages.cms.contact-us');
    }

    public function bcomWithCaOnline()
    {
        return view('pages.cms.bcom-with-ca-online');
    }

    public function enquiries(Request $request)
    {
       $this->validate($request,[
          'name' => 'required',
          'mobile' => 'required|numeric',
          'email' => 'required|email:rfc,dns',
          'comment' => 'required',
       ]);

        $response=  $this->apiService->contactUs($request->all());
        // if($response['message']=='success'){
            
        //     return redirect()->back()->with('success', 'We will contact you soon');
        // }else{
        //     return redirect()->back()->with('error', 'Verification failure. Please try again');
        // }
        if($response['message']=='success'){
            $result["msg"] = "Mobile verified successfully.";
            $result["status"] = 1;
            $result["value"] = 200;
        }else{
            $result["msg"] = "Invalid Otp";
            $result["status"] = 2;
            $result["value"] = 200;
        }
        return response()->json($result);

    }

    public function aboutUs()
    {
        SEOMeta::setTitle("About Us - Best CA Courses and online classes in India | JK Shah Online");
        SEOMeta::setDescription("Jk Shah is the best coaching classes for CA & Commerce since 1983. We give our students best coaching faculty, updated study material and excellent results.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/about-us");

        return view('pages.cms.about-us');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->apiService->postContact($request->input());

        if ($response->clientError()) {
            abort(500);
        }

        return $response['data'];
    }
    public function thane()
    {
        return view('pages.cms.cafc-scholarship');
    }
    public function validate_captcha(request $request){
       
        $input = $request->all();
        $captcha=$input['captchaa'];
        info($captcha);
      
       if(empty($captcha)){
        return false;
        }
        else{
        $secret_key = env('SECRET_KEY');

        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$captcha);

        $response_data = json_decode($response);


        if(!$response_data->success)
        {
            return false;
        }
           
        }
}
}