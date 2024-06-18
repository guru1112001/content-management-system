<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use App\Filament\Clusters\pages;

class EditUser extends EditRecord

{
 
protected static ?string $cluster = pages::class;
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
    ];
    }
}
