<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bidang_pelayanans') || Schema::hasColumn('bidang_pelayanans', 'service_year')) {
            return;
        }

        $defaultYear = (int) date('Y');

        Schema::table('bidang_pelayanans', function (Blueprint $table) use ($defaultYear) {
            $table->unsignedSmallInteger('service_year')->default($defaultYear);
        });

        DB::table('bidang_pelayanans')->whereNull('service_year')->update([
            'service_year' => $defaultYear,
        ]);
    }

    public function down(): void
    {
        if (!Schema::hasTable('bidang_pelayanans') || !Schema::hasColumn('bidang_pelayanans', 'service_year')) {
            return;
        }

        Schema::table('bidang_pelayanans', function (Blueprint $table) {
            $table->dropColumn('service_year');
        });
    }
};
