<?php
// ============================================
// USER SEEDER
// Location: database/seeders/UserSeeder.php
// Kaam: Test user database mein dalta hai
// Command: php artisan db:seed --class=UserSeeder
// ============================================

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // --- Admin User ---
        DB::table('users')->insert([
            'name'       => 'Admin User',
            'username'   => 'admin',           // Login: admin
            'email'      => 'admin@srslab.com',
            'password'   => Hash::make('admin123'), // Password: admin123
            'role'       => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // --- Manager User ---
        DB::table('users')->insert([
            'name'       => 'Lab Manager',
            'username'   => 'manager',         // Login: manager
            'email'      => 'manager@srslab.com',
            'password'   => Hash::make('manager123'),
            'role'       => 'manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // --- Technician User ---
        DB::table('users')->insert([
            'name'       => 'Ahmad Technician',
            'username'   => 'technician',      // Login: technician
            'email'      => 'tech@srslab.com',
            'password'   => Hash::make('tech123'),
            'role'       => 'technician',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}