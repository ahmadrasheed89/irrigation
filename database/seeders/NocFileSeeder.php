<?php

namespace Database\Seeders;

use App\Models\Noc;
use App\Models\NocCategory;
use App\Models\NocFile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class NocFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noc = Noc::all();
        $nocCategory = NocCategory::all();
        $user = User::all();

        NocFile::factory()->count(30)->make()->each(function ($nocFile) use ($noc, $nocCategory, $user) {
            $nocFile->noc_id = $noc->random()->id;
            $nocFile->noc_category_id = $nocCategory->random()->id;
            $nocFile->user_id = $user->random()->id;
            $nocFile->save();
        });
    }
}
