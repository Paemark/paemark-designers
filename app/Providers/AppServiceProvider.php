<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        // Globally allow "Super Admin" role to pass all permission checks
        Gate::before(function (User $user, string $ability) {
            return $user->hasRole('admin') ? true : null;
        });
        
    }
}
