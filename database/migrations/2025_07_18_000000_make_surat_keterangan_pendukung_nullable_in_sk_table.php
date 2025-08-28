<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->string('surat_keterangan_pendukung')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->string('surat_keterangan_pendukung')->nullable(false)->change();
        });
    }
}; 