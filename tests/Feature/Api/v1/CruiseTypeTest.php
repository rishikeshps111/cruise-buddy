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
    public function setup(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user, ['*']);
        CruiseType::factory(10)->create();
    }
    public function test_fetch_all_cruise_type_api(): void
    {
        $response = $this->getJson('/api/v1/cruise-type');
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
        $response = $this->getJson('/api/v1/cruise-type/' . $id);
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