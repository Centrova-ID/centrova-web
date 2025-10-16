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
        // If domain_nameservers already exists, skip creating it.
        if (Schema::hasTable('domain_nameservers')) {
            return;
        }

        Schema::create('domain_nameservers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained()->onDelete('cascade');
            $table->string('nameserver');
            $table->string('ip_address')->nullable();
            $table->integer('priority')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Ensure unique nameserver per domain
            $table->unique(['domain_id', 'nameserver']);
            $table->index(['domain_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_nameservers');
    }
};