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
        // If domain_pricing already exists, skip creating it.
        if (Schema::hasTable('domain_pricing')) {
            return;
        }

        Schema::create('domain_pricing', function (Blueprint $table) {
            $table->id();
            $table->string('tld', 10)->unique(); // .com, .id, .net, etc.
            $table->decimal('registration_price', 10, 2);
            $table->decimal('renewal_price', 10, 2);
            $table->decimal('transfer_price', 10, 2);
            $table->decimal('cost_price', 10, 2); // Our cost from provider
            $table->integer('min_years')->default(1);
            $table->integer('max_years')->default(10);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->json('features')->nullable(); // Special features for this TLD
            $table->timestamps();

            // Indexes
            $table->index(['is_available', 'sort_order']);
            $table->index(['is_featured', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_pricing');
    }
};