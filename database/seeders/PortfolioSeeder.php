<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\User;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::all();
        Portfolio::factory()->count(12)->create([
            'user_id' => $user->random()->id,
        ]);
    }
}
