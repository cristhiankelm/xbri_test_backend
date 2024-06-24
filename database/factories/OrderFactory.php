<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('email', 'admin@xbri.com')->first()->id,
            'client_id' => Client::factory(),
            'total_amount' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
