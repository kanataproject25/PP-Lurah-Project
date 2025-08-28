<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            if (Schema::hasColumn('sk', 'pekerjaan')) {
                $table->dropColumn('pekerjaan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sk', function (Blueprint $table) {
            $table->string('pekerjaan')->nullable();
        });
    }
}; 