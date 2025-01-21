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
        Schema::table('messages', function (Blueprint $table) {
            $table->string('phone');
            $table->string('city');

            $table->string('gender')->nullable();
            $table->string('age')->nullable();

            $table->string('agency')->nullable();
            $table->string('visitor_size')->nullable();
            $table->date('visit_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['phone', 'city', 'gender', 'age', 'agency', 'visitor_size', 'visit_date']);
        });
    }
};
