<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Response;

class ApiLoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    /** @test */
    public function it_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('fgf111@2'), // Ensure the password matches
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'fgf111@2', // Ensure this matches the registered password
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'data' => ['id', 'name', 'email'],
                     'token',
                 ]);
    }

    public function it_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
                 ->assertJson([
                     'message' => 'Unauthorized',
                 ]);
    }

    public function it_can_logout()
    {
        $user = User::factory()->create([
            'password' => bcrypt('fgf111@2'),
        ]);

        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/logout');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'status' => 'success',
                     'data' => 'successLogout',
                 ]);
    }

}
