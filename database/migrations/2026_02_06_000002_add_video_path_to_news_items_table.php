<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->string('video_path', 255)->nullable()->after('youtube_url');
        });
    }

    public function down(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->dropColumn('video_path');
        });
    }
};

