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

        $this->user = User::factory()->create();
        $this->trip = Trip::factory()->create([
            'city_id' => 1,
            'user_id' => $this->user['id'],
            'name' => 'Test',
            'date_from' => '2022-02-02',
            'date_to' => '2022-02-10'
        ]);
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

        $content = json_decode($response->getContent(), true);

        $updateResponse = $this->post('trip/update-event/' . $content['id'], [
            'name' => 'Testing the update',
            'description' => 'This is a test to ensure update works',
            'notes' => 'Just a test'
        ]);

        $eventRecord = Event::find($content['id']);

        $this->assertEquals($eventRecord->name, 'Testing the update', $eventRecord);
        $this->assertEquals($eventRecord->description, 'This is a test to ensure update works', $eventRecord);

        $updateResponse
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
            ]);
    }

    public function testValidUserCanDeleteEvent()
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

        $content = json_decode($response->getContent(), true);

        $deleteResponse = $this->get('trip/destroy-event/' . $content['id']);

        $deleteResponse
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
            ]);
    }
}