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
        Schema::table('post_news', function (Blueprint $table) {
            $table->json('excerpt')->nullable();
            $table->date('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_news', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'published_at']);
        });
    }
};
