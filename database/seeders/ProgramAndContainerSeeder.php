<?php

namespace Database\Seeders;

use App\Enums\FixateContainer;
use App\Enums\GutProtocolContainer;
use App\Models\Container;
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

    }
}
