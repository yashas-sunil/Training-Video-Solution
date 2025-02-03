<?php

namespace App\Http\Controllers;

use App\ApiService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CanNotFindEnquireController extends Controller
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
   
   
   
    /** Set can not find session for pop up display
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
       session()->put('cannotfind', 1);

       return session()->get('cannotfind');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(session()->has('access_token')){
        $validated = $request->validate([
            
            'cannotfind_fname' => 'required',
            'cannotfind_lname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'descript'=>'required|max:255',
            'form'=>'required|string'
        ]);
       }else{
        $validated = $request->validate([
            'cannotfind_otp_token' => 'required',
            'cannotfind_otp_code' => 'required|numeric',
            'cannotfind_fname' => 'required',
            'cannotfind_lname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'descript'=>'required|max:255',
            'form'=>'required|string'
        ]);
       }
        
       
        $response = $this->apiService->canNotFindEnquire($validated);

        if (! $response->successful()) {
           
            if ($response->status() == 422) {

                $data['message']=$response->offsetGet('errors');
                $data['status']=0;
                return $data;
                
               // return redirect()->back()->withInput()->with('error', $response->offsetGet('errors'));
            } else if ($response->clientError()) {
              
               $data['message']=$response->offsetGet('message');
                $data['status']=0;
                return $data;
               // return redirect()->back()->withInput()->with('error', $response->offsetGet('message'));
            } else {
                return $response;
                $data['message']='Server error, Please try later';
                $data['status']=0;
                return $data;
               
                //return redirect()->back()->withInput()->with('error', 'Server error, Please try later');
            }
            //info($response->status());
        }else{
            $data['message']='Enquiry has submitted successfully.';
            $data['status']=1;
            return $data;
           
           // return redirect()->back()->withInput()->with('success',$response['data']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
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
}
