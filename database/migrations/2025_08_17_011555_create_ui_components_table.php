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
        Schema::create('ui_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ui_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->longText('html_code');
            $table->text('preview_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('staff_users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('staff_users')->onDelete('set null');
            $table->timestamps();
            
            $table->unique(['ui_category_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ui_components');
    }
};
