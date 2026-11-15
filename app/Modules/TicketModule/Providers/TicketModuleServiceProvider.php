<?php

namespace App\Modules\TicketModule\Providers;

use App\Modules\TicketModule\Contracts\TicketServiceInterface;
use App\Modules\TicketModule\Services\TicketService;
use Illuminate\Support\ServiceProvider;

class TicketModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // RegistrationModule memanggil ticket lewat Contract ini, bukan model langsung
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
    }
}
