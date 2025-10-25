<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin Final',
            'email' => 'admin@mouglowing.com',
            'password' => Hash::make('SuperAdminMouGlowing2025!'), 
            'role' => 'admin', 
        ]);

    }
}
