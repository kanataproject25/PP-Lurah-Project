<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skbm', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->text('alamat');
            $table->string('status_pernikahan')->nullable();
            $table->string('file_pernyataan')->nullable();
            $table->string('file_surat_cerai')->nullable();
            $table->string('file_surat_kematian')->nullable();
            $table->string('foto_syarat_skbm')->nullable();
            $table->string('status')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('jabatan_ttd')->nullable();
            $table->string('nama_ttd')->nullable();
            $table->string('nip_ttd')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('isi_surat')->nullable();
            $table->text('penutup_surat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skbm');
    }
}; 