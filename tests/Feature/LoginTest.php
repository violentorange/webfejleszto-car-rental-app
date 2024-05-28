<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_returns_error_with_invalid_credentials(): void
    {


        $response = $this->postJson('/api/login', [
            'email' => 'nonexistinguser@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(401);
    }

    public function test_login_returns_token_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'existinguser@test.com',
            'password' => Hash::make('12345678'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'existinguser@test.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
             'token',
        ]);
    }
}
