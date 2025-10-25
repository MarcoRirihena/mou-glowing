<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'name' => 'Admin Mou Glowing',
            'email' => 'admin@mouglowing.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Buat User biasa untuk testing
        User::create([
            'name' => 'Customer Test',
            'email' => 'user@test.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);
    }
}