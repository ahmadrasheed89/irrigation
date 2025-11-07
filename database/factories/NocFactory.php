<?php

namespace Database\Factories;

use App\Models\Noc;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NocFactory extends Factory
{
    protected $model = Noc::class;

    public function definition()
    {
        return [
            'issue_no' => strtoupper($this->faker->unique()->bothify('NOC-####')),
            'department' => $this->faker->word,
            'remarks' => $this->faker->sentence,
            'issued_date' => $this->faker->date(),
            'attachment' => null,
            //'user_id' => User::factory(),
        ];
    }
}
