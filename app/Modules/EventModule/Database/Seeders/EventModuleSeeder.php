<?php

namespace App\Modules\EventModule\Database\Seeders;

use App\Modules\EventModule\Models\Event;
use App\Modules\EventModule\Models\EventCategory;
use Illuminate\Database\Seeder;

class EventModuleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = EventCategory::factory()->count(5)->create();

        // recycle(): 10 event memakai-ulang 5 kategori yang sudah ada,
        // bukan membuat kategori baru setiap kali Event::factory() dipanggil
        Event::factory()->count(10)->recycle($categories)->create();
    }
}
