<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\NotificationComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register notification composer for navigation
        View::composer('layouts.navigation', NotificationComposer::class);
        View::composer('admin.*', NotificationComposer::class);
        View::composer('umkm.*', NotificationComposer::class);
    }
}
