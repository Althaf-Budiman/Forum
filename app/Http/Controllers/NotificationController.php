<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function notificationView()
    {
        // All notifications data
        $notifications = Notification::where('user_id', auth()->user()->id)
            ->orderByDesc('created_at')
            ->get();

        // Unread notifications data
        $unreadNotifications = Notification::where('user_id', auth()->user()->id)
            ->where('read', false)
            ->orderByDesc('created_at')
            ->get();

        // Mark all read
        foreach ($unreadNotifications as $unreadNotification) {
            $unreadNotification->update([
                'read' => true,
                'read_at' => Carbon::now()
            ]);
        }

        return view('notification-list', compact('notifications'));
    }
}
