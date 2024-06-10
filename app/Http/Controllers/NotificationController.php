<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'device_token' => 'required|string',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $deviceToken = $request->input('device_token');
        $title = $request->input('title');
        $body = $request->input('body');

        $this->firebaseService->sendNotification($deviceToken, $title, $body);

        return response()->json(['message' => 'Notification sent successfully']);
    }
    public function index()
    {
        $user=Auth::user();
        $notifications=Notification::where('notifiable_id',$user->id)->get();

        return NotificationResource::collection($notifications);
    }
}
