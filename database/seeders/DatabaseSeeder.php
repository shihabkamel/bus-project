<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create some users
        User::factory()->count(5)->create();

        // Create a bus
        $bus = Bus::create([
            'name' => 'Luxury Bus',
            'plate_number' => 'ABC-1234',
            'capacity' => 40,
        ]);

        // Create a trip for the bus
        $trip = Trip::create([
            'bus_id' => $bus->id,
            'route' => 'Dhaka → Gaibandha',
            'departure_time' => now()->addDays(1),
            'available_seats' => $bus->capacity,
        ]);

        // Create a booking for the trip
        Booking::create([
            'trip_id' => $trip->id,
            'user_id' => User::first()->id,
            'seat_number' => 1,
        ]);
    }
}
