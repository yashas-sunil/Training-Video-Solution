<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ApiService;

class VideoHistoryLogController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * VideoController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }


    public function show(Request $request,$id)
    {
        $video_id=$id;
        $package_id = request()->input('package');
        $order_id = request()->input('order_item');
        $totalDuration = request()->input('totalDuration');
        $remainingPackageDuration=request()->input('remainingPackageDuration');
        $package = $this->apiService->getHistory(['package_id' => $package_id,'video_id' => $id, 'page' =>request()->input('page')]);
        $packages=$package['data'];

        $package_name = $package['data']['data'][0];

        return view('pages.video_history.index', compact('packages','package_name','package_id','totalDuration','remainingPackageDuration','video_id','order_id'));
    }
}
