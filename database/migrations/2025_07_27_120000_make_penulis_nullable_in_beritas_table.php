<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('beritas', 'penulis')) {
            Schema::table('beritas', function (Blueprint $table) {
                $table->string('penulis')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Tidak perlu rollback, biarkan tetap nullable
    }
}; 