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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name')->nullable();
            $table->string('industry')->nullable()->index();
            $table->string('service_type')->nullable()->index();
            $table->text('challenge')->nullable();
            $table->text('solution')->nullable();
            $table->text('results')->nullable();
            $table->text('content');
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('testimonial')->nullable(); // {name, role, company, quote, avatar}
            $table->json('metrics')->nullable();     // [{label, value, unit}]
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Landing pages for commercial keywords
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('headline')->nullable();
            $table->string('subheadline')->nullable();
            $table->text('content');
            $table->string('target_keyword')->nullable()->index();
            $table->string('service_type')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('sections')->nullable();       // Flexible section builder
            $table->json('cta')->nullable();            // {text, url, type}
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
        Schema::dropIfExists('case_studies');
    }
};
