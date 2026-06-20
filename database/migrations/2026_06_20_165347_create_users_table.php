<?php
// ============================================
// USERS TABLE MIGRATION
// Location: database/migrations/xxxx_create_users_table.php
// Kaam: Database mein users table banata hai
// Command: php artisan migrate
// ============================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // --- Table banao ---
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                        // Auto ID
            $table->string('name');              // User ka naam
            $table->string('username')->unique();// Login username (unique)
            $table->string('email')->unique();   // Email (unique)
            $table->string('password');          // Encrypted password
            // Role: admin, manager, technician
            $table->enum('role', ['admin', 'manager', 'technician'])
                  ->default('technician');
            $table->timestamps();                // created_at, updated_at
        });
    }

    // --- Table hatao (rollback ke liye) ---
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};