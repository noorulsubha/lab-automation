<?php

// ============================================
// ADD STATUS TO CONTACTS TABLE
// Location: database/migrations/xxxx_add_status_to_contacts_table.php
// Purpose: Add status column to contacts table safely
// Run command: php artisan migrate
// ============================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ----------------------------------------
    // up()
    // Purpose: Add status column to contacts table
    // ----------------------------------------
    public function up(): void
    {
        // Check if status column does not already exist
        if (!Schema::hasColumn('contacts', 'status')) {

            Schema::table('contacts', function (Blueprint $table) {

                // Contact request status:
                // new      = Request has not been viewed
                // seen     = Admin has viewed the request
                // resolved = Issue has been resolved
                $table->enum('status', [
                    'new',
                    'seen',
                    'resolved'
                ])->default('new')->after('message');

            });
        }
    }

    // ----------------------------------------
    // down()
    // Purpose: Remove status column during rollback
    // ----------------------------------------
    public function down(): void
    {
        // Check if status column exists before removing
        if (Schema::hasColumn('contacts', 'status')) {

            Schema::table('contacts', function (Blueprint $table) {

                // Remove status column from contacts table
                $table->dropColumn('status');

            });
        }
    }
};