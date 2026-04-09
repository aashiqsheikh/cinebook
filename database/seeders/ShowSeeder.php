<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Show::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $theatres = Theatre::all();
        $movies = Movie::all();

        foreach ($theatres as $theatre) {
            foreach ($movies as $movie) {
                Show::create([
                    'movie_id' => $movie->id,
                    'theatre_id' => $theatre->id,
                    'show_date' => now()->addDays(rand(1, 7)),
                    'show_time' => '14:30:00',
                    'price' => rand(200, 500),
                ]);

                Show::create([
                    'movie_id' => $movie->id,
                    'theatre_id' => $theatre->id,
                    'show_date' => now()->addDays(rand(1, 7)),
                    'show_time' => '18:00:00',
                    'price' => rand(250, 550),
                ]);

                Show::create([
                    'movie_id' => $movie->id,
                    'theatre_id' => $theatre->id,
                    'show_date' => now()->addDays(rand(1, 7)),
                    'show_time' => '21:30:00',
                    'price' => rand(300, 600),
                ]);
            }
        }
    }
}

