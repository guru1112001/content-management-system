<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AttendanceStatus: string implements HasColor, HasLabel
{
    case PRESENT = 'present';

    case ABSENT = 'absent';

    case PENDING = 'pending';


    public function getLabel(): string
    {
        return match ($this) {
            self::PRESENT => 'present',
            self::ABSENT => 'absent',
            self::PENDING => 'pending',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PRESENT => 'success',
            self::ABSENT => 'danger',
        };
    }
}