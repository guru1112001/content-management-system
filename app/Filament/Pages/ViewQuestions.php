<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\QuestionBank;

class ViewQuestions extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-questions';
    public QuestionBank $questionBank;

    public function mount(QuestionBank $questionBank)
    {
        $this->questionBank = $questionBank;
        $this->data = [
            'questionBank' => $this->questionBank,
        ];
    }
    // protected static function shouldRegisterNavigation(): bool
    // {
    //     return false;
    // }
    // public function render()
    // {
    //     return view(static::$view, ['questionBank' => $this->questionBank]);
    // }
}
