<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    public function test_login_fail_wrong_credential(): void
    {
        $response = $this->post('/api/login', [
            "email" => "test_fail@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthorized.'
        ]);
    }

    public function test_login_success(): void
    {
        $response = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => true,
            'access_token' => true,
            'token_type' => true,
        ]);
    }

    public function test_register_fail_validation(): void
    {
        User::where('email', 'test_ex@mail.com')->delete();

        $response = $this->post('/api/register', [
            "email" => "test_ex@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'name' => true,
        ]);
        $response->assertJsonIsArray('name');
    }

    public function test_register_success(): void
    {
        User::where('email', 'test_ex@mail.com')->delete();

        $response = $this->post('/api/register', [
            "name" => "test ex",
            "email" => "test_ex@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => true,
            'access_token' => true,
            'token_type' => true,
        ]);
        $response->assertJsonIsObject('data');
    }

    public function test_logout_success(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->post('/api/logout', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => true
        ]);
    }
}
