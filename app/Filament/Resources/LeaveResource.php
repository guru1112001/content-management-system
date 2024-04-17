<?php

namespace App\Filament\Resources;
use Filament\Forms;
use Filament\Tables;
use App\Models\Leave;
use Filament\Forms\Form;
use App\Enums\LeaveStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\LeaveResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LeaveResource\RelationManagers;

class LeaveResource extends Resource
{
    
    protected static ?string $model = Leave::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {  $loggedInUser = Auth::user();
        $isAdmin = $loggedInUser->isAdmin();
        return $form

            ->schema([
                TextInput::make('Student')
                ->default($loggedInUser->name)
                ->readOnly(),
                TextInput::make('user_id')->default($loggedInUser->id)->numeric()->readOnly(),
                // BelongsToSelect::make('user_id')->relationship('user', 'id')->default($loggedInUser->id)->readOnly(),
                // TextInput::make('Student')->default("$loggedInUser->name")->disabledOn($isAdmin ? [] : ['edit','view'])->disabled(!$isAdmin),
                DatePicker::make('start_date')->disabledOn($isAdmin ? [] : ['edit']),
                DatePicker::make('end_date')->disabledOn($isAdmin ? [] : ['edit']),
                Textarea::make('reason')->disabledOn($isAdmin ? [] : ['edit']),
                
                ToggleButtons::make('status')
                ->default('Pending')
                ->inline()
                ->visible(fn ($record) => $loggedInUser->isAdmin())
                ->disabledOn($isAdmin ? [] : ['edit'])
                ->options(LeaveStatus::class)
                

                
            ]);
    }
    

    public static function table(Table $table): Table
    { $loggedInUser = Auth::user();
        return $table
            ->columns([
                // TextColumn::make('Student')->label('Student-Name'),
                TextColumn::make('Student')
                ->label('student Name'),
                // ->default(fn (Leave $leave) => $leave->user->name),
                TextColumn::make('start_date')->label('Start Date')->dateTime(),
                TextColumn::make('end_date')->label('End Date')->dateTime(),
                TextColumn::make('reason')->label('Reason'),
                TextColumn::make('status')->label('Status')->badge()->default('Pending'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn ($record) => $loggedInUser->isAdmin()),
                ViewAction::make()
                        ->form([
                            TextInput::make('user_id'),
                            TextInput::make('Student'),
                            DatePicker::make('start_date'),
                            DatePicker::make('end_date'),
                            Textarea::make('reason'),
                            ToggleButtons::make('status')->default('Pending')
                            ->inline()
                            ->options(LeaveStatus::class)
                            ->required(),
                                
                        ]),
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
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }
    // /** @return Forms\Components\Component[] */
    // public static function getDetailsFormSchema(): array
    // {
    //     return [
    //         TextInput::make('employee_name')
    //             ->disabled()
    //             ->dehydrated()
    //             ->required()
    //             // ->maxLength(32)
    //             // ->unique(Order::class, 'number', ignoreRecord: true)
    //     ];
    // }
}
