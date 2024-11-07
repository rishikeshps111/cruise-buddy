<?php

namespace Tests\Feature\Api\v1;

use Tests\TestCase;
use App\Models\User;
use App\Models\Location;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected $user;
    protected $headers;
    public function setup(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Location::factory(10)->create();
        Sanctum::actingAs($this->user, ['*']);
        $this->headers = [
            'CRUISE_AUTH_KEY' => env('CRUISE_AUTH_KEY')
        ];
    }
    public function test_fetch_all_location_api(): void
    {
        $response = $this->withHeaders($this->headers)->getJson('/api/v1/location');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'district',
                        'state',
                        'country',
                        'mapUrl'
                    ]
                ]
            ]);
    }
    public function test_fetch_location_api(): void
    {
        $id = Location::inRandomOrder()->first()->id;
        $response = $this->withHeaders($this->headers)->getJson('/api/v1/location/' . $id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'district',
                    'state',
                    'country',
                    'mapUrl'
                ]
            ]);
    }
}
