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
        Schema::table('sdu', function (Blueprint $table) {
            $table->string('ktp')->nullable()->change();
            $table->string('kk')->nullable()->change();
            $table->string('pbb')->nullable()->change();
            $table->string('surat_keterangan_rt')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            $table->string('ktp')->nullable(false)->change();
            $table->string('kk')->nullable(false)->change();
            $table->string('pbb')->nullable(false)->change();
            $table->string('surat_keterangan_rt')->nullable(false)->change();
        });
    }
};
