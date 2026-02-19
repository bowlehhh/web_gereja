<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('majelis_periods', function (Blueprint $table) {
            $table->id();
            $table->string('period', 120)->unique();
            $table->string('thumbnail_path')->nullable();
            $table->json('gallery_paths')->nullable();
            $table->text('about')->nullable();
            $table->text('service')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('majelis_periods');
    }
};
