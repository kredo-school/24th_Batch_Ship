<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Get notifications for the authenticated user
    public function getNotificationsForUser()
    {
        // Debug: Ensure that the authenticated user ID is correct
        if (Auth::check()) {
            $userId = Auth::id();  // Get the authenticated user's ID
            // You can remove this debug line once confirmed
            // dd($userId);  // Check if the correct user ID is being used
        } else {
            return redirect()->route('login');  // Redirect to login if the user is not authenticated
        }

        // Retrieve notifications for the authenticated user and paginate the results
        $notifications = Notification::where('notifiable_id', $userId)->paginate(10);

        // Pass notifications to the view
        return view('notifications.index', compact('notifications'));
    }

    // Mark all unread notifications as read for the authenticated user
    public function markAsRead()
    {
        // Retrieve unread notifications for the authenticated user
        $unreadNotifications = Auth::user()->unreadNotifications;

        // Check if there are any unread notifications, then mark them as read
        if ($unreadNotifications->isNotEmpty()) {
            $unreadNotifications->markAsRead();
        }

        // Redirect back to the previous page after marking notifications as read
        return redirect()->back();
    }
}
