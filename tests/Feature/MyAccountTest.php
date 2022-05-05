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

        $this->user = User::factory()->create();
    }

    public function testIfUserNotLoggedIn()
    {
        $this->get('account')->assertRedirect('/login');
    }

    public function testUserCanNavigateToMyAccount()
    {
        $this->actingAs($this->user);
        $response = $this->get('/account');
        $response->assertStatus(200);
    }

    public function testUserCanUpdateEmail()
    {
        $this->actingAs($this->user);
        $response = $this->post('/account/store-email/', [
            'email' => 'test@nottaken.com'
        ])->assertSessionHasNoErrors();
        $update = User::where('email', 'test@nottaken.com')->first();
        $this->assertNotEquals($update->email, $this->user['email']);
        $response->assertStatus(302);
    }

    public function testUserCanUpdatePassword()
    {
        $newPassword = 'tester1234567';
        $confirm = 'tester1234567';

        $this->actingAs($this->user);
        $response = $this->post('/account/store-password/', [
            'current_password' => 'test',
            'new_password' => $newPassword,
            'confirm_new_password' => $confirm
        ]);

        $currentPass = User::where('id', $this->user['id'])->first();
        $this->assertNotEquals($currentPass->password, $this->user['password']);
        $response->assertStatus(302);
    }

    public function testUserCannotUpdatePasswordIfCurrentPasswordEmpty()
    {
        $this->actingAs($this->user);
        $response = $this->post('/account/store-password/', [
            'current_password' => '',
            'new_password' => 'tester123',
            'password_confirmation' => 'tester123'
        ])->assertSessionHasErrors('current_password');

        $response->assertRedirect('/');
    }
}