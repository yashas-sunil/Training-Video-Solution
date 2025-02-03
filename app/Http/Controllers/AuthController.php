<?php

namespace App\Http\Controllers;

use App\Models\Student\Student;
use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * AuthController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'cart_uuid' => Session::get('cart_uuid'),
            'role' => $request->input('role'),
            'campaign_registration_id' => session()->get('campaign_registration_id'),
            'login_type' => $request->input('login_type')
        ];

        $response = $this->apiService->postLogin($credentials);
       

        if (!$response->successful()) {
            if ($response->status() == 422) {
                
                $testpress_response = $this->apiService->hasTestpress($credentials);
                if ($testpress_response->status() == 422) {
                    throw ValidationException::withMessages($response->offsetGet('errors'));
                }else{
                    $testpress_validate_credentials = $this->apiService->loginTestpress($credentials);
                    if ($testpress_validate_credentials->status() == 422) {
                        return redirect()->back()->withInput()->with('error', 'These credentials do not match our testpress record');
                    }else{ 
                        $testpress_sso_response=$this->apiService->login_testpress($credentials);
                        if ($testpress_sso_response->status() == 422) {
                            return redirect()->back()->withInput()->with('error', 'Server error, Please try later');
                        }else{
                            return Redirect::to($testpress_sso_response['data']);
                        }
                    }
                }
                
            } else if ($response->clientError()) {
                return redirect()->back()->withInput()->with('error', $response->offsetGet('message'));
            } else {
                return redirect()->back()->withInput()->with('error', 'Server error, Please try later');
            }
        }

        session()->put('access_token', $response['data']['access_token']);
        
        $name = $response['data']['user']['name'];
        $finalname = explode(' ', $name);

        $fname= isset($finalname[0])?$finalname[0]:null;
        $lname= isset($finalname[1])?$finalname[1]:null;
        session()->put('cannotfind_fname',$fname);
        session()->put('cannotfind_lname', $lname);
        session()->put('cannotfind_phone',$response['data']['user']['phone']);
        session()->put('cannotfind_email',$response['data']['user']['email']);
        
        if ($request->input('package_id')) {
            return redirect('/cart/checkout?package=' . $request->input('package_id'));
        }

        if ($request->input('location') == 'cart') {
            return redirect('/cart/checkout');
        }

        if ($request->input('location') == 'refer_and_earn') {
            return redirect(back()->getTargetUrl() . '?refer-and-earn');
        }

        $response = $response['data'] ?? null;


        $logs = $this->apiService->postStudentLogs([
            'user_id' => $response['user']['id'],
            'package_id' => '',
            'video_id' => '',

            'ip_address' => request()->ip(),
            'log_type' => 2,
            'session_token' => session()->get('access_token')
        ]);

        if ($response['user']['role'] == 6) {
            return redirect('/professor/dashboard');
        }

        if ($response['user']['role'] == 7) {
            return redirect('/associate/dashboard');
        }

        if ($response['user']['role'] == 11) {
            return redirect('/branch-managers/profile');
        }

        if ($response['multipleLogin'] == 1) {
            return redirect('/student-dashboard')->with('info', 'All other devices which are logged before will be closed.');
        }

        return redirect('/student-dashboard');
    }
    public function attemptYearUpdate(Request $request)
    {

        // info("login attempt year");
        //info($request->input());

        $response = $this->apiService->attemptYearUpdate($request->input());
        if ($response->clientError()) {
            return redirect()->back();
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function logout(Request $request)
    {

        $response = $this->apiService->updateLogSession();
        $logs = $this->apiService->postStudentLogs([
            'user_id' => null,
            'package_id' => null,
            'video_id' => null,
            'ip_address' => request()->ip(),
            'log_type' => 5,
            'session_token' => session()->get('access_token')
        ]);

        $deleteUserFromPushNotification = $this->apiService->removeDeviceFromPushNotification();

        $request->session()->forget('access_token');
        $request->session()->forget('cannotfind_fname');
        $request->session()->forget('cannotfind_lname');
        $request->session()->forget('cannotfind_phone');
        $request->session()->forget('cannotfind_email');
        $request->session()->forget('cannotfind');
        return redirect('/');
    }

    public function getLogout(Request $request)
    {

        $response = $this->apiService->updateLogSession();

        $logs = $this->apiService->postStudentLogs([
            'user_id' => null,
            'package_id' => null,
            'video_id' => null,
            'ip_address' => request()->ip(),
            'log_type' => 5,
            'session_token' => session()->get('access_token')
        ]);

        $deleteUserFromPushNotification = $this->apiService->removeDeviceFromPushNotification();

        request()->session()->forget('access_token');
        request()->session()->forget('cannotfind_fname');
        request()->session()->forget('cannotfind_lname');
        request()->session()->forget('cannotfind_phone');
        request()->session()->forget('cannotfind_email');
        request()->session()->forget('cannotfind');
        return redirect('/');
    }

    public function register(Request $request)
    {
        //        return $request->all();
        $validated = $request->validate([
            'otp_register_token' => 'required',
            'otp_register_code' => 'required|numeric',
            'referral' => '',
            //'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'mobile_code' => '',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'course_id' => 'required',
            'level_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'attempt_year' => 'required',
            'city' => 'required',
            'pin' => 'required',
        ]);

        $validated['campaign_registration_id'] = session()->get('campaign_registration_id');
        $validated['name'] = $request->fname . ' ' . $request->lname;
        $response = $this->apiService->register($validated);

        if (!$response->successful()) {
            if ($response->status() == 422) {
                throw ValidationException::withMessages($response->offsetGet('errors'));
            } else if ($response->clientError()) {
                return redirect()->back()->withInput()->with('error', $response->offsetGet('message'));
            } else {
                return redirect()->back()->withInput()->with('error', 'Server error, Please try later');
            }
        }

        if ($request->has('sso')) {
            return redirect(url('mobile/register/success?access_token=' . $response['data']['access_token']));
        }

        session()->put('access_token', $response['data']['access_token']);

        return redirect('/student-dashboard');
    }

    public function validateEmail()
    {
        $response = $this->apiService->validateEmail(request()->input());

        return $response ?? null;
    }

    public function validatePhone()
    {
        $response = $this->apiService->validatePhone(request()->input());

        return $response ?? null;
    }

    public function validateLogin()
    {
        $response = $this->apiService->validateLogin(request()->input());

        return $response ?? null;
    }

    public function secondaryLogin()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post(
            env('EDUGULP_URL') . 'api/validate-login',
            [
                'username' => request()->get('username'),
                'password' => request()->get('password')
            ]
        );

        $token = '';
        $userID = '';

        if ($response != "" && $response->status() == 200) {
            $token = $response['token'];
            $userID = $response['user']['id'];
        }

        return redirect(env('EDUGULP_URL') . 'login?user=' . $userID . '&token=' . $token);
    }

    public function markAsVerified($token = null)
    {
        $response = $this->apiService->studentMarkAsVerified($token);

        if ($response == 'true') {
            $isVerified = true;
        } else {
            $isVerified = false;
        }

        return view('pages.auth.verification', compact('isVerified'));
    }

    public function redirectToGoogle()
    {
        $response = $this->apiService->redirectToGoogle();

        return $response;
        //        return redirect('/student-dashboard');
    }

    public function signup_otp_verify(Request $request)
    {
        $validated = $request->validate([
            'otp_register_token' => 'required',
            'otp_register_code' => 'required|numeric'
        ]);

        $response = $this->apiService->signup_otp_verify($validated);
        if ($response['message'] == 'success') {
            $result["msg"] = "OTP verified successfully.";
            $result["status"] = 1;
            $result["value"] = 200;
        } else {
            $result["msg"] = "Invalid Otp";
            $result["status"] = 2;
            $result["value"] = 200;
        }
        return response()->json($result);
    }
}
