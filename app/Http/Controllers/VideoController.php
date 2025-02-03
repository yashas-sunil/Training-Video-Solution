<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Session;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentVideoId = $id;
        $orderItemId = request()->input('order_item');
        $freemiumPackage = request()->input('freemium_package');
        $response = $this->apiService->getVideo($id, request()->input());

        if($freemiumPackage){
            $params = array_merge(['type' => 3, 'freemium_id' => $freemiumPackage]);
            $studyMaterials = $this->apiService->getTestPapersOfUserFreemium($params);
            $orderItemId = 0;
        }else{
            $params = array_merge(['type' => 3, 'order_item_id' => $orderItemId]);
            $studyMaterials = $this->apiService->getTestPapersOfOrderItem($params);
        }
        $studyMaterials = $studyMaterials['data'];

        if ($response->status() == 404) {
            abort(404);
        }

        if ($response->status() == 401) {
            abort(401);
        }

        $video = $response['data']['video'] ?? null;

        $params = array_merge(['order_item' => $orderItemId, 'package' => request('package')]);

        $libraryUrl = 'https://cdn.jwplayer.com/libraries/rVFAIHjQ.js?exp=1699340100&sig=40bedcbec58bbe3397951ad2f72a05f4';//$response['data']['library_url'];

        $package = $this->apiService->getPackage(request('package'), ['include_inactive' => true]);
        $package = $package['data'] ?? null;
        
        $is_freemium_package = false;
        $freemium_package_percentage = 0;
        if(!empty($package['is_freemium'])){
            $is_freemium_package = true;
            $freemium_package_percentage = !empty($package['freemium_content']) ? $package['freemium_content'] : 0;
        }

        $playlist = [];
        $totalPackageDuration = 0;
        $module_videos_array = array();
        foreach ($package['subjects'] as $subject) {
            foreach ($subject['chapters'] as $chapter) {
                foreach ($chapter['modules'] as $module) {
                    $module_videos_array[$module['id']] = array('videos' => array());
                    foreach ($module['videos'] as $playlistVideo) {
                        array_push($module_videos_array[$module['id']]['videos'], $playlistVideo);
                        $totalPackageDuration += $playlistVideo['duration'];
                        $playlist[] = $playlistVideo;
                    }
                }
            }
        }

        if (!$package) {
            abort(404);
        }

        $videoID = $video['id'] ?? null;
        $user = $this->apiService->getProfile();
        $user = $user['data'] ?? null;
        $allowed_videos = array();
        
        if($freemiumPackage){
            $freemiumDaysMax = $this->apiService->getSettings(['key' => 'freemium_days_max']);
            $freemiumDaysMax = $freemiumDaysMax['data']['freemium_days_max'] ?? null;
            $freemiumHoursMax = $this->apiService->getSettings(['key' => 'freemium_hours_max']);
            $freemiumHoursMax = $freemiumHoursMax['data']['freemium_hours_max'] ?? null;
            if(!empty($freemium_package_percentage)){
                $allowed_hours = ($totalPackageDuration * ($freemium_package_percentage / 100));
            } else {
                $allowed_hours = !empty($freemiumHoursMax) ? ($freemiumHoursMax * 3600) : 0;
            }
            $video_duration = 0;
            foreach($module_videos_array as $module_info){
                foreach($module_info['videos'] as $mod_video){
                    if($video_duration < $allowed_hours){
                        $allowed_videos[$mod_video['id']] = $mod_video['id'];
                        $video_duration += $mod_video['duration'];
                    }
                }
            }
            return view('pages.videos.show-freemium', compact('video',
                'package',
                'libraryUrl',
                'freemiumDaysMax',
                'freemiumHoursMax',
                'videoID',
                'user',
                'playlist',
                'orderItemId', 'currentVideoId', 'studyMaterials', 'freemiumPackage', 'allowed_videos'
            ));
        }else{
            return view('pages.videos.show', compact('video',
                'package',
                'libraryUrl',
                'videoID',
                'user',
                'playlist',
                'orderItemId', 'currentVideoId', 'studyMaterials', 'allowed_videos'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lastWatchedVideo(Request $request)
    {
        $params = array_merge(['order_item' => request('order_item'), 'package' => request('package')]);

        $lastWatchedVideo = null;
        $lastWatchedVideo = $this->apiService->getLastWatchedVideo($params);

        $lastWatchedVideo = $lastWatchedVideo['data'];

        return response($lastWatchedVideo,200);
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

    public function embedVideo($id)
    {
        $response = $this->apiService->embedVideo($id);

        $video = $response['data'] ?? abort(404);
        $url = $video;
        if(isset($url['type']) && $url['type'] == 'aws-s3'){
            return view('pages.videos.embed.show_s3',$url);
        }     

        return view('pages.videos.embed.show', compact('video'));
    }

    public function getChapterVideos($chapterID, $videoID)
    {
        $chapterVideos = $this->apiService->getChapterVideos($chapterID, $videoID);
        $chapterVideos = $chapterVideos['data'];

        $response = $this->apiService->getVideo($videoID);

        $video = $response['data']['response'] ?? null;
        $libraryUrl = $response['data']['library_url'];

        return view('pages.contents.videos.show', compact('chapterVideos', 'video', 'libraryUrl'));
    }

    public function getPlayer($id,$s3 = null)
    {
        $response = $this->apiService->getPlayer($id,$s3);

        return $response['data'] ?? null;
    }

    public function getNotes()
    {
        $response = $this->apiService->getStudentNotes(request()->input());
        $response = $response['data'] ?? [];

        return response()->json($response);
    }

    public function postNote()
    {
        $response = $this->apiService->postStudentNote(request()->input());
        $response = $response['data'];

        return response()->json($response);
    }

    public function putNote($id)
    {
      
            $response = $this->apiService->updateStudentNote($id, request()->input());
            if(!empty($response['data'])){
                $response = $response['data'];
                return response()->json($response);
            }        
        
    }

    public function deleteNote($id)
    {
        $response = $this->apiService->deleteStudentNote($id);
        if(!empty($response['data'])){
            $response = $response['data'];
            return response()->json($response);
        }        
    }


    public function getQuestions()
    {
        $response = $this->apiService->getAskAQuestions(request()->input());
        $response = $response['data']['data'] ?? [];

        return response()->json($response);
    }

    public function postQuestion()
    {
        $response = $this->apiService->postQuestion(request()->input());
        $response = $response['data'] ?? [];

        return response()->json($response);
    }

    public function deleteQuestion($id)
    {
        $response = $this->apiService->deleteQuestion($id);

        return response()->json($response);
    }

    public function getProfessorNotes()
    {
        $response = $this->apiService->getProfessorNotes(request()->input());
        $response = $response['data'] ?? [];

        return response()->json($response);
    }
    
    public function getvideo($id){
        
        $const = env('ENC_CONST');
        $str = str_replace($const,"/",$id);
      
        if (isset($_SERVER['HTTP_REFERER']) == false) {
            //abort(401);
            $user = $this->apiService->getProfile();
            $user = $user['data'] ?? null;
            if($user){
                request()->session()->forget('access_token');
                return redirect('/');

            }
            else{
                return redirect('/');
            }
        }
        $cipher = env('ENC_CIPHER');
        $secret = env('ENC_SECRET_KEY');
        $option = 0;
        
        $iv = str_repeat("0",openssl_cipher_iv_length($cipher));
        $decryptString = openssl_decrypt($str,$cipher,$secret,$option,$iv);
        $response = $this->apiService->getVideoById($decryptString); 
        $url = $response['data'];

        if(isset($url['type']) && $url['type'] == 'aws-s3'){
            return view('pages.videos.show_video_s3',$url);
        }

        return view('pages.videos.show_video',compact('url'));

    }
    public function get_question_video($id,$time){
        $const = env('ENC_CONST');
        $str = str_replace($const,"/",$id);
      
        if (isset($_SERVER['HTTP_REFERER']) == false) {
            //abort(401);
            $user = $this->apiService->getProfile();
            $user = $user['data'] ?? null;
            if($user){
                request()->session()->forget('access_token');
                return redirect('/');

            }
            else{
                return redirect('/');
            }
        }
    
        $response = $this->apiService->getVideoById($id); 
        $url = $response['data'];
        $time=$time-300;
        return view('pages.videos.show_question_video',compact('url','time'));

    }

}
