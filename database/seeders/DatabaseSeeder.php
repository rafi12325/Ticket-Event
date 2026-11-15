<?php

namespace Database\Seeders;

use App\Modules\EventModule\Database\Seeders\EventModuleSeeder;
use App\Modules\RegistrationModule\Database\Seeders\RegistrationModuleSeeder;
use App\Modules\TicketModule\Database\Seeders\TicketModuleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Database\Seeders\UserSeeder::class,
            EventModuleSeeder::class,
            TicketModuleSeeder::class,
            RegistrationModuleSeeder::class,
        ]);
    }
}
