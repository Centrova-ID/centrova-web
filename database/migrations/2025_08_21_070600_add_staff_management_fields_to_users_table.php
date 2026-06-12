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
        $cols = ['department' => 'string', 'position' => 'string', 'location' => 'string',
                 'employee_id' => 'string', 'nationality' => 'string', 'emergency_contact' => 'string',
                 'about' => 'text', 'description' => 'text'];
        Schema::connection('account')->table('users', function (Blueprint $table) use ($cols) {
            foreach ($cols as $col => $type) {
                if (!Schema::connection('account')->hasColumn('users', $col)) {
                    $type === 'text' ? $table->text($col)->nullable() : $table->string($col)->nullable();
                }
            }
            if (!Schema::connection('account')->hasColumn('users', 'join_date')) {
                $table->date('join_date')->nullable();
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
