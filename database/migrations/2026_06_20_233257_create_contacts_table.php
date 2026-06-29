<?php
// ============================================
// CONTACTS TABLE MIGRATION
// Location: database/migrations/xxxx_create_contacts_table.php
// Purpose: Creates contacts table in database
// Stores contact form messages from visitors
// Run Command: php artisan migrate
// ============================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ----------------------------------------
    // up()
    // Purpose: Create contacts table
    // Runs when: php artisan migrate
    // ----------------------------------------
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {

            // Auto increment primary key
            $table->id();

            // Sender full name - optional field
            $table->string('name')->nullable();

            // Company name or location - optional field
            $table->string('company_or_location')->nullable();

            // Contact phone number - required field
            // Max 25 characters for international numbers
            $table->string('contact_number', 25);

            // Service request message details - required
            // Switchgear service details saved here
            $table->text('message');

            // Status of contact request
            // new = not seen yet
            // seen = admin has read it
            // resolved = issue is resolved
            $table->enum('status', [
                'new',
                'seen',
                'resolved'
            ])->default('new');

            // Auto created_at and updated_at columns
            $table->timestamps();
        });
    }

    // ----------------------------------------
    // down()
    // Purpose: Delete contacts table
    // Runs when: php artisan migrate:rollback
    // ----------------------------------------
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};