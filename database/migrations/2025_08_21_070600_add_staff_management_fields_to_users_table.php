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
        Schema::connection('account')->table('users', function (Blueprint $table) {
            // Work information fields (only add if they don't exist)
            if (!Schema::connection('account')->hasColumn('users', 'department')) {
                $table->string('department')->nullable()->after('role');
            }
            if (!Schema::connection('account')->hasColumn('users', 'position')) {
                $table->string('position')->nullable()->after('department');
            }
            if (!Schema::connection('account')->hasColumn('users', 'location')) {
                $table->string('location')->nullable()->after('position');
            }
            if (!Schema::connection('account')->hasColumn('users', 'employee_id')) {
                $table->string('employee_id')->nullable()->after('location');
            }
            if (!Schema::connection('account')->hasColumn('users', 'join_date')) {
                $table->date('join_date')->nullable()->after('employee_id');
            }
            
            // Personal information fields (only add if they don't exist)
            if (!Schema::connection('account')->hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable()->after('gender');
            }
            if (!Schema::connection('account')->hasColumn('users', 'emergency_contact')) {
                $table->string('emergency_contact')->nullable()->after('country');
            }
            
            // Alternative bio/description fields (only add if they don't exist)
            if (!Schema::connection('account')->hasColumn('users', 'about')) {
                $table->text('about')->nullable()->after('bio');
            }
            if (!Schema::connection('account')->hasColumn('users', 'description')) {
                $table->text('description')->nullable()->after('about');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->table('users', function (Blueprint $table) {
            $columns = ['department', 'position', 'location', 'employee_id', 'join_date', 'nationality', 'emergency_contact', 'about', 'description'];
            
            foreach ($columns as $column) {
                if (Schema::connection('account')->hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
