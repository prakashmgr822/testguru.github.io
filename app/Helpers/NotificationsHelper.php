<?php


namespace App\Helpers;


use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsHelper
{
    static function getDetail(DatabaseNotification $notification)
    {

        $data = [];
        switch ($notification->type) {
            case "App\Notifications\TestNotification";
                $data['title'] = $notification->data['title'];
                $data['link'] = route('notifications.edit', $notification->data['id']);
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
