<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ItemResource\RelationManagers;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('branch.name')->label('Branch'),
                TextColumn::make('batch.name')->label('Batch'),
                TextColumn::make('subject')->label('Subject'),
                TextColumn::make('classroom.name')->label('Classroom'),
                TextColumn::make('tutor.name')->label('Tutor'),
                TextColumn::make('start_time')->label('from')->sortable()->dateTime(),
                TextColumn::make('end_time')->label('to')->sortable()->dateTime(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
