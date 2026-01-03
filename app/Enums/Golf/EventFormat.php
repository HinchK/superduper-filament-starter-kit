<?php

namespace App\Enums\Golf;

enum EventFormat: string
{
    case StrokePlay = 'stroke_play';
    case Scramble = 'scramble';
    case Stableford = 'stableford';

    public function getLabel(): string
    {
        return match ($this) {
            self::StrokePlay => 'Stroke Play',
            self::Scramble => 'Scramble',
            self::Stableford => 'Stableford',
        };
    }
}
