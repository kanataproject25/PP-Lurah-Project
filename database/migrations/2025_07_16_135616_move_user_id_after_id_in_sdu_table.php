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
        Schema::table('sdu', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Komentari agar tidak error
            // $table->modifyColumn('user_id')->after('id'); // Jika ada baris seperti ini, komentari juga
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu rollback posisi kolom
    }
};
