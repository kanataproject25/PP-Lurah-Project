<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            $table->string('status')->default('pending')->nullable(false)->change();
        });
        Schema::table('sd', function (Blueprint $table) {
            $table->string('status')->default('pending')->nullable(false)->change();
        });
        Schema::table('sk', function (Blueprint $table) {
            $table->string('status')->default('pending')->nullable(false)->change();
        });
        Schema::table('skbm', function (Blueprint $table) {
            $table->string('status')->default('pending')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            $table->string('status')->nullable()->default(null)->change();
        });
        Schema::table('sd', function (Blueprint $table) {
            $table->string('status')->nullable()->default(null)->change();
        });
        Schema::table('sk', function (Blueprint $table) {
            $table->string('status')->nullable()->default(null)->change();
        });
        Schema::table('skbm', function (Blueprint $table) {
            $table->string('status')->nullable()->default(null)->change();
        });
    }
}; 