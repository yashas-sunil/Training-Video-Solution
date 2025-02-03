<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\ApiService;

class VideoController extends Controller
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

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $video = $this->apiService->showVideo($id);

        $video = $video['data'] ?? null;

        return view('mobile.pages.videos.show', compact('video'));
    }

    public function buy($id)
    {
        if (! request()->has('access_token')) {
            return 'ACCESS TOKEN REQUIRED';
        }

        session()->forget('access_token');
        session()->put('access_token', request('access_token'));

        $video = $this->apiService->getVideo($id);
        $video = $video['data'] ?? null;

        $url = url('mobile/packages?course=' . $video['course_id'] . '&level=' . $video['level_id'] . '&subject=' . $video['subject_id'] . '');

        return redirect($url);
    }
}
