<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function notificationView()
    {
        $readNotifications = Notification::where('user_id', auth()->user()->id)
            ->where('read', true)
            ->orderByDesc('created_at')
            ->get();

        $unreadNotifications = Notification::where('user_id', auth()->user()->id)
            ->where('read', false)
            ->orderByDesc('created_at')
            ->get();

        foreach ($unreadNotifications as $unreadNotification) {
            $unreadNotification->update([
                'read' => true
            ]);
        }

        return view('notification-list', compact('unreadNotifications', 'readNotifications'));
    }
}
