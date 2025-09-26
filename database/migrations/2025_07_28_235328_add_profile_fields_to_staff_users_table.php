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
        Schema::table('staff_users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('bio')->nullable()->after('phone');
            $table->string('profile_picture')->nullable()->after('bio');
            $table->boolean('email_notifications')->default(true)->after('profile_picture');
            $table->boolean('marketing_emails')->default(false)->after('email_notifications');
            $table->boolean('security_alerts')->default(true)->after('marketing_emails');
            $table->boolean('staff_updates')->default(true)->after('security_alerts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'bio', 
                'profile_picture',
                'email_notifications',
                'marketing_emails',
                'security_alerts',
                'staff_updates'
            ]);
        });
    }
};
