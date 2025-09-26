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
        Schema::table('users', function (Blueprint $table) {
            // Remove emergency contact fields
            $table->dropColumn([
                'emergency_contact_name',
                'emergency_contact_phone', 
                'emergency_contact_relation'
            ]);
            
            // Remove preferences fields
            $table->dropColumn([
                'language',
                'timezone',
                'currency'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Re-add emergency contact fields
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            
            // Re-add preferences fields
            $table->string('language', 10)->default('id');
            $table->string('timezone', 50)->default('Asia/Jakarta');
            $table->string('currency', 3)->default('IDR');
        });
    }
};
