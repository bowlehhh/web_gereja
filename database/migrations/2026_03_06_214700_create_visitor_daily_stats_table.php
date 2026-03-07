<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_daily_stats', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date')->unique();
            $table->unsignedBigInteger('visitor_count')->default(0);
            $table->timestamps();

            $table->index('visit_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_daily_stats');
    }
};
