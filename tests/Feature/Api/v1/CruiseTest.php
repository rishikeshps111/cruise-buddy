<?php

namespace Tests\Feature\Api\v1;

use App\Models\Cruise;
use App\Models\CruisesImage;
use App\Models\CruiseType;
use App\Models\Location;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CruiseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected $user;
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
    }
    public function test_fetch_all_cruise__api(): void
    {
        $response = $this->getJson('api/v1/cruise');
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
    public function test_fetch_cruise__api(): void
    {
        $id = Cruise::first()->id;
        $response = $this->getJson('api/v1/cruise/' . $id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'rooms',
                    'maxCapacity',
                    'description',
                    'isActive',
                    'images' => [
                        '*' => [
                            'id',
                            'cruiseId',
                            'cruiseImg',
                            'alt'
                        ]
                    ]
                ]
            ]);
    }
}
