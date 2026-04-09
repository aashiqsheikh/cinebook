<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            TheatreSeeder::class,
            MovieSeeder::class,
            ShowSeeder::class,
            UserSeeder::class,
            BookingSeeder::class,
            RatingSeeder::class,
        ]);

        $this->callCommand('shows:generate');
    }
}

