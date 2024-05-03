<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Calendar;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\CalendarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CalendarResource\RelationManagers;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class CalendarResource extends Resource
{
    protected static ?string $model = Calendar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TableRepeater::make('items')
                 
            ->relationship()
            ->schema([
                Select::make('branch_id')
                    ->relationship('branch','name'),
                    // ->columnSpan([
                    //     'md' => 3,
                    // ]),

                Select::make('batch_id')
                ->columnSpan([
                    'md' => 3,
                ])
                    ->relationship('batch','name'),

                Select::make('tutor_id')
                    ->relationship('tutor','name'),

                Select::make('classroom_id')
                    ->relationship('classroom','name'),

                TextInput::make('subject')->label('Subject'),
                
                DateTimePicker::make('start_time')->label('Start Time'),

                DateTimePicker::make('end_time')->label('End Time'),
            ])
            ->reorderable()
            ->cloneable()
            ->collapsible()
            ->defaultItems(2)
            ->columnSpan('full')
                
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->relationship('holidays')
            ->columns([
                TextColumn::make('items.branch.name')->label('branch'),
                TextColumn::make('items.batch.name')->label('Batch'),
                TextColumn::make('items.subject')->label('Subject'),
                TextColumn::make('items.classroom.name')->label('Classroom'),
                TextColumn::make('items.tutor.name')->label('Tutor'),
                TextColumn::make('items.start_time')->label('from')->sortable(),
                TextColumn::make('items.end_time')->label('to')->sortable(),
                // TextColumn::make('end_time')->label('End Time')->sortable()->dateTime(),

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
            // 'edit' => Pages\EditCalendar::route('/{record}/edit'),
        ];
    }
}
