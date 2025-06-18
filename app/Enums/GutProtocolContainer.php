<?php

namespace App\Enums;

enum GutProtocolContainer
{
    case BLUE;
    case GRAY;
    case GREEN;
    case ORANGE;
    case PURPLE;
    case RED_A;
    case RED_B;
    case YELLOW_A;
    case YELLOW_B;

    public function name(): string
    {
        return match ($this) {
            GutProtocolContainer::BLUE => 'blue',
            GutProtocolContainer::GRAY => 'gray',
            GutProtocolContainer::GREEN => 'green',
            GutProtocolContainer::ORANGE => 'orange',
            GutProtocolContainer::PURPLE => 'purple',
            GutProtocolContainer::RED_A => 'red_a',
            GutProtocolContainer::RED_B => 'red_b',
            GutProtocolContainer::YELLOW_A => 'yellow_a',
            GutProtocolContainer::YELLOW_B => 'yellow_b',
        };
    }

    public function fromName(string $name): GutProtocolContainer
    {
        return match ($name) {
            'blue' => GutProtocolContainer::BLUE,
            'gray' => GutProtocolContainer::GRAY,
            'green' => GutProtocolContainer::GREEN,
            'orange' => GutProtocolContainer::ORANGE,
            'purple' => GutProtocolContainer::PURPLE,
            'red_a' => GutProtocolContainer::RED_A,
            'red_b' => GutProtocolContainer::RED_B,
            'yellow_a' => GutProtocolContainer::YELLOW_A,
            'yellow_b' => GutProtocolContainer::YELLOW_B,
        };
    }
}
