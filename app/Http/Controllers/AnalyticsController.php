<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function returnScript(Request $request)
    {
        if(isset($request->amount)) {
            return view('meta-includes.purchase')->with([
                'parameter' => $request->parameter,
                'amount' => $request->amount
            ]);
        } 
            
        return view('meta-includes.meta')->with('parameter', $request->parameter);
               
    }
}
