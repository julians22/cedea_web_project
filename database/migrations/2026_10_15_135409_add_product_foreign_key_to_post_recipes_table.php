<?php

use App\Models\PostRecipes;
use App\Models\Products\Product;
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
        PostRecipes::query()
            ->whereNotNull('product_id')
            ->whereNotIn('product_id', Product::query()->select('id'))
            ->update(['product_id' => null]);

        Schema::table('post_recipes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_recipes', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
};
