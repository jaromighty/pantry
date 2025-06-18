<?php

namespace App\Enums;

enum FixateContainer
{
    case BLUE;
    case GRAY;
    case GREEN;
    case ORANGE;
    case PURPLE;
    case RED;
    case YELLOW;

    public function name(): string
    {
        return match ($this) {
            FixateContainer::BLUE => 'blue',
            FixateContainer::GRAY => 'gray',
            FixateContainer::GREEN => 'green',
            FixateContainer::ORANGE => 'orange',
            FixateContainer::PURPLE => 'purple',
            FixateContainer::RED => 'red',
            FixateContainer::YELLOW => 'yellow',
        };
    }

    public function fromName(string $name): FixateContainer
    {
        return match ($name) {
            'blue' => FixateContainer::BLUE,
            'gray' => FixateContainer::GRAY,
            'green' => FixateContainer::GREEN,
            'orange' => FixateContainer::ORANGE,
            'purple' => FixateContainer::PURPLE,
            'red' => FixateContainer::RED,
            'yellow' => FixateContainer::YELLOW,
        };
    }

    public function label(): string
    {
        return match ($this) {
            FixateContainer::BLUE => 'Healthy Fats',
            FixateContainer::GRAY => 'Oils & Nut Butters',
            FixateContainer::GREEN => 'Vegetables',
            FixateContainer::ORANGE => 'Seeds & Dressings',
            FixateContainer::PURPLE => 'Fruits',
            FixateContainer::RED => 'Proteins',
            FixateContainer::YELLOW => 'Carbohydrates',
        };
    }
}
