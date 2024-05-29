<?php

namespace App\Observers;

use App\Models\Leave;
use App\Enums\LeaveStatus;
use Filament\Notifications\Notification;

class LeaveObserver
{
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {
        if ( $leave->status === LeaveStatus::Approved){
        Notification::make()
        ->title('leave approved successfully')
        ->success()
        ->sendToDatabase($leave->user);
        }
    }

    /**
     * Handle the Leave "deleted" event.
     */
    public function deleted(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "restored" event.
     */
    public function restored(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "force deleted" event.
     */
    public function forceDeleted(Leave $leave): void
    {
        //
    }
}
