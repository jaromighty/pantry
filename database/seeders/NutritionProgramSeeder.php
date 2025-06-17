<?php

namespace Database\Seeders;

use App\Models\NutritionProgram;
use Illuminate\Database\Seeder;

class NutritionProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NutritionProgram::create([
            'name' => 'Ultimate Portion Fix',
        ]);
    }
}
