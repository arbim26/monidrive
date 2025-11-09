<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $payload = [
            'username' => 'bima',
            'email' => 'bima@example.com',
            'password' => 'password123',
            'role' => 'driver',
            'phone' => '08123456789',
            'preferred_language' => 'id',
        ];

        $response = $this->postJson('/api/users', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'username', 'email']]);
    }

    /** @test */
    public function it_can_list_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'username', 'email']]]);
    }

    /** @test */
    public function it_can_show_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['username' => $user->username]);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'username' => 'updated_username',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['username' => 'updated_username']);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");
        $response->assertStatus(204);
    }
}
