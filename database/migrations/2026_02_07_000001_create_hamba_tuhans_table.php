<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hamba_tuhans', function (Blueprint $table) {
            $table->id();

            $table->string('name', 160);
            $table->string('slug', 180)->unique();

            $table->string('photo_path')->nullable();

            // short text shown under name (card)
            $table->string('roles_summary', 255)->nullable();
            $table->string('contact', 120)->nullable();

            // detail page
            $table->text('profile')->nullable();
            $table->text('service_fields')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hamba_tuhans');
    }
};

