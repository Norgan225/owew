<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video'])->default('image')->after('image_path');
            $table->string('video_url')->nullable()->after('media_type');
            $table->string('thumbnail_path')->nullable()->after('video_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'video_url', 'thumbnail_path']);
        });
    }
};
