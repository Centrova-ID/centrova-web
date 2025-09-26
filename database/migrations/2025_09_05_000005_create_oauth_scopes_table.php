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
        Schema::create('oauth_scopes', function (Blueprint $table) {
            $table->id();
            $table->string('scope')->unique();
            $table->string('name');
            $table->text('description');
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index(['scope']);
            $table->index(['is_default']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_scopes');
    }
};
