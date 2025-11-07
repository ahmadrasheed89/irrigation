<?php

namespace Database\Factories;

use App\Models\Tender;
use App\Models\Scheme;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenderFactory extends Factory
{
    protected $model = Tender::class;

    public function definition()
    {
        return [
            //'scheme_id' => Scheme::factory(),
            //'category_id' => Category::factory(),
            'description' => $this->faker->sentence,
            'date' => $this->faker->date(),
            'attached_files' => null,
            //'user_id' => User::factory(),
        ];
    }
}
