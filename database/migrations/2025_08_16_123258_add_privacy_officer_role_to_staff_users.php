<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First modify the enum to include privacy_officer
        DB::statement("ALTER TABLE staff_users MODIFY COLUMN role ENUM('admin', 'customer_service', 'developer', 'marketing', 'manager', 'supervisor', 'privacy_officer')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove privacy_officer from enum
        DB::statement("ALTER TABLE staff_users MODIFY COLUMN role ENUM('admin', 'customer_service', 'developer', 'marketing', 'manager', 'supervisor')");
    }
};
