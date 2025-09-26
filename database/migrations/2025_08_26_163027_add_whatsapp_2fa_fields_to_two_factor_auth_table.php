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
        Schema::table('two_factor_auth', function (Blueprint $table) {
            $table->boolean('whatsapp_enabled')->default(false);
            $table->enum('preferred_method', ['pin', 'whatsapp'])->default('pin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('two_factor_auth', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_enabled',
                'preferred_method',
            ]);
        });
    }
};
