<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            if (!Schema::hasColumn('sdu', 'keperluan')) {
                $table->string('keperluan')->nullable()->after('nama_usaha');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            $table->dropColumn('keperluan');
        });
    }
}; 