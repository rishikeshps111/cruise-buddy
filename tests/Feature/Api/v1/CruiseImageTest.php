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

class CruiseImageTest extends TestCase
{
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
    public function test_fetch_all_cruise_image_api(): void
    {
        $response = $this->withHeaders($this->headers)->getJson('api/v1/cruise-images');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'cruiseId',
                        'cruiseImg',
                        'alt'
                    ]
                ]
            ]);
    }
    public function test_fetch_cruise_image_api(): void
    {
        $id = CruisesImage::first()->id;
        $response = $this->withHeaders($this->headers)->getJson('api/v1/cruise-images/' . $id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'cruiseId',
                    'cruiseImg',
                    'alt'
                ]
            ]);
    }
}
