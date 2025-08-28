<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('kewarganegaraan');
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->string('keperluan')->nullable();
            $table->string('ktp');
            $table->string('kk');
            $table->string('pbb');
            $table->string('surat_keterangan_rt');
            $table->string('pdf_path')->nullable();
            $table->string('status')->nullable();
            $table->string('alasan_tolak')->nullable();
            // Tambahan untuk SK admin
            $table->string('nama_penandatangan')->nullable();
            $table->string('jabatan_penandatangan')->nullable();
            $table->string('dasar_pengantar')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('jabatan_ttd')->nullable();
            $table->string('nama_ttd')->nullable();
            $table->string('nip_ttd')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sk');
    }
}; 