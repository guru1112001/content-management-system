<?php

namespace App\Filament\Imports;

use App\Models\Attendance;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AttendanceImporter extends Importer
{
    protected static ?string $model = Attendance::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('User')
            ->relationship()
            ->example('User -> 1'),

            ImportColumn::make('calendar')
            ->relationship()
            ->example('calendar id -> 1'),


            ImportColumn::make('attendance_by')
            ->requiredMapping()
            ->rules(['required', 'max:25'])
            ->example('tutor'),
            
        
        ImportColumn::make('status')
            ->requiredMapping()
            // ->rules('required')
            ->example('pending,present,absent'),
        
        
        ];
    }

    public function resolveRecord(): ?Attendance
    {
        // return Attendance::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Attendance();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your attendance import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
