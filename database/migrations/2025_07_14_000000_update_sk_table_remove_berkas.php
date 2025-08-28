<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            if (Schema::hasColumn('sk', 'surat_keterangan_rt')) {
                $table->renameColumn('surat_keterangan_rt', 'surat_keterangan_pendukung');
            }
        });
        Schema::table('sk', function (Blueprint $table) {
            if (Schema::hasColumn('sk', 'ktp')) $table->dropColumn('ktp');
            if (Schema::hasColumn('sk', 'kk')) $table->dropColumn('kk');
            if (Schema::hasColumn('sk', 'pbb')) $table->dropColumn('pbb');
        });
    }

    public function down(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
            $table->string('pbb')->nullable();
            if (Schema::hasColumn('sk', 'surat_keterangan_pendukung')) {
                $table->renameColumn('surat_keterangan_pendukung', 'surat_keterangan_rt');
            }
        });
    }
}; 