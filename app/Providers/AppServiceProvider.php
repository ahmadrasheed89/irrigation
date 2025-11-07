<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Scheme, Category, Tender, Portfolio, Noc, Adp};
use App\Policies\BasePolicy;
use App\Policies\AdpPolicy;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $policies = [
        Scheme::class => BasePolicy::class,
        Category::class => BasePolicy::class,
        Tender::class => BasePolicy::class,
        Portfolio::class => BasePolicy::class,
        Noc::class => BasePolicy::class,
        Adp::class => AdpPolicy::class,
    ];
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive(); // Or Paginator::useBootstrapFour() for Bootstrap 4
        //$this->registerPolicies();
    }
}
