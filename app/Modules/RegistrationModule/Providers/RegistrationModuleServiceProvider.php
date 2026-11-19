<?php

namespace App\Modules\RegistrationModule\Providers;

use App\Shared\Contracts\RegistrationServiceInterface;
use App\Modules\RegistrationModule\Events\TicketPurchased;
use App\Modules\RegistrationModule\Listeners\SendTicketConfirmationListener;
use App\Modules\RegistrationModule\Services\RegistrationService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class RegistrationModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RegistrationServiceInterface::class, RegistrationService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');

        // Domain Event: komunikasi antar modul via event, bukan akses langsung
        Event::listen(TicketPurchased::class, SendTicketConfirmationListener::class);
    }
}
