<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginLogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'user_type' => 'admin',
            'status' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }

    public function test_users_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'status' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ]);

        $this->assertGuest();
    }

    public function test_users_cannot_login_when_inactive()
    {
        $user = User::factory()->create([
            'email' => 'testinactive@example.com',
            'password' => bcrypt('password123'),
            'status' => false,
            'user_type' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => 'testinactive@example.com',
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
    }

    public function test_users_can_logout()
    {
        $user = User::factory()->create([
            'status' => true,
        ]);

        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_login_throttling()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'status' => true,
        ]);

        // Make 3 attempts (matches maxAttempts in LoginController)
        foreach (range(1, 3) as $attempt) {
            $response = $this->post('/login', [
                'email' => 'test@example.com',
                'password' => 'wrong_password',
            ]);
        }

        // Make one more attempt to trigger throttle
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertStringContainsString(
            'Too many login attempts',
            session()->get('errors')->first('email')
        );
    }
}
