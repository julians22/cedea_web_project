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
        Schema::table('post_recipes', function (Blueprint $table) {
            $table->string('featured_image')->nullable();
        });
        Schema::table('post_news', function (Blueprint $table) {
            $table->string('featured_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_recipes', function (Blueprint $table) {
            $table->dropColumn('featured_image');
        });
        Schema::table('post_news', function (Blueprint $table) {
            $table->dropColumn('featured_image');
        });
    }
};