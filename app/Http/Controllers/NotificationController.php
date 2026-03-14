<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        $user->unreadNotifications->markAsRead();

        $notifications = $user->notifications;

        return view('notifications.index', compact('notifications'));
    }
}
