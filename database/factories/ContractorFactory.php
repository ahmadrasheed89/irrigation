<?php

namespace Database\Factories;

use App\Models\Contractor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractorFactory extends Factory
{
    protected $model = Contractor::class;

    public function definition()
    {
        return [
            'constractor_name' => $this->faker->name,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'vendor_no' => $this->faker->unique()->bothify('VEN-####'),
        ];
    }
}
