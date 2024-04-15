<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class MyCustomComponent extends MyProfileComponent
{
    protected string $view = "livewire.my-custom-component";

    //

    public array $data;

    public function mount()
    {
        // Load user data including 'resume' from the database
        $eduDocs = auth()->user()->edu_docs;
        $this->data = [
            'resume' => auth()->user()->resume, 
            'edu_docs' => [],
            'info'=>auth()->user()->info,
            'id_card'=>auth()->user()->id_card,




            
            // 'edu_docs' => collect($eduDocs)->map(function ($doc) {
            //     return ['document' => $doc['document']];
            // })->toArray(),
        ];


        // if (!empty($eduDocs)) {
        //     foreach ($eduDocs as $uuid => $doc) {
        //         foreach ($doc as $innerUuid => $innerDoc) {
        //             // Extract document information from nested objects
        //             $this->data['edu_docs'][] = [
        //                 'uuid' => $innerUuid, // Assuming UUID is needed for reference
        //                 'document' => $innerDoc['document'],
        //                 'file' => null, // Initialize file to null
        //             ];
        //         }
        //     }
        // }
        if(!empty($eduDocs)){

            foreach ($eduDocs as $doc) {
                $this->data['edu_docs'][] = [
                    'document' => $doc['document'],
                    // 'file' => isset($doc['file']) ? $doc['file'] : null,
                                ];
            }
        }
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('resume'),
                Repeater::make('edu_docs')
                ->schema([
                    TextInput::make('document')
                    
                        ->required(),
                    
                ]),
                Textarea::make('info')
                ->label('Info'),
                TextInput::make('id_card')
                
            ])
            ->statePath('data');
    }
    public function submit()
    {
        // Update the user's data with the form data
        auth()->user()->update([
            'resume' => $this->data['resume'],
            'edu_docs' => $this->data['edu_docs'],
            'info' => $this->data['info'],
            'id_card'=>$this->data['id_card']
        ]);

        // Redirect to the same page (refresh the Livewire component)
        // return redirect()->to('/current-page-url');
        // $currentPageUrl = URL::current();

    // Redirect to the same page
    // return redirect()->to($currentPageUrl);
    }
}