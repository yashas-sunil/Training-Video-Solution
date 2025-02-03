<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function captchacontactcheck()
    {
        $captcha=Session::get('captcha');
        $rules = ['captcha_contact' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        
        if ($validator->fails()) {
            Session::put('captcha',$captcha);
            return 'false';
        } else {
            Session::put('captcha',$captcha);
            return 'true';
        }
    }
    public function captchasignupcheck()
    {
        $captcha=Session::get('captcha');
        $rules = ['captcha_signup' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
       
        if ($validator->fails()) {  
            Session::put('captcha',$captcha);         
            return 'false';
        } else {
            Session::put('captcha',$captcha);
            return 'true';
        }
    }
    public function captchalogincheck()
    {
        $captcha=Session::get('captcha');
        $rules = ['captcha_login' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        
        if ($validator->fails()) {
           Session::put('captcha',$captcha) ;
            return 'false';
        } else {
           Session::put('captcha',$captcha);
            return 'true';
        }
    }
    public function captchacallmecheck()
    {
        $captcha=Session::get('captcha');
        $rules = ['captcha_callme' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        
        if ($validator->fails()) {
            Session::put('captcha',$captcha);
            return 'false';
        } else {
            Session::put('captcha',$captcha);
            return 'true';
        }
    }
    public function captcha_forgotcheck(){
        $captcha=Session::get('captcha');
        $rules = ['captcha_forgot' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
       
        if ($validator->fails()) {
            Session::put('captcha',$captcha);
            return 'false';
        } else {
            Session::put('captcha',$captcha);
            return 'true';
        }

    }
}
