<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/indipay/response',
        '/payment-failure',
        '/payment-status',
        '/easebuzz-payment-failure',
        '/easebuzz-payment-status',
        'balance-orders/success',
        'balance-orders/failure',
        'easebuzz-webhook-notify'
    ];
}
