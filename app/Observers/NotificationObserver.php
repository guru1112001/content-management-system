<?php

namespace App\Observers;

use App\Models\Notification;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Auth;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     */
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }
    public function created(Notification $notification): void
    {
        $title = $notification->data['title'];
        // $user = Auth::user();
        $deviceToken='d4Hf6AUwSM-B7-NqqzRUVR:APA91bEFF5gd-iglcykQ_-iUuYOzSGFZvn7mlRnd3nZyd18RZC5nW4HLxSK-kqwWo6bvCdCsdQzYQJQcL9NjvPFVHYB4r3ABKUMgJiXjb73n-KoVKwc5eDLFwBaZyBq7CIIq5-8Vn-wr';
        // dd($deviceToken);
        $body='this is body';
        // $this->firebaseService->sendNotification($deviceToken, $title, $body);
       
    }

    /**
     * Handle the Notification "updated" event.
     */
    public function updated(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     */
    public function deleted(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     */
    public function restored(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     */
    public function forceDeleted(Notification $notification): void
    {
        //
    }
}
