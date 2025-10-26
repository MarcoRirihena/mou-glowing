<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan updateOrCreate untuk menghindari duplicate entry
        User::updateOrCreate(
            ['email' => 'admin@mouglowing.com'], // Cari berdasarkan email
            [
                'name' => 'Super Admin Final',
                'password' => Hash::make('SuperAdminMouGlowing2025!'),
                'role' => 'admin',
            ]
        );
        
        // Tampilkan pesan sukses
        $this->command->info('✅ Super Admin created/updated successfully!');
        $this->command->info('📧 Email: admin@mouglowing.com');
        $this->command->info('🔑 Password: SuperAdminMouGlowing2025!');
    }
}