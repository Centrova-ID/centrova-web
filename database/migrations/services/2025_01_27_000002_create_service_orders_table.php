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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // reference ke users di database account
            $table->enum('service_type', [
                'web-development',
                'mobile-app',
                'ui-ux-design',
                'digital-marketing',
                'maintenance',
                'other'
            ]);
            $table->string('package_name'); // Personal, Basic, Professional, Enterprise
            $table->enum('billing_type', ['project', 'monthly'])->default('project');
            $table->enum('status', [
                'pending',
                'confirmed',
                'in-progress',
                'review',
                'completed',
                'cancelled',
                'on-hold'
            ])->default('pending');
            $table->decimal('price', 12, 2);
            $table->string('currency', 3)->default('IDR');
            $table->json('requirements')->nullable(); // Detail requirements dari client
            $table->json('features')->nullable(); // Fitur yang dipilih
            $table->json('timeline')->nullable(); // Timeline project
            $table->enum('payment_status', [
                'pending',
                'dp-paid',
                'partial-paid',
                'paid',
                'refunded'
            ])->default('pending');
            $table->text('notes')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->datetime('cancelled_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['service_type', 'status']);
            $table->index(['user_id', 'status']);
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
