<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('renungan_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->string('slug', 220)->unique();
            $table->string('scripture_reference', 180);
            $table->string('author', 120)->default('Ibu Gembala');
            $table->text('excerpt');
            $table->longText('content');
            $table->string('image_path', 255);
            $table->date('published_at');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'published_at']);
            $table->index(['sort_order', 'id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('renungan_items');
    }
};

