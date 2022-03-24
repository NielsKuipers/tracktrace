<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('admin', function (User $user) {
            return $user->role == 'admin';
        });

        Gate::define('read/write', function (User $user) {
            if ($user->role == 'admin' || $user->role == 'administrative')
                return true;
            else
                return false;
        });

        Gate::define('company', function (User $user) {
            return $user->has_company != null;
        });
    }
}
