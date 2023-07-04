<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchAddressController;
use App\Models\Province;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ApiAddressSearchTest extends TestCase
{
    public function test_get_all_provinces_success(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->get('/search/provinces', [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsArray('data');
    }

    public function test_get_single_province_fail_not_found(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->get('/search/provinces?id=11111111', [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => true,
            'message' => 'Data Not Found',
        ]);
    }

    public function test_get_single_province_fail_auth(): void
    {
        $response = $this->get('/search/provinces?id=11111111', [
            "Accept" => "application/json",
            "Authorization" => 'no',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    public function test_get_single_province_success(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->get('/search/provinces?id=1', [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsObject('data');
    }

    public function test_get_all_cities_success(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->get('/search/cities', [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsArray('data');
    }

    public function test_get_single_city_fail_not_found(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->get('/search/cities?id=11111111', [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => true,
            'message' => 'Data Not Found',
        ]);
    }

    public function test_get_single_city_fail_auth(): void
    {
        $response = $this->get('/search/cities?id=11111111', [
            "Accept" => "application/json",
            "Authorization" => 'no',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    public function test_get_single_city_success(): void
    {
        $login = $this->post('/api/login', [
            "email" => "test@mail.com",
            "password" => "password"
        ], [
            "Accept" => "application/json"
        ])->json();

        $response = $this->get('/search/cities?id=1', [
            "Accept" => "application/json",
            "Authorization" => $login['token_type'] . " " . $login['access_token'],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsObject('data');
    }
}
