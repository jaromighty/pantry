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
        Schema::dropIfExists('meal_meal_plan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('meal_meal_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('meal_plan_id');
        });
    }
};
