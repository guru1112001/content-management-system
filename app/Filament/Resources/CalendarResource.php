<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Calendar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\CalendarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CalendarResource\RelationManagers;

class CalendarResource extends Resource
{
    protected static ?string $model = Calendar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                BelongsToSelect::make('branch_id')->relationship('branch', 'name')->label('Branch'),

                BelongsToSelect::make('batch_id')->relationship('batch', 'name')->label('Batch'),
                
                BelongsToSelect::make('tutor_id')->relationship('tutor', 'name')->label('Tutor'),
                
                TextInput::make('subject')->label('Subject'),
            
                BelongsToSelect::make('classroom_id')->relationship('classroom', 'name')->label('Classroom'),
                DateTimePicker::make('start_time')->label('Start Time'),
                DateTimePicker::make('end_time')->label('End Time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->relationship('holidays')
            ->columns([
                TextColumn::make('branch.name')->label('Branch'),
                TextColumn::make('tutor.name')->label('Tutor'),
                TextColumn::make('batch.name')->label('Batch'),
                TextColumn::make('subject')->label('Subject'),
                TextColumn::make('classroom.name')->label('Classroom'),
                TextColumn::make('start_time')->label('Start Time')->sortable()->dateTime(),
                TextColumn::make('end_time')->label('End Time')->sortable()->dateTime(),
                TextColumn::make('end_time')->label('End Time')->sortable()->dateTime(),

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
            'index' => Pages\ListCalendars::route('/'),
            'create' => Pages\CreateCalendar::route('/create'),
            'edit' => Pages\EditCalendar::route('/{record}/edit'),
        ];
    }
}
