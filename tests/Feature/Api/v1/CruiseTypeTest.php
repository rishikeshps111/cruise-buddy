<?php

namespace Tests\Feature\Api\v1;

use Tests\TestCase;
use App\Models\User;
use App\Models\CruiseType;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CruiseTypeTest extends TestCase
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
        Sanctum::actingAs($this->user, ['*']);
        CruiseType::factory(10)->create();
        $this->headers = [
            'CRUISE_AUTH_KEY' => env('CRUISE_AUTH_KEY')
        ];
    }
    public function test_fetch_all_cruise_type_api(): void
    {
        $response = $this->withHeaders($this->headers)->getJson('/api/v1/cruise-type');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'modelName',
                        'type'
                    ]
                ]
            ]);
    }
    public function test_fetch_cruise_type_api(): void
    {
        $id = CruiseType::inRandomOrder()->first()->id;
        $response = $this->withHeaders($this->headers)->getJson('/api/v1/cruise-type/' . $id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'modelName',
                    'type'
                ]
            ]);
    }
}
