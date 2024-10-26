<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phoneNumber = $this->faker->e164PhoneNumber;
        $countryCode = substr($phoneNumber, 0, 3);
        $phone = substr($phoneNumber, 3);

        return [
            'user_id' => User::factory(),
            'proof_type' => fake()->randomElements(['aadhar','passport','voter_id','driving_license']),
            'proof_id' => fake()->randomNumber(5, true),
            'proof_image' => fake()->imageUrl(),
            'countryCode' => $countryCode,
            'additional_phone' => $phone,
        ];
    }
}
