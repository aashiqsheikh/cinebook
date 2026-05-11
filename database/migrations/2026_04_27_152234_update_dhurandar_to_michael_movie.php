<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $oldTitle = 'Dhurandar the Revenge';
        $newTitle = 'Michael';

        $movie = DB::table('movies')
            ->where('title', 'LIKE', '%' . $oldTitle . '%')
            ->orWhere('title', 'LIKE', '%dhurandar%')
            ->first();

        if ($movie) {
            DB::table('movies')
                ->where('id', $movie->id)
                ->update([
                    'title' => $newTitle,
                    'description' => 'The story of Michael Jackson, from his rise to fame as the King of Pop to his complex personal life and legendary performances. Directed by Antoine Fuqua.',
                    'duration' => 155,
                    'genre' => 'Biography',
                    'release_date' => '2025-10-03',
                    'poster' => 'https://m.media-amazon.com/images/M/MV5BODUwYTNlNjUtOWIzOS00YzQyLWI4NjQtY2Y1MzkyODcwNzM4XkEyXkFqcGc@._V1_.jpg',
                    'updated_at' => now(),
                ]);
        } else {
            // If not found, insert as a new upcoming movie
            DB::table('movies')->insert([
                'title' => $newTitle,
                'description' => 'The story of Michael Jackson, from his rise to fame as the King of Pop to his complex personal life and legendary performances. Directed by Antoine Fuqua.',
                'duration' => 155,
                'genre' => 'Biography',
                'release_date' => '2025-10-03',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BODUwYTNlNjUtOWIzOS00YzQyLWI4NjQtY2Y1MzkyODcwNzM4XkEyXkFqcGc@._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('movies')
            ->where('title', 'Michael')
            ->where('release_date', '2025-10-03')
            ->update([
                'title' => 'Dhurandar the Revenge',
                'description' => 'An epic tale of revenge and redemption.',
                'duration' => 120,
                'genre' => 'Action',
                'release_date' => '2025-12-01',
                'poster' => null,
                'updated_at' => now(),
            ]);
    }
};

