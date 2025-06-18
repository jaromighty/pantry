<?php

namespace Database\Seeders;

use App\Enums\FixateContainer;
use App\Enums\GutProtocolContainer;
use App\Models\Container;
use App\Models\NutritionPlan;
use App\Models\NutritionProgram;
use Illuminate\Database\Seeder;

class ProgramAndContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fixate = NutritionProgram::create(['name' => 'Fixate']);
        $gut = NutritionProgram::create(['name' => 'Gut Protocol']);

        $fixateContainers = [
            FixateContainer::GREEN->name() => FixateContainer::GREEN->label(),
            FixateContainer::PURPLE->name() => FixateContainer::PURPLE->label(),
            FixateContainer::RED->name() => FixateContainer::RED->label(),
            FixateContainer::YELLOW->name() => FixateContainer::YELLOW->label(),
            FixateContainer::BLUE->name() => FixateContainer::BLUE->label(),
            FixateContainer::ORANGE->name() => FixateContainer::ORANGE->label(),
            FixateContainer::GRAY->name() => FixateContainer::GRAY->label(),
        ];

        $gutContainers = [
            GutProtocolContainer::GREEN->name() => GutProtocolContainer::GREEN->label(),
            GutProtocolContainer::PURPLE->name() => GutProtocolContainer::PURPLE->label(),
            GutProtocolContainer::RED_A->name() => GutProtocolContainer::RED_A->label(),
            GutProtocolContainer::RED_B->name() => GutProtocolContainer::RED_B->label(),
            GutProtocolContainer::YELLOW_A->name() => GutProtocolContainer::YELLOW_A->label(),
            GutProtocolContainer::YELLOW_B->name() => GutProtocolContainer::YELLOW_B->label(),
            GutProtocolContainer::BLUE->name() => GutProtocolContainer::BLUE->label(),
            GutProtocolContainer::ORANGE->name() => GutProtocolContainer::ORANGE->label(),
            GutProtocolContainer::GRAY->name() => GutProtocolContainer::GRAY->label(),
        ];

        $containerIds = [];

        foreach ($fixateContainers as $name => $label) {
            $container = Container::create([
                'program_id' => $fixate->id,
                'name' => $name,
                'label' => $label,
            ]);
            $containerIds['Fixate'][$name] = $container->id;
        }

        foreach ($gutContainers as $name => $label) {
            $container = Container::create([
                'program_id' => $gut->id,
                'name' => $name,
                'label' => $label,
            ]);
            $containerIds['Gut Protocol'][$name] = $container->id;
        }

        // Fixate Nutrition Plans
        NutritionPlan::create([
            'name' => 'Plan A',
            'nutrition_program_id' => $fixate->id,
            'container_counts' => [
                FixateContainer::GREEN->name() => 4,
                FixateContainer::PURPLE->name() => 2,
                FixateContainer::RED->name() => 4,
                FixateContainer::YELLOW->name() => 2,
                FixateContainer::BLUE->name() => 1,
                FixateContainer::ORANGE->name() => 1,
                FixateContainer::GRAY->name() => 3,
            ],
        ]);

        NutritionPlan::create([
            'name' => 'Plan B',
            'nutrition_program_id' => $fixate->id,
            'container_counts' => [
                FixateContainer::GREEN->name() => 4,
                FixateContainer::PURPLE->name() => 3,
                FixateContainer::RED->name() => 4,
                FixateContainer::YELLOW->name() => 3,
                FixateContainer::BLUE->name() => 1,
                FixateContainer::ORANGE->name() => 1,
                FixateContainer::GRAY->name() => 4,
            ],
        ]);

        NutritionPlan::create([
            'name' => 'Plan E',
            'nutrition_program_id' => $fixate->id,
            'container_counts' => [
                FixateContainer::GREEN->name() => 7,
                FixateContainer::PURPLE->name() => 5,
                FixateContainer::RED->name() => 6,
                FixateContainer::YELLOW->name() => 5,
                FixateContainer::BLUE->name() => 1,
                FixateContainer::ORANGE->name() => 1,
                FixateContainer::GRAY->name() => 7,
            ],
        ]);

        NutritionPlan::create([
            'name' => 'Plan E',
            'nutrition_program_id' => $fixate->id,
            'container_counts' => [
                FixateContainer::GREEN->name() => 8,
                FixateContainer::PURPLE->name() => 5,
                FixateContainer::RED->name() => 7,
                FixateContainer::YELLOW->name() => 5,
                FixateContainer::BLUE->name() => 1,
                FixateContainer::ORANGE->name() => 1,
                FixateContainer::GRAY->name() => 8,
            ],
        ]);

        // Gut Protocol Nutrition Plans
        NutritionPlan::create([
            'name' => 'Plan A',
            'nutrition_program_id' => $gut->id,
            'container_counts' => [
                GutProtocolContainer::GREEN->name() => 6,
                GutProtocolContainer::PURPLE->name() => 2,
                GutProtocolContainer::RED_A->name() => 2,
                GutProtocolContainer::RED_B->name() => 2,
                GutProtocolContainer::YELLOW_A->name() => 1,
                GutProtocolContainer::YELLOW_B->name() => 1,
                GutProtocolContainer::BLUE->name() => 1,
                GutProtocolContainer::ORANGE->name() => 1,
                GutProtocolContainer::GRAY->name() => 3,
            ],
        ]);

        NutritionPlan::create([
            'name' => 'Plan B',
            'nutrition_program_id' => $gut->id,
            'container_counts' => [
                GutProtocolContainer::GREEN->name() => 6,
                GutProtocolContainer::PURPLE->name() => 2,
                GutProtocolContainer::RED_A->name() => 2,
                GutProtocolContainer::RED_B->name() => 2,
                GutProtocolContainer::YELLOW_A->name() => 2,
                GutProtocolContainer::YELLOW_B->name() => 1,
                GutProtocolContainer::BLUE->name() => 1,
                GutProtocolContainer::ORANGE->name() => 1,
                GutProtocolContainer::GRAY->name() => 4,
            ],
        ]);

        NutritionPlan::create([
            'name' => 'Plan E',
            'nutrition_program_id' => $gut->id,
            'container_counts' => [
                GutProtocolContainer::GREEN->name() => 9,
                GutProtocolContainer::PURPLE->name() => 3,
                GutProtocolContainer::RED_A->name() => 4,
                GutProtocolContainer::RED_B->name() => 3,
                GutProtocolContainer::YELLOW_A->name() => 2,
                GutProtocolContainer::YELLOW_B->name() => 2,
                GutProtocolContainer::BLUE->name() => 1,
                GutProtocolContainer::ORANGE->name() => 1,
                GutProtocolContainer::GRAY->name() => 7,
            ],
        ]);
    }
}
