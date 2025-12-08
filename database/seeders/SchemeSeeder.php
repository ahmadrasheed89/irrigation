<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scheme;
use App\Models\Adp;
use App\Models\User;
use App\Models\Contractor;

class SchemeSeeder extends Seeder
{
    public function run(): void
    {
        $contractor = Contractor::all();
        $user = User::all();
        $adp = Adp::all();

        Scheme::factory()->count(20)->create([
            'contractor_id' => $contractor->random()->id,
            'user_id' => $user->random()->id,
            'adp_id' => $adp->random()->id,
        ]);
    }
}
