<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\User;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItineraryTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $user2;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->user2 = User::factory()->create();
        $this->trip = Trip::factory()->create([
            'city_id' => 1,
            'user_id' => $this->user['id'],
            'name' => 'Test',
            'date_from' => '2022-02-02',
            'date_to' => '2022-02-10'
        ]);

        $this->collaborate = Collaborator::factory()->create([
            'trip_id' => $this->trip['id'],
            'user_id' => $this->user['id'],
            'role' => 'admin'
        ]);

        
    }

    public function testIfUserNotLoggedIn()
    {
        $this->get('trip/1/itinerary')->assertRedirect('/login');
    }

    public function testLoggedInUserCantSeeUnassociatedItinerary()
    {
        $this->actingAs($this->user2);
        $response = $this->get('/trip/' .  $this->collaborate['trip_id'] . '/itinerary');
        $response->assertStatus(404);
    }

    public function testLoggedInUserCanSeeAssociatedtinerary()
    {
        $this->actingAs($this->user);

        $response = $this->get('/trip/' . $this->collaborate['trip_id']. '/itinerary');

        $response->assertStatus(200);
    }

}