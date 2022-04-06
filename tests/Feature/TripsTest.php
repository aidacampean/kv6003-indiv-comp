<?php

namespace Tests\Feature;

use App\Models\Trip;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_view_trips()
    {
        $trips = Trip::factory(2)->create();

        $response = $this->get('/home');

        // can access the page
        $response->assertSee($trips->date_from);

        // 
    }

}
