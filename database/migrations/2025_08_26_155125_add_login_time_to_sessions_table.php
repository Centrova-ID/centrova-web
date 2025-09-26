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
        Schema::connection('account')->table('sessions', function (Blueprint $table) {
            // Add created_at if it doesn't exist (for login timestamp)
            if (!Schema::connection('account')->hasColumn('sessions', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('last_activity');
            }
            
            // Add updated_at if it doesn't exist 
            if (!Schema::connection('account')->hasColumn('sessions', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
        
        // Update existing sessions with created_at based on last_activity if created_at is null
        DB::connection('account')->statement('
            UPDATE sessions 
            SET created_at = FROM_UNIXTIME(last_activity), updated_at = NOW() 
            WHERE created_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->table('sessions', function (Blueprint $table) {
            if (Schema::connection('account')->hasColumn('sessions', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::connection('account')->hasColumn('sessions', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
