<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_items', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->text('description')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('location', 150)->nullable();

            $table->string('thumbnail_path')->nullable();
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_items');
    }
};
