<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItineraryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }

    public function testIfUserNotLoggedIn()
    {
        $this->get('trip/1/itinerary')->assertRedirect('/login');
    }

    public function testLoggedInUserCantSeeUnassociatedItinerary()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $trip = Trip::whereUserId($user['id'])->first();
        $response = $this->get('/trip/' . $trip['id']. '/itinerary');

        $response->assertStatus(404);
    }
}