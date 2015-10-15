<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \app\User::creating(function ($user) {
            echo('creating ');
        });

        // Attach event handler, on deleting of the user
        \app\User::deleting(function($user)
        {
            echo('deleting from AppServiceProvider ');
            $user->districts()->detach();
            $user->organizations()->detach();
            $user->groups()->detach();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
