<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('wartas')) {
            Schema::table('wartas', function (Blueprint $table) {
                $table->string('title', 200)->nullable()->change();
            });
        }

        if (Schema::hasTable('event_items')) {
            Schema::table('event_items', function (Blueprint $table) {
                $table->string('title', 150)->nullable()->change();
            });
        }

        if (Schema::hasTable('gallery_items')) {
            Schema::table('gallery_items', function (Blueprint $table) {
                $table->string('title')->nullable()->change();
                $table->string('image_path')->nullable()->change();
            });
        }

        if (Schema::hasTable('hamba_tuhans')) {
            Schema::table('hamba_tuhans', function (Blueprint $table) {
                $table->string('name', 160)->nullable()->change();
            });
        }

        if (Schema::hasTable('media_items')) {
            Schema::table('media_items', function (Blueprint $table) {
                $table->string('title', 200)->nullable()->change();
                $table->string('youtube_url', 255)->nullable()->change();
            });
        }

        if (Schema::hasTable('cabangs')) {
            Schema::table('cabangs', function (Blueprint $table) {
                $table->string('name', 160)->nullable()->change();
                $table->text('about')->nullable()->change();
            });
        }

        if (Schema::hasTable('renungan_items')) {
            Schema::table('renungan_items', function (Blueprint $table) {
                $table->string('title', 180)->nullable()->change();
                $table->string('scripture_reference', 180)->nullable()->change();
                $table->string('author', 120)->nullable()->default(null)->change();
                $table->text('excerpt')->nullable()->change();
                $table->longText('content')->nullable()->change();
                $table->string('image_path', 255)->nullable()->change();
                $table->date('published_at')->nullable()->change();
            });
        }

        if (Schema::hasTable('bidang_pelayanans')) {
            $hasServiceYear = Schema::hasColumn('bidang_pelayanans', 'service_year');

            Schema::table('bidang_pelayanans', function (Blueprint $table) use ($hasServiceYear) {
                $table->string('name', 160)->nullable()->change();
                $table->text('description')->nullable()->change();
                if ($hasServiceYear) {
                    $table->unsignedSmallInteger('service_year')->nullable()->default(null)->change();
                }
            });
        }
    }

    public function down(): void
    {
        // The previous schema mixed required identity fields with optional content.
        // Keeping rollback empty avoids breaking existing rows that now intentionally
        // contain blank/null admin-entered content.
    }
};
