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
                            {--force : Overwrite existing shows}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate shows for all movies and theatres (skip if exists)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $movies = Movie::all();
        $theatres = Theatre::all();
        $force = $this->option('force');

        $bar = $this->output->createProgressBar($movies->count() * $theatres->count());

        $count = 0;

        foreach ($movies as $movie) {
            foreach ($theatres as $theatre) {
                $times = [
                    ['show_time' => '14:30:00', 'price' => rand(200, 500)],
                    ['show_time' => '18:00:00', 'price' => rand(250, 550)],
                    ['show_time' => '21:30:00', 'price' => rand(300, 600)],
                ];

                foreach ($times as $slot) {
                    $showDate = now()->addDays(rand(1, 7))->format('Y-m-d');

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
                }

                $bar->advance();
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info("Generated {$count} shows.");
    }
}
