<?php


namespace App\Auth;


class AuthManager
{
    public function isAutheticated()
    {
        return request()->session()->has('access_token');
    }
}
