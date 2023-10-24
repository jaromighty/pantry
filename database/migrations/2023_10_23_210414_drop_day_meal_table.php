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
        Schema::dropIfExists('day_meal');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('day_meal', function (Blueprint $table) {
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('meal_id');
        });
    }
};
