<?php

namespace App\Providers;

use App\Policies\AdminPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrapFive();

        Gate::policy(User::class, AdminPolicy::class);
    }
}
