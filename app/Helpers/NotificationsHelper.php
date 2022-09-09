<?php


namespace App\Helpers;


use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsHelper
{
    static function getDetail(TestNotification $notification)
    {
        $data = [];
        switch ($notification->type) {
            case "App\Notifications\TestNotification";
                $data['title'] = $notification->data['title'];
                $data['link'] = route('notifications.show', $notification->data['id']);
                $data['notification'] = $notification;
                break;
            case "App\Notifications\AdminNewBlogNotification";
                $data['title'] = $notification->data['title'];
                $data['link'] = route('front.blog-details', $notification->data['id']);
                $data['notification'] = $notification;
                break;
            default:
                break;
        }
        return $data;
    }

    static function unreadCount()
    {
        return Auth::user()->unreadNotifications->count();
    }
}
