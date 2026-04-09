<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $cities = [
            ['name' => 'Mumbai', 'slug' => 'mumbai'],
            ['name' => 'Delhi', 'slug' => 'delhi'],
            ['name' => 'Bangalore', 'slug' => 'bangalore'],
            ['name' => 'Chennai', 'slug' => 'chennai'],
            ['name' => 'Hyderabad', 'slug' => 'hyderabad'],
            ['name' => 'Pune', 'slug' => 'pune'],
            ['name' => 'Kolkata', 'slug' => 'kolkata'],
        ];

        City::insert($cities);
    }
}

