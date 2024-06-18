<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum FeatureStatus: string implements  HasLabel
{
    case Full_Access = 'Full_Access';

    case Restricted_Access = 'Restricted_Access';

    case No_Access = 'No_Access';
   

    public function getLabel(): string
    {
        return match ($this) {
            self::Full_Access => 'Full_Access',
            self::Restricted_Access => 'Restricted_Access',
            self::No_Access => 'No_Access',
        };
    }

    // public function getColor(): string | array | null
    // {
    //     return match ($this) {
    //         self::PENDING => 'warning',
    //         self::PRESENT => 'success',
    //         self::ABSENT => 'danger',
    //     };
    // }
}