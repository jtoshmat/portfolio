<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Uuid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        \app\User::creating(function ($user) {
            $user->uuid = Uuid::uuid1();
        });

        // Attach event handler, on deleting of the user
        \app\User::deleting(function ($user) {
            echo('deleting from AppServiceProvider ');
            $user->districts()->detach();
            $user->organizations()->detach();
            $user->groups()->detach();
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
