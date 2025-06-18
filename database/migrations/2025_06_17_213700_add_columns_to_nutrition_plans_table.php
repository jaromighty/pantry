<?php

use App\Models\NutritionProgram;
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
        Schema::table('nutrition_plans', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->json('container_counts')->after('name');
            $table->foreignIdFor(NutritionProgram::class)
                ->after('container_counts')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nutrition_plans', function (Blueprint $table) {
            $table->dropForeign('nutrition_plans_nutrition_program_id_foreign');
            $table->dropColumn('name');
            $table->dropColumn('nutrition_program_id');
            $table->dropColumn('container_counts');
        });
    }
};
