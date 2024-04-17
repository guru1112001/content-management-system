<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum LeaveStatus: string implements HasColor, HasLabel
{
    case Pending = 'Pending';

    case Declined = 'declined';

    case Approved = 'approved';


    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Declined => 'Declined',
            self::Approved => 'Approved',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Declined => 'danger',
        };
    }
}