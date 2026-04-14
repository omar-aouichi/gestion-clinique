<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Mock repositories have been removed. All data access is now handled
     * directly via Eloquent Models in the Service classes.
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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (auth()->check()) {
                $notifications = \App\Models\Notification::where('destinataire_id', auth()->id())
                    ->where('lu', false)
                    ->orderBy('date_envoi', 'desc')
                    ->take(5)
                    ->get();
                $unreadCount = \App\Models\Notification::where('destinataire_id', auth()->id())
                    ->where('lu', false)
                    ->count();
                $view->with('unreadNotifications', $notifications)->with('unreadCount', $unreadCount);
            }
        });
    }
}
