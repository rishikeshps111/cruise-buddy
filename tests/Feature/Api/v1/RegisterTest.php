<?php

namespace Tests\Feature\Api\v1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected $headers;
    public function setup(): void
    {
        parent::setUp();
        $this->headers = [
            'CRUISE_AUTH_KEY' => env('CRUISE_AUTH_KEY')
        ];
    }

    public function test_new_users_can_register_via_api(): void
    {
        $response = $this->withHeaders($this->headers)->post('api/v1/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' =>  'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    "id",
                    "name",
                    "email",
                    "phoneNumber"
                ],
                "token"
            ]);
    }
}
