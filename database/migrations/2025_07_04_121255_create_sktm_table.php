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
    Schema::create('sktm', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('nama');
        $table->string('nik');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('jenis_kelamin');
        $table->string('agama');
        $table->string('pekerjaan');
        $table->string('alamat');
        $table->string('keperluan')->nullable();
        $table->string('file_ktp')->nullable();
        $table->string('file_kk')->nullable();
        $table->string('status')->default('pending');
        $table->string('nomor_surat')->nullable();
        $table->string('penandatangan_nama')->nullable();
        $table->string('penandatangan_jabatan')->nullable();
        $table->text('isi_surat')->nullable();
        $table->text('penutup_surat')->nullable();
        $table->date('tanggal_surat')->nullable();
        $table->string('jabatan_ttd')->nullable();
        $table->string('nama_ttd')->nullable();
        $table->string('nip_ttd')->nullable();
        $table->string('pdf_path')->nullable();
        $table->string('alasan_tolak')->nullable();
        $table->timestamps();
        
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sktm');
    }
};
