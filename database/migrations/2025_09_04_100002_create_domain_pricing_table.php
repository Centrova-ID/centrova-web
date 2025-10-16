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
        // If domain_pricing already exists on the 'account' connection or default, skip creating it.
        if (Schema::connection('account')->hasTable('domain_pricing') || Schema::hasTable('domain_pricing')) {
            return;
        }

        Schema::connection('account')->create('domain_pricing', function (Blueprint $table) {
            $table->id();
            $table->string('tld', 10)->unique(); // .com, .id, .co.id, etc.
            $table->string('tld_display')->nullable(); // Display name
            $table->decimal('registration_price', 10, 2);
            $table->decimal('renewal_price', 10, 2);
            $table->decimal('transfer_price', 10, 2);
            $table->decimal('privacy_price', 10, 2)->default(0);
            $table->integer('min_years')->default(1);
            $table->integer('max_years')->default(10);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('registrar')->default('resellerclub'); // Which registrar handles this TLD
            $table->json('features')->nullable(); // Additional features/restrictions
            $table->text('description')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'sort_order']);
            $table->index('is_popular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->dropIfExists('domain_pricing');
    }
};
