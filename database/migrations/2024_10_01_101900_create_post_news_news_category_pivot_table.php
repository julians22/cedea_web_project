<?php

use App\Models\NewsCategory;
use App\Models\PostNews;
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
        Schema::create('post_news_news_category', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PostNews::class);
            $table->foreignIdFor(NewsCategory::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_news_news_category');
    }
};
