<?php

namespace App\Modules\EventModule\Database\Factories;

use App\Modules\EventModule\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventCategoryFactory extends Factory
{
    protected $model = EventCategory::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Seminar', 'Workshop', 'Musik', 'Olahraga', 'Komunitas']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
