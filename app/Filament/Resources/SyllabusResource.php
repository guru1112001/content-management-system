<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Syllabus;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\SyllabusResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SyllabusResource\RelationManagers;

class SyllabusResource extends Resource
{
    protected static ?string $model = Syllabus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('Day')
                ->label('Days')
                ->options(array_combine(range(1, 1000), range(1, 1000)))
                ->hiddenon('edit'),
                
                Select::make('Batch_id')
                ->label('Batch')
                ->relationship('batch','name')
                ->hiddenon('edit'),

                Select::make('Course_id')
                ->label('course')
                ->relationship('course','name')
                ->hiddenon('edit'),

                TextInput::make('Syllabus'),
                
                TextInput::make('SSTA')
                ->label('Topics and Sub topics'),


                Select::make('user_id')
                ->label('tutor')
                ->relationship('tutor','name')
                ->hiddenon('edit'),
                
                DateTimePicker::make('Date')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->firstDayOfWeek(7)
                    ->closeOnDateSelection()
                    ->minDate(today())
                    ->reactive()
                    ->hiddenon('edit'),
                
                Select::make('Status')
                ->options([
                    'Not Completed' => 'Not Completed',
                    'Completed' => 'Completed',
                ])
                ->hiddenon('edit'),
                Textarea::make('Comments')
                ->hiddenon(['create', 'edit'])

                
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Day')
            ->label('Day'), 
            TextColumn::make('Syllabus') 
            ->label('Syllabus'),

            TextColumn::make('SSTA') 
            ->label('Topics and Sub topics'),

            TextColumn::make('tutor.name') 
            ->label('Tutor'),

            TextColumn::make('Date')
            ->date()
            ->label('Date'),

            SelectColumn::make('Status')
            ->options([
                'Not Completed' => 'Not Completed',
                'Completed' => 'Completed',
            ])
            ,
        TextInputColumn::make('Comments')
        ->label('Comments')
        // ->visible(fn ($record) => $record && $record->Status === 'Completed')

                // ->getStateUsing(function ($record) {
        //     return $record->Status !== 'Completed' ? $record->Comments : null;
        // }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ReplicateAction::make()
                
               
                
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
            'index' => Pages\ListSyllabi::route('/'),
            'create' => Pages\CreateSyllabus::route('/create'),
            // 'edit' => Pages\EditSyllabus::route('/{record}/edit'),
        ];
    }
}
