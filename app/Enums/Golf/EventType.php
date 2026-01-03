<?php

namespace App\Enums\Golf;

enum EventType: string
{
    case Weekly = 'weekly';
    case Tournament = 'tournament';

    public function getLabel(): string
    {
        return match ($this) {
            self::Weekly => 'Weekly League',
            self::Tournament => 'Tournament',
        };
    }
}
