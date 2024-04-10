<?php
namespace App;
use Filament\Forms\Components\TextInput;

class PersonalInfo extends \Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo
{
    public array $only = ['name','resume', 'email'];

    public function getProfileFormSchema(): array
    {
        return [
        
            TextInput::make("resume")
                ->label("resume")
                ->columnSpanFull()
                ->hint("anything"),
            
        ];
    }
}
