<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\QuestionBank;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionBankResource\Pages;
use App\Filament\Resources\QuestionBankResource\RelationManagers;

class QuestionBankResource extends Resource
{
    protected static ?string $model = QuestionBank::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        
            ->schema([
                Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Add Questions')
                        ->schema([
            
           
                Repeater::make('questions')
                    ->relationship('questions')
                    ->schema([
                        Select::make('question_bank_type_id')
                        ->relationship('type', 'name')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            $defaultItems = match($state) {
                                    '1' => 4,
                                    '2' => 4,
                                    '3' => 1,
                                    '4' => 2,
                                    default => 1,
                                };
                                $set('options', array_fill(1, $defaultItems, [
                                    'option_text' => '',
                                    'is_correct' => false,
                                ]));
                            }),
                        MarkdownEditor::make('question_text')
                        ->label('Question')
                        ->required(),
                        TextInput::make('marks')
                        ->required(),
                        TextInput::make('negative_marks')
                        ->required(),
                        Repeater::make('options')
                        ->relationship('options')
                        ->schema([
                        MarkdownEditor::make('option_text')
                        ->label('Option')
                        ->required(),
                        Checkbox::make('is_correct')
                        ->label('Correct Answer'),
                    ])
                        ->defaultItems(4)
                        ->createItemButtonLabel('Add Option')
                        ->visible(function (callable $get) {
                            return in_array($get('question_bank_type_id'), ['1', '2','3', '4']);
                        }),
                        ])->createItemButtonLabel('Add Question')   
                ])->hiddenOn('create'),
            Tabs\Tab::make('Question Bank Details')
            ->schema([
                    TextInput::make('name')
                    
                    ->required(),
                    TextInput::make('Chapters')
                    ,
                    Select::make('curriculum_id')
                    ->relationship('curriculum', 'name')
                    ,
                    Select::make('question_bank_difficulty_id')
                    ->relationship('difficulty', 'name')
                    ,
                    TextInput::make('short_description')
                    ,
                    Select::make('question_bank_type_id')
                    ->relationship('type', 'name')
                    ->required(),
                ])->columns(2),
             ]),
        ])->columns(1);
            }

            public static function table(Table $table): Table
            {
                return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('Chapters')->sortable()->searchable(),
                TextColumn::make('subject.name')->label('Subject')->sortable(),
                TextColumn::make('type.name')->label('Type')->sortable(),
                TextColumn::make('difficulty.name')->label('Difficulty')->sortable(),
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
            'index' => Pages\ListQuestionBanks::route('/'),
            // 'create' => Pages\CreateQuestionBank::route('/create'),
            // 'edit' => Pages\EditQuestionBank::route('/{record}/edit'),
        ];
    }
}
