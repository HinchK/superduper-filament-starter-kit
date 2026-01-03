<?php

namespace App\Enums\Golf;

enum EventStatus: string
{
    case Upcoming = 'upcoming';
    case Open = 'open';
    case Closed = 'closed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::Upcoming => 'Upcoming',
            self::Open => 'Open for Registration',
            self::Closed => 'Registration Closed',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }
}
