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
        Schema::create('arsip_lamas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->date('tanggal_pengajuan');
            $table->enum('jenis_surat', ['SKTM', 'SD', 'SDU', 'SK', 'SKBM']);
            $table->string('file_pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_lamas');
    }
};
