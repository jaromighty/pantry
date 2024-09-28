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
            $table->unsignedBigInteger('unit_id')->after('recipe_id');
            $table->unsignedBigInteger('quantity')->after('unit_id');
            $table->string('notes')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient_recipe', function (Blueprint $table) {
            $table->dropColumn('unit_id');
            $table->dropColumn('quantity');
            $table->dropColumn('notes');
        });
    }
};
