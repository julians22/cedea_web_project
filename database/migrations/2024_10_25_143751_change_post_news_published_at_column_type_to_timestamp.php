<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('post_news', function (Blueprint $table) {
            DB::statement('ALTER TABLE `post_news` CHANGE `published_at` `published_at` TIMESTAMP NULL DEFAULT NULL;');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_news', function (Blueprint $table) {
            DB::statement('ALTER TABLE `post_news` CHANGE `published_at` `published_at` DATE NULL DEFAULT NULL;');
        });
    }
};
