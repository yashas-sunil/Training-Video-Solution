<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;

class ProfileController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * ProfileController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function show()
    {
        $user =  $this->apiService->getProfile() ?? null;
        $user = $user['data'] ?? null;

        $wishlists = $this->apiService->getSaveForLater();

        $wishlists=$wishlists['data'] ?? null;
//        if ($user->clientError()) {
//            return redirect('/');
//        }
        SEOMeta::setTitle("Profile | JK Shah Online");
        return view('pages.profile.show', compact('user', 'wishlists'));
    }

    public function update(Request $request)
    {
//        info($request->input());
        $response = $this->apiService->updateProfile($request->input());
//        info($response);
        if ($response->clientError()) {
            return redirect()->back();
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateAcademicInformation(Request $request)
    {
        $response = $this->apiService->updateAcademicInformation($request->input());
//        info($response);
        if ($response->clientError()) {
            return redirect()->back();
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateStudentAddress(Request $request)
    {
        $response = $this->apiService->updateStudentAddress($request->input());
//        info($response);
        if ($response->clientError()) {
            return redirect()->back();
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function uploadProfileImage(Request $request) {
        $response = $this->apiService->uploadProfileImage($request->file('image'));

        if ($response->clientError()) {
            abort(500);
        }

        return redirect()->back();
    }

    public function editEmailOtp(Request  $request){
        $response = $this->apiService->editEmailOtp($request->input());

        if ($response->clientError()) {
            return redirect()->back();
        }

        return $response;
    }

    public function verifyEmailOtp(Request  $request){
        $response = $this->apiService->verifyEmailOtp($request->input());

        if ($response->clientError()) {
            return redirect()->back();
        }

        return $response;
    }

    public function updateEmail(Request  $request){
        $response = $this->apiService->updateEmail($request->input());

        if ($response->clientError()) {
            return redirect()->back();
        }

        return $response;
    }
}
