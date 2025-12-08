<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(2)->create();
        User::factory()->create([
            'username' => 'admin',
            'first_name' => 'Rasheed',
            'last_name' => 'Ahmad',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 1,
            'status' => 1,
        ]);
    }
}
