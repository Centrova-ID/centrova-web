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
        Schema::create('oauth_authorization_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('client_id');
            $table->unsignedBigInteger('user_id');
            $table->text('redirect_uri');
            $table->text('scopes')->nullable();
            $table->string('code_challenge')->nullable(); // for PKCE
            $table->string('code_challenge_method')->nullable(); // S256 or plain
            $table->boolean('revoked')->default(false);
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->foreign('client_id')->references('client_id')->on('oauth_clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['code', 'revoked']);
            $table->index(['client_id']);
            $table->index(['expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_authorization_codes');
    }
};
