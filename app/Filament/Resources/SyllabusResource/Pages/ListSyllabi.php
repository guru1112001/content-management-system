<?php

namespace App\Filament\Resources\SyllabusResource\Pages;

use App\Filament\Resources\SyllabusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSyllabi extends ListRecords
{
    protected static string $resource = SyllabusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
