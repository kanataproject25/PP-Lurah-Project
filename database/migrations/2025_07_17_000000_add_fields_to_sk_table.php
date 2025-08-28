<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            if (!Schema::hasColumn('sk', 'nama_penandatangan')) {
                $table->string('nama_penandatangan')->nullable();
            }
            if (!Schema::hasColumn('sk', 'jabatan_penandatangan')) {
                $table->string('jabatan_penandatangan')->nullable();
            }
            if (!Schema::hasColumn('sk', 'dasar_pengantar')) {
                $table->string('dasar_pengantar')->nullable();
            }
            if (!Schema::hasColumn('sk', 'tanggal_surat')) {
                $table->date('tanggal_surat')->nullable();
            }
            if (!Schema::hasColumn('sk', 'jabatan_ttd')) {
                $table->string('jabatan_ttd')->nullable();
            }
            if (!Schema::hasColumn('sk', 'nama_ttd')) {
                $table->string('nama_ttd')->nullable();
            }
            if (!Schema::hasColumn('sk', 'nip_ttd')) {
                $table->string('nip_ttd')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->dropColumn([
                'nama_penandatangan',
                'jabatan_penandatangan',
                'dasar_pengantar',
                'tanggal_surat',
                'jabatan_ttd',
                'nama_ttd',
                'nip_ttd',
            ]);
        });
    }
}; 