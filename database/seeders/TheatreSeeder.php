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
            // Mumbai (city_id 1)
            ['name' => 'PVR Phoenix', 'location' => 'Lower Parel', 'total_seats' => 250, 'city_id' => $cities[0]->id],
            ['name' => 'IMAX Nexus', 'location' => 'Mall of Asia', 'total_seats' => 300, 'city_id' => $cities[0]->id],
            ['name' => 'INOX R-City', 'location' => 'Ghatkopar', 'total_seats' => 180, 'city_id' => $cities[0]->id],
            ['name' => 'Cinepolis Viva', 'location' => 'Thane', 'total_seats' => 220, 'city_id' => $cities[0]->id],
            ['name' => 'PVR Oberoi', 'location' => 'Goregaon', 'total_seats' => 260, 'city_id' => $cities[0]->id],
            ['name' => 'Big Cinemas', 'location' => 'Andheri', 'total_seats' => 190, 'city_id' => $cities[0]->id],

            // Delhi (city_id 2)
            ['name' => 'INOX South City', 'location' => 'Saket', 'total_seats' => 180, 'city_id' => $cities[1]->id],
            ['name' => 'PVR Select Citywalk', 'location' => 'Saket', 'total_seats' => 240, 'city_id' => $cities[1]->id],
            ['name' => 'Cinepolis Pacific', 'location' => 'Subhash Nagar', 'total_seats' => 210, 'city_id' => $cities[1]->id],
            ['name' => 'SRS Cinemas', 'location' => 'Janakpuri', 'total_seats' => 150, 'city_id' => $cities[1]->id],
            ['name' => 'PVR Vegas', 'location' => 'Dwarka', 'total_seats' => 280, 'city_id' => $cities[1]->id],

            // Bangalore (city_id 3)
            ['name' => 'PVR Forum Mall', 'location' => 'Koramangala', 'total_seats' => 220, 'city_id' => $cities[2]->id],
            ['name' => 'INOX Garuda Mall', 'location' => 'Jayanagar', 'total_seats' => 200, 'city_id' => $cities[2]->id],
            ['name' => 'Cinepolis Royal Meenakshi', 'location' => 'Bannerghatta', 'total_seats' => 230, 'city_id' => $cities[2]->id],
            ['name' => 'PVR VR Bengaluru', 'location' => 'Whitefield', 'total_seats' => 270, 'city_id' => $cities[2]->id],
            ['name' => 'Big Cinemas', 'location' => 'Mantri Square', 'total_seats' => 160, 'city_id' => $cities[2]->id],

            // Chennai (city_id 4)
            ['name' => 'SPI Palazzo', 'location' => 'Velachery', 'total_seats' => 200, 'city_id' => $cities[3]->id],
            ['name' => 'PVR Gold', 'location' => 'Anna Nagar', 'total_seats' => 240, 'city_id' => $cities[3]->id],
            ['name' => 'INOX Chennai Citi Centre', 'location' => 'Rajiv Gandhi Salai', 'total_seats' => 190, 'city_id' => $cities[3]->id],
            ['name' => 'Cinepolis EVP', 'location' => 'Poonamallee', 'total_seats' => 210, 'city_id' => $cities[3]->id],

            // Hyderabad (city_id 5)
            ['name' => 'Cinepolis', 'location' => 'Hitech City', 'total_seats' => 210, 'city_id' => $cities[4]->id],
            ['name' => 'PVR Inorbit', 'location' => 'Hitech City', 'total_seats' => 250, 'city_id' => $cities[4]->id],
            ['name' => 'Miraj Cinemas', 'location' => 'Gachibowli', 'total_seats' => 180, 'city_id' => $cities[4]->id],
            ['name' => 'INOX South Main', 'location' => 'Banjara Hills', 'total_seats' => 220, 'city_id' => $cities[4]->id],

            // Pune (city_id 6)
            ['name' => 'INOX Amanora Mall', 'location' => 'Hadapsar', 'total_seats' => 230, 'city_id' => $cities[5]->id],
            ['name' => 'PVR Pavilion', 'location' => 'Phoenix Marketcity', 'total_seats' => 260, 'city_id' => $cities[5]->id],
            ['name' => 'Cinepolis Westend', 'location' => 'Pune Station', 'total_seats' => 200, 'city_id' => $cities[5]->id],

            // Kolkata (city_id 7)
            ['name' => 'INOX South City Mall', 'location' => 'Prince Anwar Shah Road', 'total_seats' => 190, 'city_id' => $cities[6]->id],
            ['name' => 'PVR Logix', 'location' => 'New Town', 'total_seats' => 240, 'city_id' => $cities[6]->id],
        ];



        Theatre::insert($theatres);
    }
}


