<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('staff_uid', 12)->unique()->nullable()->after('id');
        });

        // Generate UID untuk semua staff yang sudah ada
        $this->generateStaffUIDs();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('staff_uid');
        });
    }

    /**
     * Generate unique staff UID for existing staff members
     */
    private function generateStaffUIDs(): void
    {
        $staffUsers = DB::table('users')
            ->whereNotNull('role')
            ->where('role', '!=', 'customer')
            ->whereNull('staff_uid')
            ->get();

        foreach ($staffUsers as $staff) {
            $uid = $this->generateUniqueStaffUID();
            DB::table('users')->where('id', $staff->id)->update(['staff_uid' => $uid]);
        }
    }

    /**
     * Generate unique staff UID with format CNV + 8 random numbers
     */
    private function generateUniqueStaffUID(): string
    {
        do {
            $uid = 'CNV' . str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $exists = DB::table('users')->where('staff_uid', $uid)->exists();
        } while ($exists);

        return $uid;
    }
};
