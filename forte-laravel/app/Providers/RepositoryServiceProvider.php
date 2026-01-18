<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\ReportService;
use App\Services\RaspiService;
use App\Repositories\UserRepository;
use App\Repositories\ReportRepository;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\ServiceProvider;

/**
 * RepositoryServiceProvider: Register semua repository ke service container
 * Mengikuti principle of Dependency Injection
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register Repositories
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->bind(ReportRepository::class, function ($app) {
            return new ReportRepository(new Report());
        });

        // Register Services
        $this->app->singleton(UserService::class);
        $this->app->singleton(ReportService::class);
        $this->app->singleton(RaspiService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
