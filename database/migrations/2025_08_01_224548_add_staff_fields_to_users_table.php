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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['customer', 'admin', 'customer_service', 'developer', 'marketing', 'manager', 'supervisor'])->nullable()->default('customer')->after('email');
            $table->enum('status', ['active', 'suspended'])->default('active')->after('role');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->text('bio')->nullable()->after('profile_picture');
            $table->boolean('email_notifications')->default(true)->after('bio');
            $table->boolean('marketing_emails')->default(true)->after('email_notifications');
            $table->boolean('security_alerts')->default(true)->after('marketing_emails');
            $table->boolean('staff_updates')->default(true)->after('security_alerts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'status', 
                'last_login_at',
                'bio',
                'email_notifications',
                'marketing_emails',
                'security_alerts',
                'staff_updates'
            ]);
        });
    }
};
