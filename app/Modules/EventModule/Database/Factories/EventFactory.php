<?php

namespace App\Modules\EventModule\Database\Factories;

use App\Modules\EventModule\Models\Event;
use App\Modules\EventModule\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'event_category_id' => EventCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::lower(Str::random(4)),
            'description' => fake()->paragraph(),
            'event_date' => fake()->dateTimeBetween('+1 week', '+2 months'),
            'location' => fake()->city(),
            'status' => 'open',
        ];
    }
}
