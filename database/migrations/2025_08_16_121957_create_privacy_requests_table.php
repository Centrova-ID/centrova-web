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
        Schema::create('privacy_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('customer_email');
            $table->string('customer_name');
            $table->enum('request_type', [
                'data_access',
                'data_deletion',
                'data_portability',
                'consent_withdrawal',
                'data_correction',
                'complaint'
            ]);
            $table->text('description');
            $table->enum('status', [
                'pending',
                'in_progress', 
                'completed',
                'rejected',
                'cancelled'
            ])->default('pending');
            $table->enum('priority', [
                'low',
                'medium',
                'high',
                'urgent'
            ])->default('medium');
            $table->foreignId('template_id')->nullable()->constrained('privacy_templates');
            $table->longText('response_content')->nullable();
            $table->timestamp('response_sent_at')->nullable();
            $table->date('due_date')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['customer_email', 'created_at']);
            $table->index(['status', 'priority']);
            $table->index(['due_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_requests');
    }
};
