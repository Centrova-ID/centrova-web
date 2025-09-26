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
        // User data exports tracking
        Schema::create('user_data_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('export_type', ['full_export', 'partial_export', 'specific_category']);
            $table->string('file_path')->nullable();
            $table->timestamp('requested_at');
            $table->timestamp('completed_at')->nullable();
            $table->string('ip_address', 45);
            $table->text('user_agent');
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->text('error_message')->nullable();
            $table->timestamps();
        });

        // User deletion requests
        Schema::create('user_deletion_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('reason');
            $table->timestamp('requested_at');
            $table->timestamp('processed_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed']);
            $table->text('admin_notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->string('ip_address', 45);
            $table->text('user_agent');
            $table->timestamps();
        });

        // Data rectification requests
        Schema::create('user_data_rectifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('field_name');
            $table->text('current_value');
            $table->text('requested_value');
            $table->text('reason');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed']);
            $table->timestamp('requested_at');
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->text('admin_notes')->nullable();
            $table->string('ip_address', 45);
            $table->timestamps();
        });

        // Consent management
        Schema::create('user_consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('consent_type'); // analytics, marketing, functional, etc.
            $table->boolean('is_given');
            $table->timestamp('given_at')->nullable();
            $table->timestamp('withdrawn_at')->nullable();
            $table->string('ip_address', 45);
            $table->text('user_agent');
            $table->string('source'); // website, mobile_app, etc.
            $table->timestamps();
        });

        // GDPR audit log
        Schema::create('gdpr_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('action'); // data_export, data_deletion, consent_given, consent_withdrawn, etc.
            $table->string('resource_type'); // user, login_activity, chat_message, etc.
            $table->json('resource_details')->nullable();
            $table->text('description');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->foreignId('performed_by')->nullable()->constrained('users');
            $table->string('legal_basis')->nullable(); // contract, consent, legitimate_interest, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gdpr_audit_logs');
        Schema::dropIfExists('user_consents');
        Schema::dropIfExists('user_data_rectifications');
        Schema::dropIfExists('user_deletion_requests');
        Schema::dropIfExists('user_data_exports');
    }
};
