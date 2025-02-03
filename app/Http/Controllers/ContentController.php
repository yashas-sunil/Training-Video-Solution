<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Support\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;

class ContentController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * ContentController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $params = array_merge($request->all());

        $response =  $this->apiService->getProfile();
        $user = $response['data'] ?? null;

        $userFreemiumItems = [];
        $orderItems = [];

        if (request()->has('freeOrPurchased') && 'trial' == request()->input('freeOrPurchased')){
            $userFreemiumItems = $this->apiService->getDashboardUserFreemiumPackage($params);
            $userFreemiumItems = $userFreemiumItems['data'] ?? [];
        }else{
            $response = $this->apiService->getDashboardPurchasedPackage($params);
            $orderItems = $response['data'] ?? [];
        }

        $purchasedPackageCount = $this->apiService->getMyCourseCourseDetails();
        $purchasedPackageCount = $purchasedPackageCount['data'] ?? [];

        $purchasedSubjects = $this->apiService->getPurchasedSubjects();
        $purchasedSubjects = $purchasedSubjects['data'];

        $professors = $this->apiService->getProfessors();
        $professors = $professors['data'] ?? [];

//        return $orderItems;

//        foreach ($orderItems as $orderItem){
//            return $orderItem['package']['videos'][0];
//        }

//        $totalCoursePurchased = count($orderItems);
//
//        $completedCourse = $this->apiService->getCompletedCourse($totalCoursePurchased);
//
//        $completedCourseCount = $completedCourse['data'] ?? null;

//        $subjects = [];

        if (request()->filled('package')) {
            $packageId = request()->input('package');
        } else {
            $packageId = $orderItems[0]['package']['id'] ?? null;
        }

        if (request()->filled('order_item')) {
            $orderItemId = request()->input('order_item');
        } else {
            $orderItemId = $orderItems[0]['id'] ?? null;
        }

//        if ($packageId) {
//            $response = $this->apiService->getPackageSubjects($packageId);
//            $subjects = $response['data'] ?? [];
//        }

//        $contents = [];
//        $order = null;
//
//        if ($packageId) {
//            $response = $this->apiService->getContents(['package' => $packageId, 'subject' => request()->input('subject')]);
//            $contents = $response['data'] ?? [];
//
//            $response = $this->apiService->getOrderItem(['package_id' => $packageId, 'with' => 'package']);
//            $order = $response['data'] ?? null;
//        }

//        return $contents;

//        $response = $this->apiService->getTotalChapters(request()->input());
//        $totalChapters = $response['data']['total_chapters'] ?? 0;
//        $totalChaptersBought = $response['data']['total_chapters_bought'] ?? 0;
//
//        $response = $this->apiService->getRemainingDuration([
//            'package_id' => request()->input('package') ?? $packageId,
//            'order_item_id' => request()->input('order_item') ?? $orderItemId
//        ]);
//
//        $remainingDurationInSeconds = $response['data']['remaining_duration'] ?? 0;
//        $totalDurationInSeconds = $response['data']['total_duration'] ?? 0;
//
//        if($totalDurationInSeconds > 0){
//            $reviewDuration = $totalDurationInSeconds/2;
//        }
//        else{
//            $reviewDuration = 0;
//        }

//        $remainingDuration = $this->formatDuration($remainingDurationInSeconds);
//        $totalDuration = $this->formatDuration($totalDurationInSeconds);

//        $orderItemResponse =  $this->apiService->showOrderItem($orderItemId);
//
//        $feedBackOrderItem = $orderItemResponse['data'];

        $response =  $this->apiService->getCourseDetails();
        $courseDetails = $response['data'] ?? null;

        $freemiumDaysMax = $this->apiService->getSettings(['key' => 'freemium_days_max']);
        $freemiumDaysMax = $freemiumDaysMax['data']['freemium_days_max'] ?? null;
        $freemiumHoursMax = $this->apiService->getSettings(['key' => 'freemium_hours_max']);
        $freemiumHoursMax = $freemiumHoursMax['data']['freemium_hours_max'] ?? null;

