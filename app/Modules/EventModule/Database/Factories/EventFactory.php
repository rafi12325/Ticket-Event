<?php

namespace App\Modules\EventModule\Database\Factories;

use App\Modules\EventModule\Models\Event;
use App\Modules\EventModule\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    // Nama event yang realistis untuk data dummy
    private const TITLES = [
        'Seminar Teknologi Digital 2026',
        'Workshop Desain UI/UX untuk Pemula',
        'Konser Jazz Malam Amikom',
        'Festival Musik Indie Yogyakarta',
        'Career Day Mahasiswa D3',
        'Lomba Startup Mahasiswa Nasional',
        'Pelatihan Public Speaking Gen Z',
        'Kompetisi Esport Mahasiswa',
        'Webinar Data Science untuk Pemula',
        'Bazar UMKM Kreatif Jogja',
        'Seminar Kewirausahaan Digital',
        'Workshop Fotografi Dasar',
        'Turnamen Futsal Antar Kampus',
        'Talkshow Industri Kreatif',
    ];

    // Lokasi yang realistis
    private const LOCATIONS = [
        'Auditorium Universitas Amikom Yogyakarta',
        'Jogja Expo Center',
        'Alun-alun Kidul Yogyakarta',
        'Grha Cakrawala UGM',
        'Convention Hall Surabaya',
        'Balai Kartini Jakarta',
        'Sasana Budaya Ganesha Bandung',
        'Semarang Creative Gallery',
        'Gedung Sate Bandung',
        'Taman Budaya Yogyakarta',
    ];

    public function definition(): array
    {
        $title = fake()->unique()->randomElement(self::TITLES);

        return [
            'event_category_id' => EventCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::lower(Str::random(4)),
            'description' => fake('id_ID')->paragraph(),
            'event_date' => fake()->dateTimeBetween('+1 week', '+2 months'),
            'location' => fake()->randomElement(self::LOCATIONS),
            'status' => 'open',
        ];
    }
}
