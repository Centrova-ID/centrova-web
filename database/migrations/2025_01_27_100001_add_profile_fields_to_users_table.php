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
        Schema::connection('account')->table('users', function (Blueprint $table) {
            // Add new profile fields
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->string('country', 100)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('language', 10)->default('id');
            $table->string('timezone', 50)->default('Asia/Jakarta');
            $table->string('currency', 3)->default('IDR');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'country',
                'emergency_contact_name',
                'emergency_contact_phone',
                'emergency_contact_relation',
                'language',
                'timezone',
                'currency'
            ]);
        });
    }
};
