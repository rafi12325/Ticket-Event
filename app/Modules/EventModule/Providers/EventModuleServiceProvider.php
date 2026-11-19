<?php

namespace App\Modules\EventModule\Providers;

use App\Shared\Contracts\EventServiceInterface;
use App\Modules\EventModule\Services\EventService;
use Illuminate\Support\ServiceProvider;

class EventModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Komunikasi antar modul: modul lain memakai Event lewat Contract ini
        $this->app->bind(EventServiceInterface::class, EventService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
    }
}
