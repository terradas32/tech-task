<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Chema',
            'surname' => 'Terradas',
            'email' => 'chema@terradas.org',
            'phone' => '123456789',
            'country' => 'Spain',
            'gender' => 'male',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'chema@terradas.org']);
    }

    public function test_users_can_be_listed()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_single_user_can_be_fetched()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);
    }

    public function test_user_can_be_updated()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_email_must_be_unique()
    {
        User::factory()->create(['email' => 'chema@terradas.org']);

        $response = $this->postJson('/api/users', [
            'name' => 'Chema',
            'surname' => 'Terradas',
            'email' => 'chema@terradas.org',
            'phone' => '123456789',
            'country' => 'Spain',
            'gender' => 'male',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_required_fields_are_validated()
    {
        $response = $this->postJson('/api/users', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'name',
            'surname',
            'email',
            'phone',
            'country',
            'gender',
            'password',
        ]);
    }

    public function test_email_must_be_valid()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Chema',
            'surname' => 'Terradas',
            'email' => 'not-an-email',
            'phone' => '123456789',
            'country' => 'Spain',
            'gender' => 'male',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_password_must_be_confirmed()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Chema',
            'surname' => 'Terradas',
            'email' => 'mismatch@example.com',
            'phone' => '123456789',
            'country' => 'Spain',
            'gender' => 'male',
            'password' => 'secret123',
            'password_confirmation' => 'different123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }

    public function test_gender_must_be_one_of_allowed_values()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Chema',
            'surname' => 'Terradas',
            'email' => 'invalidgender@example.com',
            'phone' => '123456789',
            'country' => 'Spain',
            'gender' => 'unknown', // invalid
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['gender']);
    }
}
