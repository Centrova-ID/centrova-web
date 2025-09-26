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
        // First check if timestamps columns exist
        if (!Schema::hasColumn('users', 'created_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
            });
        }
        
        if (!Schema::hasColumn('users', 'updated_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }

        // Set default values for existing rows
        DB::table('users')->whereNull('created_at')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
