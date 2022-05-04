<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItineraryTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
        $this->user = User::find(1);
    }

    public function testIfUserNotLoggedIn()
    {
        $this->get('trip/1/itinerary')->assertRedirect('/login');
    }

    public function testLoggedInUserCantSeeUnassociatedItinerary()
    {
        $this->actingAs($this->user);
        $trip = Collaborator::where('user_id', '!=', $this->user['id'])->first();
        $response = $this->get('/trip/' . $trip['id']. '/itinerary');

        $response->assertStatus(404);
    }

    public function testLoggedInUserCanSeeAssociatedtinerary()
    {
        $this->actingAs($this->user);
        $collab = Collaborator::whereUserId($this->user['id'])->first();

        $response = $this->get('/trip/' . $collab['trip_id']. '/itinerary');

        $response->assertStatus(200);
    }
}