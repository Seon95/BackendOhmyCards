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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('url')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('link');
            $table->text('description')->nullable();
            $table->string('name');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
        Schema::dropIfExists('users');
        Schema::table('urls', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
