<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cabangs', function (Blueprint $table) {
            $table->string('address', 255)->nullable()->after('city');
            $table->string('email', 190)->nullable()->after('address');
            $table->string('phone', 60)->nullable()->after('email');
            $table->string('pastor', 160)->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('cabangs', function (Blueprint $table) {
            $table->dropColumn(['address', 'email', 'phone', 'pastor']);
        });
    }
};

