<?php

namespace cmwn\Providers;

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
        \cmwn\User::creating(function ($user) {
            echo('creating ');
        });

        // Attach event handler, on deleting of the user
        \cmwn\User::deleting(function($user)
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
