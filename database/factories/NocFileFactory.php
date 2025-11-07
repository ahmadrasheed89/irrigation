<?php

namespace Database\Factories;

use App\Models\NocFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NocFile>
 */
class NocFileFactory extends Factory
{
    protected $model = NocFile::class;
    /**
     *
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'date' => $this->faker->date(),
            'attached_files' => null,
        ];
    }
}
