<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Update atau buat admin
        User::updateOrCreate(
            ['email' => 'admin@mouglowing.com'],
            [
                'name' => 'Admin Mou Glowing',
                'password' => Hash::make('AdminMouGlowing2025!'),
                'role' => 'admin'
            ]
        );
    }
}