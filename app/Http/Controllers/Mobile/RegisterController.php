<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mobile.pages.register.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('mobile.pages.register.success');
    }
}
