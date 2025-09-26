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
        // Update sessions table to ensure it has all needed columns for device tracking
        Schema::connection('account')->table('sessions', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::connection('account')->hasColumn('sessions', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't remove the columns as they might be needed
        // Schema::connection('account')->table('sessions', function (Blueprint $table) {
        //     $table->dropTimestamps();
        // });
    }
};
