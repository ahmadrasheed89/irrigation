<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adp;
use App\Models\User;



class AdpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all();

        Adp::factory()->count(10)->create(  [
            'user_id' => $user->random()->id,
        ]);
    }
}
