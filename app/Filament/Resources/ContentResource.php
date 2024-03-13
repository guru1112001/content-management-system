<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Content;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Filament\Components\UploadFile;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\ContentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContentResource\RelationManagers;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('folder_id')
                    ->relationship('folder', 'name'), // Assuming the Folder model has a 'name' attribute
                TextInput::make('file_name')
                    ->required(),
                FileUpload::make('file_path')
                    ->disk('public') // Make sure to configure your filesystems correctly
                    ->directory('content_files') // Directory within your disk
                    ->required(),
                Toggle::make('published'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('folder.name')
            ->sortable()->searchable(),
            TextColumn::make('file_name')
            ->sortable()->searchable(),
            TextColumn::make('file_path')
            ->sortable()->searchable(),
            ToggleColumn::make('published'),
                      
             ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->url(fn (Content $record): string => route('download.file', ['content' => $record->id])),
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->url(function (Content $record): string {
                    return route('download.file', ['content' => $record->id]) . '?preview=true';
                        }   ) ])
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
