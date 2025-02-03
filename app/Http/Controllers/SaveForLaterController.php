<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;

class SaveForLaterController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * SaveForLaterController constructor.
     * @param ApiService $apiService
     */
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
        $items = $this->apiService->getSaveForLater();

        $items = $items['data'] ?? [];

        $packages = $this->apiService->getFullPackages(['limit' => 11]);
        $packages = $packages['data'] ?? [];
        $miniPackages = $this->apiService->getMiniPackages(['limit' => 11]);
        $miniPackages = $miniPackages['data'] ?? [];
        SEOMeta::setTitle("Save for Later | JK Shah Online");
        SEOMeta::setDescription("Save your courses/packages which you want to buy later from Jk Shah Classes online.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/save-for-later");

        return view('pages.cart.save-for-later', compact('items', 'packages', 'miniPackages'));
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
        $uuID = $this->getCartUUID();

        $response = $this->apiService->postSaveForLater(array_merge($request->input(),['uuid'=>$uuID]));

        $response = $response['data'] ?? null;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $response = $this->apiService->deleteSaveForLater($id);

        $response = $response['data'] ?? null;

        return response()->json($response);
    }

    function getCartUUID() {
        $uuid = Session::get('cart_uuid');

        if (! $uuid) {
            $uuid = Str::uuid();
            Session::put('cart_uuid', $uuid);
        }

        return $uuid;
    }
     public function remove(Request $request)
     {
         $response = $this->apiService->deleteFromWishList(array_merge($request->input()));

         return response()->json($response);
     }
}
