<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Feature;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\FeatureStatus;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FeatureResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FeatureResource\RelationManagers;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Feature Name'),
                Select::make('super_admin')
                    ->options(FeatureStatus::class)
                    // ->required()
                    ->label('Super Admin'),
                Select::make('admin')
                ->options(FeatureStatus::class)
                    // ->required()
                    ->label('Admin'),
                Select::make('member')
                ->options(FeatureStatus::class)
                    // ->required()
                    ->label('Member'),
                Repeater::make('list_routes')
                ->schema([
                        TextInput::make('route')
                            // ->required()
                            ->label('Route'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Feature'),
                SelectColumn::make('super_admin')
                ->label('Super Admin')
                ->options(FeatureStatus::class),
                SelectColumn::make('admin')
                ->label('Admin')
                ->options(FeatureStatus::class),
                SelectColumn::make('member')
                ->label('Member')
                ->options(FeatureStatus::class),
                // TextColumn::make('list_routes')->label('List Routes')
                // ->getStateUsing(function ($record) {
                //     return is_array($record->list_routes) ? implode(', ', array_column($record->list_routes, 'route')) : $record->list_routes;
                // }),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
