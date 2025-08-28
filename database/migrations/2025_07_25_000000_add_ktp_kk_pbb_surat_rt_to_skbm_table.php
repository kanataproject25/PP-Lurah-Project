<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skbm', function (Blueprint $table) {
            $table->string('ktp')->nullable()->after('foto_syarat_skbm');
            $table->string('kk')->nullable()->after('ktp');
            $table->string('pbb')->nullable()->after('kk');
            $table->string('surat_keterangan_rt')->nullable()->after('pbb');
        });
    }

    public function down(): void
    {
        Schema::table('skbm', function (Blueprint $table) {
            $table->dropColumn(['ktp', 'kk', 'pbb', 'surat_keterangan_rt']);
        });
    }
}; 