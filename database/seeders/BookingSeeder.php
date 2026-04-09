<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Booking::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::where('is_admin', false)->get();
        $shows = Show::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Booking::create([
                    'user_id' => $user->id,
                    'show_id' => $shows->random()->id,
                    'seat_number' => 'A' . rand(1, 20),
                    'payment_id' => 'PAY_' . strtoupper(substr(md5(rand()), 0, 10)),
                    'payment_status' => ['pending', 'paid', 'failed'][rand(0, 2)],
                    'total_price' => rand(250, 600),
                ]);
            }
        }
    }
}

