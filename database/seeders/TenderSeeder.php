<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tender;
use App\Models\Scheme;
use App\Models\Category;
use App\Models\User;

class TenderSeeder extends Seeder
{
    public function run(): void
    {
        $schemes = Scheme::all();
        $categories = Category::all();
        $user = User::all();

        Tender::factory()->count(30)->make()->each(function ($tender) use ($schemes, $categories, $user) {
            $tender->scheme_id = $schemes->random()->id;
            $tender->category_id = $categories->random()->id;
            $tender->user_id = $user->random()->id;
            $tender->save();
        });
    }
}
