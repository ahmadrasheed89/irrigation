<?php

namespace Database\Seeders;

use App\Models\NocCategory;
use App\Models\NocFile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ContractorSeeder::class,
            CategorySeeder::class,
            AdpSeeder::class,
            SchemeSeeder::class,
            TenderSeeder::class,
            PortfolioSeeder::class,
            NocSeeder::class,
            NocCategorySeeder::class,
            NocFileSeeder::class,
        ]);
    }
}
