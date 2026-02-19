<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();

            $table->string('title', 200);
            $table->string('speaker', 150)->nullable();
            $table->dateTime('service_at')->nullable();

            $table->string('youtube_url', 255);
            $table->string('youtube_id', 32)->nullable();

            $table->string('thumbnail_path')->nullable();
            $table->boolean('is_published')->default(true);

            $table->timestamps();

            $table->index(['is_published', 'service_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};

