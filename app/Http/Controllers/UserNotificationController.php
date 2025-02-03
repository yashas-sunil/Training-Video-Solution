<?php

namespace App\Http\Controllers;

use App\ApiService;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * UserNotificationController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        return $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        if (request()->ajax()) {
            $userNotifications = $this->apiService->getUserNotifications(['unread_only' => true]);
            $userNotifications = $userNotifications['data'] ?? [];

            return response()->json($userNotifications);
        }
    }

    public function markAsRead()
    {
        if (request()->ajax()) {
            $userNotifications = $this->apiService->postUserNotifications();
            $userNotifications = $userNotifications['message'] ?? null;

            return response()->json($userNotifications);
        }
    }
}
