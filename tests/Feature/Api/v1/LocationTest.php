<?php

namespace Tests\Feature\Api\v1;

use App\Models\Location;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected $user;
    public function setup(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Location::factory(10)->create();
        Sanctum::actingAs($this->user, ['*']);
    }
    public function test_fetch_all_location_api(): void
    {
        $response = $this->getJson('/api/v1/location');
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
        $response = $this->getJson('/api/v1/location/' . $id);
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
