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
        Schema::create('sdu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('kewarganegaraan');
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->string('nama_usaha')->nullable();
            $table->string('ktp')->nullable(); // path file
            $table->string('kk')->nullable(); // path file
            $table->string('pbb')->nullable(); // path file
            $table->string('surat_keterangan_rt')->nullable(); // path file
            $table->string('pdf_path')->nullable();
            $table->string('status')->nullable();
            $table->string('alasan_tolak')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdu');
    }
}; 