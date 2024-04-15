<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Name'),
            TextInput::make('email')
                ->label('Email'),
                TextInput::make('password')
                ->password()
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->revealable(),
            TextInput::make('resume')
                ->label('Resume'),
            TextInput::make('id_card')
                ->label('ID Card'),
            Textarea::make('info')
                ->label('Info'),
                Repeater::make('edu_docs')
                ->schema([
                    TextInput::make('document')
                    
                        ->required(),
                ])
                ->columns(2),
            FileUpload::make('photo')
                ->label('photo')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name'),
                TextColumn::make('email')
                    ->label('Email'),
                // Exclude the password field from the table
                // Components\Text::make('password')
                //     ->label('Password'),
                TextColumn::make('resume')
                    ->label('Resume'),
                TextColumn::make('id_card')
                    ->label('ID Card'),
                TextColumn::make('info')
                    ->label('Info'),
                // Exclude the edu_docs field from the table
                // Components\Text::make('edu_docs')
                //     ->label('Edu Docs'),
                // Exclude the photo field from the table
                // Components\Text::make('photo')
                //     ->label('Photo'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
