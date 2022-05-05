<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\Task;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollaborateTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $trip;
    private $collaborate;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->user = User::factory()->create();
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
        $this->get('trip/1/collaborate')->assertRedirect('/login');
    }

    public function testUserCanSeeCollaborateIfLoggedIn()
    {
        $this->actingAs($this->user);
        $response = $this->get('/trip/' . $this->trip['id']. '/collaborate');
        $response->assertStatus(200);
    }

    public function testErrorDisplayedIfNoTripExists()
    {
        $this->actingAs($this->user);
        $response = $this->get('/trip/1000/collaborate');
        $response->assertStatus(404);
    }

    public function testInviteFormDisplays()
    {
        $this->actingAs($this->user);
        $this->get('/trip/' . $this->trip['id'] . '/invite')->assertStatus(200);
    }

    public function testStoreInviteReturnsValidationErrorsWhenEmpty()
    {
        $this->actingAs($this->user);
        $this->post('/trip/' . $this->trip['id'] . '/invite', [])->assertSessionHasErrors('email');
    }

    public function testValidUserCanStoreInvite()
    {
        $this->actingAs($this->user);
        $response = $this->post('/trip/' . $this->trip['id'] . '/invite', [
            'email' => 'test@test.com'
        ])->assertSessionHasNoErrors();

        $inviteRecord = UserInvitation::where('email', 'test@test.com')->first();

        $this->assertEquals($inviteRecord->email,'test@test.com', $inviteRecord);
        $response->assertRedirect('/trip/' . $this->trip['id'] . '/invite');
    }

    public function testValidUserCanAddAndUpdateTask()
    {
        $this->actingAs($this->user);
        $this->post('/trip/' . $this->trip['id'] . '/add-task/' . $this->collaborate['id'], [
            'task1' => 'flight',
            'task2' => 'hotel'
        ])->assertSessionHasNoErrors();

        $taskRecord = Task::where('collaborator_id', $this->collaborate['id'])->first();

       $this->assertEquals($taskRecord->task1, 'flight', $taskRecord);
       $this->assertEquals($taskRecord->task2, 'hotel', $taskRecord);
       $this->post('/trip/' . $this->trip['id'] . '/add-task/' . $this->collaborate['id'], [
            'task1' => 'other',
            'task2' => 'excursion'
        ])->assertSessionHasNoErrors();

        $taskRecord = Task::find($taskRecord['id']);

        $this->assertEquals($taskRecord->task1, 'other', $taskRecord);
        $this->assertEquals($taskRecord->task2, 'excursion', $taskRecord);
    }

    public function testCanRemoveUserFromCollaborationReturnsSuccess()
    {
        $this->actingAs($this->user);

        $record = Collaborator::whereTripId($this->trip['id'])->first();
        $response = $this->get('trip/' . $this->trip['id'] . '/destroy-collaborator/' . $record['id']);

        $response
            ->assertSessionHas('success')
            ->assertStatus(302);
    }

    public function testCanRemoveAnInvitation()
    {
        $this->actingAs($this->user);
        $this->post('/trip/' . $this->trip['id'] . '/invite', [
            'email' => 'test@test.com'
        ]);

        $inviteRecord = UserInvitation::where('email', 'test@test.com')->first();
        $response = $this->get('trip/' . $this->trip['id'] . '/destroy-invite/' . $inviteRecord->id);
        $response
            ->assertSessionHas('success')
            ->assertStatus(302);
    }
}