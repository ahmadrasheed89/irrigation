<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Noc;
use App\Models\User;

class NocSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::all();
        Noc::factory()->count(12)->create([
            'user_id' => $user->random()->id,
        ]);
        //Noc::factory()->count(12)->create();
    }
}
