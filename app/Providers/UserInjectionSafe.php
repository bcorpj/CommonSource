<?php

namespace App\Providers;

use App\Custom\Role\RoleProvider;
use App\Custom\Role\UserEditSafe;
use Illuminate\Support\ServiceProvider;

class UserInjectionSafe extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleProvider::class, function () {
            return new RoleProvider(request());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
