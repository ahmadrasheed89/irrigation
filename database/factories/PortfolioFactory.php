<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'file_path' => null,
            //'user_id' => User::factory(),
        ];
    }
}
