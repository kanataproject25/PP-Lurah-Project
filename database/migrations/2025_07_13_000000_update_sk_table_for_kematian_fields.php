<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->string('nomor_surat')->nullable()->after('id');
            $table->string('nik')->nullable()->after('nama');
            $table->string('agama')->nullable()->after('jenis_kelamin');
            $table->string('hari_meninggal')->nullable()->after('alamat');
            $table->date('tanggal_meninggal')->nullable()->after('hari_meninggal');
            $table->string('penyebab')->nullable()->after('tanggal_meninggal');
            $table->string('tempat_meninggal')->nullable()->after('penyebab');
            $table->string('nama_pelapor')->nullable()->after('tempat_meninggal');
            $table->string('nik_pelapor')->nullable()->after('nama_pelapor');
            $table->string('status_hubungan')->nullable()->after('nik_pelapor');
            $table->string('no_hp')->nullable()->after('status_hubungan');
        });
    }

    public function down(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_surat', 'nik', 'agama', 'hari_meninggal', 'tanggal_meninggal',
                'penyebab', 'tempat_meninggal', 'nama_pelapor', 'nik_pelapor', 'status_hubungan', 'no_hp'
            ]);
        });
    }
}; 