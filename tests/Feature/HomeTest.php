<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
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
        $this->get('/home')->assertRedirect('/login');
    }

    public function testUserCanSeeHomeIfLoggedIn()
    {
        $user = User::find(2);
        $trips = Trip::whereUserId($user['id'])->first()->toArray();

        $this->actingAs($user);
        $response = $this->get('/home');
        $this->assertTrue($response->isOk());
    }

    public function testUserHasNoTripsWhenLoggedInSeesDefaultMessage()
    {
        $user = User::find(2);

        $this->actingAs($user);

        $view = $this->view('planner.home',
            [
                'trips' => [],
                'section' => 'home',
                'userId' => $user['id']
            ]
        );

        $view->assertSee('This looks empty. Add your trip so it will appear here!');
    }

    public function testUserCanSeeTripsWhenLoggedIn()
    {
        $user = User::find(2);

        $this->actingAs($user);
        $trips = Trip::whereUserId($user['id'])->first()->toArray();

        $view = $this->view('planner.home',
            [
                'trips' => [$trips],
                'section' => 'home',
                'user_id' => $user['id']
            ]
        );

        $view->assertSee($trips['name']);
    }
}