//        return $contents;
        SEOMeta::setTitle("My Courses | JK Shah Online");

        return view('pages.contents.index', compact(
            'user',
            'userFreemiumItems',
            'freemiumDaysMax',
            'freemiumHoursMax',
            'orderItems',
            'packageId',
            'orderItemId',
            'courseDetails',
            'purchasedSubjects',
            'professors', 'purchasedPackageCount'));
    }

    public function formatDuration($seconds)
    {
        $durationInSeconds = $seconds;
        $h = floor($durationInSeconds / 3600);
        $resetSeconds = $durationInSeconds - $h * 3600;
        $m = floor($resetSeconds / 60);
        $resetSeconds = $resetSeconds - $m * 60;
        $s = round($resetSeconds, 3);
        $s = round($s);
        $h = str_pad($h, 2, '0', STR_PAD_LEFT);
        $m = str_pad($m, 2, '0', STR_PAD_LEFT);
        $s = str_pad($s, 2, '0', STR_PAD_LEFT);

        if ($h > 0) {
            $duration[] = $h;
        }

        $duration[] = $m;

        $duration[] = $s;

        return implode(':', $duration);
    }

    public function videoContents(Request $request)
    {

        $packageId = request()->input('package');
        $orderItemId = request()->input('order_item');

        if ($packageId) {
            $response = $this->apiService->getContents(['package' => $packageId, 'subject' => request()->input('subject')]);
            $contents = $response['data'] ?? [];
        }
        //info($contents);
        $videoIds = [];
        foreach ($contents as $content){
            foreach ($content['chapters'] as $chapter){
                foreach ($chapter['modules'] as $module){
                    foreach ($module['videos'] as $video){
                        array_push($videoIds, $video['id']);
                    }
                }
            }
        }
		    $user =  $this->apiService->getProfile();
        $user = $user['data'] ?? null;
        $package = $this->apiService->getPackage($packageId, ['include_inactive' => true]);
        $package = $package['data'] ?? null;

        $playlist = [];

        foreach ($package['subjects'] as $subject) {
            foreach ($subject['chapters'] as $chapter) {
                foreach ($chapter['modules'] as $module) {
                    foreach ($module['videos'] as $playlistVideo) {
                        $playlist[] = $playlistVideo['id'];
                    }
                }
            }
        }
      //  print_r($playlist);exit;
        $completed_video=$this->apiService->getlastCompletedVideo(['package' => $packageId, 'orderItemId' => $orderItemId,'user_id'=>$user['id']]);
         if(!empty($completed_video['data'])){
$vid=$completed_video['data']['video_id'];
if(in_array($vid,$playlist)){
    $vid=$vid;
}else{
    $vid=$videoIds[0];

}
      }else{
          $vid=$videoIds[0];
      }
//
//        <a href="{{ url('videos') . '/' . $video['id'] . '?package=' . $packageId . '&order_item=' . $orderItemId ?? '' }}">

        return redirect('/videos/'.$vid.'?package='.$packageId.'&order_item='.$orderItemId);
//
//        <a href="{{ url('videos') . '/' . $video['id'] . '?package=' . $packageId . '&order_item=' . $orderItemId ?? '' }}">

       // return redirect('/videos/'.$videoIds[0].'?package='.$packageId.'&order_item='.$orderItemId);
    }


    public function freemiumVideoContents(Request $request)
    {
        $packageId = request()->input('package');
        $freemiumId = request()->input('freemiumId');

        if ($packageId) {
            $response = $this->apiService->getContents(['package' => $packageId, 'freemium_package' => $freemiumId]);
            $contents = $response['data'] ?? [];
        }

        if(!empty($contents)){
            $videoIds = [];
            foreach ($contents as $content){
                foreach ($content['chapters'] as $chapter){
                    foreach ($chapter['modules'] as $module){
                        foreach ($module['videos'] as $video){
                            array_push($videoIds, $video['id']);
                        }
                    }
                }
            }

            $user =  $this->apiService->getProfile();
            $user = $user['data'] ?? null;
            $package = $this->apiService->getPackage($packageId, ['include_inactive' => true]);
            $package = $package['data'] ?? null;

            $playlist = [];

            foreach ($package['subjects'] as $subject) {
                foreach ($subject['chapters'] as $chapter) {
                    foreach ($chapter['modules'] as $module) {
                        foreach ($module['videos'] as $playlistVideo) {
                            $playlist[] = $playlistVideo['id'];
                        }
                    }
                }
            }
            $vid=$videoIds[0];
            return redirect('/freemium-videos/'.$vid.'?package='.$packageId.'&freemium_package='.$freemiumId);
        } else {
            return redirect('/contents');
        }
    }
}