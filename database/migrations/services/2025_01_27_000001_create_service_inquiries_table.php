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
        Schema::create('service_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->enum('service_type', [
                'web-development',
                'mobile-app',
                'ui-ux-design',
                'digital-marketing',
                'other'
            ]);
            $table->string('subject');
            $table->text('message');
            $table->string('budget_range')->nullable();
            $table->string('timeline')->nullable();
            $table->enum('source', [
                'website',
                'whatsapp',
                'social-media',
                'referral',
                'google',
                'other'
            ])->default('website');
            $table->enum('status', [
                'new',
                'contacted',
                'quoted',
                'converted',
                'closed'
            ])->default('new');
            $table->enum('priority', [
                'low',
                'medium',
                'high',
                'urgent'
            ])->default('medium');
            $table->string('assigned_to')->nullable();
            $table->datetime('follow_up_date')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('converted_to_order_id')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['service_type', 'status']);
            $table->index('follow_up_date');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_inquiries');
    }
};
