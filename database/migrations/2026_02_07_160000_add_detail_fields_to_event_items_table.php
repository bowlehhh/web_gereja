<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_items', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('description');

            // optional main photo for detail page
            $table->string('photo_path')->nullable()->after('thumbnail_path');

            // optional video (upload) or youtube url
            $table->string('video_path')->nullable()->after('photo_path');
            $table->string('youtube_url', 255)->nullable()->after('video_path');
        });
    }

    public function down(): void
    {
        Schema::table('event_items', function (Blueprint $table) {
            $table->dropColumn(['content', 'photo_path', 'video_path', 'youtube_url']);
        });
    }
};

