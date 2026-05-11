<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Console\Command;

class GenerateShowsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shows:generate
                            {--days=7 : Number of days in advance to generate shows}
                            {--theatre= : Theatre ID to generate shows for (optional)}
                            {--movie= : Movie ID to generate shows for (optional)}
                            {--force : Overwrite existing shows}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate shows for movies and theatres (skip if exists)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $theatreId = $this->option('theatre');
        $movieId = $this->option('movie');
        $force = $this->option('force');

        $movies = $movieId ? Movie::where('id', $movieId)->get() : Movie::all();
        $theatres = $theatreId ? Theatre::where('id', $theatreId)->get() : Theatre::all();

        if ($movies->isEmpty()) {
            $this->error('No movies found matching the given criteria.');
            return 1;
        }

        if ($theatres->isEmpty()) {
            $this->error('No theatres found matching the given criteria.');
            return 1;
        }

        $times = [
            ['show_time' => '14:30:00', 'price' => rand(200, 500)],
            ['show_time' => '18:00:00', 'price' => rand(250, 550)],
            ['show_time' => '21:30:00', 'price' => rand(300, 600)],
        ];

        $totalIterations = $movies->count() * $theatres->count() * $days * count($times);
        $bar = $this->output->createProgressBar($totalIterations);

        $count = 0;

        foreach ($movies as $movie) {
            foreach ($theatres as $theatre) {
                for ($dayOffset = 1; $dayOffset <= $days; $dayOffset++) {
                    $showDate = now()->addDays($dayOffset)->format('Y-m-d');

                    foreach ($times as $slot) {
                        if ($force || !Show::where('movie_id', $movie->id)
                                           ->where('theatre_id', $theatre->id)
                                           ->where('show_date', $showDate)
                                           ->where('show_time', $slot['show_time'])
                                           ->exists()) {
                            Show::updateOrCreate(
                                [
                                    'movie_id' => $movie->id,
                                    'theatre_id' => $theatre->id,
                                    'show_date' => $showDate,
                                    'show_time' => $slot['show_time'],
                                ],
                                ['price' => $slot['price']]
                            );
                            $count++;
                        }

                        $bar->advance();
                    }
                }
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info("Generated {$count} shows for {$movies->count()} movie(s) across {$theatres->count()} theatre(s) over {$days} day(s).");

        return 0;
    }
}
