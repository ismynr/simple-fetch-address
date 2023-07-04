<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchAddressController;
use App\Models\Province;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ApiAddressSearchTest extends TestCase
{
    public function test_get_all_provinces_success(): void
    {
        $response = $this->get('/search/provinces');

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsArray('data');
    }

    public function test_get_single_province_fail(): void
    {
        $response = $this->get('/search/provinces?id=11111111');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => true,
            'message' => 'Data Not Found',
        ]);
    }

    public function test_get_single_province_success(): void
    {
        $response = $this->get('/search/provinces?id=1');

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsObject('data');
    }

    public function test_get_all_cities_success(): void
    {
        $response = $this->get('/search/cities');

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsArray('data');
    }

    public function test_get_single_city_fail(): void
    {
        $response = $this->get('/search/cities?id=11111111');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => true,
            'message' => 'Data Not Found',
        ]);
    }

    public function test_get_single_city_success(): void
    {
        $response = $this->get('/search/cities?id=1');

        $response->assertStatus(200);
        $response->assertJson([
            'error' => false,
            'message' => 'Success',
        ]);
        $response->assertJsonIsObject('data');
    }
}
