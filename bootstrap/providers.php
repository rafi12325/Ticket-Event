<?php

use App\Modules\EventModule\Providers\EventModuleServiceProvider;
use App\Modules\RegistrationModule\Providers\RegistrationModuleServiceProvider;
use App\Modules\TicketModule\Providers\TicketModuleServiceProvider;
use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    EventModuleServiceProvider::class,
    TicketModuleServiceProvider::class,
    RegistrationModuleServiceProvider::class,
];
