<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_countries()
    {
        $response = $this->getJson('/country');

        $response->assertStatus(200);
    }

    public function test_add_country_validation()
    {
        $response = $this->withoutMiddleware()->postJson('/country', []);

        $response->assertStatus(422);
    }

    public function test_add_country()
    {
        $response = $this->withoutMiddleware()
            ->postJson('/country', ['name' => 'Belarus', 'capital' => 'Minsk']);

        $response->assertStatus(200);
    }

    public function test_delete_country()
    {
        $country = Country::create(['name' => 'Dummy country', 'capital' => 'Capital']);
        $response = $this->withoutMiddleware()->deleteJson("/country/{$country->id}");

        $response->assertOk();
    }
}
