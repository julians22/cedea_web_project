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
            $table->longText('content')->change();
        });

        Schema::table('post_recipes', function (Blueprint $table) {
            $table->longText('content')->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->longText('description')->change();
            $table->text('name')->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->text('title')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
