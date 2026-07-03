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
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email', 255);
            $table->longText('token')->nullable(); // JWT token panjang
            $table->string('ip_address', 45)->nullable(); // Support IPv6
            $table->text('user_agent')->nullable();
            $table->dateTime('login_at');
            $table->dateTime('logout_at')->nullable();
            $table->integer('expires_in')->nullable(); // dalam detik
            $table->timestamps();

            // Indexes
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('email');
            $table->index('login_at');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};
