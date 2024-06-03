<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AttendanceStatus: string implements HasLabel
{
    case Completed = 'Completed';

    case NotCompleted = 'Not Completed';

    


    public function getLabel(): string
    {
        return match ($this) {
            self::Completed => 'Completed',
            self::NotCompleted => 'Not Completed',
            
        };
    }
}