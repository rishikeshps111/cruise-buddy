<?php

namespace Tests\Feature\Api\v1;

use Tests\TestCase;
use App\Models\User;
use App\Models\Owner;
use App\Models\Cruise;
use App\Models\Location;
use App\Models\CruiseType;
use App\Models\CruisesImage;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CruiseTest extends TestCase
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
        User::factory(10)->create();
        $this->user  = User::first();
        Sanctum::actingAs($this->user, ['*']);
        Owner::factory()->create();
        Location::factory(5)->create();
        CruiseType::factory(5)->create();
        Cruise::factory(50)->create();
        CruisesImage::factory(200)->create();
        $this->headers = [
            'CRUISE_AUTH_KEY' => env('CRUISE_AUTH_KEY')
        ];
    }
    public function test_fetch_all_cruise_api(): void
    {
        $response = $this->withHeaders($this->headers)->getJson('api/v1/cruise');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'rooms',
                        'maxCapacity',
                        'description',
                        'isActive'
                    ]
                ]
            ]);
    }
    public function test_fetch_cruise_api(): void
    {
        $id = Cruise::first()->id;
        $response = $this->withHeaders($this->headers)->getJson('api/v1/cruise/' . $id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'rooms',
                    'maxCapacity',
                    'description',
                    'isActive'
                ]
            ]);
    }
}
