<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $bindings =  [
        \App\Services\Contracts\FungiContract::class => \App\Services\FungiService::class,
        \App\Services\Contracts\AuthContract::class => \App\Services\AuthService::class,
        \App\Services\Contracts\UserContract::class => \App\Services\UserService::class
    ];

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
        //
    }
}
