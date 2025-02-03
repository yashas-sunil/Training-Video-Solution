<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function handleApiError(\Illuminate\Http\Client\Response $response) {
        if ($response->successful()) {
            return null;
        }

        if ($response->status() == 401) {
            return new AuthenticationException('Unauthenticated.', [], '/');
        }

        if ($response->status() == 422) {
            throw ValidationException::withMessages($response->offsetGet('errors'));
        }

        if ($response->clientError()) {
            return redirect()->back()->withInput()->with('error', $response->offsetGet('message'));
        }

        abort($response->status());
    }
}
