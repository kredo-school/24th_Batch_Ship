<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // to get user"s notifications
    public function getNotificationsForUser($userId)
    {
        // to get notifications for the specified user."
        $notifications = Notification::where('notifiable_id', $userId)->get();

        return view('notifications.index', compact('notifications'));
    }

    // mark as read for unread notifications
    public function markAsRead()
    {
        // mark read for auth user"s unread notifications
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
};
