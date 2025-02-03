<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use EditorJS\EditorJSException;
use Illuminate\Http\Request;
use App\ApiService;
use \EditorJS\EditorJS;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->apiService->getBlogs(request()->input());
        $blogs = $response['data'] ?? [];

        $response = $this->apiService->getBlogCategories(request()->input());
        $categories = $response['data'] ?? [];

        $response = $this->apiService->getBlogTags(request()->input());
        $blogTags = $response['data'] ?? [];

        SEOMeta::setTitle("Blogs | JK Shah Online");

        return view('pages.blogs.index', compact('blogs', 'categories', 'blogTags'));
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
        $response = $this->apiService->getBlog($id);
        $blog = $response['data']['blog'] ?? null;
        $userId = $response['data']['userId'] ?? null;

        $response = $this->apiService->getBlogCategories(request()->input());
        $categories = $response['data'] ?? [];

        if (! $blog) {
            abort(404);
        }

        $blogUserIds = [];

        foreach ($blog['likes'] as $like){
            array_push($blogUserIds, $like['user_id']);
        }

        $body = json_decode($blog['body'], true);
        $blocks = $body['blocks'];

        $blog['body'] = collect($blocks)->map(function ($block) {
            switch ($block['type']) {
                case 'header':
                    $level = $block['data']['level'] ?? 1;
                    return '<h'.$level.'>'.$block['data']['text'].'</h'.$level.'>';
                case 'paragraph':
                    return '<p>'.$block['data']['text'].'</p>';
                case 'image':
                    $classes = [
                        'border' => $block['data']['withBorder'],
                        'bg-light' => $block['data']['withBackground'],
                        'justify-content-center' => $block['data']['withBackground'],
                        'p-2' => $block['data']['withBackground'],
                    ];

                    $classes = collect($classes)->filter()->keys()->join(' ');

                    $img_Classes = [
                        'w-100' => $block['data']['stretched'],
                    ];

                    $img_Classes = collect($img_Classes)->filter()->keys()->join(' ');

                    $caption = $block['data']['caption'];

                    $html = '';

                    if ($block['data']['file']) {
                        if ($caption) {
                            $html =  '<div class="d-flex '.$classes.'"><img class="img-fluid '.$img_Classes.'" src="'.$block['data']['file']['url'].'"  alt="'.$caption.'" /></div>';
                        } else {
                            $html =  '<div class="d-flex '.$classes.'"><img class="img-fluid mb-5'.$img_Classes.'" src="'.$block['data']['file']['url'].'"  alt="'.$caption.'" /></div>';
                        }
                    }

                    if ($caption) {
                        $html .= "<small class='d-block text-center text-muted mb-5'>$caption</small>";
                    }

                    return $html;
            }
        })->join('');

        $response = $this->apiService->getBlogTags(request()->input());
        $blogTags = $response['data'] ?? [];

        SEOMeta::setTitle($blog['title']);
        SEOMeta::setDescription($blog['title']);

        return view('pages.blogs.show', compact('blog', 'categories', 'blogTags', 'blogUserIds', 'userId'));
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

    public function like(int $id)
    {
        $response = $this->apiService->likeBlog($id);
        $response = $response['data'] ?? null;

        return response()->json($response);
    }
    public function blogview(){
        return view("blogs.blog_view");
    }
}
