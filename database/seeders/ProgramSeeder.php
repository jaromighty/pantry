<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = ['Fixate', 'Gut Protocol'];

        foreach ($programs as $program) {
            Program::create([
                'name' => $program,
            ]);
        }
    }
}
