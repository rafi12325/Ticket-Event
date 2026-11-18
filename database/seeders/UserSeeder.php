<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Credential demo (tulis juga di README)
        User::create([
            'name' => 'Budi Prasetyo',
            'email' => 'admin@eventku.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'peserta@eventku.test',
            'password' => Hash::make('password'),
            'role' => 'participant',
        ]);
    }
}
