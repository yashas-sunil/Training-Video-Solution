<?php

namespace App\Providers;

use App\ApiService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var ApiService $apiService */
        $apiService = $this->app->make(ApiService::class);

        View::composer('partials.header', function ($view) use ($apiService) {
            $response = $apiService->getCourses(true);
            $courses = $response['data'];
            $view->with('courses', $courses);

            $response = $apiService->getProfessors();
            $professors = $response['data'];
            $view->with('professors', $professors);

            $user = $apiService->getProfile();
            $user = $user['data'] ?? null;
            $view->with('user', $user);

            $userNotifications = $apiService->getUserNotifications();
            $userNotifications = $userNotifications['data'] ?? []; 

//            $userNotifications = collect($userNotifications)->map(function ($notification) {
//                $body = json_decode($notification['notification']['mail_notification_body'], true);
//                if ($body) {
//                    $blocks = $body['blocks'];
//                    $notification['notification']['body_text'] = collect($blocks)->map(function ($block) {
//                        return $block['data']['text'];
//                    })->join(' ');
//
//                }
//                return $notification;
//            });
            $view->with('userNotifications', $userNotifications);

            $response = $apiService->getHighPriorityNotification();
            $notification = $response['data'] ?? null;

            if ($notification && Cookie::has('notification_' . $notification['id'])) {
                $notification = null;
            }

            $view->with('notification', $notification);

        });
        View::composer('layouts.master', function ($view) use ($apiService) {
            $user= $apiService->getProfile()?? null;
            if(isset($user['role'])){
                $view->with('role', $user['role']);
            }
            else{
                $view->with('role', null);
            }

        });
    }
}
