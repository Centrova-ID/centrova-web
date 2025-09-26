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
        Schema::create('service_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_order_id');
            $table->enum('payment_type', ['dp', 'progress', 'final', 'monthly']);
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('IDR');
            $table->enum('status', [
                'pending',
                'processing',
                'success',
                'failed',
                'cancelled'
            ])->default('pending');
            $table->string('payment_method')->nullable(); // bank_transfer, e-wallet, etc
            $table->string('payment_reference')->nullable(); // reference number
            $table->json('payment_details')->nullable(); // detail pembayaran
            $table->datetime('paid_at')->nullable();
            $table->datetime('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('service_order_id')->references('id')->on('service_orders')->onDelete('cascade');

            // Indexes
            $table->index(['service_order_id', 'payment_type']);
            $table->index(['status', 'created_at']);
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_payments');
    }
};
