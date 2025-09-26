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
        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('client_id')->unique();
            $table->string('client_secret');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('redirect_uris'); // JSON array of allowed redirect URIs
            $table->text('scopes')->nullable(); // JSON array of allowed scopes
            $table->string('grant_types')->default('authorization_code,refresh_token'); // comma separated
            $table->boolean('is_confidential')->default(true); // public/confidential client
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('user_id'); // Developer who owns this client
            $table->string('website_url')->nullable();
            $table->string('privacy_policy_url')->nullable();
            $table->string('terms_of_service_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['client_id', 'is_active']);
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_clients');
    }
};
