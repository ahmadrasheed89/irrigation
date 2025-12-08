<?php

namespace Database\Factories;

use App\Models\Scheme;
use App\Models\Contractor;
use App\Models\User;
use App\Models\Adp;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchemeFactory extends Factory
{
    protected $model = Scheme::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'sub_work_t_s_cost' => $this->faker->randomFloat(2, 10000, 1000000),
            'expenditure' => $this->faker->randomFloat(2, 10000, 1000000),
            'liability' => $this->faker->randomFloat(2, 10000, 1000000),
            'physical_progress' => $this->faker->randomFloat(2, 0, 100),
            'financial_progress' => $this->faker->randomFloat(2, 0, 100),
            //'contractor_id' => Contractor::factory(),
            'contractor_premium' => $this->faker->randomFloat(2, 0, 5000),
            'bid_cost' => $this->faker->randomFloat(2, 0, 5000),
            //'user_id' => User::factory(),
            //'adp_id' => Adp::factory(),
        ];
    }
}
