<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ratings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::where('is_admin', false)->get();
        $movies = Movie::all();

        foreach ($users as $user) {
            foreach ($movies->shuffle()->take(3) as $movie) {
                DB::table('ratings')->insertOrIgnore([
                    'movie_id' => $movie->id,
                    'user_id' => $user->id,
                    'rating' => rand(1, 5),
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}

