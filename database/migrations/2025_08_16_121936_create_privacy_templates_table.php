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
        Schema::create('privacy_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', [
                'data_access_request',
                'data_deletion_request', 
                'data_portability_request',
                'privacy_policy_update',
                'consent_confirmation',
                'data_breach_notification'
            ]);
            $table->string('subject');
            $table->longText('content');
            $table->json('variables')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_templates');
    }
};
