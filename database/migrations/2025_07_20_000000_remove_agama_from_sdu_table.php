<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            if (Schema::hasColumn('sdu', 'agama')) {
                $table->dropColumn('agama');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sdu', function (Blueprint $table) {
            $table->string('agama')->nullable();
        });
    }
}; 