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
        Schema::table('ingredient_recipe', function (Blueprint $table) {
            $table->after('recipe_id', function (Blueprint $table) {
                $table->string('full_text');
                $table->unsignedBigInteger('unit_id');
                $table->unsignedFloat('quantity', 4)->nullable();
                $table->string('notes')->nullable();
                });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient_recipe', function (Blueprint $table) {
            $table->dropColumn('full_text');
            $table->dropColumn('unit_id');
            $table->dropColumn('quantity');
            $table->dropColumn('notes');
        });
    }
};
