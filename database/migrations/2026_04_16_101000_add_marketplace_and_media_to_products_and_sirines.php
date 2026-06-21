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
        Schema::table('products', function (Blueprint $table) {
            $table->string('tiktokshop_url', 2048)->nullable()->after('shopee_url');
            $table->string('tokopedia_url', 2048)->nullable()->after('tiktokshop_url');
            $table->json('gallery_images')->nullable()->after('image');
            $table->json('gallery_videos')->nullable()->after('gallery_images');
        });

        Schema::table('sirines', function (Blueprint $table) {
            $table->string('tiktokshop_url', 2048)->nullable()->after('shopee_url');
            $table->string('tokopedia_url', 2048)->nullable()->after('tiktokshop_url');
            $table->json('gallery_images')->nullable()->after('image');
            $table->json('gallery_videos')->nullable()->after('gallery_images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'tiktokshop_url',
                'tokopedia_url',
                'gallery_images',
                'gallery_videos',
            ]);
        });

        Schema::table('sirines', function (Blueprint $table) {
            $table->dropColumn([
                'tiktokshop_url',
                'tokopedia_url',
                'gallery_images',
                'gallery_videos',
            ]);
        });
    }
};
