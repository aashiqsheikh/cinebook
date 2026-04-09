<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Movie::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $movies = [
            [
                'title' => 'Dunkirk',
                'description' => 'Allied soldiers from Belgium, the British Empire and France are surrounded by the German Army, and evacuate during a fierce battle in World War II.',
                'duration' => 106,
                'genre' => 'Action',
                'release_date' => '2024-01-15',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNGYyZGM5MGMtZDY1NS00NjQ5LWFhZDAtNWY2YmE3YzZiMWQ2XkEyXkFqcGc@._V1_.jpg',
            ],
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'duration' => 152,
                'genre' => 'Action',
                'release_date' => '2024-02-01',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg',
            ],
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'duration' => 148,
                'genre' => 'Sci-Fi',
                'release_date' => '2024-02-15',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
            ],
            [
                'title' => 'Interstellar',
                'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity survival.',
                'duration' => 169,
                'genre' => 'Sci-Fi',
                'release_date' => '2024-03-01',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGc@._V1_.jpg',
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'duration' => 142,
                'genre' => 'Drama',
                'release_date' => '2024-03-15',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGc@._V1_.jpg',
            ],
            [
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'duration' => 154,
                'genre' => 'Crime',
                'release_date' => '2024-04-01',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGc@._V1_.jpg',
            ],
        ];

        Movie::insert($movies);
    }
}

