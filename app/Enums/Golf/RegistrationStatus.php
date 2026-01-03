<?php

namespace App\Enums\Golf;

enum RegistrationStatus: string
{
    case Registered = 'registered';
    case Waitlist = 'waitlist';
    case Cancelled = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::Registered => 'Registered',
            self::Waitlist => 'Waitlist',
            self::Cancelled => 'Cancelled',
        };
    }
}
