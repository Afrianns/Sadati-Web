<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('authen', function (User $user) {
            // dd(Auth::guest());
            return Auth::guest();
        });

        Gate::define('admin', function (User $user) {
            return $user->isAdmin;
        });

        Gate::define('authNoAdmin', function(User $user) {
            return $user->exists && !$user->isAdmin;
        });


        Gate::define('edit_user', function(User $user, User $param_user){
            return $user->id == $param_user->id;
        });


    }
}
