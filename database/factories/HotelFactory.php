<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->unique()->email(),
            'number' => fake()->phonenumber(),
            'location' => fake()->address(),
            'description' => fake()->sentence(),
            'business_permit' => '',
            'picture' => '' ,
            'status' => 1,
            'user_id' => User::factory(),
        ];
    }
}
 