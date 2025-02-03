<?php

namespace App\Http\Middleware;

use App\ApiService;
use Closure;

class CheckAuthenticatedMiddleware
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * ContentController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response =  $this->apiService->getProfile();

        if($response->status() == 401){
            return redirect('logout');
        }

        return $next($request);

    }
}
