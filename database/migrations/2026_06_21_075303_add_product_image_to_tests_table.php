<?php

// ============================================
// ADD PRODUCT IMAGE COLUMN TO TESTS TABLE
// Location: database/migrations/xxxx_add_product_image_to_tests_table.php
// Purpose: Safely add product_image column
// ============================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ----------------------------------------
    // up()
    // Add product_image column safely
    // ----------------------------------------
    public function up(): void
    {
        if (!Schema::hasColumn('tests', 'product_image')) {

            Schema::table('tests', function (Blueprint $table) {

                // Store image file path
                $table->string('product_image')
                      ->nullable();

            });

        }
    }

    // ----------------------------------------
    // down()
    // Remove product_image column safely
    // ----------------------------------------
    public function down(): void
    {
        if (Schema::hasColumn('tests', 'product_image')) {

            Schema::table('tests', function (Blueprint $table) {
                $table->dropColumn('product_image');
            });

        }
    }
};