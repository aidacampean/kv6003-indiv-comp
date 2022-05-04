<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $trip;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');

        $this->user = User::find(1);
        $this->trip = Trip::whereUserId($this->user['id'])->first();
    }

    public function testIfUserCanCreateIsNotLoggedIn()
    {
        $this->get('trip/create')->assertRedirect('/login');
    }

    public function testUserCanCreateIfLoggedIn()
    {
        $this->actingAs($this->user);
        $response = $this->get('trip/create');
        $response->assertStatus(200);
    }

    public function testStoreReturnsValidationErrorsWhenEmpty()
    {
        $this->actingAs($this->user);
        $response = $this->post('trip/store', [])->assertSessionHasErrors();

        $response->assertStatus(302);
    }

    public function testUserCanStoreTripIfValid()
    {
        $this->actingAs($this->user);
        $response = $this->post('trip/store', [
            'name' => 'New Test',
            'city_id' => 2,
            'date_from' => '2022-07-01',
            'date_to' => '2022-07-10'
        ])->assertSessionHasNoErrors();

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true
            ]);
    }

    public function testUserCanDeleteTrip()
    {
        $this->actingAs($this->user);
        $response = $this->post('trip/store', [
            'name' => 'New Test',
            'city_id' => 2,
            'date_from' => '2022-07-01',
            'date_to' => '2022-07-10'
        ])->assertSessionHasNoErrors();

        $content = json_decode($response->getContent(), true);

        $deleteResponse = $this->get('trip/delete/' . $content['id']);

        $deleteResponse
            ->assertStatus(302);
    }
}
