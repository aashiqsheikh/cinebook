<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Theatre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TheatreSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Theatre::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $cities = City::all();

        $theatres = [
            ['name' => 'PVR Phoenix', 'location' => 'Lower Parel', 'total_seats' => 250, 'city_id' => $cities[0]->id],
            ['name' => 'INOX South City', 'location' => 'Saket', 'total_seats' => 180, 'city_id' => $cities[1]->id],
            ['name' => 'PVR Forum Mall', 'location' => 'Koramangala', 'total_seats' => 220, 'city_id' => $cities[2]->id],
            ['name' => 'SPI Palazzo', 'location' => 'Velachery', 'total_seats' => 200, 'city_id' => $cities[3]->id],
            ['name' => 'Cinepolis', 'location' => 'Hitech City', 'total_seats' => 210, 'city_id' => $cities[4]->id],
            ['name' => 'IMAX Nexus', 'location' => 'Mall of Asia', 'total_seats' => 300, 'city_id' => $cities[0]->id],
        ];

        Theatre::insert($theatres);
    }
}

