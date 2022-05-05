<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        //$this->artisan('db:seed');
        $this->user = User::factory()->create();
        $this->trip = Trip::factory()->create([
            'city_id' => 1,
            'user_id' => $this->user['id'],
            'name' => 'Test',
            'date_from' => '2022-02-02',
            'date_to' => '2022-02-10'
        ]);
    }

    public function testIfUserNotLoggedIn()
    {
        $this->get('/home')->assertRedirect('/login');
    }

    public function testUserCanSeeHomeIfLoggedIn()
    {
        $this->actingAs($this->user);
        $response = $this->get('/home');
        $this->assertTrue($response->isOk());
    }

    public function testUserHasNoTripsWhenLoggedInSeesDefaultMessage()
    {
        $this->actingAs($this->user);

        $view = $this->view('planner.home',
            [
                'trips' => [],
                'section' => 'home',
                'userId' => $this->user['id']
            ]
        );

        $view->assertSee('This looks empty. Add your trip so it will appear here!');
    }

    public function testUserCanSeeTripsWhenLoggedIn()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $view = $this->view('planner.home',
            [
                'trips' => [$this->trip],
                'section' => 'home',
                'user_id' => $this->user['id']
            ]
        );

        $view->assertSee($this->trip['name']);
    }
}