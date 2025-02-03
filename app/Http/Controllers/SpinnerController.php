<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.spinners.index');
    }

    public function calculate_price(){
        return 5;
    }
}
