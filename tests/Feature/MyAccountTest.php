<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class MyAccountTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
        $this->user = User::find(1);
    }

    public function testIfUserNotLoggedIn()
    {
        $this->get('account')->assertRedirect('/login');
    }

    public function testUserCanNavigateToMyAccount()
    {
        $this->actingAs($this->user);
        //$trip = Trip::whereUserId($user['id'])->first();
        $response = $this->get('/account');

        $response->assertStatus(200);
    }

    // not right endpoint
    public function testUserCanUpdateEmail()
    {
        $this->actingAs($this->user);
        $response = $this->post('/account/store-email/', [
            'email' => 'test@nottaken.com'
        ])->assertSessionHasNoErrors();
        $update = User::where('email', 'test@nottaken.com')->first();
        $this->assertEquals($update->email,'test@nottaken.com');

        $response->assertStatus(302);
    }

    // not right endpoint
    public function testUserCanUpdatePassword()
    {
        $newPassword = 'tester1234567';
        $confirm = 'tester1234567';

        $this->actingAs($this->user);
        $response = $this->post('/account/store-password/', [
            'password' => 'test',
            'new_password' => $newPassword,
            'password_confirmation' => $confirm
        ]);
        $currentPass = User::where('password', 'test')->first();
        $this->assertEquals($currentPass->password,'test', $currentPass);

        $this->assertEquals($confirm, $newPassword, $confirm);
        $response->assertStatus(302);
    }

    // public function testUserCannotUpdatePasswordIfCurrentPasswordEmpty()
    // {
    //     $this->actingAs($this->user);
    //     $response = $this->post('/account/store-password/', [
    //         'current_password' => '',
    //         'new_password' => 'tester123',
    //         'password_confirmation' => 'tester123'
    //     ]);

    //     $update = User::where('email', 'test@nottaken.com')->first();
    //     $this->assertEquals($update->email,'test@nottaken.com', $update);

    //     $response->assertRedirect('/');
    // }
}