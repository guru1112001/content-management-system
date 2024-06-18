<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
// use App\Filament\Clusters\pages;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    // protected static ?string $cluster = pages::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
