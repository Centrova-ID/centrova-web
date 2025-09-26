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
            $table->boolean('require_2fa_every_login')->default(false)->after('preferred_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('two_factor_auth', function (Blueprint $table) {
            $table->dropColumn('require_2fa_every_login');
        });
    }
};
