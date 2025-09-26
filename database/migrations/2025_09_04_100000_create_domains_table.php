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
        Schema::connection('account')->create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('registrar_domain_id')->nullable(); // ID dari registrar
            $table->string('tld', 10);
            $table->enum('status', ['pending', 'active', 'expired', 'cancelled', 'transferred'])->default('pending');
            $table->date('registration_date');
            $table->date('expiry_date');
            $table->boolean('auto_renew')->default(false);
            $table->decimal('registration_price', 10, 2);
            $table->decimal('renewal_price', 10, 2);
            $table->json('nameservers')->nullable(); // Array of nameservers
            $table->json('contact_info')->nullable(); // Domain contact information
            $table->json('dns_records')->nullable(); // Custom DNS records
            $table->boolean('privacy_protection')->default(false);
            $table->decimal('privacy_price', 10, 2)->default(0);
            $table->string('registrar_status')->nullable(); // Status dari registrar
            $table->text('notes')->nullable();
            $table->timestamp('last_sync_at')->nullable(); // Last sync with registrar
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'status']);
            $table->index(['expiry_date', 'status']);
            $table->index('tld');
            $table->index('status');

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->dropIfExists('domains');
    }
};
