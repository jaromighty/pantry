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
        Schema::table('ingredients', function (Blueprint $table) {
            $table->string('container_type')->after('name')->nullable();
            $table->string('unit')->after('container_type')->nullable();
            $table->double('amount_per_container')->after('unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('container_type');
            $table->dropColumn('unit');
            $table->dropColumn('amount_per_container');
        });
    }
};
