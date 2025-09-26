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
        Schema::table('ui_components', function (Blueprint $table) {
            $table->string('icon', 10)->nullable()->after('description');
            $table->longText('css_code')->nullable()->after('html_code');
            $table->longText('js_code')->nullable()->after('css_code');
            $table->string('demo_url')->nullable()->after('js_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ui_components', function (Blueprint $table) {
            $table->dropColumn(['icon', 'css_code', 'js_code', 'demo_url']);
        });
    }
};
