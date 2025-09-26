<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('privacy_requests', function (Blueprint $table) {
            // Drop existing foreign key constraints if they exist
            try {
                $table->dropForeign(['assigned_to']);
                $table->dropForeign(['processed_by']);
            } catch (Exception $e) {
                // Foreign keys might not exist, continue
            }
            
            // Update to reference staff_users table
            $table->foreign('assigned_to')->references('id')->on('staff_users')->onDelete('set null');
            $table->foreign('processed_by')->references('id')->on('staff_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('privacy_requests', function (Blueprint $table) {
            // Drop staff_users foreign keys
            $table->dropForeign(['assigned_to']);
            $table->dropForeign(['processed_by']);
            
            // Restore original users foreign keys
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('set null');
        });
    }
};
