<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $trip;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->user = User::find(1);
        $this->trip = Trip::whereUserId($this->user['id'])->first();
    }

    public function testStoreEventReturnsValidationErrorsWhenEmpty()
    {
        $this->actingAs($this->user);
        $this->post('trip/add-event', [])->assertSessionHasErrors('name');
    }

    public function testValidUserCanStoreEvent()
    {
        $this->actingAs($this->user);
        $response = $this->post('trip/add-event', [
            'id' => $this->trip['id'],
            'user_id' => $this->user['id'],
            'name' => 'Test',
            'description' => 'This is a test',
            'notes' => 'This is a test',
            'date' => '2022-10-10',
        ])->assertSessionHasNoErrors();

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
            ]);
    }

    public function testValidUserCanUpdateEvent()
    {
        $this->actingAs($this->user);
        $response = $this->post('trip/add-event', [
            'id' => $this->trip['id'],
            'user_id' => $this->user['id'],
            'name' => 'Test',
            'description' => 'This is a test',
            'notes' => 'This is a test',
            'date' => '2022-10-10',
        ]);
        
        $response
        ->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
        ]);

    }
}