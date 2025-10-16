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
        // If the domains table already exists, skip creating it. This handles cases where
        // the table was created by an imported SQL dump or another migration.
        if (Schema::hasTable('domains')) {
            return;
        }

        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('domain_name')->unique();
            $table->string('tld', 10); // .com, .id, .net, etc.
            $table->enum('status', ['pending', 'active', 'expired', 'suspended', 'cancelled'])->default('pending');
            $table->decimal('registration_price', 10, 2);
            $table->decimal('renewal_price', 10, 2);
            $table->date('registration_date');
            $table->date('expiry_date');
            $table->date('next_due_date')->nullable();
            $table->boolean('auto_renew')->default(false);
            $table->string('registrar_domain_id')->nullable(); // ID from external provider
            $table->string('auth_code')->nullable();
            $table->json('nameservers')->nullable(); // Store as JSON array
            $table->json('contact_info')->nullable(); // Registrant contact details
            $table->text('notes')->nullable();
            $table->timestamp('last_sync_at')->nullable(); // Last sync with external provider
            $table->timestamps();

            // Indexes for performance
            $table->index(['user_id', 'status']);
            $table->index(['status', 'expiry_date']);
            $table->index(['expiry_date']);
            $table->index(['registrar_domain_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};