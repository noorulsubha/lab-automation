<?php
// ============================================
// TESTS TABLE MIGRATION
// Location: database/migrations/xxxx_create_tests_table.php
// Purpose: Creates tests table in database
// Run: php artisan migrate
// ============================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Create the tests table
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            // Auto increment primary key
            $table->id();

            // Auto generated 12 digit test ID
            // Example: TSTEL00012024
            $table->string('test_id', 12)->unique();

            // Links to products table
            // 10 digit product code
            $table->string('product_id', 10);

            // Type of test performed
            $table->enum('test_type', [
                'electrical',
                'load',
                'thermal',
                'safety',
                'mechanical'
            ]);

            // Test result status
            $table->enum('result', [
                'pass',
                'fail',
                'pending'
            ])->default('pending');

            // Detailed testing remarks
            $table->text('remarks')->nullable();

            // Name of technician who tested
            $table->string('tester_name');

            // Date when test was done
            $table->date('test_date');

            // Which user entered this record
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Created and updated timestamps
            $table->timestamps();
        });
    }

    // Drop table if migration is rolled back
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};