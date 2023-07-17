<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('*', function ($view) {
            if (auth()->check()) {
                
                $notifications = auth()->user()->unreadnotifications;
                
                $notificationCount = $notifications->count();
                $view->with([
                    'notifications' => $notifications,
                    'notificationCount' => $notificationCount,
                    // Add other variables here
                ]);
            }
        });
    }
    

    
}
