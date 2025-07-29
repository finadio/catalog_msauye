<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (Auth::check()) {
            $unreadNotifications = Auth::user()->unreadNotifications;
            $unreadCount = $unreadNotifications->count();
            $recentNotifications = $unreadNotifications->take(5);

            $view->with([
                'unreadNotificationsCount' => $unreadCount,
                'recentNotifications' => $recentNotifications
            ]);
        } else {
            $view->with([
                'unreadNotificationsCount' => 0,
                'recentNotifications' => collect()
            ]);
        }
    }
}
