<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adp>
 */
class AdpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adp_code' => strtoupper($this->faker->unique()->bothify('ADP-####')),
            'allocation' => $this->faker->randomFloat(2, 1000000, 10000000),
            'adp_t_s_cost' => $this->faker->randomFloat(2, 100000, 5000000),
            'total_expenditure' => $this->faker->randomFloat(2, 50000, 4000000),
            'accured_liability' => $this->faker->randomFloat(2, 30000, 2000000),
            //'user_id' => User::factory(),
        ];
    }
}
