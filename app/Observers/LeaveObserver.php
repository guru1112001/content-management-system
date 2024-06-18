<?php

namespace App\Observers;

use App\Models\Leave;
use App\Enums\LeaveStatus;
use App\Services\FirebaseService;
use Filament\Notifications\Notification;

class LeaveObserver
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        
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
        $deviceToken=$leave->user->fcm_token;
        $body = 'You have a new notification!';
        $title='leave approved successfully';
        
        
        // $this->firebaseService->sendNotification($deviceToken, $title, $body);
        // dd('Sending notification', ['deviceToken' => $deviceToken, 'title' => $title, 'body' => $body]);
        }



        elseif ( $leave->status === LeaveStatus::Declined){
            Notification::make()
            ->title('Your leave has been declined')
            ->danger()
            ->sendToDatabase($leave->user);
            $deviceToken=$leave->user->fcm_token;
            $body = 'You have a new notification!';
            $title='Your leave has been declined';
            
            
            // $this->firebaseService->sendNotification($deviceToken, $title, $body);
            // dd('Sending notification', ['deviceToken' => $deviceToken, 'title' => $title, 'body' => $body]);
            
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
