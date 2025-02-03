<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class FreeResourceController extends Controller
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

    public function index(Request $request)
    {
        $tab = $request->filled('tab') ? $request->input('tab') : 'videos';
        $page = $request->filled('page') ? $request->input('page') : '1';


//        if($request->input('selected_type')==1){
//            $tab = 'videos';
//        }
//        elseif($request->input('selected_type')==2){
//            $tab = 'documents';
//        }
        $type =  $tab;

        if($request->search_tab){
            $tab = $request->search_tab;
        }
        if($request->filled('filter_type')){
            $tab = $request->input('filter_type');
        }
        if($request->filled('tab')){
            $tab = $request->input('tab');
        }
        if($request->filled('resource_type')){
            $tab = $request->input('resource_type');
        }

        $levelIds = $request->input('level_ids') ?? [];
        $professorIds = $request->input('professor_ids') ?? [];

          
        
        $freeResourcesVideos = $this->apiService->getFreeResources([
            'type' => 'videos',
            'selected_type' =>$request->input('type'),
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'professor' => $request->input('professor'),
            'search' => $request->input('search'),
            'limit' => 12,
            'page' => $page,
            'levels' => $request->input('level_ids'),
            'professors' => $request->input('professor_ids'),
            'sort' => $request->input('sort')
        ]);

        $freeResourcesVideos = $freeResourcesVideos['data'];

        $freeResourcesVideos = new LengthAwarePaginator(
            $freeResourcesVideos['data'],
            $freeResourcesVideos['total'],
            $freeResourcesVideos['per_page'],
            $freeResourcesVideos['current_page'],
            $options = [
                'path' => '/ca-demo-lectures-online?tab=videos'
            ]
        );

        if ($request->ajax()) {

            if($request->input('tab') == 'videos'){

        $freeResourcesVideos = $this->apiService->getFreeResources([
            'type' => 'videos',
            'selected_type' =>$request->input('type'),
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'professor' => $request->input('professor'),
            'search' => $request->input('search'),
            'limit' => 12,
            'page' => $request->input('page'),
            'levels' => $request->input('level_ids'),
            'professors' => $request->input('professor_ids'),
            'sort' => $request->input('sort')
        ]);

        $freeResourcesVideos = $freeResourcesVideos['data'];

        $freeResourcesVideos = new LengthAwarePaginator(
            $freeResourcesVideos['data'],
            $freeResourcesVideos['total'],
            $freeResourcesVideos['per_page'],
            $freeResourcesVideos['current_page'],
            $options = [
                'path' => '/ca-demo-lectures-online?tab=videos'
            ]
        );

        
        if(count($freeResourcesVideos)>0){

            foreach($freeResourcesVideos as $free_resource){

                $data = '' ;
                
                if($free_resource['type'] == 5 ){

                    $a_embed = url("embed/videos/".$free_resource['media_id']) ;
                    $iframe_img = "https://cdn.jwplayer.com/v2/media/".$free_resource['media_id']."/poster.jpg?width=320 ";

                    $data .= '  <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="course-demo">
                                        <a class="popup-iframe" href="'.$a_embed.'">
                                            <img src="'.$iframe_img.'" loading="lazy">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </a>
                                        <div class="demo-details p-md-3">
                                            <h4>'.$free_resource['title'].'</h4>
                                        </div>
                                    </div>
                                </div>';

                }elseif($free_resource['type'] == 1 ){
               
                    $a_test_rev =  url('linked_packages',$free_resource['id']);
                    $a_test_href = "http://www.youtube.com/watch?v=".$free_resource['youtube_id'] ;
                    $img_rev = "https://img.youtube.com/vi/".$free_resource['youtube_id']."/mqdefault.jpg";
                    $data .= '  <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="course-demo">
                                        <a title="test" rev="'.$a_test_rev.'" class="popup-iframe" href="'.$a_test_href.'">
                                            <img src="'.$img_rev.'">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </a>
                                        <div class="demo-details p-md-3">
                                            <h4>'.$free_resource['title'].'</h4>
                                        </div>
                                    </div>
                                </div>' ;
                }

                $array[]=$data;

            }
        }else{
                $array = [] ;
        }


        return $array;
              

    }if($request->input('tab') =='documents'){

        $freeResourcesDocuments = $this->apiService->getFreeResources([
            'type' => 'documents',
            'selected_type' =>$request->input('type'),
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'professor' => $request->input('professor'),
            'search' => $request->input('search'),
            'limit' => 12,
            'page' => $request->input('page'),
            'levels' => $request->input('level_ids'),
            'professors' => $request->input('professor_ids'),
            'sort' => $request->input('sort')
        ]);

        $freeResourcesDocuments = $freeResourcesDocuments['data'];

        $freeResourcesDocuments = new LengthAwarePaginator(
            $freeResourcesDocuments['data'],
            $freeResourcesDocuments['total'],
            $freeResourcesDocuments['per_page'],
            $freeResourcesDocuments['current_page'],
            $options = [
                'path' => '/ca-demo-lectures-online?tab=documents'
            ]
        );

        if(count($freeResourcesDocuments)>0){

            foreach($freeResourcesDocuments as $freeResourcesDocument){
                $data = '' ;
                if($freeResourcesDocument['type'] == 3 ){
                    $data .= '<div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="doc-demo">
                                    <embed name="plugin" src="'.$freeResourcesDocument['file_url'].'" type="application/pdf">
                                    <a class="text-decoration-none" target="_blank" download="'.$freeResourcesDocument['file'].'" href="'.$freeResourcesDocument['file_url'].'">
                                        <div class="demo-details p-md-3">
                                            <h4>'.$freeResourcesDocument['title'].'</h4>
                                            <span>new</span>
                                        </div>
                                    </a>
                                </div>
                            </div>';
                }

                $array[]=$data;
            }
        }else{
            $array= [];
        }

        return $array;
    }

    }

        $freeResourcesDocuments = $this->apiService->getFreeResources([
            'type' => 'documents',
            'selected_type' =>$request->input('type'),
            'course' => $request->input('course'),
            'level' => $request->input('level'),
            'professor' => $request->input('professor'),
            'search' => $request->input('search'),
            'limit' => 12,
            'page' => $page,
            'levels' => $request->input('level_ids'),
            'professors' => $request->input('professor_ids'),
            'sort' => $request->input('sort')
        ]);

        $freeResourcesDocuments = $freeResourcesDocuments['data'];

        $freeResourcesDocuments = new LengthAwarePaginator(
            $freeResourcesDocuments['data'],
            $freeResourcesDocuments['total'],
            $freeResourcesDocuments['per_page'],
            $freeResourcesDocuments['current_page'],
            $options = [
                'path' => '/ca-demo-lectures-online?tab=documents'
            ]
        );

        $levels = $this->apiService->getLevels();
        $levels = $levels['data'];

        $languages = $this->apiService->getLanguages();
        $languages = $languages['data'];

        $professors = $this->apiService->getProfessors();
        $professors = $professors['data'];

        SEOMeta::setTitle("Free CA Demo Online Video Lectures | JK Shah Online");
        SEOMeta::setDescription("JK Shah provides free demo online video lectures for CA Final & CA Inter related courses. Enroll now to experience high-quality audio&video learning sessions.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/ca-demo-lectures-online");




        return view('pages.free-resources.index', compact( 'levels', 'languages',
            'freeResourcesVideos', 'freeResourcesDocuments', 'professors', 'tab','page', 'levelIds', 'professorIds'));
    }

    public function show($id)
    {
//
    }

    public function downloadDocument()
    {
        try {
            return response()->streamDownload(function () {
                echo file_get_contents(request()->input('url'));
            }, request()->input('title') . '.' . pathinfo(request()->input('file'), PATHINFO_EXTENSION));
        } catch (\Exception $exception) {
            abort(404);
        }
    }
    public function linked_packages($id){

        $datapk=array('free_resource_id'=>$id);
        $linkedpackages=$this->apiService->getLinkedPackages($datapk);
        $linkpkg=$linkedpackages['data'] ?? null;
        $pkg_count=0;
        if($linkpkg){
        $pkg_count=count( $linkpkg);                        
        if($pkg_count==1){
            $ln=$linkpkg['0'];
            $package_id=$ln['package_id'];
            return redirect('packages/'.$package_id);
        }
        else{
            foreach($linkpkg as $packages){
                $linked_packages_id[]=$packages['package_id'];
                
            }
           // $linked_packages_id=implode(',',$linked_packages_id);
            //return redirect('packages?'.$linked_packages_id);
            return redirect('packages')->with( ['linked_packagedata' => $linked_packages_id] );
        }
        
    }
    else{
        return redirect('packages');
    }

    }
}
