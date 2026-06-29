<?php
// ============================================
// PRODUCTS TABLE MIGRATION
// Location: database/migrations/xxxx_create_products_table.php
// Purpose: Creates products table in database
// Run: php artisan migrate
// ============================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Create the products table
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Auto increment primary key
            $table->id();

            // Unique 10 digit product code
            // Example: SRS2024001A
            $table->string('product_id', 10)->unique();

            // Full product name
            $table->string('name');

            // Product category type
            $table->enum('type', [
                'switchgear',
                'fuse',
                'capacitor',
                'resistor'
            ]);

            // Revision number of product
            $table->string('revision')->nullable();

            // Full product description
            $table->text('description')->nullable();

            // Product image file path
            // Image stored in: public/images/products/
            $table->string('image')->nullable();

            // Created and updated timestamps
            $table->timestamps();
        });
    }

    // Drop table if migration is rolled back
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};