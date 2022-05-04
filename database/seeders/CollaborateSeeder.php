<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollaborateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Collaborator::factory(15)->create()->each(function($collaborator) {
            $trip = \App\Models\Trip::inRandomOrder()->first();

            $collaborator->update([
                'trip_id' => $trip['id'],
                'user_id' => $trip['user_id']
            ]);
        });
    }
}
