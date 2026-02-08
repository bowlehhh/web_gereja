<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wartas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->date('date')->nullable();
            $table->string('edition', 50)->nullable();

            $table->string('thumbnail_path')->nullable();
            $table->string('pdf_path')->nullable();

            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wartas');
    }
};
