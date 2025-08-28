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
        // SDU
        Schema::table('sdu', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id')->nullable(false)->change(); // Komentari agar tidak error
        });
        // SD
        Schema::table('sd', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id')->nullable(false)->change(); // Komentari agar tidak error
        });
        // SK
        Schema::table('sk', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id')->nullable(false)->change(); // Komentari agar tidak error
        });
        // SKBM
        Schema::table('skbm', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id')->nullable(false)->change(); // Komentari agar tidak error
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        Schema::table('sd', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        Schema::table('sk', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        Schema::table('skbm', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
};
