<?php

namespace Tests\Feature;

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

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');

        $this->user = User::find(1);
        $this->trip = Trip::whereUserId($this->user['id'])->first();
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

    // public function testValidUserCanAddAndUpdateTask()
    // {
    //     $this->actingAs($this->user);
    //     $this->post('/trip/' . $this->trip['id'] . '/add-task/2', [
    //         'task1' => 'flight',
    //         'task2' => 'hotel'
    //     ])->assertSessionHasNoErrors();

    //    $taskRecord = Task::where('collaborator_id', 2)->first();
    //    $this->assertEquals($taskRecord->task1, 'flight', $taskRecord);
    //    $this->assertEquals($taskRecord->task2, 'hotel', $taskRecord);

    //    $this->post('/trip/' . $this->trip['id'] . '/add-task/2', [
    //         'task1' => 'other',
    //         'task2' => 'excursion'
    //     ])->assertSessionHasNoErrors();

    //     $taskRecord = Task::find($taskRecord['id']);

    //     $this->assertEquals($taskRecord->task1, 'other', $taskRecord);
    //     $this->assertEquals($taskRecord->task2, 'excursion', $taskRecord);
    // }

    // public function testCanRemoveUserFromCollaborationReturnsSuccess()
    // {

    // }

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