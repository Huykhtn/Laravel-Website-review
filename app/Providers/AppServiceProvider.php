<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Auth\Notifications\ResetPassword;

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
        // ResetPassword::createUrlUsing(function (string $token) {
        //     return 'https://127.0.0.1:8000/reset-password?token='.$token;
        // });
    }
}
